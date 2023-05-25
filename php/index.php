<?php session_start();

include('navbar.php');?>

<body class=" layout-boxed ">

    <div class=" container ">

        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-push-8">

                <div class="row">
                    <div class="col-xs-12" style="padding: 0">
                        <div style="display: table; margin: 10px auto;">
                        </div>
                        <div style="display: table; margin: 10px auto;">
                        </div>
                    </div>
                </div>

                <div class="alert alert-success">
                    <div class="about">
                        <?php
                            $db=new SQLite3('r209-db-01.sqlite');
                            $querry0='SELECT * from announce WHERE announceId = 2';
                            $results0=$db->query($querry0);
                            $data0=$results0->fetchArray();
                            echo '<h2>'.$data0[1].'</h2>';
                            $querry1='SELECT * from announce WHERE announceId = 3';
                            $results1=$db->query($querry1);
                            $data1=$results1->fetchArray();
                            echo '<h6>'.$data1[1].'</h6>';?>
                        <p>
                            Find all of your favorite mangas online, One Piece, One Punch Man, My Hero Academia, Attack
                            on Titan and more... at manila-manga.com.
                        </p>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <?php
                            $querry2='SELECT * from announce WHERE announceId = 1';
                            $results2=$db->query($querry2);
                            while($data2=$results2->fetchArray()){
                                echo '<h3 class="panel-title"><strong>'.$data2[1].'</strong></h3>';                               
                            }                            
                        ?>
                    </div>
                    <div id="waiting" style="display: none;text-align: center;">
                    </div>
                    <ul class="top_rating_blade"></ul>
                </div>
            </div>
            <div class="col-sm-8 col-sm-pull-4">
                <div class="col-sm-12">
                    <h2 class="hotmanga-header"><i class=""></i>🔔 Newest Mangas</h2>
                    <hr>
                    <ul class="hot-thumbnails">
                        <?php

                            $req = 'SELECT * FROM mangas ORDER BY releaseDate DESC LIMIT 3';
                            $results = $db->query($req);
                            $req2='SELECT * FROM mangas ORDER BY viewsNumber DESC LIMIT 6';
                            $results2=$db->query($req2);
                            
    
                            while ($data=$results->fetchArray()) {
                                echo '<li class="span3">
                                <div class="photo" style="position: relative;">
                                    <div class="manga-name">
                                        <a class="label label-warning"
                                            href="individual.php?id='.$data[0].'">'.$data[2].'</a>
                                    </div>
                                    <a class="thumbnail"
                                        style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                                        href="individual.php?id='.$data[0].'">
                                        <img src="'.$data[1].'?>"
                        alt="'.$data[2].'">
                        </a>
                        <div class="well">
                            <p>
                                # '.$data[4].'
                            </p>
                        </div>
                </div>
                </li>';
                };
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-push-8">
            <div class="row" id="sidebar">
                <div class="col-xs-12" style="padding: 0">
                    <div style="display: table; margin: 10px auto;">
                        <div id="protag-sidebar"></div>
                    </div>
                    <div style="display: table; margin: 10px auto;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-sm-pull-4">
            <div class="col-sm-12">
                <h2 class="hotmanga-header"><i class=""></i>⭐ Most Viewed</h2>
                <hr>
                <ul class="hot-thumbnails">
                    <?php
                            while ($data2=$results2->fetchArray()) {
                                echo '<li class="span3">
                                <div class="photo" style="position: relative;">
                                    <div class="manga-name">
                                        <a class="label label-warning"
                                            href="individual.php?id='.$data2[0].'">'.$data2[2].'</a>
                                    </div>
                                    <a class="thumbnail"
                                        style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                                        href="individual.php?id='.$data2[0].'">
                                        <img src="'.$data2[1].'?>"
                    alt="'.$data2[2].'">
                    </a>
                    <div class="well">
                        <p>
                            # '.$data2[4].'
                        </p>
                    </div>
            </div>
            </li>';
            };
            ?>
            </ul>
        </div>
    </div>
    <?php include('footer.php');?>
</div>