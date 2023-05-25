<?php session_start();

include('adminSecurityCheck.php');
include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$db=new SQLite3('r209-db-01.sqlite');
$mangasDataQuery='SELECT * from mangas';
$mangasData=$db->query($mangasDataQuery);

while($eachMangaData=$mangasData->fetchArray()){
    echo '<div class="admp">
            <p>
                <a href="mngart1.php?id='.$eachMangaData['mangaId'].'">Edit mangas '.$eachMangaData['displayName'].' - '.$eachMangaData['volumeNumber'].'</a>
            </p>
        </div>';
}
echo'<div class="admp"><a href="addart.php">Add a manga</a></div>';
include('footer.php');
$db->close();
unset($db);?>