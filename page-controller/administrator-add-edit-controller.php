<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Admin Edit');
$headerInfo->setDescription(null);
$headerInfo->setKeywords(null);


//specify which interface to show: movie or showing
$type = $_GET['type'];

//initialise error reporting
$errors = '';

//set requirement for id to enable editing
$edit = array_key_exists('id', $_GET);
if ($edit && $type == 'movie') {
    //if sepcific entry selected, retrieve its data via GET id  
    $dao = new MovieDao();
    $movie = Utilities::getObjByGetId($dao);

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

$edit = array_key_exists('id', $_GET);
if ($edit && $type == 'showing') {
    //if sepcific entry selected, retrieve its data via GET id  
    $dao = new ShowingDao();
    $showing = Utilities::getObjByGetId($dao);

    if (array_key_exists('title', $_POST)) {
        $title = $_POST['title'];
    } elseif (array_key_exists('save', $_POST)) {
        $title = $_POST['save'];
    }
    //map supplied information to the existing/new object
    if (array_key_exists('save', $_POST)) {

        $title = $_POST['save'];
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


            //TODO ensure unique entries

            $dao = new ShowingDao();
            $dao->save($showing);
            $id = $showing->getId();
            header('Location: index.php?page=administrator-interface');
        }
    }
}
