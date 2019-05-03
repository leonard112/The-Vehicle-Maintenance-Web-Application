<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Delete Vehicle?</title>
            <?php
                session_start();
                
                if (isset($_SESSION['user_id']))
                {
                    include ("./nav.php");
                }
        
                else
                {
                    header("Location: ./index.php");
                }
            ?>
    </head>
    <body>
        <?php 
            include ("./objects/VehicleViewer.php");
            
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
                
                $belongs = new VehicleViewer();
                $belongs->belongsToUser($vehicleId);
        
                echo    '<div class = "container">';
             
                $display = new VehicleViewer();
                $display->displayVehicleData($vehicleId);
            
                echo            '<div class = "list">
                                    <h3>Are you sure you want to delete this vehicle?</h3><br>
                                    <br><a class = "link" href = "./delete-vehicle.php?vehicle-id='.$vehicleId.'">Yes</a>
                                    <a class = "link" href = "./view-vehicle.php?vehicle-id='.$vehicleId.'">No</a>
                                
			                    </div>
			                </div>';
            }
            else
            {
                header("Location: ./index.php");
            }
            
            include("./footer.php");
        ?>
    </body>
</html>