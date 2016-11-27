<?php 

$dao = new MovieDao();

//return all movies that are active

$sql = 'SELECT * FROM movies WHERE status != "deleted"';
$movies = $dao->findAll($sql);