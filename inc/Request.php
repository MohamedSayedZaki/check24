<?php

namespace App\Inc;

class Request{

    private $method;
    private $page;
    private $params;
    private $id;
    /*
    * @param string $page
    * @param array  $_SERVER
    * @param array  $_POST
    * @return array $request 
    */
    public function __construct($page, $method, $params)
    {
        $this->page = $page;
        $this->method = $method;
        ($method == "POST")? $this->params = $params : '';
    }

    public function getPage(){
        return $this->page;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getParams(){
        return $this->params;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getId(){
        return $this->id;
    }
}