<?php


class Seat {
    private $id,
            $cinema,
            $cinemaRow,
            $cinemaColumn,
            $status;
    
    public function getId() {
        return $this->id;
    }

    public function getCinema() {
        return $this->cinema;
    }

    public function getCinemaRow() {
        return $this->cinemaRow;
    }

    public function getCinemaColumn() {
        return $this->cinemaColumn;
    }
    
        public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCinema($cinema) {
        $this->cinema = $cinema;
    }

    public function setCinemaRow($cinemaRow) {
        $this->cinemaRow = $cinemaRow;
    }

    public function setCinemaColumn($cinemaColumn) {
        $this->cinemaColumn = $cinemaColumn;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }

}
