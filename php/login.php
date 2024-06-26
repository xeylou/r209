<?php session_start();

// if alreader signed in, redirect to cart
if (isset($_SESSION['userId'])) {
    // Redirect to the cart page
    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// if (isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
    
    $db = new SQLite3('r209-db-01.sqlite');

    $user = $_POST['inputUsername'];
    $pwd = $_POST['inputPassword'];

    $verifyUser = "SELECT * FROM users WHERE username = '$user' AND password = '$pwd'";
    $res=$db->query($verifyUser);
    
    if ($res->fetchArray()) {
        $tempReq="SELECT userId FROM users WHERE username = '$user'";
        $tempRes=$db->query($tempReq);

        while($tempData = $tempRes->fetchArray()) {
            $_SESSION['userId'] = $tempData['userId'];
        }

        //looking if wanted manga is waiting
        //if so, adding it in order
        if(isset($_SESSION['wantedWaitingMangaId'])){
            $currentDate=date('l jS \of F Y h:i:s A');
            $addUser=$db->prepare('INSERT INTO ordersItems (userId, wantedMangaId, dateCreated, quantity) VALUES ('.$_SESSION['userId'].', '.$_SESSION['wantedWaitingMangaId'].', "'.$currentDate.'", 1)');
            $addUser->execute();
        }

        header("Location: cart.php");
        exit();
    }
    else {
        $errorMessage = '<p style="color: red">Invalid credentials, please try again.</p>';
    }
}

?>
<!doctype login>

<head>
    <meta name="darkreader-lock">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Manila Manga</title>
    <meta name="description" content="Buy your mangas"/>
    <meta name="keywords" content="buy, manga"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="manilla_mikey.jpg">
    <link defer rel="stylesheet" href="bootstrap.min.css"/>
    <link rel="stylesheet" href="style2.css"/>
</head>

<body class=" layout-boxed ">
    <div class="wrapper">
        <nav class="navbar navbar-default" role="navigation">
            <div class=" container ">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="# 01navbar-menu">
                        <span class="sr-only" Navigation"</span> <span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <h1 class="" style="margin:0;">
                        <a class="navbar-brand" href="index.php">
                            Manila Manga
                        </a>
                    </h1>
                </div>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav  navbar-right">
                        <li>
                            <a href="index.php" title="Home">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="categories.php" title="Categories">
                                Categories
                            </a>
                        </li>
                        <li>
                            <a href="catalogue.php" title="Mangas">
                                Catalogue
                            </a>
                        </li>
                        <li>
                            <a href="cart.php" title="Cart">
                                Cart
                            </a>
                        </li>
                        </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <div class=" container ">
            <div class=" indexcontainer ">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <div>
                                    <p>If you are a new on this website, please consider <a href="register.php">signing up</a>.</p>
                                    <div class="fcf-body">
                                        <div id="fcf-form">
                                            <h3>Sign in</h3>
                                            <?php if (isset($errorMessage)) : ?>
                                            <p><?php echo $errorMessage; ?></p>
                                            <?php endif; ?>
                                            <!-- <form method="POST" action="logging.php"> -->
                                            <form method="POST">
                                                <div>
                                                    <label>Username:</label>
                                                    <div>
                                                        <input type="text" name="inputUsername">
                                                    </div>
                                                </div>

                                                <div>
                                                    <label>Password:</label>
                                                    <div>
                                                        <input type="password" name="inputPassword">
                                                    </div>  
                                                </div>
                                                <p>

                                                </p>
                                                <div>
                                                    <button type="submit" value="login">Login</button>
                                                </div>
                                                <?php
                                            ?>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="manga-footer">
    
                            <ul class=" pull-right ">
                                <li>
                                    <a href="index.php" title="Home">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="catalogue.php" title="Mangas">
                                        Catalogue
                                    </a>
                                </li>
                            </ul>
                            <a href="index.php">Manila Manga</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

</body>

</login> 
