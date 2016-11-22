<?php

class MovieDao extends Dao {
    
    //---------- DATA RETRIEVAL ----------//
    
//   public static function getAllShowings() {
//       $statement = $db->query('SELECT');
//       $row = $statement->fetch(PDO::FETCH_ASSOC);
//   }
   
     public function find($sql) {
        $row = $this->getRow($sql);
        $movie = new Movie();
        MovieMapper::map($movie, $row);
        $result = $movie;
        return $result;
    }
    
    public function findAll($sql) {
        $result = array();
        $rows = $this->getRows($sql);
        foreach ($rows as $row) {
            $movie = new Movie();
            MovieMapper::map($movie, $row);
            $result[$movie->getId()] = $movie;
        }
        return $result;
    }
    
}
