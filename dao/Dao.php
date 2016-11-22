<?php

//main database access object class
class Dao {

    private $db = null;

    //create database connection
    public function getDb() {
        $dsn = "mysql:host=localhost;dbname=mellor_cinemas;charset=utf8";
        $username = 'root';
        $password = '';
        //if the database is loaded, return it
        if ($this->db !== null) {
            return $this->db;
        }
        //otherwise attempt to establish a connection using supplied parameters
        try {
            $this->db = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (Exception $ex) {
            throw new Exception('database connection error');
        }
        //and then return the database
        return $this->db;
    }
    
    
        public function getRow($sql) {
        $row = $this->query($sql)->fetch();
        return $row;
    }

    public function getRows($sql) {
        $result = array();
        foreach ($this->query($sql) as $row) {
            $result[] = $row;
        }
        return $result;
    }

    protected function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        return $statement;
    }

}
