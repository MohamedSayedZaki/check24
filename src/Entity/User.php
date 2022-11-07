<?php

namespace App\Src\Entity;

class User{
    protected $table ="user";

    public function getTable(){
        return $this->table;
    }
}