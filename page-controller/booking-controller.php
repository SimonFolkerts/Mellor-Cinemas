<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Booking');
$headerInfo->setDescription('Reserve seats and book tickets for a movie at Mellor Cinema');
$headerInfo->setKeywords('Mellor, Cinema, movie, ticket, seat, booking, buy, reserve');

//----------SHOWING DETAILS----------

//get the information relevant tot he selected movie
$dao = new Dao();

$showingSql = "SELECT movies.id AS id_movie, movie_title, poster, movie_synopsis, movies.status AS status_movie, showings.id AS id_showing, movie_id, date, start_time, end_time, cinema, showings.status AS status_showing FROM movies, showings WHERE movies.id = showings.movie_id AND showings.id = '" . $_GET['id'] . "' AND movies.status != 'deleted' AND showings.status != 'deleted'";
$showingResults = $dao->getRow($showingSql);

//TODO clean up here

$movieId = $showingResults['movie_id'];
$moviePoster = $showingResults['poster'];
$movieTitle = $showingResults['movie_title'];
$movieSynopsis = $showingResults['movie_synopsis'];

$showingId = $showingResults['id_showing'];
$sessionTime = $showingResults['start_time'] . " - " . $showingResults['end_time'];
$cinema = $showingResults['cinema'];


//-----------GRID GENERATION---------//

$dao = new SeatDao();

//return all seats in the cinema specified by the showing
$allSeatsSql = "SELECT seats.id, cinema_row, cinema_column FROM seats WHERE cinema = '" . $cinema . "' ORDER BY cinema_row ASC, cinema_column ASC";

//return all seats that are not available
$reservedSeatsSql = "SELECT seats.id, cinema_row, cinema_column FROM seats, bookings_seats, showings, bookings WHERE bookings_seats.seat_id = seats.id AND bookings_seats.booking_id = bookings.id AND bookings.showing_id = '" . $showingId . "' AND bookings.booking_status != 'deleted' ORDER BY cinema_row ASC, cinema_column ASC";

//execute queries
$allSeats = $dao->findAll($allSeatsSql);
$reservedSeats = $dao->findAll($reservedSeatsSql);

//if non available seats exist, set the status of them to disabled (for use in their html for greying out)
if ($reservedSeats) {
    foreach ($allSeats as $seat) {
        foreach ($reservedSeats as $reservedSeat) {
            if ($seat->getId() == $reservedSeat->getId()) {
                $seat->setStatus('disabled="disabled"');
            }
        }
    }
}


//empty array
$output = '';

function generateGrid($seats) {
    $output = '';
    $row = 1;
    
    //get the maximum dimension of the grid
    end($seats);
    $lastSeat = $seats[key($seats)];
    $rowCount = $lastSeat->getCinemaRow();

    //generate the theatre grid row by row, stopping at the last row.
    while ($row <= $rowCount) {
        foreach ($seats as $seat) {
            if ($seat->getCinemaRow() == $row) {
                $output = $output . '<input class="seat-checkbox" type="checkbox" name="seat[]" value="' . $seat->getId() . '"' . $seat->getStatus() . '>';
            }
        }
        $row++;
        $output = $output . '<br>';
    }
    return $output;
}

$grid = generateGrid($allSeats);

//---------- CREATE BOOKING ----------//

//if seats have been selected, generate empty booking object
if (array_key_exists('seat', $_POST)) {
    $booking = new Booking();
    $bookingId = null;
    $booking->setId($bookingId);
    $booking->setShowingId('');
    $booking->setUserId('');
    $booking->setStatus('');
    
    //if a user is logged in, assign the booking to the user
    if (array_key_exists('username', $_SESSION)) {
        $booking->getUserId($_SESSION['id']);
    } else {
        $booking->setUserId(null);
    }

    //add the showing id and the user id, if extant, to the object
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
    header('Location: index.php?page=booking-confirm&id=' . $booking->getId());    
}