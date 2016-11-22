<?php 

$dao = new MovieDao();

$sql = 'SELECT * FROM movies WHERE status != "deleted"';
$movies = $dao->findAll($sql);


