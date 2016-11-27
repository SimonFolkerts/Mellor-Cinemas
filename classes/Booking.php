<?php


class Booking {
    
    //SERVER-SIDE PROPERTIES 
    
    private $id,
            $showingId,
            $userId,
            $status;
    
    public function getId() {
        return $this->id;
    }

    public function getShowingId() {
        return $this->showingId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setShowingId($showingId) {
        $this->showingId = $showingId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    
    //CLIENT-SIDE PROPERTIES
    
    private $showing,
            $user,
            $seats;
    
    function getShowing() {
        return $this->showing;
    }

    function getUser() {
        return $this->user;
    }

    function getSeats() {
        return $this->seats;
    }

    function setShowing($showing) {
        $this->showing = $showing;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setSeats($seats) {
        $this->seats = $seats;
    }



}
