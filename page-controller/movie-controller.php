<?php

$dao = new ShowingDao();

$sql = 'SELECT poster, movie_title, movie_synopsis FROM showings WHERE id = ' . $_GET['id'];
$showing = $dao->find($sql);

$moviePoster = $showing->getPoster();
$movieTitle = $showing->getMovieTitle();
$movieSynopsis = $showing->getMovieSynopsis();

?>