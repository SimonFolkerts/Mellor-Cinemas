<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Confirm');
$headerInfo->setDescription('Confirm your booking.');
$headerInfo->setKeywords('Mellor, Cinema, movie, ticket, confirm, buy');

//----------- BOOKING ----------//

$dao = new Dao();

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
        . "AND "
        . "bookings.id = " . $_GET['id'] . " "
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