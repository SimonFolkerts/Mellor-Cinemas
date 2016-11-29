<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="web/css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Limelight|Oswald:light" rel="stylesheet">
    </head>
    <body>
        <nav id="navbar">
            <img id="logo" src="web/img/logo.gif" alt='Mellor Cinemas'>
            <div id="navbox-outer">
                <div id="navbox-inner">
                    <ul id="nav-list">
                        <li><a href="http://localhost/MellorCinemas/index.php?page=home">Movies</a></li>
                        <!--if user is set, display logged in interface, else display log in option-->
                        <?php if (isset($_SESSION['username'])) { ?>
                            <p>Hello "<?php echo $_SESSION['username'] ?>"</p>
                            <?php if ($_SESSION['username'] == 'administrator') : ?>
                                <li><a href="http://localhost/MellorCinemas/index.php?page=administrator-interface">Administrator Interface</a></li>
                            <?php else : ?>
                                <li><a href="http://localhost/MellorCinemas/index.php?page=account">Account</a></li>
                            <?php endif; ?>
                            <li><a href="http://localhost/MellorCinemas/index.php?page=login&logout=true">Log Out</a></li>
                        <?php } else { ?>
                            <li><a href="http://localhost/MellorCinemas/index.php?page=login">Log In/Sign Up</a></li>
                        <?php } ?>
                        <li><a href="http://localhost/MellorCinemas/index.php?page=contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>