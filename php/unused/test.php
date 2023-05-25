<?php
 
    session_start();
    if (!isset($_SESSION["visits"]))
        $_SESSION["visits"] = 0;
    $_SESSION["visits"] = $_SESSION["visits"] + 1;
 
    if ($_SESSION["visits"] > 1)
    {
        echo 'you refreshed the page';
    }
    else
    {
        echo 'you didnt refresh the page';
    }
 
?>