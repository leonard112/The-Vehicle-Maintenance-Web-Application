<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Delete Account</title>
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
            include ("./objects/UserViewer.php");
        
             echo    '<div class = "container">
                            <div>
                                <form class = "list" onsubmit="return verifyOnePassword()" id = "deleteAccount" method="POST">
                                    <br> <input type="password" name="password" maxlength="50" placeholder = "Password" required> <br>
			                        <br> <input type="password" name="confirmpassword" maxlength="50" placeholder = "Confirm Password" required> <br>
			                        <br><button class = "button" type="submit">Delete Account</button><br>
			                        <br><a class = "link" href = "./manage-account.php">Back</a><br>
			                        <br><b id = "err" style = "color: red;">'.$_SESSION["err"].'</b>
			                    </form>
			                </div>
			            </div>';
			  
			  $_SESSION["err"] = "";   
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $delete = new UserViewer();   
                $delete->deleteAccount();
            }
            
            include("./footer.php");
        ?>
    </body>
    <script type="text/javascript" src="./vehicle-maintenance.js"></script>
</html>