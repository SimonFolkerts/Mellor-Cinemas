<section class="page-container">
    <?php if ($_SESSION['username'] === 'administrator') : ?>
        <section class="admin-pages">
            <section class="wrapper-section">
                <h3>Add Movie/Showing</h3>
                <details>
                    <summary>Show Add Forms</summary>
                    <section class="add-forms">
                        <div class="add-forms__container">
                            <h3>Add Movie</h3>
                            <form class="add-forms__form" action="index.php?page=administrator-interface&create-movie=true" method="post">
                                <label for="movie_title">Title: </label><input type="text" name="movie_title"><br>
                                <p>Poster Filename: </p><input type="text" name="poster"><br>
                                <p>Synopsis<br></p>
                                <textarea name="synopsis" rows="6" cols="70"></textarea><br>
                                <button class="button" type="submit" name="save">Add Movie</button>
                            </form>
                        </div>

                        <div class="add-forms__container">
                            <h3>Add Showing</h3>
                            <form class="add-forms__form" action="index.php?page=administrator-interface&create-showing=true" method="post">
                                <p>Movie: </p><select name="movie_id">
                                    <?php foreach ($movies as $movie) : ?>
                                        <option value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <p>Date: </p><input type="text" name="date" value="dd/mm/yy"><br>
                                <p>Start Time: </p><input type="text" name="start" value="24:00"><br>
                                <p>End Time: </p><input type="text" name="end" value="24:00"><br>
                                <p>Cinema: </p><input type="text" name="cinema" value="1"><br>
                                <button class="button" type="submit" name="save">Add Showing</button>
                            </form>
                        </div>
                    </section>
                </details>
            </section>

            <section class="wrapper-section">
                <h3>Movies</h3>
                <details>
                    <summary>Show Movies</summary>
                    <div class="list">
                        <?php foreach ($movies as $movie) : ?>
                            <div class="list__listing">
                                <ul class="list__info-list">
                                    <li>Title: <?php echo $movie->getTitle(); ?></li>
                                    <li>Movie ID: <?php echo $movie->getId(); ?></li>
                                    <li>Poster: <?php echo $movie->getPoster(); ?></li>
                                    <li>
                                        <details>
                                            <summary><?php echo $movie->getTitle(); ?> Synopsis</summary>
                                            Synopsis: <?php echo $movie->getSynopsis(); ?>
                                        </details>
                                    </li>
                                    <li>Active Showings: <?php echo $movie->getShowings(); ?></li>
                                    <li>Status: <?php echo $movie->getStatus(); ?></li>
                                </ul>
                                <div class="list__button-box">
                                    <?php if ($movie->getShowings()) : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface">
                                            <button class="button list__button" name="movieId" type="submit" value="<?php echo $movie->getId(); ?>">Get Showings</button>
                                        </form>
                                    <?php endif; ?>
                                    <form class="list__button-form" method="post" action="index.php?page=administrator-add-edit&type=movie&id=<?php echo $movie->getId(); ?>">
                                        <button class="button list__button" type="submit">Edit</button>
                                    </form>
                                    <?php if ($movie->getStatus() == 'deleted') : ?>
                                        <button class="button list__button" type="submit" disabled>Delete</button>
                                        <p>Movie is deleted!</p>
                                    <?php elseif ((int) $movie->getShowings() > 0) : ?>
                                        <button class="button list__button" type="submit" disabled>Delete</button>
                                        <p>Cannot delete movie with active showings!</p>
                                    <?php else : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-movie=<?php echo $movie->getId(); ?>">
                                            <button class="button list__button" type="submit">Delete</button> 
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                </details>
            </section>



            <section class="wrapper-section">
                <h3>Showings </h3>
                <details>
                    <summary>Show Showings</summary>
                    <?php if (array_key_exists('movieId', $_POST) && !$noShowings) : ?>
                        <div class="list">
                            <?php foreach ($showings as $showing) : ?>
                                <div class="list__listing">
                                    <ul class="list__info-list">
                                        <li>Movie Title: <?php echo $title ?></li>
                                        <li>Showing ID: <?php echo $showing->getId(); ?></li>
                                        <li>Date: <?php echo $showing->getDate(); ?></li>
                                        <li>Start Time: <?php echo $showing->getStartTime(); ?></li>
                                        <li>End Time: <?php echo $showing->getEndTime(); ?></li>
                                        <li>Cinema: <?php echo $showing->getCinema(); ?></li>
                                        <li>Active Bookings: <?php echo $showing->getBookings(); ?></li>
                                        <li>Status: <?php echo $showing->getStatus(); ?></li>
                                    </ul>
                                    <div class="list__button-box">
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-add-edit&type=showing&id=<?php echo $showing->getId(); ?>">
                                            <button class="button list__button" name="title" type="submit" value="<?php echo $title ?>">Edit Showing</button>
                                        </form>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-showing=<?php echo $showing->getId(); ?>">
                                            <button class="button list__button" type="submit">Delete Showing</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p>No showings</p>

                    <?php endif; ?>
                </details>
            </section>

            <section class="wrapper-section">
                <h3>Users</h3>
                <details>
                    <summary>Show Users</summary>
                    <div class="list">
                        <?php foreach ($users as $user) : ?>
                            <div class="list__listing">
                                <ul class="list__info-list">
                                    <li>ID: <?php echo $user->getId(); ?></li>
                                    <li>Username: <?php echo $user->getUserName(); ?></li>
                                    <li>Password: <?php echo $user->getPassword(); ?></li>
                                    <li>Email: <?php echo $user->getEmail(); ?></li>
                                    <li>Active Bookings: <?php echo $user->getBookingCount(); ?></li>
                                    <li>Status: <?php echo $user->getStatus(); ?></li>
                                </ul>
                                <div class="list__button-box">
                                    <?php if ($user->getBookingCount()) : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&userId=<?php echo $user->getId(); ?>">
                                            <button class="button list__button" name="userId" type="submit" value="<?php echo $user->getId(); ?>">Get Bookings</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($user->getStatus() != 'admin') : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-user=<?php echo $user->getId(); ?>">
                                            <button class="button list__button" type="submit" name="delete-user" value="<?php echo $user->getId(); ?>">Delete User</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </details>
            </section>

            <section class="wrapper-section">
                <h3>Bookings</h3>
                <details>
                    <summary>Show Bookings</summary>
                    <div class="list">
                        <?php if (!$noBookings) : ?>
                            <?php foreach ($data as $booking) : ?>
                                <div class="list__listing">
                                    <ul class="list__info-list">
                                        <li>ID: <?php echo $booking['id']; ?></li>
                                        <li>User: <?php echo $booking['user']; ?></li>
                                        <li>Showing: <?php echo $booking['showing']; ?></li>
                                        <li>Date: <?php echo $booking['date']; ?></li>
                                        <li>Time: <?php echo $booking['start']; ?> - <?php echo $booking['end'] ?></li>
                                        <li>Seat(s) [row, no.]:</li>
                                        <ul>
                                            <?php foreach ($booking['seats'] as $seat) : ?>
                                                <li>[ R: <?php echo $seat['row']; ?>, N: <?php echo $seat['seat']; ?> ]<br></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <li>Status: <?php echo $booking['status']; ?></li>
                                    </ul>
                                    <div class="list__button-box">
                                        <form class="list__button-form" method="post" action="index.php?page=account&admin=true&user-index=<?php echo $booking['userId']; ?>">
                                            <button class="button list__button" type="submit" name="delete-booking" value="<?php echo $booking['id']; ?>">Delete Booking</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        </h3><p>No bookings to display.</p>
                    <?php endif ?>
                </details>
            </section>

        <?php else : ?>
            <h3>Access Denied</h3>
        <?php endif; ?>

    </section>
</section>