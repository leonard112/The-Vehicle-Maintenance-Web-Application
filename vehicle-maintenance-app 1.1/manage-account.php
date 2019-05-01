<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Manage Account</title>
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
        <div class = "container">
            <?php
                echo    '<h1 style = "text-align: center">Manage Account</h1>
                        <div class = "vehiclehead">
                                <div class = "col-md-6 centerdata">Username: '.$_SESSION["username"].'</div>
                                <div class = "col-md-6 centerdata">Email: '.$_SESSION["email"].'</div>
			            </div>';
            ?>
            <div class = "row list" style = "margin-top: 160px">
                <div class = "col-md-4 centerdata"><a class = "link" href = "./change-password.php">Change Password</a></div>
                <div class = "col-md-4 centerdata"><a class = "link" href = "./delete-account-confirm.php">Delete Account</a></div>
                <div class = "col-md-4 centerdata"><a class = "link" href = "./vehicles.php">Back</a></div>
            </div>
        </div>
        <?php
            include("./footer.php");
        ?>
    </body>
</html>
