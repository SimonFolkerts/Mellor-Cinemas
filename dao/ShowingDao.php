<?php


class ShowingDao extends Dao {

    public function find($sql) {
        $row = $this->getRow($sql);
        $showing = new Showing();
        ShowingMapper::map($showing, $row);
        $result = $showing;
        return $result;
    }
    
    public function findAll($sql) {
        $result = array();
        $rows = $this->getRows($sql);
        foreach ($rows as $row) {
            $showing = new Showing();
            ShowingMapper::map($showing, $row);
            $result[$showing->getId()] = $showing;
        }
        return $result;
    }
}
