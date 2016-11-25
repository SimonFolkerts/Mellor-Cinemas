<div>
    <h3>Account Options</h3>
    <ul>
        <li><a href="index.php?page=login&id=<?php echo $user->getId(); ?>">Edit Details</a></li>
        <li><a href="index.php?page=account&delete=true">Delete Account</a></li>
    </ul>
</div>
<div>
    <div>
        <?php foreach ($showingInfos as $booking) : ?>

            <h3>Showing: <?php echo $booking['title'] ?></h3>
            <p>Date: <?php echo $booking['date'] ?></p>
            <p>Time: <?php echo $booking['start'] ?> - <?php echo $booking['end'] ?></p>
            <p>Seat(s):</p>
            <?php foreach ($booking['seats'] as $seat) : ?>
                <p>----Row: <?php echo $seat['row']; ?><br>----Seat No.: <?php echo $seat['seat']; ?><br></p>
            <?php endforeach ?>
    </div>
    <?php endforeach ?>
</div>
<p>--------------</p>