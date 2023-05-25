<?php session_start();

include('adminSecurityCheck.php');

include('navbar.php');
echo'<button onclick="history.go(-1);">Back</button>';

$userId=$_GET['id'];

$usersDataQuery='SELECT * FROM users WHERE userId='.$userId.'';
$userData=$db->query($usersDataQuery)->fetchArray();

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['changeUserId'])){
        $newUserId=$_POST['changeUserId'];
        $changeUserIdQuery="UPDATE users SET userId = '$newUserId' WHERE userId = '$userId'";
        $db->query($changeUserIdQuery);
        //to force refresh w/ out using header
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeUsername'])){
        $newUsername=$_POST['changeUsername'];
        $changeUsernameQuery="UPDATE users SET username = '$newUsername' WHERE userId = '$userId'";
        $db->query($changeUsernameQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changePassword'])){
        $newPassword=$_POST['changePassword'];
        $changePasswordQuery="UPDATE users SET password = '$newPassword' WHERE userId = '$userId'";
        $db->query($changePasswordQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }
    if(isset($_POST['changeIsAdmin'])){
        $newIsAdmin=$_POST['changeIsAdmin'];
        $changeIsAdminQuery="UPDATE users SET isAdmin = '$newIsAdmin' WHERE userId = '$userId'";
        $db->query($changeIsAdminQuery);
        echo'<meta http-equiv="refresh" content="0">';
    }    
}

echo'
<form method="POST">
<div class="admp">
<p>User Id (userId):</p>
<input type="text" name="changeUserId" value="'.$userData['userId'].'">
<button type="submit">Change</button>
<p>Username (username):</p>
<input type="text" name="changeUsername" value="'.$userData['username'].'">
<button type="submit">Change</button>
<p>Password (password):</p>
<input type="text" name="changePassword" value="'.$userData['password'].'">
<button type="submit">Change</button>
<p>Admin privileges (isAdmin):</p>
<input type="text" name="changeIsAdmin" value="'.$userData['isAdmin'].'">
<button type="submit">Change</button>
</div>
</form>';

include('footer.php');
$db->close();
unset($db);?>