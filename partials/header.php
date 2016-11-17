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
                <li><a href="http://localhost/MellorCinemas/index.php?page=home">Home</a></li>
                <li><a href="http://localhost/MellorCinemas/index.php?page=movies">Movies</a></li>
                <li><a href="http://localhost/MellorCinemas/index.php?page=login">Log In/Sign Up</a></li>
                <?php if (isset($_SESSION['username'])) {
                    echo "<p>Hello " . $_SESSION['username'] . "</p>";
                } else { echo 'nope';} ?>
            </ul>
        </nav>
         <p>--------------</p>