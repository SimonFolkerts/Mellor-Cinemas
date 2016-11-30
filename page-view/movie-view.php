<div class="page-container">
    <div class="movie">
        <img class="movie__poster" src="web/img/image-uploads/<?php echo $moviePoster ?>">
        <div class="movie__text-container">
            <h2 class="movie__title"><?php echo $movieTitle ?></h2>
            <p class="movie__synopsis"><?php echo $movieSynopsis ?></p>
        </div>
    </div>

    <?php foreach ($showings as $showing): ?>
        <div>
            <?php if (empty($_SESSION['username'])) : ?>
                <a href="index.php?page=login&id=<?php echo $showing->getId(); ?>"><p><?php echo $showing->getStartTime(); ?> - <?php echo $showing->getEndTime(); ?></p></a>
            <?php else : ?>
                <a href="index.php?page=booking&id=<?php echo $showing->getId(); ?>"><p><?php echo $showing->getStartTime(); ?> - <?php echo $showing->getEndTime(); ?></p></a>
            <?php endif; ?>
        </div>
    <?php endforeach ?>
</div>
