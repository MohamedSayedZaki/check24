<?php

namespace App\Src\Interfaces;


interface ArticleRepositoryInterface{
    
    public function getArticle($id);

    public function getAllArticles($offset);
    
    public function saveArticle($article);
}