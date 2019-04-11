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
                    header("Location: index.php");
                }
            ?>
    </head>
    <body>
        <div class = "container">
            <p class = "list" style = "margin-top: 160px">
                <a class = "link" href = "./change-password.php">Change Password</a><br>
                <br><a class = "link" href = "./delete-account-confirm.php">Delete Account</a>
            </p>
        </div>
        <?php
            include("./footer.php");
        ?>
    </body>
</html>
