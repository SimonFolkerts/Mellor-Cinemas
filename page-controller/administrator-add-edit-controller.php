<?php

$type = $_GET['type'];

$edit = array_key_exists('id', $_GET);
if ($edit && $type == 'movie') {
    //if sepcific entry selected, retrieve its data via GET id  
    $dao = new MovieDao();
    $movie = Utilities::getObjByGetId($dao);

    //map supplied information to the existing/new object
    if (array_key_exists('save', $_POST)) {

        $data = array(
            'poster' => $_POST['poster'],
            'movie_title' => $_POST['movie_title'],
            'movie_synopsis' => $_POST['synopsis']
        );

        MovieMapper::map($movie, $data);

//        $errors = UserValidator::validate($user);
        $errors = [];
        //TODO ensure unique entries
        //TODO add functionality for updating existing user

        if (empty($errors)) {
            $dao = new MovieDao();
            $dao->save($movie);
            $movie = $dao->getMovieDetails($movie->getTitle(), $dao->getDb());
            header('Location: index.php?page=administrator-interface');
        }
    }
}

$edit = array_key_exists('id', $_GET);
    if ($edit && $type == 'showing') {
        //if sepcific entry selected, retrieve its data via GET id  
        $dao = new ShowingDao();
        $showing = Utilities::getObjByGetId($dao);
        
        //map supplied information to the existing/new object
    if (array_key_exists('save', $_POST)) {

        $data = array(
            'movie_id' => $_POST['movie_id'],
            'date' => $_POST['date'],
            'start_time' => $_POST['start'],
            'end_time' => $_POST['end'],
            'cinema' => $_POST['cinema']
        );

        ShowingMapper::map($showing, $data);

//        $errors = UserValidator::validate($user);
        $errors = [];
        //TODO ensure unique entries
        //TODO add functionality for updating existing user

        if (empty($errors)) {
            $dao = new ShowingDao();
            $dao->save($showing);
            header('Location: index.php?page=administrator-interface');
        }
    }
}