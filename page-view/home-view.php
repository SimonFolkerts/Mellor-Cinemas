<div>
    <?php foreach ($showings as $showing): ?>
    <a href="index.php?page=movie&id=<?php echo $showing->getId(); ?>"><img src="web/img/image-uploads/<?php echo $showing->getPoster(); ?>"></a>
    <?php endforeach ?>
</div>
<p>--------------</p>