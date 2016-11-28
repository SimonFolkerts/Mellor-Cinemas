<?php

class Movie {
    private $id,
            $poster,
            $title,
            $synopsis,
            $status;
    
    public function getId() {
        return $this->id;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSynopsis() {
        return $this->synopsis;
    }
        
    function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPoster($poster) {
        $this->poster = $poster;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSynopsis($synopsis) {
        $this->synopsis = $synopsis;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
     //----------- CLIENT SIDE PROPERTIES ----------//
    
    private $showings;
    
    public function getShowings() {
        return $this->showings;
    }

    public function setShowings($showings) {
        $this->showings = $showings;
    }


}