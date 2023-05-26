<?php
include('navbar.php');
$db=new SQLite3('r209-db-01.sqlite');
$orderId=$_GET['orderId'];
$validateOrder=$db->prepare("UPDATE orders SET isValidated = 1 WHERE orderId = '$orderId'");
$validateOrder->execute();
echo'successfull';
include('footer.php');
?>