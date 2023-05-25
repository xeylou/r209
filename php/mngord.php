<?php session_start();

include'adminSecurityCheck.php';

include'navbar.php';
echo '<button onclick="history.go(-1);">Back </button>';

echo'<div class="admp">
        <p>
            <a href="mngordi.php">
                Manage ordered items.
            </a>
        </p>
        <p>
            <a href="mngord1.php">
                Manage orders.
            </a>
        </p>
    </div>';



include'footer.php';
?>

