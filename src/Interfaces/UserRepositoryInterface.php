<?php

namespace App\Src\Interfaces;


interface UserRepositoryInterface{
    
    public function getUserByUsername($username);

    public function getUserByEmail($email);
}