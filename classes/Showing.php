<?php

class Showing {
    private $id,
            $poster,
            $movieTitle,
            $movieSynopsis,
            $date,
            $startTime,
            $endTime,
            $cinema,
            $status;
    
    public function getId() {
        return $this->id;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function getMovieTitle() {
        return $this->movieTitle;
    }

    public function getMovieSynopsis() {
        return $this->movieSynopsis;
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

    public function setPoster($poster) {
        $this->poster = $poster;
    }

    public function setMovieTitle($movieTitle) {
        $this->movieTitle = $movieTitle;
    }

    public function setMovieSynopsis($movieSynopsis) {
        $this->movieSynopsis = $movieSynopsis;
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

}
