<?php

class BookingsSeatsMapper {

    public static function map(BookingsSeats $bookingsSeats, array $data) {
        if (array_key_exists('id', $data)) {
            $bookingsSeats->setId($data['id']);
        }

        if (array_key_exists('booking_id', $data)) {
            $bookingsSeats->setBookingId($data['booking_id']);
        }

        if (array_key_exists('seat_id', $data)) {
            $bookingsSeats->setSeatId($data['seat_id']);
        }
    }

}
