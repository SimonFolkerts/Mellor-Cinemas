<section class="page-container">
    <div class="account-details">
        <div>
            <h3>Account Details</h3>
            <ul>
                <li><p>Username: <?php echo $user->getUsername(); ?></p></li>
                <li><p>Email: <?php echo $user->getEmail(); ?></p></li>
            </ul>
        </div>
        <div>
            <h3>Account Options</h3>
            <ul>
                <li><a href="index.php?page=login&id=<?php echo $user->getId(); ?>">Edit Details</a></li>
                <li><a href="index.php?page=account&delete-account=true">Delete Account</a></li>
            </ul>
        </div>
    </div>
    <div class="bookings">
        <h3>Bookings</h3>
        <?php if ($showingInfos) : ?>
            <div class="list">
                <?php foreach ($showingInfos as $booking) : ?>
                    <div class="list__listing">
                        <ul class="list__info-list">
                            <li>ID: <?php echo Utilities::escape($booking['id']); ?></li>
                            <li>Date: <?php echo Utilities::escape($booking['date']); ?></li>
                            <li>Time: <?php echo Utilities::escape($booking['start']); ?> - <?php echo Utilities::escape($booking['end']); ?></li>
                            <li>Seat(s) [Row, No.]:
                                <ul>
                                    <?php foreach ($booking['seats'] as $seat) : ?>
                                        <li>[ R: <?php echo Utilities::escape($seat['row']); ?>, N: <?php echo Utilities::escape($seat['seat']); ?> ]<br></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                        <form class="list__button-form" method="post" action="index.php?page=account&admin=true&user-index=<?php echo Utilities::escape($booking['userId']); ?>">
                            <button class="button list__button" type="submit" name="delete-booking" value="<?php echo Utilities::escape($booking['id']); ?>">Delete Booking</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No bookings to display.</p>
        <?php endif ?>
    </div>
</section>