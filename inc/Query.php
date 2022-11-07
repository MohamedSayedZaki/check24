<?php 

namespace App\Inc;

use PDO;
use App\Config\DB;

class Query{

    private $table;
    private $statement;
    private $params;
    private $where;

    public function __construct($table, $statement, $params, $where){
        $this->table = $table;
        $this->statement = $statement;
        $this->params = $params;
        $this->where = $where;
    }

    public function executeQuery()
    {
        try {
            
            $this->db = DB::getConnection();
            
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $this->db->prepare($this->statement);

            if($this->params){
                $stmt->execute($this->params);
            }else{
                $stmt->execute();
            }
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if(preg_match("/select/i", $this->statement, $matches, PREG_OFFSET_CAPTURE)){
                return $stmt->fetchAll();
            }

            return $this->db->lastInsertId();
        
        } catch(PDOException $e) {
        
            echo "Error: " . $e->getMessage();
        }
        
        $this->db ='';
    }
}