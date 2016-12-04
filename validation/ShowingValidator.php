<?php

class ShowingValidator {

    public static function validateShowing($post) {

        $errors = array(); 
        
        $date = $post['date'];

        $start = $post['start'];

        $end = $post['end'];

        $cinema = $post['cinema'];

        if (!$date) {
            $errors[] = 'No date entered';
        }

        if (!preg_match("/^[\d\d\/\d\d\/\d\d]*$/", $date)) {
            $errors[] = 'Please use dd/mm/yy format for date';
        }

        $start = self::testInput($start);

        if (!$start) {
            $errors[] = 'No start time entered';
        }

        if (!preg_match("/^[\d\d:\d\d]*$/", $start)) {
            $errors[] = 'Please use hh:mm format for start time';
        }

        $end = self::testInput($end);

        if (!$end) {
            $errors[] = 'No end time entered';
        }

        if (!preg_match("/^[\d\d:\d\d]*$/", $end)) {
            $errors[] = 'Please use hh:mm format for end time';
        }

        $cinema = self::testInput($cinema);

        if (!$cinema) {
            $errors[] = 'No cinema entered';
        }

        if (!preg_match("/^[\d]*$/", $cinema)) {
            $errors[] = 'Please choose a valid cinema number';
        }
        return $errors;
    }

    protected static function testInput($string) {
        $string = trim($string);
        $string = htmlspecialchars($string);
        return $string;
    }

}
