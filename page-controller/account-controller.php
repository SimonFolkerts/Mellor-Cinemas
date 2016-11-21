<?php
$dao = new UserDao();

$sql = "SELECT id FROM users WHERE username = '" . $_SESSION['username'] . "'";
$user = $dao->find($sql);

if (array_key_exists('delete', $_GET)) {
    $dao->delete($user->getId());
    session_unset();
    session_destroy();
    header('Location: index.php');
}
