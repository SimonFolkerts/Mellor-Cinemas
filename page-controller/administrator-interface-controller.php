<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Admin');
$headerInfo->setDescription(null);
$headerInfo->setKeywords(null);

//return all movies in the database
$dao = new Dao();
//MINIFIED SQL: SELECT movies.id, poster, movie_title, movie_synopsis, movies.status, count(showings.id) as showing_count FROM movies LEFT JOIN showings ON showings.movie_id = movies.id AND showings.status != 'deleted' WHERE movies.status != 'deleted' GROUP BY movies.id;
$moviesSql = ""
        . "SELECT "
        . "movies.id, "
        . "poster, "
        . "movie_title, "
        . "movie_synopsis, "
        . "movies.status, "
        . "count(showings.id) as showing_count "
        . "FROM "
        . "movies "
        . "LEFT JOIN "
        . "showings "
        . "ON "
        . "showings.movie_id = movies.id "
        . "AND "
        . "showings.status != 'deleted' "
        . "WHERE "
        . "movies.status != 'deleted' "
        . "GROUP BY "
        . "movies.id;";

$movieRows = $dao->getRows($moviesSql);

//map the movies to objects and append them to an array
$movies = array();
foreach ($movieRows as $movieRow) {
    $movie = new Movie();
    MovieMapper::map($movie, $movieRow);
    $movie->setShowings($movieRow['showing_count']);
    $movies[] = $movie;
}

//if a movie has been selected, return its showings, including extra information from the movie table for clarity
if (array_key_exists('movieId', $_POST)) {
    //MINIFIED SQL: SELECT movie_title, showings.id, date, start_time, end_time, cinema, showings.status, count(bookings.id) as bookings FROM movies, showings LEFT JOIN bookings ON showings.id = bookings.showing_id AND bookings.booking_status != 'deleted' WHERE movies.id = showings.movie_id AND movie_id = " . $_POST['movieId'] . " GROUP BY showings.id ORDER BY showings.date DESC, showings.start_time ASC
    $showingsSql = ""
            . "SELECT "
            . "movie_title, "
            . "showings.id, "
            . "date, "
            . "start_time, "
            . "end_time, "
            . "cinema, "
            . "showings.status, "
            . "count(bookings.id) as bookings FROM movies, "
            . "showings "
            . "LEFT JOIN "
            . "bookings ON showings.id = bookings.showing_id "
            . "AND "
            . "bookings.booking_status != 'deleted' "
            . "WHERE "
            . "movies.id = showings.movie_id "
            . "AND "
            . "movie_id = " . $_POST['movieId'] . " "
            . "AND "
            . "showings.status != 'deleted' "
            . "GROUP BY "
            . "showings.id "
            . "ORDER BY "
            . "showings.date ASC, "
            . "showings.start_time ASC;";

    $showingRows = $dao->getRows($showingsSql);

    //map the showings to objects and append them to an array
    $showings = array();
    if ($showingRows) {
        $noShowings = false;
        foreach ($showingRows as $showingRow) {
            $title = $showingRow['movie_title'];
            $showing = new Showing();
            ShowingMapper::map($showing, $showingRow);
            $showing->setBookings($showingRow['bookings']);
            $showings[] = $showing;
        }
    }
} else {
    $noShowings = true;
}

//return all users in the database
//MINIFIED SQL: SELECT users.id, username, password, email, users.status, count(bookings.id) as booking_count FROM users LEFT JOIN bookings ON bookings.user_id = users.id AND bookings.booking_status != 'deleted' GROUP BY users.id";
$usersSql = ""
        . "SELECT "
        . "users.id, "
        . "username, "
        . "password, "
        . "email, "
        . "users.status, "
        . "count(bookings.id) as booking_count "
        . "FROM "
        . "users "
        . "LEFT JOIN "
        . "bookings "
        . "ON "
        . "bookings.user_id = users.id "
        . "AND "
        . "bookings.booking_status != 'deleted' "
        . "WHERE "
        . "users.status != 'deleted' "
        . "GROUP BY "
        . "users.id";
$userRows = $dao->getRows($usersSql);
//map the users to objects and append them to an array
$users = array();
foreach ($userRows as $userRow) {
    $user = new User();
    UserMapper::map($user, $userRow);
    $user->setBookingCount($userRow['booking_count']);
    $users[] = $user;
}

//MINIFIED SQL: SELECT bookings.id as booking_id, movies.movie_title, showings.start_time, showings.end_time, users.username, seats.cinema_row, seats.cinema_column, bookings.booking_status FROM movies, bookings, showings, users, seats, bookings_seats WHERE bookings.user_id = users.id AND bookings.showing_id = showings.id AND movies.id = showings.movie_id AND seats.id = bookings_seats.seat_id AND bookings.id = bookings_seats.booking_id;

