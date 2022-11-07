<?php

namespace App\Inc;

class Response{

    public static function view($template, $params = [])
    {
        $VIEW_PATH = $_ENV['VIEW_PATH'];
        return include($VIEW_PATH.$template.".php");
    }
}