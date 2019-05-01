<?php
    include("./objects/DBConnect.php");
    
    class VehicleViewer
    {
        //Add a new vehicle.
        public function addVehicle()
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['make'] != filter_var($_POST['make'], FILTER_SANITIZE_STRING) ||
                $_POST['model'] != filter_var($_POST['model'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header("Location: ./vehicles.php");
                exit();
            }
            
            $year = $_POST['year'];
            $make = filter_var($_POST['make'], FILTER_SANITIZE_STRING);
            $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
            $miles = $_POST['miles'];
            
            $insert = 'INSERT INTO VEHICLE (user_id, year, make, model, miles, status)
                        VALUES ("'.$_SESSION["user_id"].'", "'.$year.'", "'.$make.'", "'.$model.'", "'.$miles.'", "1")';
                
            if ($conn->query($insert) === TRUE) 
            { 
                header("Location: ./vehicles.php");
                exit();
            }
            
            else
            {
                $_SESSION["err"] = "Error! There was a problem adding the vehicle.";
                header("Location: ./vehicles.php");
                exit();
            }
        }
        
        //display a list of all the vehicles that the current user has.
        public function getVehicles()
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM VEHICLE WHERE user_id = "'.$_SESSION["user_id"].'" AND status = "1" ORDER BY year';
            
            $result = mysqli_query($conn,$query);
            
             echo   '<div class = "data">
                        <div class = "row">
                        </div>
                    </div>';
            
            if ($result)        
            {
                if (mysqli_num_rows($result) == 0) //if user has no vehicles.
                {
                    echo    '<div class = "data">
        	                    <div class = "row">
                                    <div class = "col-md-12 centerdata">No Vehicles Found.</div>
			                    </div>
			                </div>';
                }
            
                while ($row = mysqli_fetch_assoc($result)) //for each vehicle
                {
        	        echo    '<div class = "data">
        	                    <div class = "row">
                                <div class = "col-md-2 centerdata">'.$row["year"].'</div>
                                <div class = "col-md-4 centerdata">'.$row["make"].' '.$row["model"].'</div>
                                <div class = "col-md-2 centerdata">'.$row["miles"].' miles</div>
                                <div class = "col-md-4">
                                    <div class = "itembutton">
                                        <a class = "link" href = "./view-vehicle.php?vehicle-id='.$row['vehicle_id'].'">Veiw</a>
                                    </div>
                                </div>
			                    </div>
			                </div>';
                }
            }
            
            else
            {
                $_SESSION["err"] = "Error! There was a problem connecting to the database to get the user's vehicles.";
                
                header("Location: ./logout.php");
                exit();
            }
        }
        
        //Display vehicle data and display options to edit and delete.
        public function displayVehicleDataAndOptions($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM VEHICLE WHERE user_id = "'.$_SESSION["user_id"].'" AND vehicle_id = "'.$vehicleId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                echo    '<div class = "vehiclehead">
        	                <div class = "row">
                                <div class = "col-md-1 centerdata">'.$data["year"].'</div>
                                <div class = "col-md-4 centerdata">'.$data["make"].' '.$data["model"].'</div>
                                <div class = "col-md-3 centerdata">'.$data["miles"].' miles</div>
                                <div class = "col-md-4">
                                    <div class = "itembutton">
                                        <a class = "link" href = "./edit-vehicle.php?vehicle-id='.$vehicleId.'">Edit</a>
                                        <a class = "link" href = "./delete-vehicle-confirm.php?vehicle-id='.$vehicleId.'">Delete</a>
                                        <a class = "link" href = "./vehicles.php">Back</a>
                                    </div>
                                </div>
			                </div>
			            </div>';
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./vehicles.php");
                exit();
            }
        }
        
        //Display vehicle data.
        public function displayVehicleData($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM VEHICLE WHERE user_id = "'.$_SESSION["user_id"].'" AND vehicle_id = "'.$vehicleId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                echo    '<div class = "vehiclehead">
        	                <div class = "row">
                                <div class = "col-md-4 centerdata">'.$data["year"].'</div>
                                <div class = "col-md-4 centerdata">'.$data["make"].' '.$data["model"].'</div>
                                <div class = "col-md-4 centerdata">'.$data["miles"].' miles</div>
			                </div>
			            </div>';
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'");
                exit();
            }
        }
        
        //Display form for changing vehicle data.
        public function displayUpdateForm($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM VEHICLE WHERE user_id = "'.$_SESSION["user_id"].'" AND vehicle_id = "'.$vehicleId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                echo    '<div class = "container">
                            <div>
                                <form class = "list" method="POST">
                                    <br> <input type="number" name="year" maxlength="50" placeholder = "Year" value = "'.$data["year"].'" required> <br>
			                        <br> <input type="text" name="make" maxlength="50" placeholder = "Make" value = "'.$data["make"].'"required> <br>
			                        <br> <input type="text" name="model" maxlength="50" placeholder = "Model" value = "'.$data["model"].'" required> <br>
			                        <br> <input type="number" name="miles" maxlength="50" placeholder = "miles" value = "'.$data["miles"].'" required> <br>
			                        <br><button class = "button" type="submit">Update Vehicle</button><br>
			                        <br><a class = "link" href = "./view-vehicle.php?vehicle-id='.$vehicleId.'">Back</a><br>
			                    </form>
			                </div>
			            </div>';
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'");
                exit();
            }
        }
        
        //delete vehicle
        public function deleteVehicle($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $userid = $_SESSION['user_id'];
            
            $delete = 'UPDATE VEHICLE SET status = "0" WHERE vehicle_id = "'.$vehicleId.'" AND user_id = "'.$_SESSION['user_id'].'"';
                
            if ($conn->query($delete) === TRUE) 
            { 
                header("Location: ./vehicles.php");
                exit();
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'");
                exit();
            }
        }
        
        //update vehicle
        public function updateVehicle($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['make'] != filter_var($_POST['make'], FILTER_SANITIZE_STRING) ||
                $_POST['model'] != filter_var($_POST['model'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header("Location: ./view-vehicle.php?vehicle-id=".$vehicleId);
                exit();
            }
            
            $year = $_POST['year'];
            $make= filter_var($_POST['make'], FILTER_SANITIZE_STRING);
            $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
            $miles = $_POST['miles'];
            
            $update = 'UPDATE VEHICLE SET year = "'.$year.'", make = "'.$make.'",
                        model = "'.$model.'", miles = "'.$miles.'" WHERE user_id = "'.$_SESSION['user_id'].'"
                        AND vehicle_id = "'.$vehicleId.'"';
                
            if ($conn->query($update) === TRUE) 
            { 
                
                    header("Location: ./view-vehicle.php?vehicle-id=".$vehicleId);
                    exit();
            }
            else
            {
                    $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                    header("Location: ./view-vehicle.php?vehicle-id='.$vehicleId.'");
                    exit();
            }
        }
        
        //if the vehicle belongs to the user, do nothing. if not, go to index.php
        public function belongsToUser($vehicleId)
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = 'SELECT * FROM VEHICLE WHERE user_id = "'.$_SESSION["user_id"].'" AND vehicle_id = "'.$vehicleId.'" AND status = "1"';
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                if (mysqli_num_rows($result) == 0)
                {
                    header("Location: ./vehicles.php");
                    exit();
                }
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./vehicles.php");
                exit();
            }
        }
    }
?>