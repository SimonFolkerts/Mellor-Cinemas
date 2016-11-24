<?php

class BookingMapper {

    public static function map(Booking $booking, array $data) {

        if (array_key_exists('id', $data)) {
            $booking->setId($data['id']);
        }

        if (array_key_exists('showingId', $data)) {
            $booking->setShowingId($data['showingId']);
        }

        if (array_key_exists('userId', $data)) {
            $booking->setUserId($data['userId']);
        }

        if (array_key_exists('status', $data)) {
            $booking->setStatus($data['status']);
        }
    }

}
