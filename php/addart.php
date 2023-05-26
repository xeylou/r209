<?php session_start();

include('adminSecurityCheck.php');
include('navbar.php');

echo '<button onclick="history.go(-1);">Back </button>';
//admin submited a modification
if($_SERVER['REQUEST_METHOD']==='POST'){
    $newImageLink=$_POST["newImageLink"];
    $newDisplayName=$_POST["newDisplayName"];
    $newAuthorName=$_POST["newAuthorName"];
    $newVolumeNumber=$_POST["newVolumeNumber"];
    $newReleaseDate=$_POST["newReleaseDate"];
    $newCategoryId=$_POST["newCategoryId"];
    $newViewsNumber=$_POST["newViewsNumber"];
    $newStockLeft=$_POST["newStockLeft"];
    $newPrice=$_POST["newPrice"];
    $newDescription=$_POST["newDescription"];
    $addArtQuery=$db->prepare("INSERT INTO mangas (imageLink, displayName, authorName, volumeNumber, realeaseDate, categoryId, viewsNumber, stockLeft, price, description) VALUES ('$newImageLink', '$newDisplayName', '$newAuthorName', '$newVolumeNumber', '$newReleaseDate', '$newCategoryId', '$newViewsNumber', '$newStockLeft', '$newPrice', '$newDescription')");
    $addArtQuery->execute();
}


echo'
<form method="POST">
<div class="admp">
<p>Link to the manga cover image (imageLink):</p>
<input type="text"  name="newImageLink">
<p>Manga Name (displayName):</p>
<input type="text"  name="newDisplayName">
<p>Author Name (authorName):</p>
<input type="text"  name="newAuthorName">
<p>Volume Number (volumeNumber):</p>
<input type="text"  name="newVolumeNumber">
<p>Release Date (releaseDate):</p>
<input type="text" name="newReleaseDate">
<p>Category Id (categoryId):</p>
<input type="text" name="newCategoryId">
<p>Views Number (viewsNumber):</p>
<input type="text" name="newViewsNumber">
<p>Stock Left (stockLeft):</p>
<input type="text" name="newStockLeft">
<p>Price (price):</p>
<input type="text" name="newPrice">
<p>Description (description):</p>
<input type="text" name="newDescription">
<p></p>
<button type="submit">Add Manga</button>
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>        