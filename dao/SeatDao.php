<?php


class SeatDao extends Dao {
     
    public function find($sql) {
        $row = $this->getRow($sql);
        $seat = new Seat();
        SeatMapper::map($seat, $row);
        $result = $seat;
        return $result;
    }
    
    public function findAll($sql) {
        $result = array();
        $rows = $this->getRows($sql);
        foreach ($rows as $row) {
            $seat = new Seat();
            SeatMapper::map($seat, $row);
            $result[$seat->getId()] = $seat;
        }
        return $result;
    }
}
