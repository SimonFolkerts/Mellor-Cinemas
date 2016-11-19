<?php

class UserDao extends Dao {

    public function getUserDetails($username, $password, $db) {
        $statement = $db->query('SELECT username, password FROM users WHERE username = "' . $username . '" AND password = "' . $password . '"');
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function find($sql) {
        $row = $this->query($sql)->fetch();
        $user = new User();
        UserMapper::map($user, $row);
        $result = $user;
        return $result;
    }
    
     public function findById($id) {
        $row = $this->query('SELECT * FROM users WHERE id = ' . (int) $id)->fetch();
        if (!$row) {
            throw new NotFoundException('No row returned');
        }
        $user = new User();
        UserMapper::map($user, $row);
        return $user;
    }
    
     private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        return $statement;
    }

//    public function createNewUser($username, $password, $email) {
//        $statement = $db->query('INSERT INTO mellor_cinemas.users (id, username, password, email) VALUES (NULL, :username, :password, :email');
//        $row = $statement->fetch(PDO::FETCH_ASSOC);
//    }

    //if the user object has no id, insert the user into the database
    //else update pre-existing user
    public function save(User $user) {
        if ($user->getId() === null) {
            return $this->insert($user);
        }
//        var_dump($user);
//        die();
        return $this->update($user);
    }

    private function insert(User $user) {
        $user->setId(null);
        $sql = '
            INSERT INTO users (id, username, password, email)
                VALUES (:id, :username, :password, :email)';
        return $this->execute($sql, $user);
    }

//    private function update(Booking $booking) {
//        $sql = '
//            UPDATE bookings SET
//                flight_name = :flight_name,
//                flight_date = :flight_date,
//                status = :status,
//                user_id = :user_id,
//                image_url = :image_url
//            WHERE
//                id = :id';
//        
//        return $this->execute($sql, $booking);
    
    private function update(User $user) {
        $sql = 'UPDATE users SET
                username = :username,
                password = :password,
                email = :email
            WHERE
                id = :id';
        return $this->execute($sql, $user);
    }

    private function execute($sql, User $user) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($user));
        return $user;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

       private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }
    
    private function getParams(User $user) {
        $params = array(
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':email' => $user->getEmail(),
            ':id' => $user->getId()
        );
        return $params;
    }

}
