<?php

class SeatMapper {

    public static function map(Seat $seat, array $data) {

        if (array_key_exists('id', $data)) {
            $seat->setId($data['id']);
        }
        if (array_key_exists('cinema', $data)) {
            $seat->setCinema($data['cinema']);
        }
        if (array_key_exists('cinema_row', $data)) {
            $seat->setCinemaRow($data['cinema_row']);
        }
        if (array_key_exists('cinema_column', $data)) {
            $seat->setCinemaColumn($data['cinema_column']);
        }
    }

}
