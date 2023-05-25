<?php session_start();

include'adminSecurityCheck.php';

include'navbar.php';

echo'<div class="admp">
        <p>
            <a href="mngann.php">
                Manage announces.
            </a>
        </p>
        <p>
            <a href="mngart.php">
                Manage articles.
            </a>
        </p>
        <p>
            <a href="mngctg.php">
                Manage categories.
            </a>
        </p>
        <p>
            <a href="mngord.php">
                Manage orders.
                </a>
        </p>
        <p>
            <a href="mngusers.php">
                Manage users.
            </a>
        </p>
    </div>';

include'footer.php';
?>




       
