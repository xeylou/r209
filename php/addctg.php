<?php session_start();

//the ../../path to go one folder back to a file
if(!isset($_SESSION['userId'])){
	header("Location:../login.php");
}

$tmp=$_SESSION['userId'];
$db=new SQLite3('../r209-db-01.sqlite');
$querry1="SELECT * FROM users WHERE userId = '$tmp'";
$res1=$db->query($querry1);
$data1=$res1->fetchArray();

if ($data1[3]!=1) {
    header("Location: ../../error.php");
    exit();
}

?>
<!doctype admin>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Manila Manga</title>
    <meta name="description" content="Site pour acheter vos mangas" />
    <meta name="keywords" content="achat, manga" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/766013915536556056/1103986776583970937/manilla_mikey.jpg">
    <link defer rel="stylesheet" href="https://cdn.discordapp.com/attachments/766013915536556056/1103987220710445076/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.discordapp.com/attachments/766013915536556056/1104383479724130314/style2.css"/>
</head>

<body class="layout-boxed">
    <div class="wrapper">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
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
                            <a href="catalogue.php" title="Catalogue Mangas">
                                Catalogue
                            </a>
                        </li>
                        <li>
                            <a href="cart.php" title="Cart">
                                <i class="fa fa-ofthermometer-full"></i>
                                Cart
                            </a>
                        </li>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php
        $db=new SQLite3('r209-db-01.sqlite');
        

        echo '<div class="admp"><p>Category Id:</p>
        <input type="text" placeholder="categoryId">
        <p>Category Name    :</p>
        <input type="text" placeholder="categoryName">
        <br>
        <br>
        <button type="submit">Add</button></div>';
        ?>




        <div class=" container ">

            <div class="row">
                <div class="col-sm-12">
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
                            <!-- &copy;&nbsp;2023&nbsp; -->
                            <a href="index.php">Manila Manga</a>
                            <!-- &nbsp; -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    </div>
    </div>

</body>

</admin>