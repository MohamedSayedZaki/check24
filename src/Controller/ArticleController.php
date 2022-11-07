<?php
namespace App\Src\Controller;

use PDO;
use App\Config\DB;
use App\Inc\Request;
use App\Inc\Session;
use App\Config\Route;
use App\Inc\Response;
use App\Src\Entity\Article;
use App\Inc\Builders\QueryBuilder;
use App\Src\Repository\ArticleRepository;

class ArticleController
{
    /**
     * Find and get article by id 
    */
    public function getArticle($request)
    {
        #check if user logged in
        $session = new Session();
        if(empty($session::getSessionParam('username')) && $session::getSessionParam('is_loggedin') != 1){
            Route::redirect('auth/login/');
            exit;        
        }
        $article = $this->getRepo()->getArticle($request->getId());

        return Response::view('article/single',['article'=>$article]);
    }

    /**
     * @return article form view
    */
    public function createArticle()
    {
        # create csrf token and send it to login form
        $session = new Session();
        if(empty($session::getSessionParam('username')) && $session::getSessionParam('is_loggedin') != 1){
            Route::redirect('auth/login/');
            exit;        
        }
        $session::setSessionParam('token', bin2hex(random_bytes(35)));
        
        return Response::view('article/create', ['token' => $session::getSessionParam('token')]);
    }

    /**
     * Add new article
    */
    public function addArticle($request)
    {
        #check if user logged in
        $session = new Session();
        if(empty($session::getSessionParam('username')) && $session::getSessionParam('is_loggedin') != 1){
            Route::redirect('auth/login/');
            exit;        
        }

        # get user id from session
        $user_id = (int) $session::getSessionParam('user_id');
        
        if(!$user_id){
            $session::setSessionParam('error',"Sorry ! You Need to login again");
            Route::redirect('auth/login/');
            exit;        
        }

        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);

        #check csrf token value
        if($token !== $session::getSessionParam('token')){
            $session::setSessionParam('error',"Sorry ! Invalid Input Values");
            Route::redirect('article/createArticle');
            exit;
        }

        #check for empty inputs
        if(empty($title) || empty($text) || empty($image)){
            $session::setSessionParam('error',"Sorry ! Invalid Input Values");
            Route::redirect('article/createArticle');
            exit;
        }

        $article = (new Article())
                        ->setTitle($title)
                        ->setImageLink($image)
                        ->setText($text)
                        ->setUser($user_id);

        $article = $this->getRepo()->saveArticle($article);

        Route::redirect('article/getArticle/'.$article);
        exit;
    }

    /**
     * Get All articles with pagination and maximum number of articles per page 3
    */
    public function getAllAricles(Request $request)
    {
        if(!$request->getId()){
            $request->setId(1);
        }

        [$articles,$articleCount] = $this->getRepo()->getAllArticles($request->getId());
        return Response::view('article/index',['articles' => $articles, 'articleCount' => $articleCount, 'page' => $request->getId()]);
    }

    private function getRepo()
    {
        $queryBuilder = new QueryBuilder();
    
        return new ArticleRepository($queryBuilder);
    }
}