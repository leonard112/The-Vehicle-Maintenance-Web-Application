<!DOCTYPE html>
<html lang="en-us">

    <head>
	    <title>Delete Account?</title>
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
            include ("./objects/UserViewer.php");
        
             echo    '<div class = "container">
                            <div class = "list" style = "margin-top: 160px">
                                <h3>Are you sure you want to delete your account?</h3><br>
                                <br><a class = "link" href = "./delete-account.php">Yes</a>
                                <a class = "link" href = "./manage-account.php">No</a>
                                
			                </div>
			            </div>';
		    include("./footer.php");
        ?>
    </body>
</html>