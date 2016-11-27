<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <nav>
            <p>This is the Header</p>
            <ul>
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
            </ul>
        </nav>
        <p>--------------</p>