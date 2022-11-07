<?php
namespace App\Src\Repository;

use PDO;
use App\Src\Entity\Article;
use App\Inc\Builders\QueryBuilder;
use App\Inc\Query;
use App\Src\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface{

    private $queryBuilder ='';

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getArticle($id)
    {
        $result = $this->queryBuilder->setStatement('SELECT username, article.id, title, article.create_date, text, image FROM article join user ON article.user_id = user.id where article.id=:id')
                                      ->setParams([':id' => $id])
                                      ->buildQuery();

        return $result->executeQuery();
    }

    public function getAllArticles($offset)
    {
        $per_page = 3;
        $start = ($offset-1) * $per_page; 

        $resultSet = $this->queryBuilder->setStatement('SELECT username, article.id, title, image, article.create_date, text FROM article join user ON article.user_id = user.id order by article.create_date desc Limit '. $start.' , 3')
                                      ->buildQuery();

        $countResult = $this->queryBuilder->setStatement('SELECT count(article.id) AS ArticleCount FROM article join user ON article.user_id = user.id order by article.create_date desc')
                                      ->buildQuery();                                      

        
        return [$resultSet->executeQuery(), $countResult->executeQuery()];
    }

    public function saveArticle($article)
    {
        $title = $article->getTitle();
        $text = $article->getText();
        $image = $article->getImageLink();   
        $user_id = $article->getUser();        

        $result = $this->queryBuilder->setStatement("INSERT INTO article (title, text, image, user_id) VALUES (:title, :text, :image, :user_id)")
                                     ->setParams([':title' => $title, ':text' => $text, ':image' => $image, ':user_id' => $user_id])
                                     ->buildQuery();

        return $result->executeQuery();
    }
}