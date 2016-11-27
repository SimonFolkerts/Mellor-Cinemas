<?php

$dao = new Dao();
$moviesSql = "SELECT id, poster, movie_title, movie_synopsis, status FROM movies";
$movieRows = $dao->getRows($moviesSql);
$movies = array();
foreach ($movieRows as $movieRow) {
    $movie = new Movie();
    MovieMapper::map($movie, $movieRow);
    $movies[] = $movie;
}

if (array_key_exists('movieId', $_POST)) {
    $showingsSql = "SELECT movie_title, showings.id, date, start_time, end_time, cinema, showings.status FROM showings, movies WHERE movies.id = showings.movie_id AND movie_id =" . $_POST['movieId'];
    $showingRows = $dao->getRows($showingsSql);
    $showings = array();
    foreach ($showingRows as $showingRow) {
        $title = $showingRow['movie_title'];
        $showing = new Showing();
        ShowingMapper::map($showing, $showingRow);
        $showings[] = $showing;
    }
}

$usersSql = "SELECT users.id, username, password, email, users.status, count(bookings.id) as booking_count FROM users LEFT JOIN bookings ON bookings.user_id = users.id GROUP BY users.id";
$userRows = $dao->getRows($usersSql);
$users = array();
foreach ($userRows as $userRow) {
    $user = new User();
    UserMapper::map($user, $userRow);
    $user->setBookingCount($userRow['booking_count']);
    $users[] = $user;
}

//MINIFIED SQL: SELECT bookings.id as booking_id, movies.movie_title, showings.start_time, showings.end_time, users.username, seats.cinema_row, seats.cinema_column, bookings.booking_status FROM movies, bookings, showings, users, seats, bookings_seats WHERE bookings.user_id = users.id AND bookings.showing_id = showings.id AND movies.id = showings.movie_id AND seats.id = bookings_seats.seat_id AND bookings.id = bookings_seats.booking_id;

if (array_key_exists('userId', $_GET)) {
    $bookingsSql = ""
            . "SELECT bookings.id as booking_id, "
            . "movies.movie_title, "
            . "showings.date, "
            . "showings.start_time, "
            . "showings.end_time, "
            . "users.username, "
            . "seats.cinema_row, "
            . "seats.cinema_column, "
            . "bookings.booking_status "
            . "FROM "
            . "movies, "
            . "bookings, "
            . "showings, "
            . "users, "
            . "seats, "
            . "bookings_seats "
            . "WHERE "
            . "bookings.user_id = users.id "
            . "AND "
            . "bookings.showing_id = showings.id "
            . "AND "
            . "movies.id = showings.movie_id "
            . "AND "
            . "seats.id = bookings_seats.seat_id "
            . "AND "
            . "bookings.id = bookings_seats.booking_id "
            . "AND users.id = " . $_GET['userId'];

    $bookingRows = $dao->getRows($bookingsSql);
    $data = '';
    $bookingId = '';
    $lastId = '';
    $i = 0;

    foreach ($bookingRows as $row) {
        $bookingId = $row['booking_id'];
        if ($lastId != $bookingId) {
            $i++;
            $data[$i] = array(
                'id' => $row['booking_id'],
                'showing' => $row['movie_title'],
                'user' => $row['username'],
                'userId' => $_GET['userId'],
                'date' => $row['date'],
                'start' => $row['start_time'],
                'end' => $row['end_time'],
                'seats' => [],
                'status' => $row['booking_status']
            );
        }
        $data[$i]['seats'][] = array(
            'row' => $row['cinema_row'],
            'seat' => $row['cinema_column']
        );

        $lastId = $bookingId;
    }
}