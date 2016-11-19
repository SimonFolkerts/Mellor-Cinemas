<?php
$dao = new UserDao();

$sql = "SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'";
$user = $dao->find($sql);