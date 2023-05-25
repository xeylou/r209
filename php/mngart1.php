<?php session_start();

//check if user logged and if is an admin
include('adminSecurityCheck.php');


//the id of the modified manga
$mangaId=$_GET['id'];

//catching mangas data
$mangasDataQuery='SELECT * FROM mangas WHERE mangaId='.$mangaId.'';
$eachMangaData=$db->query($mangasDataQuery)->fetchArray();

include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';
//admin submited a modification
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['changeMangaId'])){
        $newMangaId=$_POST["changeMangaId"];
        $changeMangaIdQuery="UPDATE mangas SET mangaId = '$newMangaId' WHERE mangaId = '$mangaId'";
        $db->query($changeMangaIdQuery);
        //to force refresh w/ out using header
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeImageLink'])){
        $newImageLink=$_POST['changeImageLink'];
        $changeImageLinkQuery="UPDATE mangas SET imageLink = '$newImageLink' WHERE mangaId = '$mangaId'";
        $db->query($changeImageLinkQuery);
        echo'<meta http-equiv="refresh" content="0">';
        
    }
    if(isset($_POST['changeDisplayName'])){
        $newDisplayName=$_POST['changeDisplayName'];
        $changeDisplayNameQuery="UPDATE mangas SET displayName = '$newDisplayName' WHERE mangaId = '$mangaId'";
        $db->query($changeDisplayNameQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeAuthorName'])){
        $newAuthorName=$_POST['changeAuthorName'];
        $changeAuthorNameQuery="UPDATE mangas SET authorName = '$newAuthorName' WHERE mangaId = '$mangaId'";
        $db->query($changeAuthorNameQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeVolumeNumber'])){
        $newVolumeNumber=$_POST['changeVolumeNumber'];
        $changeVolumeNumberQuery="UPDATE mangas SET volumeNumber = '$newVolumeNumber' WHERE mangaId = '$mangaId'";
        $db->query($changeVolumeNumberQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeReleaseDate'])){
        $newReleaseDate=$_POST['changeReleaseDate'];
        $changeReleaseDateQuery="UPDATE mangas SET releaseDate = '$newReleaseDate' WHERE mangaId = '$mangaId'";
        $db->query($changeReleaseDateQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeCategoryId'])){
        $newCategoryId=$_POST['changeCategoryId'];
        $changeCategoryIdQuery="UPDATE mangas SET categoryId = '$newCategoryId' WHERE mangaId = '$mangaId'";
        $db->query($changeCategoryIdQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeViewsNumber'])){
        $newViewsNumber=$_POST['changeViewsNumber'];
        $changeViewsNumberQuery="UPDATE mangas SET viewsNumber = '$newViewsNumber' WHERE mangaId = '$mangaId'";
        $db->query($changeViewsNumberQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeStockLeft'])){
        $newStockLeft=$_POST['changeStockLeft'];
        $changeStockLeftQuery="UPDATE mangas SET stockLeft = '$newStockLeft' WHERE mangaId = '$mangaId'";
        $db->query($changeStockLeftQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changePrice'])){
        $newPrice=$_POST['changePrice'];
        $changePriceQuery="UPDATE mangas SET price = '$newPrice' WHERE mangaId = '$mangaId'";
        $db->query($changePriceQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeDescription'])){
        $newDescription=$_POST['changeDescription'];
        $changeDescriptionQuery="UPDATE mangas SET description = '$newDescription' WHERE mangaId = '$mangaId'";
        $db->query($changeDescriptionQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
}


echo'
<form method="POST">
<div class="admp">
<p>Manga Id (mangaId):</p>
<input type="text" name="changeMangaId" value="'.$eachMangaData['mangaId'].'">
<button type="submit">Change</button>
<p>Link to the manga cover image (imageLink):</p>
<input type="text"  name="changeImageLink" value="'.$eachMangaData['imageLink'].'">
<button type="submit">Change</button>
<p>Manga Name (displayName):</p>
<input type="text"  name="changeDisplayName" value="'.$eachMangaData['displayName'].'">
<button type="submit">Change</button>
<p>Author Name (authorName):</p>
<input type="text"  name="changeAuthorName" value="'.$eachMangaData['authorName'].'">
<button type="submit">Change</button>
<p>Volume Number (volumeNumber):</p>
<input type="text"  name="changeVolumeNumber" value="'.$eachMangaData['volumeNumber'].'">
<button type="submit">Change</button>
<p>Release Date (releaseDate):</p>
<input type="text" name="changeReleaseDate" value="'.$eachMangaData['releaseDate'].'">
<button type="submit">Change</button>
<p>Category Id (categoryId):</p>
<input type="text" name="changeCategoryId" value="'.$eachMangaData['categoryId'].'">
<button type="submit">Change</button>
<p>Views Number (viewsNumber):</p>
<input type="text" name="changeViewsNumber" value="'.$eachMangaData['viewsNumber'].'">
<button type="submit">Change</button>
<p>Stock Left (stockLeft):</p>
<input type="text" name="changeStockLeft" value="'.$eachMangaData['stockLeft'].'">
<button type="submit">Change</button>
<p>Price (price):</p>
<input type="text" name="changePrice" value="'.$eachMangaData['price'].'">
<button type="submit">Change</button>
<p>Description (description):</p>
<input type="text" name="changeDescription" value="'.$eachMangaData['description'].'">
<button type="submit">Change</button>
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>




        