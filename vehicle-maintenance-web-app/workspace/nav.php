<?php
    include("./site-info.php");
            
    echo    '<nav class = "navbar" style = "border-radius: 0">
                <div class = "container">
                    <div class = "row">
                        <div class = "homebutton col-md-8">
                            <a href = "./index.php">
                                <img src="images/vehicle-maintenance-white.png" alt = "The Vehicle Maintenance Application" style = "width: 300px; margin: 5px;">
                            </a>
                        </div>
                        <div class = "col-md-4" id = "navlinks">
                            <a class = "navlink" href = "./index.php">Home</a>
                            <a class = "navlink" href = "./logout.php">Log Out</a>
                            <a class = "navlink" href = "./manage-account.php">'.$_SESSION["username"].'</a>
                        </div>
                    </div>
                </div>
            </nav>';
?>
