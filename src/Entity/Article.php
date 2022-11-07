<?php

namespace App\Src\Entity;

class Article{
    
    protected $table ="article";
    private $title ='';
    private $imageLink ='';
    private $text = '';
    private $user_id = '';

    public function getTable(){
        return $this->table;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }    

    public function setImageLink($imageLink){
        $this->imageLink = $imageLink;
        return $this;
    }

    public function getImageLink(){
        return $this->imageLink;
    }    

    public function setText($text){
        $this->text = $text;
        return $this;
    }

    public function getText(){
        return $this->text;
    }

    public function setUser($user_id){
        $this->user_id = $user_id;
        return $this;
    }

    public function getUser(){
        return $this->user_id;
    }
}