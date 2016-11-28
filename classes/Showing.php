<?php


class Showing {
    private $id,
            $movieId,
            $date,
            $startTime,
            $endTime,
            $cinema,
            $status;
    
    public function getId() {
        return $this->id;
    }

    public function getMovieId() {
        return $this->movieId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function getCinema() {
        return $this->cinema;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMovieId($movieId) {
        $this->movieId = $movieId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

    public function setCinema($cinema) {
        $this->cinema = $cinema;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    //----------- CLIENT SIDE PROPERTIES ----------//
    
    private $bookings;
    
    function getBookings() {
        return $this->bookings;
    }

    function setBookings($bookings) {
        $this->bookings = $bookings;
    }

}
