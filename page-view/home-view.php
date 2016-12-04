<section class="page-container">
    <section id="carousel">
        <ul>
            <?php foreach ($movies as $movie): ?>
                <li>
                    <div class="carousel-item">
                        <div class="carousel-item__caption"><p><?php echo $movie->getTitle(); ?></p></div>
                        <a href="index.php?page=home&id=<?php echo $movie->getId(); ?>"><img class="carousel-item__movie-thumb" title="<?php echo $movie->getTitle(); ?>" src="../web/img/image-uploads/<?php echo $movie->getPoster(); ?>"/></a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>


    <?php if (array_key_exists('id', $_GET)) : ?>
        <div class="movie">
            <div class="movie__poster-container">
                <img class="movie__poster" src="../web/img/image-uploads/<?php echo $moviePoster ?>">
            </div>
            <div class="movie__text-container">
                <h2 class="movie__title"><?php echo $movieTitle ?></h2>
                <p class="movie__synopsis"><?php echo $movieSynopsis ?></p>
            </div>
        </div>
        <?php if ($showings) : ?>
            <section class="showing-display">
                <h3 class="showing-title">Dates and Times for <span class="movie-title"><?php echo $movieTitle ?></span></h3>
                <table class="showings">
                    <tr>
                        <th>Date</th>
                        <th>Showings</th>
                    </tr>
                    <tr class="spacer-row"></tr>
                    <?php foreach ($showingString as $showing): ?>
                        <tr>
                            <?php if (empty($_SESSION['username'])) : ?>
                                <td class="no-border">
                                    <p class="showing__date"><?php echo $showing['date']; ?></p>
                                </td>
                                <?php foreach ($showing['times'] as $time) : ?>
                                    <td>
                                        <a class="showing__time" href="index.php?page=login&id=<?php echo $showing['id']; ?>"><?php echo $time['start']; ?> - <?php echo $time['end']; ?></a>
                                    </td>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <td class="no-border">
                                    <p class="showing__date"><?php echo $showing['date']; ?></p>
                                </td>
                                <?php foreach ($showing['times'] as $time) : ?>
                                    <td>
                                        <a class="showing__time" href="index.php?page=booking&id=<?php echo $showing['id']; ?>"><?php echo $time['start']; ?> - <?php echo $time['end']; ?></a>
                                    </td>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tr>
                        <tr class="spacer-row"></tr>
                    <?php endforeach ?>
                </table>
            <?php else : ?>
                <h3 class="showing-title">No Showings for <span class="movie-title"><?php echo $movieTitle ?></span></h3>
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