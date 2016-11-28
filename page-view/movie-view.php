<div>
    <img src="web/img/image-uploads/<?php echo $moviePoster ?>"
         <p><?php echo $movieTitle ?></p>
    <p><?php echo $movieSynopsis ?></p>
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
<p>--------------</p>
