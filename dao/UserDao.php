<?php

class UserDao extends Dao {

    //---------- DATA RETRIEVEAL ----------//

    //return a row based on the supplied information, and map it to an object. If nothing is returned, return null
    public function getUserDetails($username, $password, $db) {
        $statement = $db->query('SELECT id, username, password, status FROM users WHERE username = "' . $username . '" AND password = "' . $password . '" AND status != "deleted"');
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $user = new User();
            UserMapper::map($user, $row);
            return $user;
        } else {
            return null;
        }
    }

    //return a single row based on an SQL query, and map it to an object
    public function find($sql) {
        $row = $this->getRow($sql);
        $user = new User();
        UserMapper::map($user, $row);
        $result = $user;
        return $result;
    }

    //return a multiple rows based on an SQL query, mapping each one to an object which is then appended to an array. The array is then returned
    public function findById($id) {
        $row = $this->query("SELECT * FROM users WHERE id = " . (int) $id . " AND status = 'active'")->fetch();
        if (!$row) {
            throw new NotFoundException('No row returned');
        }
        $user = new User();
        UserMapper::map($user, $row);
        return $user;
    }

    //----------- CRUD FUNCTIONALITY ----------//

    //if the object has no id, insert it into the database, else update pre-existing entry
    public function save(User $user) {
        if ($user->getId() === null) {
            return $this->insert($user);
        }
        return $this->update($user);
    }

    //insert new entry into database using prepared statement
    private function insert(User $user) {
        $user->setId(null);
        $user->setStatus('active');
        $sql = '
            INSERT INTO users (id, username, password, email, status)
                VALUES (:id, :username, :password, :email, :status)';
        return $this->execute($sql, $user);
    }

    //update existing entry in the datapase using prepared statemnt
    private function update(User $user) {
        $sql = 'UPDATE users SET
                username = :username,
                password = :password,
                email = :email,
                status = :status
            WHERE
                id = :id';
        return $this->execute($sql, $user);
    }

    //set the status of the database entry to 'deleted' usin a prepared statement
    public function delete($id) {
        $sql = '
            UPDATE users SET
                status = :status
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':status' => 'deleted',
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }

    //---------- PREPARED STATEMENT EXECUTIONS ----------//

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
            ':id' => $user->getId(),
            ':status' => $user->getStatus()
        );
        return $params;
    }

}
