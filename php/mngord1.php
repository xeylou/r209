<?php session_start();

include('adminSecurityCheck.php');

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$ordersDataQuery='SELECT * from orders';
$ordersData=$db->query($ordersDataQuery);

while ($orderData=$ordersData->fetchArray()){
    //catching the username of the consumer for each order
    $catchingConsumerName='SELECT username FROM users WHERE userId in (SELECT userId FROM orders WHERE orderId = '.$orderData['orderId'].')';
    $consumerName=$db->query($catchingConsumerName)->fetchArray();
    echo '<div class="admp">
        <p>
        <a href="mngord111.php?id='.$orderData['orderId'].'">Edit order '.$orderData['orderId'].' ('.$consumerName['username'].')</a>
        </p>
        </div>';
}


include'footer.php';
$db->close();
unset($db);?>