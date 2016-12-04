<?php

class BookingsSeatsDao extends Dao {

//----------- CRUD FUNCITONALITY ------------//
//---------- PREPARED STATEMENT EXECUTIONS ----------//
    
    //batch insert a junction between seats and bookings into the database junction table 'bookings_seats' 
    public function save($id, $seats) {
        $db = $this->getDb();
        
        // begin the transaction
        $db->beginTransaction();

        foreach ($seats as $seat) {
            $db->exec("INSERT INTO bookings_seats (booking_id, seat_id) VALUES ('" . $id . "', '" . $seat . "')");
        }
        // commit the transaction
        $db->commit();
        echo "New records created successfully";
        $db = null;
    }

    private function execute($sql, BookingsSeats $bookingsSeats) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($bookingsSeats));
        return $bookingsSeats;
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

}
