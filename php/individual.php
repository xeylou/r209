<?php session_start();

$db=new SQLite3('r209-db-01.sqlite');
$id=$_GET['id'];
$req1='SELECT * FROM mangas WHERE mangaId="'.$id.'"';
$results1=$db->query($req1);
$dataManga=$results1->fetchArray();

$ctgName='SELECT categoryName FROM categories WHERE categoryId IN (SELECT categoryId FROM mangas WHERE mangaId = "'.$id.'")';
$results2=$db->query($ctgName);
$data2=$results2->fetchArray();

if($_SERVER['REQUEST_METHOD']==='POST'){
    //verify is stock left
    if($dataManga['stockLeft']<1){
        //there is no stock left so cancel the order

        $noStockLeft='<p style="color: red">Error: no stock left</p>';
    }
    else{
        //the user is not logged
        if(!isset($_SESSION['userId'])){
            // $wantedMangaId=$dataManga.[0];
            header("Location:../../login.php");
            $db->close();
            exit();
        }
        else{
            //user logged, starts the proccess of ordering the item
            $wantedMangaId=$dataManga['mangaId'];
            $currentDate=date('l jS \of F Y h:i:s A');
            $userId=$_SESSION['userId'];

            //verifiy the user already ordered the manga once
            $alreadyExisted='SELECT * FROM ordersItems WHERE userId="'.$userId.'" AND wantedMangaId="'.$wantedMangaId.'"';
            $query=$db->query($alreadyExisted);
            if($orderExisted=$query->fetchArray()){
                //replace the date, quantity of the order
                $newQuantity=$orderExisted['quantity']+1;
                $orderId=$orderExisted['orderId'];
                //$replaceQuery="UPDATE ordersItems SET dateCreated = '.$currentDate.', quantity = '.$newQuantity.' WHERE orderId = '.$orderId.'";
                $replaceQuery=$db->prepare('UPDATE ordersItems SET dateCreated = "'.$currentDate.'", quantity = '.$newQuantity.' WHERE orderId = '.$orderId.'');
                $replaceQuery->execute();
                $successAdd='<p style="color: green">Successfully added this manga to your cart '.$newQuantity.' times!</p>';
                //remove 1 from stock TO DO
                $newStock=$dataManga['stockLeft']-1;
                $remove1FromStock=$db->prepare('UPDATE mangas SET stockLeft = '.$newStock.' WHERE mangaId = '.$wantedMangaId.'');
                $remove1FromStock->execute();
            }
            else{
                //add the order item to the table because its not
                $sth=$db->prepare('INSERT INTO ordersItems (userId, wantedMangaId, dateCreated, quantity) VALUES ('.$userId.', '.$wantedMangaId.', "'.$currentDate.'", 1)');
                $sth->execute();
                $successAdd='<p style="color: green">Successfully added this manga to your cart 1 time!</p>';
                
                //remove 1 from stock TO DO
                $newStock=$dataManga['stockLeft']-1;
                $remove1FromStock=$db->prepare('UPDATE mangas SET stockLeft = '.$newStock.' WHERE mangaId = '.$wantedMangaId.'');
                $remove1FromStock->execute();
            }
        }            
    }
}

    
include('navbar.php');



//refresh page detector
//can only add 1 view per session
//i prefer doing this than using the db 
//and check if the ip already checked the page
if (!isset($_SESSION["visits"]))
    $_SESSION["visits"]=0;
    $_SESSION["visits"]=$_SESSION["visits"]+1;

if($_SESSION["visits"]>1){
    // the user had refresh one time or more the page
}
else{
    $oldViewsNumber=$dataManga[7];
    $currentViewsNumber=$oldViewsNumber+1;

    $sth = $db->prepare('UPDATE mangas SET viewsNumber = "'.$currentViewsNumber.'" WHERE mangaId = "'.$id.'"');
    $sth->execute();
}

?>
<div class=" container ">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="widget-title" style="display: inline-block;"><?php echo $dataManga['displayName'];?></h2>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="boxed" style="width: 250px; height: 350px;">
                        <img class="img-responsive" style="height:auto" src="<?php echo $dataManga['imageLink'];?>"
                            alt="<?php echo $display_name;?>">
                    </div>
                </div>
                <div class="col-sm-8">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd><?php echo $dataManga['displayName'];?></dd>
                        <dt>Author</dt>
                        <dd><?php echo $dataManga['authorName'];?></dd>
                        <dt>Volume</dt>
                        <dd><?php echo $dataManga['volumeNumber'];?></dd>
                        <dt>Release date</dt>
                        <dd><?php echo $dataManga['releaseDate'];?></dd>
                        <dt>Category</dt>
                        <dd><a
                                href="<?php echo 'category.php?id='.$dataManga['categoryId'].'';?>"><?php echo $data2[0];?></a>
                        </dd>
                        <dt>Views</dt>
                        <dd><?php echo $dataManga['viewsNumber'];?></dd>
                        <br>
                        <dt>Quantity left</dt>
                        <dd><?php echo $dataManga['stockLeft'];?></dd>
                        <dt>Price (USD)</dt>
                        <dd>$<?php echo $dataManga['price'];?>0</dd>
                    </dl>
                </div>
                <dt>Description</dt>
                <p>
                    <dl style="margin-right: 80px;">
                        <?php echo $dataManga['description'];?>
                    </dl>
                    <form method=POST>
                        <div style='margin-left: 320px' name="test" type="submit" method="POST">
                            <button>Add to cart</button>
                            <?php if(isset($noStockLeft)){echo "<p>$noStockLeft</p>";}?>
                            <?php if(isset($successAdd)){echo "<p>$successAdd</p>";}?>
                        </div>
                    </form>
                    
            </div>
        </div>
    </div>
</div>
    <?php include('footer.php')?>