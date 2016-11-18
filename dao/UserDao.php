<?php

class UserDao extends Dao {

    public function getUserDetails($username, $password, $db) {
        $statement = $db->query('SELECT username, password FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"');
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        echo $row;
        return $row;
    }

    public function createNewUser($username, $password, $email) {
        $statement = $db->query('INSERT INTO mellor_cinemas.users (id, username, password, email) VALUES (NULL, :username, :password, :email');
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    private function executeQuery() {
        
    }
}
