<?php

$dao = new UserDao();

$sql = "SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'";
$user = $dao->find($sql);

if (array_key_exists('delete-account', $_GET)) {
    $dao->delete($user->getId());
    session_unset();
    session_destroy();
    header('Location: index.php');
}

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

$showingInfos = '';
$bookingId = '';
$lastId = '';
$i = 0;

foreach ($rows as $row) {
    $bookingId = $row['id'];
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
    $showingInfos[$i]['seats'][] = array(
        'row' => $row['cinema_row'],
        'seat' => $row['cinema_column']
    );

    $lastId = $bookingId;
}

if (array_key_exists('delete-booking', $_POST)) {
    $dao = new BookingDao();
    $dao->delete($_POST['delete-booking']);
    if (array_key_exists('admin', $_GET)) {
        if ($_SESSION['username'] == 'administrator') {
            header('Location: index.php?page=administrator-interface&userId=' . $_GET['user-index']);
        } else {
            header('Location: index.php?page=access-denied');
        }
    } else {
        header('Location: index.php?page=account');
    }
}