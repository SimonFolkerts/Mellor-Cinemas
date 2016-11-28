<?php

class UserCredentialsValidator {

    public static function validateAll($username, $password, $email) {

        $errors = UserCredentialsValidator::validateLogin($username, $password);
        
        if (!$email) {
            $errors[] = 'No Email Entered';
        }

        $email = UserCredentialsValidator::testInput($email);

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        return $errors;
    }

    public static function validateLogin($username, $password) {

        $errors = array();

        $username = UserCredentialsValidator::testInput($username);

        if (!$username) {
            $errors[] = 'No username entered';
        }

        if (!preg_match("/^[\da-zA-Z ]*$/", $username)) {
            $errors[] = 'Only letters, numbers and spaces allowed in username';
        }

        if (!$password) {
            $errors[] = 'No password entered';
        }

        $password = UserCredentialsValidator::testInput($password);

        if (!preg_match("/^[\da-zA-Z ]*$/", $password)) {
            $errors[] = 'Only letters, numbers and spaces allowed in password';
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
