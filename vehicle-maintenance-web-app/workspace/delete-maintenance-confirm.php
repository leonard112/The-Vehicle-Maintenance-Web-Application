<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Delete Maintenance Record?</title>
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
            include ("./objects/MaintenanceViewer.php");
            
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']) and 
                isset($_GET['maintenance-id']) and is_numeric($_GET['maintenance-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
                $maintenanceId = $_GET['maintenance-id'];
                
                $belongs = new MaintenanceViewer();
                $belongs->belongsToUserAndVehicle($vehicleId, $maintenanceId);
        
                echo    '<div class = "container">';
             
                $display = new MaintenanceViewer();
                $display->displayMaintenanceData($vehicleId,$maintenanceId);
            
                echo            '<div class = "list">
                                    <h3>Are you sure you want to delete this maintenance record?</h3><br>
                                    <br><a class = "link" href = "./delete-maintenance.php?vehicle-id='
                                    .$vehicleId.'&maintenance-id='.$maintenanceId.'">Yes</a>
                                    <a class = "link" href = "./view-vehicle.php?vehicle-id='.$vehicleId.'">No</a>
                                
			                    </div>
			                </div>';
            }
            else
            {
                header("Location: index.php");
            }
            
            include("./footer.php");
        ?>
    </body>
</html>