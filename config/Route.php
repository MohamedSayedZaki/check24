<?php

namespace App\Config;

class Route{


    public static function request($request)
    {
        $requestParams = explode(' ',ltrim(str_replace('/',' ', $request->getPage())));

        if(count($requestParams) ==2){
            [$controllerName, $action] = $requestParams;
        }
        
        if(count($requestParams) ==3){
            [$controllerName, $action, $id] = $requestParams;
            (!empty($id)) ? $request->setId($id) : '';
        }

        if(!empty($controllerName)){
            $controller = '\\App\\Src\\Controller\\' . ucwords($controllerName.'Controller');
        }

        if (isset($controller) && class_exists($controller) && method_exists($controller, $action)) {
            (new $controller())->$action($request);
        }else {
            echo 'NOT FOUND :(';
        }
    }

    public static function redirect($path = '')
    {
        $ROUTES_PATH = $_ENV['url'];
        header("Location: ".$ROUTES_PATH.$path);
    }
}