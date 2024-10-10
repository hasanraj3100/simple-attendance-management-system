<?php
namespace Ninja;

use DateTime;

class DatabaseTable {
    private $table;
    private $primarykey;
    private $pdo;

    public function __construct(\PDO $pdo, string $table, string $primarykey) {
        $this->pdo= $pdo;
        $this->table= $table;
        $this->primarykey= $primarykey;
    }

    private function processDates($fields) {
        foreach($fields as $key=>$value) {
            if($value instanceof \DateTime) {
                $fields[$key]=$value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function insert($fields) {
        $sql='INSERT INTO `' . $this->table . '`(';

        foreach($fields as $key=>$value) {
            $sql.= '`' . $key . "`,";
        }
        $sql=rtrim($sql, ',');

        $sql.=') VALUES (';

        foreach($fields as $key=>$value) {
            $sql.=':' . $key . ',';
        }

        $sql= rtrim($sql,',');
        $sql.= ');';
        $fields=$this->processDates($fields);

        $this->query($sql, $fields);

    }

    public function findAll() {
        $sql='SELECT * FROM `' . $this->table . '`;';
        $query= $this->query($sql);
        return $query->fetchAll();
    }

    public function findById($id) {
        $sql='SELECT * FROM `' . $this->table . '` WHERE `' . $this->primarykey . '`=:id;';
        $parameters= [
            'id'=>$id
        ];

        $query= $this->query($sql, $parameters);
        return $query->fetch();
    }

    public function find($column, $value) {
        $sql= 'SELECT * FROM `' . $this->table . '` WHERE `' . $column . '`=:value';
        if($value instanceof DateTime) {
            $value=$value->format('y-m-d');
        } 
        $parameters= [
            'value'=> $value
        ];


        $query=$this->query($sql,$parameters);
        return $query->fetchAll();
    }

    public function distinctValue($column) {
        $sql='SELECT DISTINCT ' . $column . ' FROM ' . $this->table . ';';


        $query= $this->query($sql);
        return $query->fetchAll();
    }

    private function query($sql, $parameters=[]) {
        $query= $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }
    
}