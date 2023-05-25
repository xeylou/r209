<?php session_start();

//user is not logged
if(!isset($_SESSION['userId'])){
    header("Location:login.php");
    exit();
}

$db=new SQLite3('r209-db-01.sqlite');
$consumerId=$_SESSION['userId'];

//catching all mangas info from user's order
$orderMangasInfo='SELECT * FROM mangas WHERE mangaId in (SELECT wantedMangaId FROM ordersItems WHERE userId = '.$consumerId.')';
$mangasInfoResults=$db->query($orderMangasInfo);
$wantedMangasData=$mangasInfoResults->fetchArray();


//check if the user has no order
if(empty($wantedMangasData)){
    $emptyCart='<p>You have an empty cart :(</p>';
    $db->close();
    unset($db);
}

//user has order(s), initializing order's info
else{    
    $currentDate=date('l jS \of F Y h:i:s A');

    //$totalArticle[0]
    $totalArticleQuery='SELECT SUM(quantity) FROM ordersItems WHERE userId = '.$consumerId.'';
    $totalArticle=$db->query($totalArticleQuery)->fetchArray();

    //username[0]
    $usernameQuery='SELECT username FROM users WHERE userId = '.$consumerId.'';
    $username=$db->query($usernameQuery)->fetchArray();

    //$totalPrice price w/ out shipping fees 
    //quantity * price for each manga
    $totalPrice=0;
    $totalPriceQuery1='SELECT price FROM mangas WHERE mangaId in (SELECT wantedMangaId FROM ordersItems WHERE userId = '.$consumerId.');';
    $totalPrice1=$db->query($totalPriceQuery1);
    $totalPriceQuery2='SELECT quantity FROM ordersItems WHERE wantedMangaId IN (SELECT mangaId FROM mangas WHERE userId = '.$consumerId.')';
    $totalPrice2=$db->query($totalPriceQuery2);
    while($total1=$totalPrice1->fetchArray() AND $total2=$totalPrice2->fetchArray()){
        $totalPrice=$totalPrice+$total1[0]*$total2[0];
    }

    //$totalPriceShipping total price w/ shipping
    $totalPriceShipping=$totalPrice+3.99;
}


