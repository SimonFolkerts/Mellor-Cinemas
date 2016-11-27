<?php

//---------- DISPLAY SELECTED MOVIE ----------//

$dao = new MovieDao();

$sql = 'SELECT id, poster, movie_title, movie_synopsis FROM movies WHERE id = ' . $_GET['id'];
$movie = $dao->find($sql);

$movieId = $movie->getId();
$moviePoster = $movie->getPoster();
$movieTitle = $movie->getTitle();
$movieSynopsis = $movie->getSynopsis();


//---------- DISPLAY MOVIE SHOWINGS ----------//

$dao = new ShowingDao();

$sql = 'SELECT * FROM showings WHERE status != "deleted" AND movie_id = ' . $_GET['id'];
$showings = $dao->findAll($sql);


?>