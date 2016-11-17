<?php

$errors = '';

if (isset($_POST['submit'])) {
    $dao = new UserDao();
    $db = $dao->getDb();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user = $dao->getUserDetails($username, $password, $db);
    //TODO find out about inheritance and variable scope. 
    
    if ($username === $user['username'] && $password === $user['password']) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $errors = 'NAH WRONG!';
    }

}

?>