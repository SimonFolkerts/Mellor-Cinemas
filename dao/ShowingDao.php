<?php

class ShowingDao extends Dao {
    
    //---------- DATA RETRIEVAL ----------//
    
//   public static function getAllShowings() {
//       $statement = $db->query('SELECT');
//       $row = $statement->fetch(PDO::FETCH_ASSOC);
//   }
   
     public function find($sql) {
        $row = $this->query($sql)->fetch();
        $showing = new Showing();
        ShowingMapper::map($showing, $row);
        $result = $showing;
        return $result;
    }
    
    public function findAll($sql) {
        $result = array();
        foreach ($this->query($sql) as $row) {
            $showing = new Showing();
            ShowingMapper::map($showing, $row);
            $result[$showing->getId()] = $showing;
        }
        return $result;
    }
    
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        return $statement;
    }
}
