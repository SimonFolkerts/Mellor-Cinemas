<?php
$dao = new Dao();

$sql = 'SELECT * FROM movies, showings WHERE movies.id = showings.movie_id AND showings.id = ' . $_GET['id'];
$results = $dao->getRow($sql);

//TODO clean up here

$movieId = $results['movie_id'];
//$moviePoster = $results['poster'];
$movieTitle = $results['movie_title'];
//$movieSynopsis = $results['movie_synopsis'];

$sessionTime = $results['start_time'] . " - " . $results['end_time'];