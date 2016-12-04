<?php

class headerInfo {
    private $title,
            $description,
            $keywords;
    
    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function getKeywords() {
        return $this->keywords;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

}