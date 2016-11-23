<!--<div>
    <img src="web/img/image-uploads/<?php echo $moviePoster ?>"
    <p><?php echo $movieTitle ?></p>
    <p><?php echo $movieSynopsis ?></p>
</div>-->

<!--TODO decide if the above is desirable-->
<div>
    <h3>Create a booking for <?php echo $movieTitle ?> at <?php echo $sessionTime ?></h3>
</div>
<div>
    <form action="#">

    </form>
</div>
<h4>Step Two: Select Seats</h4>
<div>
    <form method="post" action="index.php?page=booking&id=<?php echo $showingId ?>">
        <?php echo $grid ?>
        <input type="submit" value="Submit">
    </form>
</div>
<h4>Step Three: Details</h4>
<a href="index.php?page=movie&id=<?php echo $movieId; ?>">Go Back</a>
<p>--------------</p>

