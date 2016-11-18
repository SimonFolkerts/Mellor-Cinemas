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


    //if the user onject has no id, insert the user into the database
    //else update pre-existing user
    public function save(User $user) {
        if ($user->getId() === null) {
            return $this->insert($user);
        }
        return $this->update($user);
    }

    private function insert(User $user) {
        $user->setId(null);
        $sql = '
            INSERT INTO users (id, username, password, email)
                VALUES (:id, :username, :password, :email)';
        return $this->execute($sql, $user);
    }
    
    private function update(User $user) {
        $sql = 'UPDATE users SET
                username = :username,
                password = :password,
                email = :password,
            WHERE
                id = :id';
        echo 'updated';
        return $this->execute($sql, $user);
    }

    private function execute($sql, User $user) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($user));
        return $user;
    }
    
    private function executeStatement(PDOStatement $statement, array $params) {
        $statement->execute($params);
    }
    
    private function getParams(User $user) {
        $params = array(
            ':id' => $user->getId(),
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':email' => $user->getEmail()
        );
//        var_dump($params);
//        die();
        return $params;
    }
}
