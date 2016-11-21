<?php

class ShowingMapper {

    public static function map(Showing $showing, array $data) {
        if (array_key_exists('id', $data)) {
            $showing->setId($data['id']);
        }
        if (array_key_exists('poster', $data)) {
            $showing->setPoster($data['poster']);
        }
        if (array_key_exists('movie_title', $data)) {
            $showing->setMovieTitle($data['movie_title']);
        }
        if (array_key_exists('movie_synopsis', $data)) {
            $showing->setMovieSynopsis($data['movie_synopsis']);
        }
         if (array_key_exists('date', $data)) {
            $showing->setDate($data['date']);
        }
        if (array_key_exists('start_time', $data)) {
            $showing->setStartTime($data['start_time']);
        }
        if (array_key_exists('end_time', $data)) {
            $showing->setEndTime($data['end_time']);
        }
        if (array_key_exists('cinema', $data)) {
            $showing->setCinema($data['cinema']);
        }
        if (array_key_exists('status', $data)) {
            $showing->setStatus($data['status']);
        }
    }

}
