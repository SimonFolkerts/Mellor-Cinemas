<section class="page-container">
    <section id="carousel">
        <ul>
            <?php foreach ($movies as $movie): ?>
                <li>
                    <div class="carousel-item">
                        <div class="caption"><p><?php echo $movie->getTitle(); ?></p></div>
                        <a href="index.php?page=movie&id=<?php echo $movie->getId(); ?>"><img class="movie-thumb" title="<?php echo $movie->getTitle(); ?>" src="web/img/image-uploads/<?php echo $movie->getPoster(); ?>"/></a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>
</section>