<?php session_start();

include('adminSecurityCheck.php');

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$announcesDataQuery='SELECT * from announce';
$announcesData=$db->query($announcesDataQuery);

while($eachAnnounceData=$announcesData->fetchArray()){
    echo '<div class="admp">
        <p>
            <a href="mngann1.php?id='.$eachAnnounceData['announceId'].'">Edit '.$eachAnnounceData['purpose'].'</a>
        </p>
    </div>';
}
include('footer.php');
$db->close();
unset($db);?>