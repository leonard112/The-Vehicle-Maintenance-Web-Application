<!DOCTYPE html>
<html lang="en-us">
    <head>
	    <title>Delete Vehicle</title>
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
                
                $delete = new VehicleViewer();   
                $delete->deleteVehicle($vehicleId);
            }
            else
            {
                header("Location: index.php");
            }
        ?>
    </body>
</html>