<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Create Account</title>
        <?php
            session_start();
            
            if (isset($_SESSION['user_id']))
            {
                header("Location: ./vehicles.php");
            }
            
            include("./site-info.php");
        ?>
        <nav style = "text-align: center">
            <a class = "login" href = "./index.php">
                <img src="images/vehicle-maintenance-red.png" alt = "The Vehicle Maintenance Application" style = "width: 300px">
            </a>
        </nav>
        
    </head>
    <body>
        <?php 
            include ("./objects/UserViewer.php");
        
             echo    '<div class = "container">
                            <div>
                                <form class = "list" onsubmit="return verifyNewAccount()" id = "newAccount" method="POST">
                                    <br><input type="text" name="email" maxlength="50" placeholder = "email" required> <br>
                                    <br> <input type="text" name="username" maxlength="50" placeholder = "username" required> <br>
			                        <br> <input type="password" name="password" maxlength="50" placeholder = "password" required> <br>
			                        <br> <input type="password" name="confirmpassword" maxlength="50" placeholder = "confirm password" required> <br>
			                        <br><button class = "button" type="submit">Create Account</button><br>
			                        <br><b id = "err" style = "color: red;">'.$_SESSION["err"].'</b>
			                    </form>
			                </div>
			            </div>';
			            
			   $_SESSION["err"] = "";
			     
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $verify = new UserViewer();   
                $verify->createAccount();
            }
            
            include("./footer.php");
        ?>
    </body>
    <script type="text/javascript" src="./vehicle-maintenance.js"></script>
</html>