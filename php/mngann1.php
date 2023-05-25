<?php session_start();

include('adminSecurityCheck.php');

$announceId=$_GET['id'];


$announcesDataQuerry='SELECT * FROM announce WHERE announceId='.$announceId.'';
$announcesData=$db->query($announcesDataQuerry);
$eachAnnounceData=$announcesData->fetchArray();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $newAnnounce=$_POST["newAnnounce"];
    $updateAnnounceQuerry="UPDATE announce SET text = '$newAnnounce' WHERE announceId = '$announceId'";
    $db->query($updateAnnounceQuerry);
    header("Location:mngann1.php?id=$announceId"); 
}

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

echo'
<form method="POST">
    <div class="admp">
        <p>'.$eachAnnounceData['purpose'].'</p>
        <input type="text" name="newAnnounce" value="'.$eachAnnounceData['text'].'">
        <button type="submit">Change</button>
    </div>
</form>';

include('footer.php');
$db->close();
unset($db);?>