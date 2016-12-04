<section class='page-container'>
    <div class='edit-page-container'>
    <div>
    <?php if ($type == 'movie') : ?>
        <div class="movie">
            <div class="movie__poster-container">
                <img class="movie__poster" src="../web/img/image-uploads/<?php echo $movie->getPoster(); ?>">
            </div>
            <div class="movie__text-container">
                <h2 class="movie__title"><?php echo $movie->getTitle(); ?></h2>
                <p class="movie__synopsis"><?php echo $movie->getSynopsis(); ?></p>
            </div>
        </div>
        <div class="add-forms">
            <form class="add-forms__form" action="index.php?page=administrator-add-edit&type=movie&id=<?php echo $movie->getId(); ?>" method="post">
                <br>Title: <input type="text" name="movie_title" value=<?php echo '"' . $movie->getTitle() . '"'; ?>><br><br>
                Poster Filename: <input type="text" name="poster" value=<?php echo '"' . $movie->getPoster() . '"'; ?>><br><br>
                Synopsis: <br>
                <textarea name="synopsis" rows="12" cols="80"><?php echo $movie->getSynopsis(); ?></textarea><br><br>
                <button class="button" type="submit" name="save">Edit Movie</button>
            </form>
        </div>
    <?php else : ?>
        <h3>Edit Showing for: <?php if (array_key_exists('title', $_POST)) { echo $_POST['title']; } else { echo $_POST['save']; } ?></h3><br>
        <ul>
            <li>Showing ID: <?php echo $showing->getId(); ?></li>
            <li>Date: <?php echo $showing->getDate(); ?></li>
            <li>Start Time: <?php echo $showing->getStartTime(); ?></li>
            <li>End Time: <?php echo $showing->getEndTime(); ?></li>
            <li>Cinema: <?php echo $showing->getCinema(); ?></li>
        </ul>
        <br>
        <div class="edit-showing">
        <form class="edit-showing__form add-forms__form" action="index.php?page=administrator-add-edit&type=showing&id=<?php echo $showing->getId(); ?>" method="post">
            Date: <input type="text" name="date" value=<?php echo $showing->getDate(); ?>><br>
            Start Time: <input type="text" name="start" value=<?php echo $showing->getStartTime(); ?>><br>
            End Time: <input type="text" name="end" value=<?php echo $showing->getEndTime(); ?>><br>
            Cinema: <input type="text" name="cinema" value=<?php echo $showing->getCinema(); ?>><br>
            <button class="button" type="submit" name="save" value="<?php echo $title; ?>">Edit Showing</button>
        </form>
        </div>
    <?php endif; ?>
    </div>
        <?php if($errors) : ?>
    <div>
        <ul>
            <?php foreach ($errors as $error) : ?>
            <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
        <?php endif; ?>
    <br>
    </div>
    <div class='page-spacer'></div>
</section>