<?php
    //incudes VehicleViewer to avoid errors on some pages that include both the MaintenanceViewer and the VehicleViewer, and to include DBConnect
    include("./objects/VehicleViewer.php");
    
    class MaintenanceViewer
    {
        //insert new maintencance record.
        public function addMaintenance($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['workdone'] != filter_var($_POST['workdone'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                exit();
            }
            
            $date = $_POST['date'];
            $miles = $_POST['miles'];
            $workdone = filter_var($_POST['workdone'], FILTER_SANITIZE_STRING);
            
            $insert = 'INSERT INTO MAINTENANCE (user_id, vehicle_id, date, miles, workdone, status)
                        VALUES ("'.$_SESSION["user_id"].'", "'.$vehicleId.'", "'.$date.'", "'.$miles.'", "'.$workdone.'", "1")';
                
            if ($conn->query($insert) === TRUE) 
            { 
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId);
                exit();
            }
            
            else
            {
                $_SESSION["err"] = "Error! There was a problem adding the vehicle.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId);
                exit();
            }
        }
        
        //Display all of the maintenance records for a given vehicle.
        public function getMaintenance($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM MAINTENANCE WHERE user_id = "'.$_SESSION["user_id"].'" AND 
                    vehicle_id = "'.$vehicleId.'" AND status = "1" ORDER BY miles';
            
            $result = mysqli_query($conn,$query);
            
             echo   '<div class = "data">
                        <div class = "row">
                        </div>
                    </div>';
            
            if ($result)        
            {
                if (mysqli_num_rows($result) == 0) //if there are no maintenance records
                {
                    echo    '<div class = "data">
        	                    <div class = "row">
                                    <div class = "col-md-12 centerdata">No Maintenance Records Found.</div>
			                    </div>
			                </div>';
                }
            
                while ($row = mysqli_fetch_assoc($result)) //for each maintenance record
                {
                    $date = date_create($row["date"]);
                    $date = date_format($date,"m/d/y");
                    
        	        echo    '<div class = "data">
        	                    <div class = "row">
        	                        <div class = "col-md-2 centerdata">'.$row["miles"].' miles</div>
                                    <div class = "col-md-2 centerdata">'.$date.'</div>
                                    <div class = "col-md-4 centerdata">'.$row["workdone"].'</div>
                                    <div class = "col-md-4">
                                    <div class = "itembutton">
                                        <a class = "link" href = "./edit-maintenance.php?vehicle-id='.$vehicleId.'&maintenance-id='
                                        .$row["maintenance_id"].'">Edit</a>
                                        <a class = "link" href = "./delete-maintenance-confirm.php?vehicle-id='.$vehicleId.'&maintenance-id='
                                        .$row["maintenance_id"].'">Delete</a>
                                    </div>
                                </div>
			                    </div>
			                </div>';
                }
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header('Location: ./vehicles.php');
                exit();
            }
        }
        
        //Display maintenance data.
        public function displayMaintenanceData($vehicleId, $maintenanceId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM MAINTENANCE WHERE user_id = "'.$_SESSION["user_id"].'" AND 
                        vehicle_id = "'.$vehicleId.'" AND maintenance_id = "'.$maintenanceId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                echo    '<div class = "vehiclehead">
        	                <div class = "row">
                                <div class = "col-md-4 centerdata">'.$data["date"].'</div>
                                <div class = "col-md-4 centerdata">'.$data["miles"].' miles</div>
                                <div class = "col-md-4 centerdata">'.$data["workdone"].'</div>
			                </div>
			            </div>';
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId);
                exit();
            }
        }
        
        //Delete specified maintenance record.
        public function deleteMaintenance($vehicleId, $maintenanceId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $delete = 'UPDATE MAINTENANCE SET status = "0" WHERE maintenance_id = "'.$maintenanceId.'" AND vehicle_id = "'.$vehicleId.'" AND user_id = "'.$_SESSION['user_id'].'"';
                
            if ($conn->query($delete) === TRUE) 
            { 
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                exit();
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                exit();
            }
        }
        
        //display update form for modifying maintenance record.
        public function displayUpdateForm($vehicleId, $maintenanceId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM MAINTENANCE WHERE user_id = "'.$_SESSION["user_id"].'" AND vehicle_id = "'.$vehicleId.'" 
                    AND maintenance_id = "'.$maintenanceId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                echo    '<div class = "container">
                            <div>
                                <form class = "list" method="POST">
                                    <br> <input type="date" name="date" placeholder = "Date" value = "'.$data["date"].'" required> <br>
			                        <br> <input type="number" name="miles" maxlength="7" placeholder = "Miles" value = "'.$data["miles"].'"required> <br>
			                        <br> <textarea type="text" name="workdone" maxlength="50" placeholder = "Work Done" required>'.$data["workdone"].'</textarea> <br>
			                        <br><button class = "button" type="submit">Update Maintenance Record</button><br>
			                        <br><a class = "link" href = "./view-vehicle.php?vehicle-id='.$vehicleId.'">Back</a><br>
			                    </form>
			                </div>
			            </div>';
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                exit();
            }
        }
        
        //Update the specified maintenance record.
        public function updateMaintenance($vehicleId, $maintenanceId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['workdone'] != filter_var($_POST['workdone'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                exit();
            }
            
            $date = $_POST['date'];
            $miles = $_POST['miles'];
            $workdone = filter_var($_POST['workdone'], FILTER_SANITIZE_STRING);
            
            $update = 'UPDATE MAINTENANCE SET date = "'.$date.'", miles = "'.$miles.'",
                        workdone = "'.$workdone.'" WHERE user_id = "'.$_SESSION['user_id'].'"
                        AND vehicle_id = "'.$vehicleId.'" AND maintenance_id = "'.$maintenanceId.'"';
                
            if ($conn->query($update) === TRUE) 
            { 
                
                    header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                    exit();
            }
            else
            {
                    $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                    header('Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'');
                    exit();
            }
        }
        
        //if the maintenance record belongs to the user and the vehicle, do nothing. if not, go to index.php
        public function belongsToUserAndVehicle($vehicleId, $maintenanceId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM MAINTENANCE WHERE user_id = "'.$_SESSION["user_id"].'" AND 
                        vehicle_id = "'.$vehicleId.'" AND maintenance_id = "'.$maintenanceId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                if (mysqli_num_rows($result) == 0)
                {
                    header("Location: ./index.php");
                    exit();
                }
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./index.php");
                exit();
            }
        }
    }
?>