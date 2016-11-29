<section class="page-container">
    <?php foreach ($movies as $movie): ?>
    <a href="index.php?page=movie&id=<?php echo $movie->getId(); ?>"><img title="<?php echo $movie->getTitle(); ?>" src="web/img/image-uploads/<?php echo $movie->getPoster(); ?>"></a>
    <?php endforeach ?>
</section>