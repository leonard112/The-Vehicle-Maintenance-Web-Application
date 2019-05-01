<!DOCTYPE html>
<html lang="en-us">
    <head>
	    <title>About</title>
            <?php
                session_start();
                
                if (isset($_SESSION['user_id']))
                {
                    include ("./nav.php");
                }
                
                else
                {
                    echo    '<nav style = "text-align: center">
                                <a class = "login" href = "./index.php">
                                    <img src ="./images/vehicle-maintenance-red.png" alt = "The Vehicle Maintenance Application" style = "width: 300px">
                                </a>
                            </nav>';
                    
                    include("./site-info.php");
                }
            ?>
    </head>
    <body>
        <div class = "container">
            <h1>About</h1>
            
            <h3>Purpose/Use</h3>
            <p>The Vehicle Maintenance Application is a web app that was built for a school project; however,
            this web app is hosted at <a href = "https://vehiclemaintenanceapp.com">https://vehiclemaintenanceapp.com</a> 
            for anyone to use. This is a place where anyone can store the maintenance records for his or her vehicles.</p>
            
            <h3>How was it Built?</h3>
            <p>The Vehicle Maintenance Application was built in the Cloud9 ide using the LAMP configuration. This web app makes use of Bootstrap
            to make the pages responsive, php methods to filter user input to protect against SQL/JavaScript injection, php methods to encrypt
            passwords for additional security, JavaScript for client
            side form validation, Object Oriented Programing, Font Awesome for the "hamburger" icon, 
            and JQuery for the dropdown menu.</p>
            
            <h3>The Productin Server</h3>
            <p>The production server is hosted using Amazon Lightsail, and it it is running on a Bitnami LAMP stack server configuration.
            The production server also has an SSL certificate for additional security.</p>
            
            <h3>Important Information About Creating Accounts and Logging in</h3>
            <p>Currently the email feild will accept any correctly fomated email when creating an account. 
            It does not require a real email addess. Ideally,
            it would be nice to have it accept only real emails so that when a user forgets his or her password, he or she can
            get a replacement password via email. Currently, this web app is not able to check if an email exists, and it is uable to send
            emails, so that is why, if you do actually plan on using this web app to store your vehicle maintainance records, you must remember
            your password!</p>
        </div>
        
        <?php
            include("./footer.php");
        ?>
    </body>
</html>