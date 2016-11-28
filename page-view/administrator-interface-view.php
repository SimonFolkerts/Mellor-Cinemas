<?php if ($_SESSION['username'] === 'administrator') : ?>

    <div>
        <h3>Add Movie</h3>
        <form action="index.php?page=administrator-interface&create-movie=true" method="post">
            Title: <input type="text" name="movie_title"><br>
            Poster Filename: <input type="text" name="poster"><br>
            Synopsis<br>
            <textarea name="synopsis" rows="8"></textarea><br>
            <button type="submit" name="save">Add Movie</button>
        </form>

        <h3>Add Showing</h3>
        <form action="index.php?page=administrator-interface&create-showing=true" method="post">
            Movie: <select name="movie_id">
                <?php foreach ($movies as $movie) : ?>
                    <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                <?php endforeach ?>
            </select>
            Date: <input type="text" name="date" value="dd/mm/yy"><br>
            Start Time: <input type="text" name="start" value="24:00"><br>
            End Time: <input type="text" name="end" value="24:00"><br>
            Cinema: <input type="text" name="cinema" value="1"><br>
            <button type="submit" name="save">Add Showing</button>
        </form>
    </div>

    <div>
        <h3>Movie List</h3>
        <p>Movies</p>
        <?php foreach ($movies as $movie) : ?>
            <ul>
                <li>Title: <?php echo $movie->getTitle(); ?></li>
                <li>Movie ID: <?php echo $movie->getId(); ?></li>
                <li>Poster: <?php echo $movie->getPoster(); ?></li>
                <li>Synopsis: <?php echo $movie->getSynopsis(); ?></li>
                <li>Active Showings: <?php echo $movie->getShowings(); ?></li>
                <li>Status: <?php echo $movie->getStatus(); ?></li>
            </ul>
            <?php if ($movie->getShowings()) : ?>
                <form method="post" action="index.php?page=administrator-interface">
                    <button name="movieId" type="submit" value="<?php echo $movie->getId(); ?>">Get Showings</button>
                </form>
            <?php endif; ?>
            <form method="post" action="index.php?page=administrator-add-edit&type=movie&id=<?php echo $movie->getId(); ?>">
                <button type="submit">Edit Movie</button>
            </form>
            <?php if ($movie->getStatus() == 'deleted') : ?>
                <button type="submit" disabled>Delete Movie</button>
                <p>Movie is deleted!</p>
            <?php elseif ((int) $movie->getShowings() > 0) : ?>
                <button type="submit" disabled>Delete Movie</button>
                <p>Cannot delete movie with active showings!</p>
            <?php else : ?>
                <form method="post" action="index.php?page=administrator-interface&delete-movie=<?php echo $movie->getId(); ?>">
                    <button type="submit">Delete Movie</button> 
                </form>
            <?php endif; ?>
        <?php endforeach ?>
    </div>




    <div>
        <h3>Showings 
            <?php if (array_key_exists('movieId', $_POST) && !$noShowings) : ?>
                <?php echo 'for: ' . $title ?></h3>
            <?php foreach ($showings as $showing) : ?>
                <ul>
                    <li>Movie Title: <?php echo $title ?></li>
                    <li>Showing ID: <?php echo $showing->getId(); ?></li>
                    <li>Date: <?php echo $showing->getDate(); ?></li>
                    <li>Start Time: <?php echo $showing->getStartTime(); ?></li>
                    <li>End Time: <?php echo $showing->getEndTime(); ?></li>
                    <li>Cinema: <?php echo $showing->getCinema(); ?></li>
                    <li>Active Bookings: <?php echo $showing->getCinema(); ?></li>
                    <li>Status: <?php echo $showing->getStatus(); ?></li>
                </ul>
                <form method="post" action="index.php?page=administrator-add-edit&type=showing&id=<?php echo $showing->getId(); ?>">
                    <button name="title" type="submit" value="<?php echo $title ?>">Edit Showing</button>
                </form>
            </form>
            <form method="post" action="index.php?page=administrator-interface&delete-showing=<?php echo $showing->getId(); ?>">
                <button type="submit">Delete Showing</button>
            </form>
        <?php endforeach; ?>
    <?php else : ?>
        </h3><p>No showings</p>
    <?php endif; ?>
    </div>

    <div>
        <h3>Users</h3>
        <?php foreach ($users as $user) : ?>
            <ul>
                <li>ID: <?php echo $user->getId(); ?></li>
                <li>Username: <?php echo $user->getUserName(); ?></li>
                <li>Password: <?php echo $user->getPassword(); ?></li>
                <li>Email: <?php echo $user->getEmail(); ?></li>
                <li>Active Bookings: <?php echo $user->getBookingCount(); ?></li>
                <li>Status: <?php echo $user->getStatus(); ?></li>
            </ul>
            <?php if ($user->getBookingCount()) : ?>
                <form method="post" action="index.php?page=administrator-interface&userId=<?php echo $user->getId(); ?>">
                    <button name="userId" type="submit" value="<?php echo $user->getId(); ?>">Get Bookings</button>
                </form>
            <?php endif; ?>
            <?php if ($user->getStatus() != 'admin') : ?>
                <form method="post" action="index.php?page=administrator-interface&delete-user=<?php echo $user->getId(); ?>">
                    <button type="submit" name="delete-user" value="<?php echo $user->getId(); ?>">Delete User</button>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div>

        <h3>Bookings</h3>
        <?php if (!$noBookings) : ?>
            <?php foreach ($data as $booking) : ?>
                <p>ID: <?php echo $booking['id']; ?>
                <p>User: <?php echo $booking['user']; ?>
                <p>Showing: <?php echo $booking['showing']; ?>
                <p>Date: <?php echo $booking['date']; ?></p>
                <p>Time: <?php echo $booking['start']; ?> - <?php echo $booking['end'] ?></p>
                <p>Seat(s):</p>
                <?php foreach ($booking['seats'] as $seat) : ?>
                    <p>----Row: <?php echo $seat['row']; ?><br>----Seat No.: <?php echo $seat['seat']; ?><br></p>
                <?php endforeach; ?>
                <p>Status: <?php echo $booking['status']; ?>
                <form method="post" action="index.php?page=account&admin=true&user-index=<?php echo $booking['userId']; ?>">
                    <button type="submit" name="delete-booking" value="<?php echo $booking['id']; ?>">Delete Booking</button>
                </form>
            </div>
            <?php
        endforeach;
    else :
        ?>
        </h3><p>No bookings to display.</p>
    <?php endif ?>
    </div>

<?php else : ?>
    <h3>Access Denied</h3>
<?php endif; ?>

<p>--------------</p>