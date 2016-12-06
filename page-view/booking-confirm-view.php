<section class="page-container">
    <section class="booking-confirm-container">
    <h3>Booking Placed!</h3>
    <p>The following Booking was successfully created</p>
    <?php foreach ($showingInfos as $booking) : ?>
        <div class="list__listing booking-field">
            <ul class="list__info-list">
                <li>ID: <?php echo Utilities::escape($booking['title']); ?></li>
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
        </div>
    <?php endforeach; ?>
    </section>
</section>