<?php

class SeatDao extends Dao {

    //return a single row based on an SQL query, and map it to an object
    public function find($sql) {
        $row = $this->getRow($sql);
        $seat = new Seat();
        SeatMapper::map($seat, $row);
        $result = $seat;
        return $result;
    }

    //return a multiple rows based on an SQL query, mapping each one to an object which is then appended to an array. The array is then returned
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
