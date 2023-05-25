<?php session_start();

include('navbar.php');
echo '<div class="row">
<div class="col-sm-4 col-sm-push-8">

    <div class="row">
        <div class="col-xs-12" style="padding: 0">
        </div>
    </div>
    
</div>';

$db=new SQLite3('r209-db-01.sqlite');

// put the number of categories in first position of an array
// decrement from 2 to 1 (shonen to seinen)
$quer1='SELECT * FROM categories ORDER BY categoryId DESC LIMIT 1';
$res1=$db->query($quer1);
$data1=$res1->fetchArray();                

while ($data1[0] != 0) {
    
    // catching the categoryId of the query above & make it usable
    $quer2='SELECT * FROM categories WHERE categoryId = '.$data1[0].'';
    $res2=$db->query($quer2);
    $data2=$res2->fetchArray();

    // name of the categories
    echo '<div class="col-sm-8 col-sm-pull-4">
    <div class="col-sm-12">
        <h2 class="hotmanga-header"><i class=""></i>'.$data2[1].'</h2>
        <hr>
        <ul class="hot-thumbnails">';

    // /!\ COMMENT JE PEUX FAIRE POUR AVOIR UNE VARIABLE QUI PREND SUCCESSIVEMENT CHAQUE ID DES MANGAS QUI CONSTISTUE UNE CATEGORIE


    $quer3='SELECT * FROM mangas WHERE categoryId = '.$data1[0].'';
    $res3=$db->query($quer3);

    while ($data3=$res3->fetchArray()) {
        echo '<li class="span3">
                <div class="photo" style="position: relative;">
                    <div class="manga-name">
                        <a class="label label-warning"
                            href="individual.php?id='.$data3[0].'">'.$data3[2].'</a>
                    </div>
                    <a class="thumbnail"
                        style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                        href="individual.php?id='.$data3[0].'">
                        <img src="'.$data3[1].'?>"
                            alt="'.$data3[2].'">
                    </a>
                    <div class="well">
                        <p>
                            # '.$data3[4].'
                        </p>
                    </div>
                </div>
            </li>';
    }
    $data1[0]=$data1[0] - 1;

    echo '</div>
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
</div>'; // the ending of the category
}

include('footer.php');
?>