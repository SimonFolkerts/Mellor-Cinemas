<section class="page-container">
    <section id="carousel">
        <ul>
            <?php foreach ($movies as $movie): ?>
                <li>
                    <div class="carousel-item">
                        <div class="carousel-item__caption"><p><?php echo $movie->getTitle(); ?></p></div>
                        <a href="index.php?page=movie&id=<?php echo $movie->getId(); ?>"><img class="carousel-item__movie-thumb" title="<?php echo $movie->getTitle(); ?>" src="web/img/image-uploads/<?php echo $movie->getPoster(); ?>"/></a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>
</section>