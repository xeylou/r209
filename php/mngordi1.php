<?php session_start();

include('adminSecurityCheck.php');


$orderId=$_GET['id'];

$orderDataQuery='SELECT * FROM ordersItems WHERE orderId='.$orderId.'';
$orderData=$db->query($orderDataQuery)->fetchArray();

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['changeOrderId'])){
        $newOrderId=$_POST["changeOrderId"];
        $changeOrderIdQuery="UPDATE ordersItems SET orderId = '$newOrderId' WHERE orderId = '$orderId'";
        $db->query($changeOrderIdQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeUserId'])){
        $newUserId=$_POST["changeUserId"];
        $changeUserIdQuery="UPDATE orderItems SET userId = '$newUserId' WHERE orderId = '$orderId'";
        $db->query($changeUserIdQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeWantedMangaId'])){
        $newWantedMangaId=$_POST["changeWantedMangaId"];
        $changeWantedMangaIdQuery="UPDATE orderItems SET wantedMangaId = '$newWantedMangaId' WHERE orderId = '$orderId'";
        $db->query($changeWantedMangaIdQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeDateCreated'])){
        $newDateCreated=$_POST["changeDateCreated"];
        $changeDateCreatedQuery="UPDATE orderItems SET dateCreated = '$newDateCreated' WHERE orderId = '$orderId'";
        $db->query($changeDateCreatedQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeQuantity'])){
        $newQuantity=$_POST['changeQuantity'];
        $changeQuantityQuery="UPDATE orderItems SET quantity = '$newQuantity' WHERE orderId = '$orderId'";
        $db->query($changeQuantityQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
}

echo'
<form method="POST">
<div class="admp">
<p>Order Id (orderId):</p>
<input type="text" name="changeOrderId" value="'.$orderData['orderId'].'">
<button type="submit">Change</button>
<p>Consumer id (userId):</p>
<input type="text"  name="changeUserId" value="'.$orderData['userId'].'">
<button type="submit">Change</button>
<p>Id of the manga the consumer want (wantedMangaId):</p>
<input type="text"  name="changeWantedMangaId" value="'.$orderData['wantedMangaId'].'">
<button type="submit">Change</button>
<p>Date the consumer added to the cart (userId):</p>
<input type="text"  name="changeDateCreated" value="'.$orderData['dateCreated'].'">
<button type="submit">Change</button>
<p>Quantity (quantity):</p>
<input type="text"  name="changeQuantity" value="'.$orderData['quantity'].'">
<button type="submit">Change</button>  
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>