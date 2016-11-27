<?php


class BookingsSeats {
    private $id,
            $bookingId,
            $seatId,
            $status;
    
    function getId() {
        return $this->id;
    }

    function getBookingId() {
        return $this->bookingId;
    }

    function getSeatId() {
        return $this->seatId;
    }
        
    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBookingId($bookingId) {
        $this->bookingId = $bookingId;
    }

    function setSeatId($seatId) {
        $this->seatId = $seatId;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
}
