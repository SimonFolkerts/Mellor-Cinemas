<?php
//---------- USER OBJECT -----------//
//
//retrive the user from the database
$dao = new UserDao();
$sql = "SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'";
$user = $dao->find($sql);

//---------- ACCOUNT DELETION ----------//

//if deletion has been called for by the GET, call the delete function on the current user, close the session and return to home
if (array_key_exists('delete-account', $_GET)) {
    $dao->delete($user->getId());
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//otherwise proceed with retrieval of user booking data for display

//----------- BOOKING DISPLAY ----------//

$dao = new Dao();

//MINIFIED SQL: SELECT movies.movie_title, movies.poster, showings.date, showings.start_time, showings.end_time, showings.cinema, bookings.id, seats.cinema_row, seats.cinema_column FROM users, bookings, bookings_seats, seats, showings, movies WHERE showings.movie_id = movies.id AND bookings.showing_id = showings.id AND bookings.user_id = users.id AND bookings.id = bookings_seats.booking_id AND bookings_seats.seat_id = seats.id AND users.id = " . $_SESSION['id'] . " AND bookings.booking_status != 'deleted' ORDER BY bookings.id ASC;

$sql = "SELECT "
        . "movies.movie_title, "
        . "movies.poster, "
        . "showings.date, "
        . "showings.start_time, "
        . "showings.end_time, "
        . "showings.cinema, "
        . "bookings.id, "
        . "seats.cinema_row, "
        . "seats.cinema_column "
        . "FROM "
        . "users, "
        . "bookings, "
        . "bookings_seats, "
        . "seats, "
        . "showings, "
        . "movies "
        . "WHERE "
        . "showings.movie_id = movies.id "
        . "AND "
        . "bookings.showing_id = showings.id "
        . "AND "
        . "bookings.user_id = users.id "
        . "AND "
        . "bookings.id = bookings_seats.booking_id "
        . "AND "
        . "bookings_seats.seat_id = seats.id "
        . "AND "
        . "users.id = " . $_SESSION['id'] . " "
        . "AND bookings.booking_status != 'deleted' "
        . "ORDER BY bookings.id ASC;";

$rows = $dao->getRows($sql);


//nested for loops to display multi-row data
$showingInfos = '';
$bookingId = '';
$lastId = '';
$i = 0;

//create an array, and loop through the rows
foreach ($rows as $row) {
    $bookingId = $row['id'];
    //if a new booking id is encountered, append it to the array with a specific index
    if ($lastId != $bookingId) {
        $i++;
        $showingInfos[$i] = array(
            'id' => $row['id'],
            'title' => $row['movie_title'],
            'poster' => $row['poster'],
            'date' => $row['date'],
            'start' => $row['start_time'],
            'end' => $row['end_time'],
            'cinema' => $row['cinema'],
            'seats' => []
        );
    }
    //if the booking id has not changed, skip everything except the seats.
    //for every row, append the seat cordinates to the current array index
    $showingInfos[$i]['seats'][] = array(
        'row' => $row['cinema_row'],
        'seat' => $row['cinema_column']
    );
    
    $lastId = $bookingId;
}
//an array with an entry for each unique booking id, with a sub-array containing all seats assigned to that booking id is created
// (array[information, seats[[x,y], [x,y], [x,y]]

//----------- BOOKING DLETION ----------//

//if deletion is called for in the POST, call the delete function on the booking with the id specified in the 'delete-booking' key
if (array_key_exists('delete-booking', $_POST)) {
    $dao = new BookingDao();
    $dao->delete($_POST['delete-booking']);
    //check if the delete call was made from the admin account
    if (array_key_exists('admin', $_GET)) {
        if ($_SESSION['username'] == 'administrator') {
            //if the admin called for deletion and is verified, redirect to the admin interface with the id of the user to whom the booking belonged
            header('Location: index.php?page=administrator-interface&userId=' . $_GET['user-index']);
        } else {
            //if the admin is not logged in, block access to the admin interface
            header('Location: index.php?page=access-denied');
        }
    } else {
        //refresh
        header('Location: index.php?page=account');
    }
}