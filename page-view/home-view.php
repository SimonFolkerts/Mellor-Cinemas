<section class="page-container">
    <section id="carousel">
        <ul>
            <?php foreach ($movies as $movie): ?>
                <li>
                    <div class="carousel-item">
                        <div class="carousel-item__caption"><p><?php echo Utilities::escape($movie->getTitle()); ?></p></div>
                        <a href="index.php?page=home&id=<?php echo Utilities::escape($movie->getId()); ?>"><img class="carousel-item__movie-thumb" title="<?php echo Utilities::escape($movie->getTitle()); ?>" src="../web/img/image-uploads/<?php echo Utilities::escape($movie->getPoster()); ?>"/></a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>


    <?php if (array_key_exists('id', $_GET)) : ?>
        <div class="movie">
            <div class="movie__poster-container">
                <img class="movie__poster" src="../web/img/image-uploads/<?php echo Utilities::escape($moviePoster); ?>">
            </div>
            <div class="movie__text-container">
                <h2 class="movie__title"><?php echo Utilities::escape($movieTitle); ?></h2>
                <p class="movie__synopsis"><?php echo Utilities::escape($movieSynopsis); ?></p>
            </div>
        </div>
        <?php if ($showings) : ?>
            <section class="showing-display">
                <h3 class="showing-title">Dates and Times for <span class="movie-title"><?php echo Utilities::escape($movieTitle); ?></span></h3>
                <p class="showing-title__p">Please select a time below to make a booking</p>
                <table class="showings">
                    <tr>
                        <th>Date</th>
                        <th>Showings</th>
                    </tr>
                    <tr class="spacer-row"></tr>
                    <?php foreach ($showingString as $date): ?>
                        <tr>
                            <?php if (empty($_SESSION['username'])) : ?>
                                <td class="no-border">
                                    <p class="showing__date"><?php echo Utilities::escape($date['date']); ?></p>
                                </td>
                                <?php foreach ($date['times'] as $showing) : ?>
                                    <td>
                                        <a class="showing__time" href="index.php?page=login&id=<?php echo Utilities::escape($showing['id']); ?>"><?php echo Utilities::escape($showing['start']); ?> - <?php echo Utilities::escape($showing['end']); ?></a>
                                    </td>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <td class="no-border">
                                    <p class="showing__date"><?php echo Utilities::escape($date['date']); ?></p>
                                </td>
                                <?php foreach ($date['times'] as $showing) : ?>
                                    <td>
                                        <a class="showing__time" href="index.php?page=booking&id=<?php echo Utilities::escape($showing['id']); ?>"><?php echo Utilities::escape($showing['start']); ?> - <?php echo Utilities::escape($showing['end']); ?></a>
                                    </td>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tr>
                        <tr class="spacer-row"></tr>
                    <?php endforeach ?>
                </table>
            <?php else : ?>
                <h3 class="showing-title">No Showings for <span class="movie-title"><?php echo Utilities::escape($movieTitle); ?></span></h3>
            <?php endif ?>
        </section>

    <?php else: ?>
        <section class="home-greeting">
            <h1>Welcome to the Mellor Cinema Website</h1>

            <p>Please select a movie from the list to view dates and times.</p>
            <div class="gif-box">
                <img class="clapper placeholder-gif" src="../web/img/clapper.gif"/><img class="reel placeholder-gif" src="../web/img/reel.gif"/><img class="masks placeholder-gif"src="../web/img/masks.gif"/>
            </div>
        </section>
    <?php endif; ?>
    <div class="page-spacer"></div> 
</section>