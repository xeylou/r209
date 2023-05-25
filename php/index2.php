<?php if (isset($_SESSION['username'])) { ?>
                            
                            <li class="dropdown" aria-labelledby="navbarDropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php echo $_SESSION['username']; ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li role="separator" class="divider"></li>
                                    <a class="has-submenu" href="logout.php">Log Out</a>
                                </ul>
                            </li>

                        <?php } ?>
