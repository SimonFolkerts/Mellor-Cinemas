<?php

//----------SHOWING DETAILS----------

$dao = new Dao();

$showingSql = 'SELECT movies.id AS id_movie, movie_title, poster, movie_synopsis, movies.status AS status_movie, showings.id AS id_showing, movie_id, date, start_time, end_time, cinema, showings.status AS status_showing FROM movies, showings WHERE movies.id = showings.movie_id AND showings.id = ' . $_GET['id'];
$showingResults = $dao->getRow($showingSql);

//TODO clean up here

$movieId = $showingResults['movie_id'];
$moviePoster = $showingResults['poster'];
$movieTitle = $showingResults['movie_title'];
$movieSynopsis = $showingResults['movie_synopsis'];

$showingId = $showingResults['id_showing'];
$sessionTime = $showingResults['start_time'] . " - " . $showingResults['end_time'];
$cinema = $showingResults['cinema'];


//-----------GRID GENERATION---------

$dao = new SeatDao();

$allSeatsSql = 'SELECT seats.id, cinema_row, cinema_column FROM seats WHERE cinema = ' . $cinema . ' ORDER BY cinema_row, cinema_column';
$reservedSeatsSql = 'SELECT seats.id, cinema_row, cinema_column FROM seats, bookings_seats, showings, bookings WHERE bookings_seats.seat_id = seats.id AND bookings_seats.booking_id = bookings.id AND bookings.showing_id = ' . $showingId . ' ORDER BY cinema_row, cinema_column';

$allSeats = $dao->findAll($allSeatsSql);
$reservedSeats = $dao->findAll($reservedSeatsSql);

if ($reservedSeats) {
    foreach ($allSeats as $seat) {
        foreach ($reservedSeats as $reservedSeat) {
            if ($seat->getId() == $reservedSeat->getId()) {
                $seat->setStatus('disabled="disabled"');
            }
        }
    }
}

$output = '';

function generateGrid($seats) {
    $output = '';
    $row = 1;
    end($seats);
    $lastSeat = $seats[key($seats)];
    $rowCount = $lastSeat->getCinemaRow();

    while ($row <= $rowCount) {
        foreach ($seats as $seat) {
            if ($seat->getCinemaRow() == $row) {
                $output = $output . '<input type="checkbox" name="seat[]" value="' . $seat->getId() . '"' . $seat->getStatus() . '>';
            }
        }
        $row++;
        $output = $output . '<br>';
    }
    return $output;
}

$grid = generateGrid($allSeats);

//TODO FINISH  SEAT UPLOAD
//---------- CREATE BOOKING ----------//

if (array_key_exists('seat', $_POST)) {
    $booking = new Booking();
    $bookingId = null;
    $booking->setId($bookingId);
    $booking->setShowingId('');
    $booking->setUserId('');
    $booking->setStatus('');
    
    if (array_key_exists('username', $_SESSION)) {
        $booking->getUserId($_SESSION['id']);
    } else {
        $booking->setUserId(null);
    }

    $data = array(
        'showingId' => $showingId,
        'userId' => (array_key_exists('id', $_SESSION) ? $_SESSION['id'] : null)
    );
    //TODO cleanup here and add validation to submission

    BookingMapper::map($booking, $data);

    $dao = new BookingDao();
    $booking = $dao->save($booking);
    

    //---------- CREATE BOOKING <-> SEAT JUNCTION ----------//

    $dao = new BookingsSeatsDao();
    
    $seats = $_POST['seat'];
    
    $id = (int) $booking->getID();
    
    $dao->save($id, $seats);
    
    header('Location: index.php');    
}