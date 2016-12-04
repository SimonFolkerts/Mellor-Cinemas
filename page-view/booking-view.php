<section class='page-container'>
    <section class="booking-container">
        <div class="movie">
            <div class="movie__poster-container">
                <img class="movie__poster" src="../web/img/image-uploads/<?php echo $moviePoster ?>">
            </div>
            <div class="movie__text-container">
                <h2 class="movie__title"><?php echo $movieTitle ?></h2>
                <p class="movie__synopsis"><?php echo $movieSynopsis ?></p>
            </div>
        </div>
        <div class="selector">
            <h3>Create a booking for <?php echo $movieTitle ?> at <?php echo $sessionTime ?></h3>
            <div class="screen">SCREEN</div>
            <form class="grid-form" method="post" action="index.php?page=booking&id=<?php echo $showingId ?>&save=true">
                <div class="grid-container">
                    <?php echo $grid ?>
                </div>
                <button class='button' type="submit" value="Submit">Submit</button>
            </form>
        </div>
    </section>
    <div class='page-spacer'></div>
</section>
