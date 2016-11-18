<?php

$errors = '';
$edit = array_key_exists('id', $_GET);
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}

if (isset($_POST['submit'])) {
    $dao = new UserDao();
    $db = $dao->getDb();

    $username = $_POST['username'];
    $password = $_POST['password'];

    //ask the database for user with the supplied credentials
    $user = $dao->getUserDetails($username, $password, $db);
    //TODO find out about inheritance and variable scope. 
    //if supplied credentials match with what was requested from the database, login
    if ($username === $user['username'] && $password === $user['password']) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        $errors = 'NAH WRONG!';
    }
}

//if create is set in the get, create a new empty User object, and 
//then map the supplied credentials to the object
if (isset($_GET['create'])) {
    $user = new User();
    $userId = null;
    $user->setId($userId);
    $user->setUserName('');
    $user->setPassword('');
    $user->setEmail('');

    $data = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email']
    );

    UserMapper::map($user, $data);

    $errors = UserValidator::validate($user);
    var_dump($errors);
    //TODO ensure unique entries
    //TODO add functionality for updating existing user

    if (empty($errors)) {
        $dao = new UserDao();
        $user = $dao->save($user);
        $_SESSION['username'] = $user->getUserName();
        header('Location: index.php');
    }
}
?>