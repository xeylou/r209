<?php session_start();

include('adminSecurityCheck.php');

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$ordersItemsDataQuery='SELECT * from ordersItems';
$ordersDataItems=$db->query($ordersItemsDataQuery);

while ($orderItemsData=$ordersDataItems->fetchArray()){
    echo '<div class="admp">
        <p>
        <a href="mngordi1.php?id='.$orderItemsData['orderId'].'">Edit order '.$orderItemsData['orderId'].'</a>
        </p>
        </div>';
}


include'footer.php';
$db->close();
unset($db);?>