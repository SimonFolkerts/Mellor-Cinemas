<?php


class BookingDao extends Dao {
    
    //---------- DATA RETRIEVAL ----------//
    
     public function find($sql) {
        $row = $this->getRow($sql);
        $booking = new Booking();
        BookingMapper::map($booking, $row);
        $result = $booking;
        return $result;
    }
    
    //---------- CRUD FUNCTIONALITY ----------//
    
    public function save(Booking $booking) {
        $booking->setId(null);
        $booking->setStatus('active');
        $sql = '
            INSERT INTO bookings (id, showing_id, user_id, booking_status)
                VALUES (:id, :showingId, :userId, :status)';
        return $this->execute($sql, $booking);
    }
    
    
     public function delete($id) {
        $sql = '
            UPDATE bookings, bookings_seats SET
                bookings.booking_status = :status,
                bookings_seats.status = :status
            WHERE
                bookings.id = :id AND bookings_seats.booking_id = bookings.id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':status' => 'deleted',
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }


    //---------- PREPARED STATEMENT EXECUTIONS ----------//
    
      private function execute($sql, Booking $booking) {
        $db = $this->getDb();
        $statement = $db->prepare($sql);
        $this->executeStatement($statement, $this->getParams($booking));
        $booking->setId($db->lastInsertId());
        return $booking;
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

    private function getParams(Booking $booking) {
        $params = array(
            ':id' => $booking->getId(),
            ':showingId' => $booking->getShowingId(),
            ':userId' => $booking->getUserId(),
            ':status' => $booking->getStatus()
        );
        return $params;
    }

}