//remove a manga from order
//or submit order
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['clearCart'])){
        $clearCartQuery='DELETE FROM ordersItems WHERE userId = '.$consumerId.'';
        $clearCart=$db->query($clearCartQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    
    //user pressed the submit button
    if(isset($_POST['validatedOrder'])){
        //adding the order in the orders table
        $insertOrder=$db->prepare('INSERT INTO orders (userId, dateValidated, totalPrice, totalArticle) VALUES ("'.$consumerId.'", "'.$currentDate.'", "'.$totalPriceShipping.'", "'.$totalArticle[0].'")');
        $insertOrder->execute();
        $db->close();
        unset($db);
        //error database is locked
        header('Location:orderSuccessfull.php');
    }

    //remove button on mangas
    //all manga in the ordersItems
    while($wantedMangasData=$mangasInfoResults->fetchArray()){








        // if(isset($_POST["idToRemove".$wantedMangasData['mangaId'].""])){
        //     echo $wantedMangasData['mangaId'];
        // }
        // //the first manga of the list is asked for remove
        // if(empty($_POST["idToRemove".$wantedMangasData['mangaId'].""])){
        //     echo 'tabarnak';
        // }
        // if(isset($_POST["idToRemove".$wantedMangasData['mangaId'].""])){
        //     echo 'aaaaa';
        //     //a remove button of a manga has been pressed
        //     //$wantedMangasData['mangaId'] is his mangaId









        

        

        if(isset($_POST["idToRemove".$wantedMangasData['mangaId'].""])){
                

            //catching his quantity ($oldQuantity[0])
            $oldQuantityQuery="SELECT quantity FROM ordersItems WHERE wantedMangaId = '$wantedMangasData[0]' AND userId = '$consumerId'";
            $oldQuantity=$db->query($oldQuantityQuery)->fetchArray();

            $newQuantity=$oldQuantity[0]-1;
            if($newQuantity===0){
                echo'DISPARU';
                $removeMangaFromOrders="DELETE FROM ordersItems WHERE userId = '$consumerId' AND wantedMangaId='$wantedMangasData[0]'";
                $db->query($removeMangaFromOrders);
                echo'<meta http-equiv="refresh" content="0">';
            }
            else{
                echo'-1';
                $decrementQuantity="UPDATE ordersItems SET quantity = '$newQuantity' WHERE userId = '$consumerId' AND wantedMangaId='$wantedMangasData[0]'";
                $db->query($decrementQuantity);
                echo'<meta http-equiv="refresh" content="0">';
            }
        }
        
        //the first manga of the list is asked for remove
        if(empty($_POST["idToRemove".$wantedMangasData['mangaId'].""])){
            
            //$removedMangaId[0] is the mangaId of the asked one
            $removedMangaIdQuery='SELECT * FROM mangas WHERE mangaId in (SELECT wantedMangaId FROM ordersItems WHERE userId = '.$consumerId.') LIMIT 1;';
            $removedMangaId=$db->query($removedMangaIdQuery)->fetchArray();

            //catching his quantity ($oldQuantity[0])
            $oldQuantityQuery="SELECT quantity FROM ordersItems WHERE wantedMangaId = '$removedMangaId[0]' AND userId = '$consumerId'";
            $oldQuantity=$db->query($oldQuantityQuery)->fetchArray();

            $newQuantity=$oldQuantity[0]-1;
            if($newQuantity===0){
                echo'DISPARU';
                $removeMangaFromOrders="DELETE FROM ordersItems WHERE userId = '$consumerId' AND wantedMangaId='$removedMangaId[0]'";
                $db->query($removeMangaFromOrders);
                echo'<meta http-equiv="refresh" content="0">';
            }
            else{
                echo'-1';
                $decrementQuantity="UPDATE ordersItems SET quantity = '$newQuantity' WHERE userId = '$consumerId' AND wantedMangaId='$removedMangaId[0]'";
                $db->query($decrementQuantity);
                echo'<meta http-equiv="refresh" content="0">';
            }
            
        }
        









            

        //     $newQuantity=$oldQuantity[0]-1;
        //     //quantity=0 so remove from ordersItems
        //     if($newQuantity===0){
        //         $removeMangaFromOrders="DELETE FROM ordersItems WHERE userId = '$consumerId' AND wantedMangaId='$wantedMangasData[0]'";
        //         $db->query($removeMangaFromOrders);
        //         echo'<meta http-equiv="refresh" content="0">';
        //     }
        
        // else{
        //     $decrementQuantity="UPDATE ordersItems SET quantity = '$newQuantity' WHERE userId = '$consumerId' AND wantedMangaId='$wantedMangasData[0]'";
        //     $db->query($decrementQuantity);
        //     echo'<meta http-equiv="refresh" content="0">';
        // } 
        }

    }
// }
include('navbar.php');

if(isset($emptyCart)){echo $emptyCart;}

if(!isset($emptyCart)){
    //prompt all orders info
    echo'<div class=" container "><div class="row"><div class="col-sm-12"></div></div><div class="row"><div class="col-sm-4 col-sm-push-8"><div class="row"><div class="col-xs-12" style="padding: 0"><div style="display: table; margin: 10px auto;"></div><div style="display: table; margin: 10px auto;"></div></div></div><div class="alert alert-success"><div class="about"><b><h2>Order details</h2>';

    echo"<h5><b>Date: </b>$currentDate</h5><p>";
            echo'Articles:<br></b><br>';
            while($wantedMangasData=$mangasInfoResults->fetchArray()){
                //for each mangas in the ordersItems

                //catching quantity added for each manga
                $catchingQuantityQuery='SELECT quantity FROM ordersItems WHERE wantedMangaId = '.$wantedMangasData['mangaId'].' AND userId = '.$consumerId.'';
                $catchingQuantity=$db->query($catchingQuantityQuery)->fetchArray();

                //displaying all the infos
                echo "- $wantedMangasData[displayName] (#$wantedMangasData[volumeNumber]) | Quantity: x$catchingQuantity[0]<br><br>";
            }
            //displaying static info
            echo "<b>Total articles: </b>$totalArticle[0]<br><br>";
            echo "<b>Username/E-mail: </b>$username[username]<br><br>";
            echo '<b>Price: </b>$'.$totalPrice.'USD<br>- Shipping Fees: + $3.99USD<br><br>';
            echo '<b>Total Price:</b> $'.$totalPriceShipping.'USD';

            echo '</p></div></div><div class="panel panel-success">
            <div class="panel-heading">
                <div class="bt3">
                    <form method="post">
                        <b><input type="submit" name="validatedOrder" value="Submit Order"></input></b>
                    </form>                
                </div>
            </div>
    
            <div id="waiting" style="display: none;text-align: center;"></div>
            <ul class="top_rating_blade"></ul>
        </div>
    </div>
            <div class="col-sm-8 col-sm-pull-4">
                <div class="col-sm-12">
                    <h2 class="hotmanga-header"><i class=""></i>Shopping Cart</h2>
                    <hr>
                    <ul class="hot-thumbnails">';

            //displaying mangas
            while($wantedMangasData=$mangasInfoResults->fetchArray()){
                echo '<li class="span3">
                            <div class="photo" style="position: relative;">
                                <div class="manga-name">
                                    <a class="label label-warning"
                                        href="individual.php?id='.$wantedMangasData['mangaId'].'">'.$wantedMangasData[2].'</a>
                                </div>
                                <a class="thumbnail"
                                    style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                                    href="individual.php?id='.$wantedMangasData['mangaId'].'">
                                    <img src="'.$wantedMangasData['imageLink'].'?>"
                                        alt="'.$wantedMangasData['displayName'].'">
                                </a>
                                <div class="well">
                                <form id="b" method="post">
                                    <p>
                                        <input type="submit" name="idToRemove'.$wantedMangasData['mangaId'].'" value="Remove"></input>
                                    </p>
                                </form>
                                </div>
                            </div>
                        </li>
                        ';
            }
            echo'</ul>
            </div> 
        </div><form method="POST">
        <b><input type="submit" name="clearCart" value="Clear Cart"></input></b>
</form>
    </div>
    
</div>';
}

include('footer.php');
$db->close();
unset($db);?>

