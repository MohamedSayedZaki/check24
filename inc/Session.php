<?php 

namespace App\Inc;

class Session{

    /**
     * Stating Session
    */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set Session KEYS -> Values
    */
    public static function setSessionParam($key, $value){
        $_SESSION[$key] = $value;
    }

    /**
     * Get Session By key
    */
    public static function getSessionParam($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }

    public static function unsetSessionParam($key){
        unset($_SESSION[$key]);
    }

    public static function destroySession(){
        session_destroy();
    }
}