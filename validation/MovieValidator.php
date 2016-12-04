<?php

class MovieValidator {

    public static function validateMovie($post) {
        $errors = array();
        
        $title = $post['movie_title'];
        
        $poster = $post['poster'];
        
        $synopsis = $post['synopsis'];

        $title = self::testInput($title);

        if (!$title) {
            $errors[] = 'No title entered';
        }

        if (!preg_match("/^[\da-zA-Z,.'\":! ]*$/", $title)) {
            $errors[] = 'Only alphanuemric and basic punctuation allowed in title';
        }

        $poster = self::testInput($poster);

        if (!$poster) {
            $errors[] = 'No poster entered';
        }

        if (!preg_match("/^[\da-z-_. ]*$/", $poster)) {
            $errors[] = 'Only lowercase alphanumeric, periods, hyphens and underscores allowed in poster';
        }

        $synopsis = self::testInput($synopsis);

        if (!$synopsis) {
            $errors[] = 'No synopsis entered';
        }

        if (!preg_match("/^[\da-zA-Z,.'\":! ]*$/", $synopsis)) {
            $errors[] = 'Only alphanuemric and basic punctuation allowed in synopsis';
        }
        
        //check for existing title
        $sql = 'SELECT * FROM movies WHERE movie_title = "' . $title . '"';
        $dao = new Dao();
        if (!empty($dao->getRows($sql))) {
            $errors[] = 'This movie already exists in the database';
        }
        return $errors;
    }

    protected static function testInput($string) {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

}
