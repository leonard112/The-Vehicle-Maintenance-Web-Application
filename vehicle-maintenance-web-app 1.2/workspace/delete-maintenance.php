<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Delete Maintenance Record</title>
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
            include ("./objects/MaintenanceViewer.php");
            session_start();
        
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']) and 
                isset($_GET['maintenance-id']) and is_numeric($_GET['maintenance-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
                $maintenanceId = $_GET['maintenance-id'];
                
                $belongs = new MaintenanceViewer();
                $belongs->belongsToUserAndVehicle($vehicleId, $maintenanceId);
                
                $delete = new MaintenanceViewer();   
                $delete->deleteMaintenance($vehicleId, $maintenanceId);
            }
            else
            {
                header("Location: ./index.php");
            }
        ?>
    </body>
</html>