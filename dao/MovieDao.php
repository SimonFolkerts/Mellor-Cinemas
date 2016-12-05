<?php

class MovieDao extends Dao {

    //---------- DATA RETRIEVAL ----------//
    //return a row based on the supplied information, and map it to an object. If nothing is returned, return null
    public function getMovieDetails($title, $db) {
        $statement = $db->query('SELECT * FROM movies WHERE movie_title = "' . $title . '" AND status != "deleted"');
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $movie = new Movie();
            MovieMapper::map($movie, $row);
            return $movie;
        } else {
            return null;
        }
    }

    //return a single row based on an SQL query, and map it to an object
    public function find($sql) {
        $row = $this->getRow($sql);
        $movie = new Movie();
        MovieMapper::map($movie, $row);
        $result = $movie;
        return $result;
    }

    //return a multiple rows based on an SQL query, mapping each one to an object which is then appended to an array. The array is then returned
    public function findAll($sql) {
        $result = array();
        $rows = $this->getRows($sql);
        foreach ($rows as $row) {
            $movie = new Movie();
            MovieMapper::map($movie, $row);
            $result[$movie->getId()] = $movie;
        }
        return $result;
    }

    //return an object by its id (for use with Utiltiy 'getObjByGetId()')
    public function findById($id) {
        $row = $this->query("SELECT * FROM movies WHERE id = " . (int) $id)->fetch();
        if (!$row) {
            throw new Exception('No row returned');
        }
        $movie = new Movie();
        MovieMapper::map($movie, $row);
        return $movie;
    }

    //---------- CRUD FUNCTIONALITY ----------//
    //if the object has no id, insert it into the database, else update pre-existing entry    
    public function save(Movie $movie) {
        if ($movie->getId() === null) {
            return $this->insert($movie);
        }
        return $this->update($movie);
    }

    //insert new entry into database using prepared statement    
    private function insert(Movie $movie) {
        $movie->setId(null);
        $movie->setStatus('active');
        $sql = '
            INSERT INTO movies (id, poster, movie_title, movie_synopsis, status)
                VALUES (:id, :poster, :movie_title, :movie_synopsis, :status)';
        return $this->execute($sql, $movie);
    }

    //update existing entry in the datapase using prepared statemnt    
    private function update(Movie $movie) {
        $sql = 'UPDATE movies SET
                poster = :poster,
                movie_title = :movie_title,
                movie_synopsis = :movie_synopsis,
                status = :status
            WHERE
                id = :id';
        return $this->execute($sql, $movie);
    }
    
       //set the status of the database entry to 'deleted' using a prepared statement, as well as its joined showings
    public function delete($id) {
        var_dump($id);

        $sql = '
            UPDATE movies 
            SET movies.status = :status
            WHERE
                movies.id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':status' => 'deleted',
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }

    //---------- PREPARED STATEMENT EXECUTIONS ----------//

    private function execute($sql, Movie $movie) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($movie));
        return $movie;
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

    private function getParams(Movie $movie) {
        $params = array(
            ':poster' => $movie->getPoster(),
            ':movie_title' => $movie->getTitle(),
            ':movie_synopsis' => $movie->getSynopsis(),
            ':id' => $movie->getId(),
            ':status' => $movie->getStatus()
        );
        return $params;
    }

}
