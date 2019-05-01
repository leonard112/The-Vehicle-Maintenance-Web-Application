<?php
    ob_start();
?>
<?php
    include("./site-info.php");
            
    echo    '<nav class = "navbar" style = "border-radius: 0">
                        <button class = "hamburger" type="button" data-toggle="dropdown"><i class="fas fa-bars"></i></button>
                        <ul class="dropdown-menu">
                            <li>
                                <div class = "dropdownlink">
                                    <a class = "dropdownlink" href="./index.php">
                                        <b>Home</b>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class = "dropdownlink">
                                    <a class = "dropdownlink" href="./manage-account.php">
                                        <b>Manage Account</b>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class = "dropdownlink">
                                    <a class = "dropdownlink" href="./logout.php">
                                        <b>Log out</b>
                                    </a>
                                </div>
                            </li>
                            <li class="divider" style = "background-color: #ccc"></li>
                            <li>
                                <div class = "dropdownlink">
                                    <a class = "dropdownlink" href="./about.php">
                                        <b>About</b>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <a href = "./index.php">
                            <img src="images/vehicle-maintenance-white.png" alt = "The Vehicle Maintenance Application" style = "margin: 5px;">
                        </a>
            </nav>';
?>
