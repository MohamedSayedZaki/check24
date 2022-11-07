<?php

use Dotenv\Dotenv;
use App\Config\Route;
use App\Inc\Builders\RequestBuilder;

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

#Router to system
$page = ($_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_URI'] != NULL && 
        $_SERVER['REQUEST_URI'] != '/')?$_SERVER['REQUEST_URI'] : '/home/index';


$request = (new RequestBuilder())
            ->setMethod($_SERVER['REQUEST_METHOD'])
            ->setPage($page)
            ->setParams($_POST)
            ->buildRequest();

Route::request($request);
exit;