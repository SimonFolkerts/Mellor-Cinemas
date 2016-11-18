<?php

class UserValidator {
    
    public static function validate(User $user) {
        $errors = array();
        if (!$user->getUsername()) {
            $errors[] = 'No username entered!';
        }
        if (!$user->getPassword()) {
            $errors[] = 'No password entered!';
        }
        if (!$user->getEmail()) {
            $errors[] = 'No email entered!';
        }
        if (strlen($user->getUserName()) > 20) {
            $errors[] = 'Username is too long!';
        }
        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address!';
        }
        return $errors;
    }

}
