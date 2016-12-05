<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo Utilities::escape($headerInfo->getTitle()); ?></title>
        <meta name="description" content=<?php echo Utilities::escape('"' . $headerInfo->getDescription() . '"'); ?>>
        <link rel="stylesheet" type="text/css" href="../web/css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Limelight|Oswald:light" rel="stylesheet">
    </head>
    <body>
        <nav id="navbar">
            <div id="header-bar">
                <img id="logo" src="../web/img/logo.gif" alt='Mellor Cinemas'>
                <div id=" nav-contact">
                    <p class="nav-contact__p">Tel: 0800 000 0000</p>
                    <p class="nav-contact__p">54 Road Avenue</p>
                </div>
            </div>
            <div id="navbox-outer">
                <div id="navbox-inner">
                    <?php if (isset($_SESSION['username'])) { ?>
                        <p class="user-greeting">Hello <?php echo Utilities::escape($_SESSION['username']); ?></p>
                    <?php } ?>
                    <ul id="nav-list">
                        <li><a href="http://localhost/MellorCinemas/web/index.php?page=home">Movies</a></li>
                        <!--if user is set, display logged in interface, else display log in option-->
                        <?php if (isset($_SESSION['username'])) { ?>
                            <?php if ($_SESSION['username'] == 'administrator') : ?>
                                <li><a href="http://localhost/MellorCinemas/web/index.php?page=administrator-interface">Administrator Interface</a></li>
                            <?php else : ?>
                                <li><a href="http://localhost/MellorCinemas/web/index.php?page=account">Account</a></li>
                            <?php endif; ?>
                            <li><a href="http://localhost/MellorCinemas/web/index.php?page=login&logout=true">Log Out</a></li>
                        <?php } else { ?>
                            <li><a href="http://localhost/MellorCinemas/web/index.php?page=login">Log In/Sign Up</a></li>
                        <?php } ?>
                        <li><a href="http://localhost/MellorCinemas/web/index.php?page=contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>