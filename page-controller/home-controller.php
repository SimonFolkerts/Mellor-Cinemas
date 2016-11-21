<?php 

$dao = new ShowingDao();

$sql = 'SELECT * FROM showings WHERE status != "deleted"';
$showings = $dao->findAll($sql);



