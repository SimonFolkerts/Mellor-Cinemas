<section class='page-container'>
    <section class="booking-container">
        <?php if ($allSeats) : ?>
            <div class="movie">
                <div class="movie__poster-container">
                    <img class="movie__poster" src="../web/img/image-uploads/<?php echo Utilities::escape($moviePoster); ?>">
                </div>
                <div class="movie__text-container">
                    <h2 class="movie__title"><?php echo Utilities::escape($movieTitle); ?></h2>
                    <p class="movie__synopsis"><?php echo Utilities::escape($movieSynopsis); ?></p>
                </div>
            </div>
            <div class="selector">
                <h3>Create a booking for <?php echo Utilities::escape($movieTitle) ?> at <?php echo Utilities::escape($sessionTime); ?></h3>
                <div class="screen">SCREEN</div>
                <form class="grid-form" method="post" action="index.php?page=booking&id=<?php echo Utilities::escape($showingId); ?>&save=true">
                    <div class="grid-container">
                        <?php echo $grid; ?>
                    </div>
                    <button class='button' type="submit" value="Submit">Submit</button>
                </form>
            </div>
        <?php else : ?>
            <h3>ERROR: Cinema has no seats</h3>
        <?php endif; ?>
    </section>
</section>
