<?php session_start();

include('navbar.php');?>

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

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Use CTRL + F to do a research</strong></h3>
                        </div>
                        <div id="waiting" style="display: none;text-align: center;">
                        </div>
                        <ul class="top_rating_blade"></ul>
                    </div>
                </div>
                <div class="col-sm-8 col-sm-pull-4">
                    <div class="col-sm-12">
                        <h2 class="hotmanga-header"><i class=""></i>📰  Catalogue</h2>
                        <hr>
                        <ul class="hot-thumbnails">
                        <?php
                        $db = new SQLite3('r209-db-01.sqlite');

                        $req = 'SELECT * FROM mangas';  // statement
                        $results = $db->query($req);
                        

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
                        </ul>
                    </div>
                </div>
<?php include('footer.php');?>