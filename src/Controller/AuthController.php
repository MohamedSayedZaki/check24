<?php

namespace App\Src\Controller;

use App\Inc\Session;
use App\Config\Route;
use App\Inc\Response;
use App\Inc\Builders\QueryBuilder;
use App\Src\Repository\UserRepository;


class AuthController{

    /**
     * @return login view
    */
    public function login()
    {
        # create csrf token and send it to login form
        $session = new Session();
        if(!empty($session::getSessionParam('username')) && $session::getSessionParam('is_loggedin') == 1){
            Route::redirect('article/getAllAricles/');
            exit;        
        }
        $session::setSessionParam('token', bin2hex(random_bytes(35)));
        
        return Response::view('auth/login', ['token' => $session::getSessionParam('token')]);
    }

    /**
     * @param Request
     * login validation
    */
    public function validateLogin($request)
    {
        $session = new Session();
        
        # Filter Login Form Inputs
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        #check csrf token value
        if($token !== $session::getSessionParam('token')){
            $session::setSessionParam('error',"Sorry ! you can't login");
            Route::redirect('auth/login');
            exit;
        }

        $user = $this->getRepo()->getUserByUsername(addslashes($username));

        if(!$user || $user[0]['username'] != $username){
            $session::setSessionParam('error',"Sorry ! Invalid Username");
            Route::redirect('auth/login');
            exit;
        }

        if(!password_verify($password,$user[0]['password'])){
            $session::setSessionParam('error',"Sorry ! Invalid Password");
            Route::redirect('auth/login');
            exit;
        }

        $session::setSessionParam('username',$user[0]['username']);
        $session::setSessionParam('email',$user[0]['email']);
        $session::setSessionParam('user_id',$user[0]['id']);
        $session::setSessionParam('is_loggedin',1);

        Route::redirect('article/getAllAricles/');
        exit;        
    }

    public function logout(){
        $session = new Session();
        $session::destroySession();
        Route::redirect('auth/login');
        exit;
    }

    private function getRepo()
    {
        $queryBuilder = new QueryBuilder();
    
        return new UserRepository($queryBuilder);
    }
}