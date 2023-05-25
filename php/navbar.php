<?php echo '<!doctype html>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Manila Manga</title>
    <meta name="description" content="Buy your mangas"/>
    <meta name="keywords" content="buy, manga"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/766013915536556056/1103986776583970937/manilla_mikey.jpg">
    <link defer rel="stylesheet" href="https://cdn.discordapp.com/attachments/766013915536556056/1103987220710445076/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.discordapp.com/attachments/766013915536556056/1104383479724130314/style2.css"/>
</head>


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
                        </li>';

        if(isset($_SESSION['userId'])) {
            $db=new SQLite3('r209-db-01.sqlite');
            $id=$_SESSION['userId'];
            $getUsername='SELECT * FROM users WHERE userId = '.$id.'';
            $querry=$db->query($getUsername);
            $username=$querry->fetchArray();
            echo '<li>
                    <a href="user.php">'.$username[1].'</a>
                </li>';
        }

        
        echo '</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>';
?>
