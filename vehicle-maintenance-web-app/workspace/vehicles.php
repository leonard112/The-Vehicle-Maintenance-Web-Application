<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
	    <title>Vehicles</title>
            <?php
                session_start();
                if (isset($_SESSION['user_id']))
                {
                    include ("./nav.php");
                }
        
                else
                {
                    header("Location: index.php");
                }
            ?>
    </head>
    <body>
        <?php
            include ("./objects/VehicleViewer.php");
        
            echo    '<div class = "container">
                            <form class = "addnew" method="POST">
                                <div class = "row">
                                    <div class = "col-md-3">
                                        <br><input type="number" name="year" maxlength="4" placeholder = "year" size="4" required>
                                    </div>
                                    <div class = "col-md-3">
                                        <br><input type="text" name="make" maxlength="50" placeholder = "make" required>
                                    </div>
                                    <div class = "col-md-3">
			                            <br><input type="text" name="model" maxlength="50" placeholder = "model" required>
			                        </div>
			                        <div class = "col-md-3">
			                            <br><input type="number" name="miles" maxlength="7" placeholder = "miles" size="7" required>
			                        </div>
			                    </div>
			                    <div class = "row">
			                        <div class = "addbutton" class = "col-md-12">
			                            <br><button class = "button" type="submit">Add Vehicle</button>
			                        </div>
			                    </div>
			                </form>
			                <b id = "err" style = "color: red;">'.$_SESSION["err"].'</b>';
			                
			 $_SESSION["err"] = "";
			                
			 $display = new VehicleViewer();
			 $display->getVehicles();
			 
			 echo       '</div>';
			 
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $add = new VehicleViewer();   
                $add->addVehicle();
            }
            
            include("./footer.php");
		?>
    </body>
</html>
