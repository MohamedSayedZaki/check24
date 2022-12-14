<?php
namespace App\Src\Repository;

use PDO;
use App\Inc\Query;
use App\Src\Entity\Article;
use App\Inc\Builders\QueryBuilder;
use App\Src\Interfaces\RepositoryInterface;
use App\Src\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{
    
    private $queryBuilder ='';

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getUserByUsername($username)
    {
        $result = $this->queryBuilder->setStatement('SELECT id, email, username, password FROM user where username=:username')
                                      ->setParams([':username' => $username])
                                      ->buildQuery();

        return $result->executeQuery();
    }

    public function getUserByEmail($email)
    {
        $result = $this->queryBuilder->setStatement('SELECT id, email, username, password FROM user where email=:email')
                                      ->setParams([':email' => $email])
                                      ->buildQuery();

        return $result->executeQuery();
    }
}