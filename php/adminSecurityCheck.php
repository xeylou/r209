<?php
//user is not logged
if(!isset($_SESSION['userId'])){
	header("Location:login.php");
}

$userId=$_SESSION['userId'];
$db=new SQLite3('r209-db-01.sqlite');
$checkAdmin="SELECT isAdmin FROM users WHERE userId = '$userId'";
$isAdmin=$db->query($checkAdmin)->fetchArray();

//user is not an admin
if($isAdmin[0]!=1){
    header("Location:error.php");
    $db->close();
    unset($db);
    exit();
}
?>