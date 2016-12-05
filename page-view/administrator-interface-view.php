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
                                <label for="movie_title">Title: </label>
                                <input type="text" name="movie_title"><br><br>
                                <label for="poster">Poster Filename: </label>
                                <input type="text" name="poster"><br><br>
                                Synopsis: <br>
                                <textarea name="synopsis" rows="6" cols="55"></textarea><br>
                                <button class="button" type="submit" name="save">Add Movie</button>
                            </form>
                        </div>

                        <div class="add-forms__container">
                            <h3>Add Showing</h3>
                            <form class="add-forms__form" action="index.php?page=administrator-interface&create-showing=true" method="post">
                                <label for="movie_id">Movie: </label>
                                <select name="movie_id">
                                    <?php foreach ($movies as $movie) : ?>
                                        <option value="<?php echo Utilities::escape($movie->getId()); ?>"><?php echo Utilities::escape($movie->getTitle()); ?></option>
                                    <?php endforeach ?>
                                </select><br><br>
                                <label for="date">Date: </label>
                                <input type="text" name="date" value="dd/mm/yy"><br><br>
                                <label for="start">Start Time: </label>
                                <input type="text" name="start" value="24:00"><br><br>
                                <label for="end">End Time: </label>
                                <input type="text" name="end" value="24:00"><br><br>
                                <label for="cinema">Cinema: </label>
                                <input type="text" name="cinema" value="1"><br><br>
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
                                    <li>Title: <?php echo Utilities::escape($movie->getTitle()); ?></li>
                                    <li>Movie ID: <?php echo Utilities::escape($movie->getId()); ?></li>
                                    <li>Poster: <?php echo Utilities::escape($movie->getPoster()); ?></li>
                                    <li>
                                        <details>
                                            <summary><?php echo Utilities::escape($movie->getTitle()); ?> Synopsis</summary>
                                            Synopsis: <?php echo Utilities::escape($movie->getSynopsis()); ?>
                                        </details>
                                    </li>
                                    <li>Active Showings: <?php echo Utilities::escape($movie->getShowings()); ?></li>
                                    <li>Status: <?php echo Utilities::escape($movie->getStatus()); ?></li>
                                </ul>
                                <div class="list__button-box">
                                    <?php if ($movie->getShowings()) : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface">
                                            <button class="button list__button" name="movieId" type="submit" value="<?php echo Utilities::escape($movie->getId()); ?>">Get Showings</button>
                                        </form>
                                    <?php endif; ?>
                                    <form class="list__button-form" method="post" action="index.php?page=administrator-add-edit&type=movie&id=<?php echo Utilities::escape($movie->getId()); ?>">
                                        <button class="button list__button" type="submit">Edit</button>
                                    </form>
                                    <?php if ($movie->getStatus() == 'deleted') : ?>
                                        <button class="button list__button" type="submit" disabled>Delete</button>
                                        <p>Movie is deleted!</p>
                                    <?php elseif ((int) $movie->getShowings() > 0) : ?>
                                        <button class="button list__button" type="submit" disabled>Delete</button>
                                        <p>Cannot delete movie with active showings!</p>
                                    <?php else : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-movie=<?php echo Utilities::escape($movie->getId()); ?>">
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
                <h3>Showings<?php
                    if (array_key_exists('movieId', $_POST) && !$noShowings) {
                        echo ' for <span class=\'movie-title\'>' . Utilities::escape($title) . '</span>';
                    }
                    ?></h3>
                <details <?php
                if (array_key_exists('movieId', $_POST)) {
                    echo 'open';
                }
                ?>>
                    <summary>Show Showings</summary>
                    <?php if (array_key_exists('movieId', $_POST) && !$noShowings) : ?>
                        <div class="list">
                            <?php foreach ($showings as $showing) : ?>
                                <div class="list__listing">
                                    <ul class="list__info-list">
                                        <li>Movie Title: <?php echo Utilities::escape($title) ?></li>
                                        <li>Showing ID: <?php echo Utilities::escape($showing->getId()); ?></li>
                                        <li>Date: <?php echo Utilities::escape($showing->getDate()); ?></li>
                                        <li>Start Time: <?php echo Utilities::escape($showing->getStartTime()); ?></li>
                                        <li>End Time: <?php echo Utilities::escape($showing->getEndTime()); ?></li>
                                        <li>Cinema: <?php echo Utilities::escape($showing->getCinema()); ?></li>
                                        <li>Active Bookings: <?php echo Utilities::escape($showing->getBookings()); ?></li>
                                        <li>Status: <?php echo Utilities::escape($showing->getStatus()); ?></li>
                                    </ul>
                                    <div class="list__button-box">
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-add-edit&type=showing&id=<?php echo Utilities::escape($showing->getId()); ?>">
                                            <button class="button list__button" name="title" type="submit" value="<?php echo $title ?>">Edit Showing</button>
                                        </form>
                                        <?php if ((int) $showing->getBookings() > 0) : ?>
                                            <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-showing=<?php echo Utilities::escape($showing->getId()); ?>">
                                                <button class="button list__button" type="submit" disabled>Delete</button>
                                                <p>Cannot delete showing with active bookings!</p>
                                            </form>
                                        <?php else : ?>
                                            <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-showing=<?php echo Utilities::escape($showing->getId()); ?>">
                                                <button class="button list__button" type="submit">Delete Showing</button>
                                            </form>
                                        <?php endif; ?>
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
                                    <li>ID: <?php echo Utilities::escape($user->getId()); ?></li>
                                    <li>Username: <?php echo Utilities::escape($user->getUserName()); ?></li>
                                    <li>Password: <?php echo Utilities::escape($user->getPassword()); ?></li>
                                    <li>Email: <?php echo Utilities::escape($user->getEmail()); ?></li>
                                    <li>Active Bookings: <?php echo Utilities::escape($user->getBookingCount()); ?></li>
                                    <li>Status: <?php echo Utilities::escape($user->getStatus()); ?></li>
                                </ul>
                                <div class="list__button-box">
                                    <?php if ($user->getBookingCount()) : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&userId=<?php echo Utilities::escape($user->getId()); ?>">
                                            <button class="button list__button" name="userId" type="submit" value="<?php echo Utilities::escape($user->getId()); ?>">Get Bookings</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if ($user->getStatus() != 'admin') : ?>
                                        <form class="list__button-form" method="post" action="index.php?page=administrator-interface&delete-user=<?php echo Utilities::escape($user->getId()); ?>">
                                            <button class="button list__button" type="submit" name="delete-user" value="<?php echo Utilities::escape($user->getId()); ?>">Delete User</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </details>
            </section>

            <section class="wrapper-section">
                <h3>Bookings<?php
                    if (!$noBookings) {
                        echo ' for <span class=\'movie-title\'>' . Utilities::escape($bookingUsername) . '</span>';
                    }
                    ?></h3>
                <details <?php
                if (array_key_exists('userId', $_POST)) {
                    echo 'open';
                }
                ?>>
                    <summary>Show Bookings</summary>
                    <div class="list">
                        <?php if (!$noBookings) : ?>
                            <?php foreach ($data as $booking) : ?>
                                <div class="list__listing">
                                    <ul class="list__info-list">
                                        <li>ID: <?php echo Utilities::escape($booking['id']); ?></li>
                                        <li>User: <?php echo Utilities::escape($booking['user']); ?></li>
                                        <li>Showing: <?php echo Utilities::escape($booking['showing']); ?></li>
                                        <li>Date: <?php echo Utilities::escape($booking['date']); ?></li>
                                        <li>Time: <?php echo Utilities::escape($booking['start']); ?> - <?php echo Utilities::escape($booking['end']); ?></li>
                                        <li>Seat(s) [row, no.]:</li>
                                        <ul>
                                            <?php foreach ($booking['seats'] as $seat) : ?>
                                                <li>[ R: <?php echo Utilities::escape($seat['row']); ?>, N: <?php echo Utilities::escape($seat['seat']); ?> ]<br></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <li>Status: <?php echo Utilities::escape($booking['status']); ?></li>
                                    </ul>
                                    <div class="list__button-box">
                                        <form class="list__button-form" method="post" action="index.php?page=account&admin=true&user-index=<?php echo Utilities::escape($booking['userId']); ?>">
                                            <button class="button list__button" type="submit" name="delete-booking" value="<?php echo Utilities::escape($booking['id']); ?>">Delete Booking</button>
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
    <div class="page-spacer"></div> 
</section>