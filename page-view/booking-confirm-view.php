<section class="page-container">
    <section class="booking-confirm-container">
    <h3>Booking Placed!</h3>
    <p>The following Booking was successfully created</p>
    <?php foreach ($showingInfos as $booking) : ?>
        <div class="list__listing booking-field">
            <ul class="list__info-list">
                <li>ID: <?php echo $booking['title']; ?></li>
                <li>ID: <?php echo $booking['id']; ?></li>
                <li>Date: <?php echo $booking['date']; ?></li>
                <li>Time: <?php echo $booking['start']; ?> - <?php echo $booking['end'] ?></li>
                <li>Seat(s) [Row, No.]:
                    <ul>
                        <?php foreach ($booking['seats'] as $seat) : ?>
                            <li>[ R: <?php echo $seat['row']; ?>, N: <?php echo $seat['seat']; ?> ]<br></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
            <form class="list__button-form" method="post" action="index.php?page=account&admin=true&user-index=<?php echo $booking['userId']; ?>">
                <button class="button list__button booking-delete" type="submit" name="delete-booking" value="<?php echo $booking['id']; ?>">Delete Booking</button>
            </form>
        </div>
    <?php endforeach; ?>
    </section>
    <div class="page-spacer"></div>
</section>