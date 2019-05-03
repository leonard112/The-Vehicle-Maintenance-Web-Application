<!DOCTYPE html>
<html lang="en-us">
    <head>
	    <title>View Vehicle</title>
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
            
            if (isset($_GET['vehicle-id']) and is_numeric($_GET['vehicle-id']))
            {
                $vehicleId = $_GET['vehicle-id'];
            
                $belongs = new VehicleViewer();
                $belongs->belongsToUser($vehicleId);
        
                echo    '<div class = "container">';
            
                $displayVehicle = new VehicleViewer();
                $displayVehicle->displayVehicleDataAndOptions($vehicleId);
            
                $date = date('Y-m-d');
            
                echo            '<form class = "addnew" method="POST">
                                    <div class = "row">
                                        <div class = "col-md-4">
                                            <br><input type="date" name="date" placeholder = "date" size="4" value = "'.$date.'"required>
                                        </div>
			                            <div class = "col-md-4">
			                                <br><input type="number" name="miles" maxlength="7" placeholder = "miles" size="7" required>
			                            </div>
			                            <div class = "col-md-4">
			                                <br><textarea rows="4" cols="35" name="workdone" placeholder = "work done" required></textarea>
			                            </div>
			                        </div>
			                        <div class = "row">
			                            <div class = "addbutton" class = "col-md-12">
			                                <br><button class = "button" type="submit">Add Maintenance Record</button>
			                            </div>
			                        </div>
			                    </form>
			                    <b id = "err" style = "color: red;">'.$_SESSION["err"].'</b>';
			                
			    $_SESSION["err"] = "";
			                
			    $display = new MaintenanceViewer();   
			    $display->getMaintenance($vehicleId);
			 
			    echo       '</div>';
			 
			    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $add = new MaintenanceViewer();   
                    $add->addMaintenance($vehicleId);
                }
            }
            else
            {
                header("Location: ./index.php");
            }
            
            include("./footer.php");
		?>
    </body>
</html>