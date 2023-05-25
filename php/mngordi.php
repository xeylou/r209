<?php session_start();

include'adminSecurityCheck.php';

include'navbar.php';
echo '<button onclick="history.go(-1);">Back </button>';

$db=new SQLite3('r209-db-01.sqlite');
$ordersItemsQuery='SELECT * from ordersItems';
$ordersItemsData=$db->query($ordersItemsQuery);

while ($orderItemsData=$ordersItemsData->fetchArray()) {

    $usernameQuerry='SELECT username FROM users WHERE userId = '.$orderItemsData['userId'].'';
    $username=$db->query($usernameQuerry)->fetchArray();

    echo '<div class="admp">
        <p>
        <a href="mngordi1.php?id='.$orderItemsData['orderId'].'">Manage '.$username['username'].' order</a>
        </p>
        </div>';
}



include'footer.php';
?>