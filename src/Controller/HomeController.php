<?php
namespace App\Src\Controller;

use App\Inc\Request;
use App\Inc\Response;
use App\Inc\Builders\QueryBuilder;
use App\Src\Repository\ArticleRepository;

class HomeController{
    
    /**
     * Overview page with pagination and maximum number of articles per page 3
    */
    public function index(Request $request)
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