if (array_key_exists('userId', $_POST)) {
//MINIFIED SQL: SELECT bookings.id as booking_id, movies.movie_title, showings.date, showings.start_time, showings.end_time, users.username, seats.cinema_row, seats.cinema_column, bookings.booking_status FROM movies, bookings, showings, users, seats, bookings_seats WHERE bookings.user_id = users.id AND bookings.showing_id = showings.id AND movies.id = showings.movie_id AND seats.id = bookings_seats.seat_id AND bookings.id = bookings_seats.booking_id AND users.id = " . $_GET['userId'] . " ORDER BY showings.date DESC, showings.start_time ASC;
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
            . "AND users.id = " . $_GET['userId'] . " "
            . "AND bookings.booking_status != 'deleted' "
            . "ORDER BY showings.date ASC, showings.start_time ASC;";

    //nested for loops to display multi-row data
    $bookingRows = $dao->getRows($bookingsSql);
    if ($bookingRows) {
        $noBookings = false;
        $data = '';
        $bookingId = '';
        $lastId = '';
        $i = 0;


        //an array is used in lieu of object as the information is from several tables
        //create an array, and loop through the rows
        foreach ($bookingRows as $row) {
            $bookingUsername = $row['username'];
            $bookingId = $row['booking_id'];
            //if a new booking id is encountered, append it to the array with a specific index
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
            //if the booking id has not changed, skip everything except the seats.
            //for every row, append the seat cordinates to the current array index
            $data[$i]['seats'][] = array(
                'row' => $row['cinema_row'],
                'seat' => $row['cinema_column']
            );

            $lastId = $bookingId;
        }
    } else {
        $noBookings = true;
    }
} else {
    $noBookings = true;
}
//an array with an entry for each unique booking id, with a sub-array containing all seats assigned to that booking id is created
//(array[information, seats[[x,y], [x,y], [x,y]]
//create or edit a new movie
if (isset($_GET['create-movie'])) {
    $edit = array_key_exists('id', $_GET);
    if ($edit) {
        //if sepcific entry selected, retrieve its data via GET id        
        $dao = new MovieDao();
        $movie = Utilities::getObjByGetId($dao);
    } else {
        //otherwise generate empty movie object
        $movie = new Movie();
        $userId = null;
        $movie->setId($userId);
        $movie->setPoster('');
        $movie->setTitle('');
        $movie->setSynopsis('');
        $movie->setStatus('');
    }

    //map supplied information to the existing/new object
    if (array_key_exists('save', $_POST)) {

        $errors = MovieValidator::validateMovie($_POST);

        if (empty($errors)) {
            $data = array(
                'poster' => $_POST['poster'],
                'movie_title' => $_POST['movie_title'],
                'movie_synopsis' => $_POST['synopsis']
            );

            MovieMapper::map($movie, $data);


            $dao = new MovieDao();
            $dao->save($movie);
            $movie = $dao->getMovieDetails($movie->getTitle(), $dao->getDb());
            header('Location: index.php?page=administrator-interface');
        }
    }
}

//create or edit a new showing
if (isset($_GET['create-showing'])) {
    $edit = array_key_exists('id', $_GET);
    if ($edit) {
        //if sepcific entry selected, retrieve its data via GET id  
        $dao = new ShowingDao();
        $showing = Utilities::getObjByGetId($dao);
    } else {
        //otherwise generate empty movie object
        $showing = new Showing();
        $showingId = null;
        $showing->setId($showingId);
        $showing->setDate('');
        $showing->setStartTime('');
        $showing->setEndTime('');
        $showing->setCinema('');
        $showing->setStatus('');
    }

    //map supplied information to the existing/new object
    if (array_key_exists('save', $_POST)) {

        $errors = ShowingValidator::validateShowing($_POST);


        if (empty($errors)) {
            $data = array(
                'movie_id' => $_POST['movie_id'],
                'date' => $_POST['date'],
                'start_time' => $_POST['start'],
                'end_time' => $_POST['end'],
                'cinema' => $_POST['cinema']
            );

            ShowingMapper::map($showing, $data);

            $dao = new ShowingDao();
            $dao->save($showing);
            header('Location: index.php?page=administrator-interface');
        }
    }
}

if (array_key_exists('delete-movie', $_GET)) {
    $dao = new MovieDao();
    $dao->delete($_GET['delete-movie']);
    header('Location: index.php?page=administrator-interface');
}

if (array_key_exists('delete-showing', $_GET)) {
    $dao = new ShowingDao();
    $dao->delete($_GET['delete-showing']);
    header('Location: index.php?page=administrator-interface');
}

if (array_key_exists('delete-user', $_GET)) {
    $dao = new UserDao();
    $dao->delete($_GET['delete-user']);
    header('Location: index.php?page=administrator-interface');
}