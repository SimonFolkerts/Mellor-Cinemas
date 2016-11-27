<?php

class UserMapper {

    public static function map(User $user, array $data) {
        if (array_key_exists('id', $data)) {
            $user->setId($data['id']);
        }
        if (array_key_exists('username', $data)) {
            $user->setUserName($data['username']);
        }
        if (array_key_exists('password', $data)) {
            $user->setPassword($data['password']);
        }
        if (array_key_exists('email', $data)) {
            $user->setEmail($data['email']);
        }
        if (array_key_exists('status', $data)) {
            $user->setStatus($data['status']);
        }
        
    }

}
