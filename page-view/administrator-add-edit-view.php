<?php if ($type == 'movie') : ?>
    <h3>Edit Movie: <?php echo $movie->getTitle(); ?></h3>
    <img title="<?php echo $movie->getTitle(); ?>" src="web/img/image-uploads/<?php echo $movie->getPoster(); ?>">
    <ul>
        <li>Movie ID: <?php echo $movie->getId(); ?></li>
        <li>Poster: <?php echo $movie->getPoster(); ?></li>
        <li>Synopsis: <?php echo $movie->getSynopsis(); ?></li>
    </ul>
    <form action="index.php?page=administrator-add-edit&type=movie&id=<?php echo $movie->getId(); ?>" method="post">
        Title: <input type="text" name="movie_title"><br>
        Poster Filename: <input type="text" name="poster"><br>
        Synopsis<br>
        <textarea name="synopsis" rows="8"></textarea><br>
        <button type="submit" name="save">Edit Movie</button>
    </form>
<?php else : ?>
    <h3>Edit Showing ID: <?php echo $_POST['title'] ?></h3>
    <ul>
        <li>Showing ID: <?php echo $showing->getId(); ?></li>
        <li>Date: <?php echo $showing->getDate(); ?></li>
        <li>Start Time: <?php echo $showing->getStartTime(); ?></li>
        <li>End Time: <?php echo $showing->getEndTime(); ?></li>
        <li>Cinema: <?php echo $showing->getCinema(); ?></li>
    </ul>
    <form action="index.php?page=administrator-add-edit&type=showing&id=<?php echo $showing->getId(); ?>" method="post">
        Date: <input type="text" name="date" value="dd/mm/yy"><br>
        Start Time: <input type="text" name="start" value="24:00"><br>
        End Time: <input type="text" name="end" value="24:00"><br>
        Cinema: <input type="text" name="cinema" value="1"><br>
        <button type="submit" name="save">Edit Showing</button>
    </form>
<?php endif; ?>