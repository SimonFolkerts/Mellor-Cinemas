<?php


class BookingsSeatsDao extends Dao {
    
    
    
     //---------- PREPARED STATEMENT EXECUTIONS ----------//

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

    private function getParams(BookingsSeats $bookingsSeats) {
        $params = array(
            ':id' => $bookingsSeats->getId(),
            ':booking_id' => $bookingsSeats->getBookingId(),
            ':seat_id' => $bookingsSeats->getSeatId(),
            ':id' => $bookingsSeats->getId(),
            ':status' => $bookingsSeats->getStatus()
        );
        return $params;
    }
    
}
