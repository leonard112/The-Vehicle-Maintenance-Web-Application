<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Edit Maintenance</title>
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
            session_start();
        
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']) and 
                isset($_GET['maintenance-id']) and is_numeric($_GET['maintenance-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
                $maintenanceId = $_GET['maintenance-id'];
            
                $belongs = new MaintenanceViewer();
                $belongs->belongsToUserAndVehicle($vehicleId, $maintenanceId);
        
                echo    '<div class = "container">
                        </div>';
            
                $updateForm = new MaintenanceViewer();
                $updateForm->displayUpdateForm($vehicleId, $maintenanceId);
			 
			    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $update = new MaintenanceViewer();   
                    $update->updateMaintenance($vehicleId, $maintenanceId);
                }
            }
            else
            {
                header("Location: index.php");
            }
            include("./footer.php");
		?>
    </body>
</html>