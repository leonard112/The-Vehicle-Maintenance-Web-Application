<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Change Password</title>
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
            session_start();
        
             echo    '<div class = "container">
                            <div>
                                <form class = "list" onsubmit="return verifyPasswords()" id = "changePassword" method="POST">
                                    <br> <input type="password" name="oldpassword" maxlength="50" placeholder = "Old Password" required> <br>
			                        <br> <input type="password" name="confirmoldpassword" maxlength="50" placeholder = "Confirm Old Password" required> <br>
			                        <br> <input type="password" name="newpassword" maxlength="50" placeholder = "New Password" required> <br>
			                        <br> <input type="password" name="confirmnewpassword" maxlength="50" placeholder = "Confirm New Password" required> <br>
			                        <br><button class = "button" type="submit">Change Password</button><br>
			                        <br><a class = "link" href = "./manage-account.php">Back</a><br>
			                        <br><b id = "err" style = "color: red;">'.$_SESSION["err"].'</b>
			                    </form>
			                </div>
			            </div>';
			            
		    $_SESSION["err"] = ""; 
        
           if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $verify = new UserViewer();   
                $verify->updatePassword();
            }
            
            include("./footer.php");
        ?>
    </body>
    <script type="text/javascript" src="./vehicle-maintenance.js"></script>
</html>