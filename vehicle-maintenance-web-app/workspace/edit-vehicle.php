<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Edit Vehicle</title>
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
        
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
            
                $belongs = new VehicleViewer();
                $belongs->belongsToUser($vehicleId);
        
                 echo   '<div class = "container">
                            </div>';
            
                $updateForm = new VehicleViewer();
                $updateForm->displayUpdateForm($vehicleId);
			 
			    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $update = new VehicleViewer();   
                    $update->updateVehicle($vehicleId);
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