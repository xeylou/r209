<?php session_start();

//user is already logged in
if(isset($_SESSION['userId'])){
    //redirect to the cart page
    header("Location:cart.php");
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    
        $attemptNewUser=$_POST['newUser'];
        $attemptNewPwd=$_POST['newPwd'];
        $checkNewPwd=$_POST['checkNewPwd'];

        //verify if all fields are filled
        if (empty($attemptNewUser)||empty($attemptNewPwd)||empty($checkNewPwd)){
            $emptyField='<p style="color: red">Please fill all the fields.</p>';
        }
        else{
            //fields filled, check if password match
            if($checkNewPwd!=$attemptNewPwd){
                $errorPwd='<p style="color: red">Passwords do not match.</p>';
            }
            else{
                //fields, password, now check if username already exists
                $db=new SQLite3('r209-db-01.sqlite');
                $checkUsername="SELECT * FROM users WHERE username = '$attemptNewUser'";
                $querry=$db->query($checkUsername);
                if($querry->fetchArray()){
                    $unavailable='<p style="color: red">Username already exist.</p>';
                }
                else{
                    //finally add the user to the users table
                    $addUser=$db->prepare('INSERT INTO users (username, password, isAdmin) VALUES ("'.$attemptNewUser.'", "'.$attemptNewPwd.'", 0)');
                    $addUser->execute();

                    //directly log the new user
                    $_SESSION['userId']=$attemptNewUser;

                    //double-check if logged by redirecting it to the logging page
                    //because if already logged user will be redirect to cart page
                    header('Location:login.php');
                    exit();
                }
            }
        }
}

include('navbar.php');?>

<div class=" container ">
    <div class=" container ">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="coindexl-xs-12">
                            <div class="fcf-body">
                                <div>
                                    <h3>Sign up</h3>
                                    <?php if(isset($emptyField)){echo "<p>$emptyField</p>";}
                                    if(isset($errorPwd)){echo "<p>$errorPwd</p>";}
                                    if(isset($unavailable)){echo "<p>$unavailable</p>";}?>
                                    <form method="post">
                                        <div>
                                            <label>Username:</label>
                                            <div>
                                                <input type="text" name="newUser">
                                            </div>
                                        </div>
                                        <div>
                                            <label>Password:</label>
                                            <div>
                                                <input type="password" name="newPwd">
                                            </div>
                                        </div>
                                        <div>
                                            <label>Confirm password:</label>
                                            <div>
                                                <input type="password" name="checkNewPwd">
                                            </div>
                                        </div>
                                        <p></p>
                                        <div>
                                            <button type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>

<?php include('footer.php')?>