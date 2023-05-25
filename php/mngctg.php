<?php session_start();

include('adminSecurityCheck.php');
include('navbar.php');
echo '<button onclick="history.go(-1);">Back </button>';

$db=new SQLite3('r209-db-01.sqlite');
$categoriesDataQuery='SELECT * from categories';
$categoriesData=$db->query($categoriesDataQuery);

while ($eachCategoryData=$categoriesData->fetchArray()) {
    echo '<div class="admp">
        <p>
        <a href="mngctg1.php?id='.$eachCategoryData['categoryId'].'">Edit category '.$eachCategoryData['categoryName'].'</a>
        </p>';
}

echo '<a href="addctg.php">Add a category</a></div></div>';

include('footer.php');
$db->close();
unset($db);
?>
    