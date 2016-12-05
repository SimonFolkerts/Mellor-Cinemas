<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Log In');
$headerInfo->setDescription('Users with a Mellor Cinema account can log in here to buy tickets online.');
$headerInfo->setKeywords('Mellor, Cinema, movie, ticket, log in, account');

$errors = array();
$edit = array_key_exists('id', $_GET);

//---------- LOG OUT ----------//

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//---------- LOG IN ----------//

if (isset($_POST['submit'])) {
    $dao = new UserDao();
    $db = $dao->getDb();

    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    $errors = UserCredentialsValidator::validateLogin($username, $password);

    if (empty($errors)) {
        //ask the database for user with the supplied credentials
        $user = $dao->getUserDetails($username, $password, $db);

        //if supplied credentials match with what was requested from the database, login
        if ($user == !null) {
            if ($username === $user->getUserName() && $password === $user->getPassword()) {
                $_SESSION['username'] = $user->getUserName();
                $_SESSION['id'] = $user->getId();
                if ($user->getStatus() === 'admin') {
                    header('Location: index.php?page=administrator-interface');
                } else {
                    header('Location: index.php');
                }
            } else {
                $errors[] = 'Incorrect credentials!';
            }
        } else {
            $errors[] = 'Incorrect credentials!';
        }
    }
}

//---------- CREATE ACCOUNT ----------//
//if create is set in the get, create a new empty User object, and 
//then map the supplied credentials to the object

if (isset($_GET['create'])) {
    if ($edit) {
        //if a pre-existing user is specified, retrieve that user object vie the id in the GET
        $dao = new UserDao();
        $user = Utilities::getObjByGetId($dao);
    } else {
        //otherwise create new empty object
        $user = new User();
        $userId = null;
        $user->setId($userId);
        $user->setUserName('');
        $user->setPassword('');
        $user->setEmail('');
    }

    if (array_key_exists('save', $_POST)) {

        $username = $_POST['create-username'];
        $password = $_POST['create-password'];
        $email = $_POST['create-email'];

        $errors = UserCredentialsValidator::validateAll($username, $password, $email);

        if (empty($errors)) {

            //add supplied information to the object
            $data = array(
                'username' => $username,
                'password' => $password,
                'email' => $email
            );

            UserMapper::map($user, $data);


            $dao = new UserDao();
            $dao->save($user);
            $user = $dao->getUserDetails($user->getUserName(), $user->getPassword(), $dao->getDb());
            //log the user into the session
            $_SESSION['username'] = $user->getUserName();
            $_SESSION['id'] = $user->getId();
            header('Location: index.php');
        }
    }
}