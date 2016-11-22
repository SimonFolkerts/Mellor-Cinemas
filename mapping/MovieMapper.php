<?php

class MovieMapper {

    public static function map(Movie $movie, array $data) {
        if (array_key_exists('id', $data)) {
            $movie->setId($data['id']);
        }
        if (array_key_exists('poster', $data)) {
            $movie->setPoster($data['poster']);
        }
        if (array_key_exists('movie_title', $data)) {
            $movie->setTitle($data['movie_title']);
        }
        if (array_key_exists('movie_synopsis', $data)) {
            $movie->setSynopsis($data['movie_synopsis']);
        }
    }

}
