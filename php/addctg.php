<?php session_start();

include('adminSecurityCheck.php');
include('navbar.php');

echo '<button onclick="history.go(-1);">Back </button>';
//admin submited a modification
if($_SERVER['REQUEST_METHOD']==='POST'){
    $newCategoryName=$_POST["newCategoryName"];
    $addCategoryQuery=$db->prepare("INSERT INTO categories (categoryName) VALUES ('$newCategoryName')");
    $addCategoryQuery->execute();
}


echo'
<form method="POST">
<div class="admp">
<p>Category Name (categoryName):</p>
<input type="text" name="newCategoryName">
<p></p> 
<button type="submit">Add Category</button>
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>        