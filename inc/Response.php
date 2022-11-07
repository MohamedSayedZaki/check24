<?php

namespace App\Inc;

use App\Inc\Session;

class Response{

    public static function view($template, $params = [])
    {
        $session = new Session();
        $is_loggedin = $session::getSessionParam('is_loggedin');

        $VIEW_PATH = $_ENV['VIEW_PATH'];
        return include($VIEW_PATH.$template.".php");
    }
}