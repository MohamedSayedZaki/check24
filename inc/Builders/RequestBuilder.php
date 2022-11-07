<?php
namespace App\Inc\Builders;

use App\Inc\Request;

class RequestBuilder{

    private $method='';
    private $page='';
    private $params=[];

    public function setMethod($method){
        $this->method = $method;
        return $this;
    }   
    
    public function setPage($page){
        $this->page = $page;
        return $this;
    }

    public function setParams($params){
        $this->params = $params;
        return $this;
    }

    public function buildRequest():Request{
        return new Request($this->page, $this->method, $this->params);
    }
}