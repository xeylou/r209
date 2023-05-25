<?php session_start();

//check if user logged and if is an admin
include('adminSecurityCheck.php');

include('navbar.php');
echo'<button onclick="history.go(-1);">Back </button>';

$categoryId=$_GET['id'];

$categoriesDataQuery='SELECT * FROM categories WHERE categoryId='.$categoryId.'';
$categoryData=$db->query($categoriesDataQuery)->fetchArray();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['changeCategoryId'])){
        $newCategoryId=$_POST['changeCategoryId'];
        $changeCategoryIdQuery="UPDATE categories SET categoryId = '$newCategoryId' WHERE categoryId = '$categoryId'";
        $db->query($changeCategoryIdQuery);
        //to force refresh w/ out using header
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeCategoryName'])){
        $newCategoryName=$_POST['changeCategoryName'];
        $changeCategoryNameQuery="UPDATE categories SET categoryName = '$newCategoryName' WHERE categoryId = '$categoryId'";
        $db->query($changeCategoryNameQuery);
        echo'<meta http-equiv="refresh" content="0">';        
    }
}

echo'
<form method="POST">
<div class="admp">
<p>Category Id (categoryId):</p>
<input type="text" name="changeCategoryId" value="'.$categoryData['categoryId'].'">
<button type="submit">Change</button>
<p>Category Name (categoryName):</p>
<input type="text" name="changeCategoryName" value="'.$categoryData['categoryName'].'">
<button type="submit">Change</button>
</div>
</form>';

include ('footer.php');
$db->close();
unset($db);?>