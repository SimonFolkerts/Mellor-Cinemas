<div>
    <h3>Account Options</h3>
    <ul>
        <li><a href="index.php?page=login&id=<?php echo $user->getId(); ?>">Edit Details</a></li>
        <li><a href="index.php?page=account&delete-account=true">Delete Account</a></li>
    </ul>
</div>
<div>
    <div>
        <h3>Bookings</h3>
        <?php if ($showingInfos) : ?>
            <?php foreach ($showingInfos as $booking) : ?>

                <h3>Showing: <?php echo $booking['title'] ?></h3>
                <p>Booking #: <?php echo $booking['id']; ?>
                <p>Date: <?php echo $booking['date'] ?></p>
                <p>Time: <?php echo $booking['start'] ?> - <?php echo $booking['end'] ?></p>
                <p>Seat(s):</p>
                <?php foreach ($booking['seats'] as $seat) : ?>
                    <p>----Row: <?php echo $seat['row']; ?><br>----Seat No.: <?php echo $seat['seat']; ?><br></p>
                <?php endforeach ?>
                <form id="delete button" method="post" action="index.php?page=account">
                    <div>
                        <button id="delete-button" type="submit" name="delete-booking" value="<?php echo $booking['id']; ?>">Delete Booking</button>
                    </div>
                </form>
            </div>
            <?php
        endforeach;
    else :
        ?>
        <p>No bookings to display.</p>
    <?php endif ?>
</div>