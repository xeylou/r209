<?php session_start();

include('adminSecurityCheck.php');
include('navbar.php');
echo'<button onclick="history.go(-1);">Back</button>';


$db=new SQLite3('r209-db-01.sqlite');
$usersDataQuery='SELECT * from users';
$usersData=$db->query($usersDataQuery);

while($userData=$usersData->fetchArray()){
    echo '<div class="admp">
        <p>
        <a href="mngusers1.php?id='.$userData['userId'].'">Edit user '.$userData['username'].'</a>
        </p>
        </div>';
}

include('footer.php');
$db->close();
unset($db);?>