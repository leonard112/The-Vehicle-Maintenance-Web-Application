<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Login</title>
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
                <img src ="./images/vehicle-maintenance-red.png" alt = "The Vehicle Maintenance Application" style = "width: 300px">
            </a>
        </nav>
    </head>
    <body>

        <?php 
            include ("./objects/UserViewer.php");
        
                echo    '<div class = "container">
                            <div>
                                <form method="POST" onsubmit="return validateLogin()" id = "login" class = "list">
                                    <br><input type="text" name="usernameoremail" maxlength="50" placeholder = "username or email" required> <br>
			                        <br> <input type="password" name="password" maxlength="50" placeholder = "password" required> <br>
			                        <br><button class = "button" type="submit">Login</button><br>
			                        <br><b id = "err" style = "color: red;">'.$_SESSION["err"].'</b><br>
			                        <br><a class = "smalllink" href = "./create-account.php">Create New Account</a><br>
			                        <a class = "smalllink" href = "./about.php">About</a><br>
			                    </form>
			                </div>
			            </div>';
			            
			    $_SESSION["err"] = "";
        
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $verify = new UserViewer();   
                    $verify->verifyLogin();
                }
            include("./footer.php");
        ?>
    </body>
    <script type="text/javascript" src="./vehicle-maintenance.js"></script>
</html>