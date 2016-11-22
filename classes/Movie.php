<?php

class Movie {
    private $id,
            $poster,
            $title,
            $synopsis;
    
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

}