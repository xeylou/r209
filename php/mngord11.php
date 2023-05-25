<?php session_start();

include('adminSecurityCheck.php');

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$ordersDataQuery='SELECT * from orders';
$ordersData=$db->query($ordersDataQuery);

$allUsernamesQuery='SELECT * FROM users';
$allUsernames=$db->query($allUsernamesQuery)->fetchArray();

while ($orderData=$ordersData->fetchArray()){
    echo '<div class="admp">
        <p>
        <a href="mngord111.php?id='.$orderData['orderId'].'">Edit order '.$orderData['orderId'].'</a>
        </p>
        </div>';
}


include'footer.php';
$db->close();
unset($db);?>