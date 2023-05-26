<?php session_start();

include('adminSecurityCheck.php');


$orderId=$_GET['id'];

$orderDataQuery='SELECT * FROM orders WHERE orderId='.$orderId.'';
$orderData=$db->query($orderDataQuery)->fetchArray();

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $newOrderId=$_POST["changeOrderId"];
    $newUserId=$_POST["changeUserId"];
    $newDateValidated=$_POST["changeDateValidated"];
    $newTotalPrice=$_POST["changeTotalPrice"];
    $newTotalArticle=$_POST['changeTotalArticle'];
    $updateOrder=$db->prepare("UPDATE orders SET orderId = '$newOrderId', userId = '$newUserId', dateValidated = '$newDateValidated', totalArticle = '$newTotalPrice', totalArticle = '$newTotalArticle' WHERE orderId = '$orderId'");
    $updateOrder->execute();
    echo'<meta http-equiv="refresh" content="0">';
}

echo'
<form method="POST">
<div class="admp">
<p>Order Id (orderId):</p>
<input type="text" name="changeOrderId" value="'.$orderData['orderId'].'">
<button type="submit">Change</button>
<p>User id (userId):</p>
<input type="text"  name="changeUserId" value="'.$orderData['userId'].'">
<button type="submit">Change</button>
<p>Date validated (dateValidated):</p>
<input type="text"  name="changeDateValidated" value="'.$orderData['dateValidated'].'">
<button type="submit">Change</button>
<p>total price (totalPrice):</p>
<input type="text"  name="changeTotalPrice" value="'.$orderData['totalPrice'].'">
<button type="submit">Change</button>
<p>Total Article (totalArticle):</p>
<input type="text"  name="changeTotalArticle" value="'.$orderData['totalArticle'].'">
<button type="submit">Change</button>
<br>
<p></p>
';
if(isset($orderValidated)){echo"<p>$orderValidated</p>";}
echo'
<a href="validateOrder.php?orderId='.$orderData['orderId'].'">Validate Order
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>