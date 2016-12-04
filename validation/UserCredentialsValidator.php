<?php

class UserCredentialsValidator {

    public static function validateAll($username, $password, $email) {

        $errors = self::validateLogin($username, $password);

        if (!$email) {
            $errors[] = 'No Email Entered';
        }

        $email = self::testInput($email);

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        //check for existing username
        $sql = 'SELECT * FROM users WHERE username = "' . $username . '"';
        $dao = new Dao();
        if (!empty($dao->getRows($sql))) {
            $errors[] = 'This username is taken';
        }

        //check for existing email
        $sql = 'SELECT * FROM users WHERE email = "' . $email . '"';
        $dao = new Dao();
        if (!empty($dao->getRows($sql))) {
            $errors[] = 'There is already an account associated with this email address';
        }

        return $errors;
    }

    public static function validateLogin($username, $password) {

        $errors = array();

        $username = self::testInput($username);

        if (!$username) {
            $errors[] = 'No username entered';
        }

        if (!preg_match("/^[\da-zA-Z ]*$/", $username)) {
            $errors[] = 'Only letters, numbers and spaces allowed in username';
        }

        if (!$password) {
            $errors[] = 'No password entered';
        }

        $password = self::testInput($password);

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
