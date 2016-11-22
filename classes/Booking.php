<?php


class Booking {
    private $id,
            $showingId,
            $userId,
            $bookingStatus;
    
    public function getId() {
        return $this->id;
    }

    public function getShowingId() {
        return $this->showingId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getBookingStatus() {
        return $this->bookingStatus;
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

    public function setBookingStatus($bookingStatus) {
        $this->bookingStatus = $bookingStatus;
    }


}
