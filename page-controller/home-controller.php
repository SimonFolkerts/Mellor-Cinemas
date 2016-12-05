<?php

//----------- HEADER OBJECT -----------//

$headerInfo = new HeaderInfo();

$headerInfo->setTitle('Mellor Cinema | Home');
$headerInfo->setDescription('The Mellor Cinema website provides movies and showing times with up to date info on the latest flicks. Buy tickets online.');
$headerInfo->setKeywords('Mellor, Cinema, movie, ticket');

//----------- DISPLAY ALL MOVIES ----------//

$dao = new MovieDao();

//return all movies that are active

$sql = 'SELECT * FROM movies WHERE status != "deleted"';
$movies = $dao->findAll($sql);


//---------- DISPLAY SELECTED MOVIE ----------//
if (array_key_exists('id', $_GET)) {
    $sql = 'SELECT id, poster, movie_title, movie_synopsis FROM movies WHERE id = ' . $_GET['id'];
    $movie = $dao->find($sql);

    $movieId = $movie->getId();
    $moviePoster = $movie->getPoster();
    $movieTitle = $movie->getTitle();
    $movieSynopsis = $movie->getSynopsis();



//---------- DISPLAY MOVIE SHOWINGS ----------//

    $dao = new ShowingDao();

    $sql = 'SELECT * FROM showings WHERE status != "deleted" AND movie_id = ' . $_GET['id'] . ' ORDER BY date DESC, start_time ASC;';
    $showings = $dao->findAll($sql);

    if ($showings) {
        $i = 0;
        $lastDate = '';
        foreach ($showings as $showing) {

            $newDate = $showing->getDate();

            if ($lastDate != $newDate) {
                $i++;
                $showingString[$i] = array(
                    'date' => $showing->getDate(),
                    'times' => []
                );
            }
            $showingString[$i]['times'][] = array(
                'id' => $showing->getId(),
                'start' => $showing->getStartTime(),
                'end' => $showing->getEndTime()
            );
            $lastDate = $showing->getDate();
        }
    }
}
