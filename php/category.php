<?php session_start();
include('navbar.php');  
    $db=new SQLite3('r209-db-01.sqlite');

    $id=$_GET['id'];
    $req1='SELECT * FROM mangas WHERE categoryId="'.$id.'"';
    $results1=$db->query($req1);

    
    $ctg_names='SELECT * FROM categories WHERE categoryId = "'.$id.'"';
    $results2=$db->query($ctg_names);
    $data2=$results2->fetchArray();
    ?>


    

        <div class=" container ">

            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4 col-sm-push-8">

                    <div class="row">
                        <div class="col-xs-12" style="padding: 0">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-8 col-sm-pull-4">
                    <div class="col-sm-12">
                        <h2 class="hotmanga-header"><i class=""></i><?php echo $data2[1]?></h2>
                        <hr>
                        <ul class="hot-thumbnails">
                            <?php
                            while ($data1=$results1->fetchArray()) {
                                echo '<li class="span3">
                                <div class="photo" style="position: relative;">
                                    <div class="manga-name">
                                        <a class="label label-warning"
                                            href="individual.php?id='.$data1[0].'">'.$data1[2].'</a>
                                    </div>
                                    <a class="thumbnail"
                                        style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                                        href="individual.php?id='.$data1[0].'">
                                        <img src="'.$data1[1].'?>"
                                            alt="'.$data1[2].'">
                                    </a>
                                    <div class="well">
                                        <p>
                                            # '.$data1[4].'
                                        </p>
                                    </div>
                                </div>
                            </li>';
                            }
                            ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-sm-push-8">
                    <div class="row">
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
                        
                            
                        </ul>
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

</body>

</categories>