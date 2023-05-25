<?php session_start();

//user is not logged
if(!isset($_SESSION['userId'])){
    header("Location:login.php");
    exit();
}

include('navbar.php');

//admin submited a modification
if($_SERVER['REQUEST_METHOD']==='POST'){
    $newPassword=$_POST['newPassword'];
    $newPasswordConfirm=$_POST['newPasswordConfirm'];
    if(empty($newPassword)||empty($newPasswordConfirm)){
        $emptyField='<p style="color: red">Please fill all the fields.</p>';
    }
    else{
        if($newPassword!=$newPasswordConfirm){
            $errorPwd='<p style="color: red">Passwords do not match.</p>';
        }
        else{
            $userId = $_SESSION['userId'];
            $changePwdQuery="UPDATE users SET password = '$newPassword' WHERE userId = '$userId'";
            $changePwd=$db->query($changePwdQuery);
            $success='<p style="color: green">Password   changed successfully!</p>';
        }
    }
}


// echo'
// <form method="POST">
// <p>Category Name (categoryName):</p>
// <input type="text" name="newCategoryName">
// <p></p> 
// <button type="submit">Add Category</button>
// </form>';

echo '
<div class=" container ">
            <div class=" indexcontainer ">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <div>
                                    <div class="fcf-body">
                                        <div id="fcf-form">
                                            <h4>Change password:</h4>
                                            <!-- <form method="POST" action="logging.php"> -->
                                            <form method="POST">
                                                <div>
                                                    <label>New password:</label>
                                                    ';
                                                    if(isset($errorPwd)){echo "<p>$errorPwd</p>";}
                                                    if(isset($emptyField)){echo "<p>$emptyField</p>";}
                                                    if(isset($success)){echo "<p>$success</p>";}
                                                    echo'
                                                    <div>
                                                        <input type="password" name="newPassword">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label>Confirm password:</label>
                                                    <div>
                                                        <input type="password" name="newPasswordConfirm">
                                                    </div>  
                                                </div>
                                                <p>

                                                </p>
                                                <div>
                                                    <button type="submit" value="login">Change Password</button>
                                                </div>
                                            </form>                                    
                                        </div>
                                        <br>
                                        <p></p>
                                        <form action="logout.php">
                                        <button type="submit" value="login">Disconnect</button>
                                      </form> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
';

include('footer.php');
$db->close();
unset($db);?>        