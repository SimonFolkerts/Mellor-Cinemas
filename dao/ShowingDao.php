<?php

class ShowingDao extends Dao {

    //----------- DATA RETRIEVAL ----------//

    public function find($sql) {
        $row = $this->getRow($sql);
        $showing = new Showing();
        ShowingMapper::map($showing, $row);
        $result = $showing;
        return $result;
    }

    public function findAll($sql) {
        $result = array();
        $rows = $this->getRows($sql);
        foreach ($rows as $row) {
            $showing = new Showing();
            ShowingMapper::map($showing, $row);
            $result[$showing->getId()] = $showing;
        }
        return $result;
    }

    //return an object by its id (for use with Utiltiy 'getObjByGetId()')
    public function findById($id) {
        $row = $this->query("SELECT * FROM showings WHERE id = " . (int) $id)->fetch();
        if (!$row) {
            throw new Exception('No row returned');
        }
        $showing = new Showing();
        ShowingMapper::map($showing, $row);
        return $showing;
    }

    //---------- CRUD FUNCTIONALITY ----------//
    //if the object has no id, insert it into the database, else update pre-existing entry
    public function save(Showing $showing) {
        if ($showing->getId() === null) {
            return $this->insert($showing);
        }
        return $this->update($showing);
    }

    //insert new entry into database using prepared statement    
    private function insert(Showing $showing) {
        $showing->setId(null);
        $showing->setStatus('active');
        $sql = '
            INSERT INTO showings (id, movie_id, date, start_time, end_time, cinema, status)
                VALUES (:id, :movie_id, :date, :start_time, :end_time, :cinema, :status)';
        return $this->execute($sql, $showing);
    }

    //update existing entry in the datapase using prepared statemnt    
    private function update(Showing $showing) {
        $sql = 'UPDATE showings SET
                movie_id = :movie_id,
                date = :date,
                start_time = :start_time,
                end_time = :end_time,
                cinema = :cinema,
                status = :status
            WHERE
                id = :id';
        return $this->execute($sql, $showing);
    }

    //set the status of the database entry to 'deleted' using a prepared statement
    public function delete($id) {
        $sql = '
            UPDATE showings SET
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

    //---------- PREPARED STATEMENT EXECUTION ----------//

    private function execute($sql, Showing $showing) {
        $db = $this->getDb();
        $statement = $db->prepare($sql);
        $this->executeStatement($statement, $this->getParams($showing));
        $showing->setId($db->lastInsertId());
        return $showing;
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

    private function getParams(Showing $showing) {
        $params = array(
            ':movie_id' => $showing->getMovieId(),
            ':date' => $showing->getDate(),
            ':start_time' => $showing->getStartTime(),
            ':end_time' => $showing->getEndTime(),
            ':cinema' => $showing->getCinema(),
            ':id' => $showing->getId(),
            ':status' => $showing->getStatus()
        );
        return $params;
    }

}
