<?php 

namespace App\Inc\Builders;

use App\Inc\Query;

class QueryBuilder{

    private $table = '';
    private $statement = '';
    private $where = '';
    private $params = [];

    public function setTable($table){
        $this->table = $table;
        return $this;
    }

    public function setStatement($statement){
        $this->statement = $statement;
        return $this;
    }

    public function setParams($params){
        $this->params = $params;
        return $this;
    }

    public function setWhere($where){
        $this->where = $where;
        return $this;
    }

    public function buildQuery():Query{
        return new Query($this->table, $this->statement, $this->params, $this->where);
    }

}