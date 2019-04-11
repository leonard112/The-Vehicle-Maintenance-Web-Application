<?php
    include("./objects/DBConnect.php");
    
    class UserViewer
    {
        //check if the username or email and the passoword inputed is valid.
        public function verifyLogin()
        {
            session_start();
            
            $usernameOrEmail = filter_var($_POST['usernameoremail'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            $query = "SELECT * FROM USER WHERE username = '".$usernameOrEmail."' AND password ='".$password."' AND status = '1'";
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
            
                if ($data["username"] == $usernameOrEmail and $data["password"] == $password) //if username and password.
                {
                    $_SESSION['email'] = $data["email"];
                    $_SESSION['user_id'] = $data["user_id"];
                    $_SESSION['username'] = $data["username"];
                    $_SESSION['password'] = $data["password"];
                    
                    header("Location: ./vehicles.php");
                }
                
                else
                {
                    $query = "SELECT * FROM USER WHERE email = '".$usernameOrEmail."' AND password ='".$password."' AND status = '1'";
                
                    $result = mysqli_query($conn,$query);
                    
                    if ($result)
                    {
                        $data = mysqli_fetch_assoc($result);
                
                        if ($data["email"] == $usernameOrEmail and $data["password"] == $password) //if email and password.
                        {
                            $_SESSION['email'] = $data["email"];
                            $_SESSION['user_id'] = $data["user_id"];
                            $_SESSION['username'] = $data["username"];
                            $_SESSION['password'] = $data["password"];
                    
                            header("Location: ./vehicles.php");
                        }
                        else
                        {
                            $_SESSION["err"] = "Invalid login information.";
                            header("Location: ./index.php");
                        }
                    }
                    
                    else
                    {
                        $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                        header("Location: ./index.php");
                    }
                }
            }
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./index.php");
            }
            
        }
        
        //Create a new account.
        public function createAccount()
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['email'] != filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) || 
                $_POST['username'] != filter_var($_POST['username'], FILTER_SANITIZE_STRING) ||
                $_POST['password'] != filter_var($_POST['password'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header("Location: ./create-account.php");
            }
            
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            
            //check to see if username already exists.
            $query = "SELECT email FROM USER WHERE email = '".$email."' AND status = '1'";
            
            $result = mysqli_query($conn,$query);
            
            if ($result)
            {
                $data = mysqli_fetch_assoc($result);
                
                if ($data["email"] == $email) //if email is already taken.
                {
                    $_SESSION["err"] = "The email \"".$email."\" is already taken";
                    header("Location: ./create-account.php");
                }
                
                else
                {
                    $query = "SELECT username FROM USER WHERE username = '".$username."' AND status = '1'";
                
                    $result = mysqli_query($conn,$query);
                    
                    if ($result)
                    {
                        $data = mysqli_fetch_assoc($result);
                    
                        if ($data["username"] == $username) //if username is already taken.
                        {
                            $_SESSION["err"] = "The username \"".$username."\" is already taken";
                            header("Location: ./create-account.php");
                        }
                
                        else //insert new account into table.
                        {
                            $insert = 'INSERT INTO USER (username, password, email, status)
                                        VALUES ("'.$username.'", "'.$password.'", "'.$email.'", "1")';
                
                            if ($conn->query($insert) === TRUE) 
                            { 
                                //get all values associated with the new account and set session vars.
                                $query = "SELECT * FROM USER WHERE username = '".$username."' AND password ='".$password."' AND status = '1'";
                
                                $result = mysqli_query($conn,$query);
                
                                $data = mysqli_fetch_assoc($result);
                
                                $_SESSION['email'] = $data["email"];
                                $_SESSION['user_id'] = $data["user_id"];
                                $_SESSION['username'] = $data["username"];
                                $_SESSION['password'] = $data["password"];
                                $_SESSION["err"] = "";
                
                                header("Location: ./vehicles.php");
                            }
                        }
                    }
                    else
                    {
                        $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                        header("Location: ./create-account.php");
                    }
                }
            }
            
            else
            {
                $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                header("Location: ./create-account.php");
            }
        }
        
        //Change the password to a new password specified by the user.
        public function updatePassword()
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['newpassword'] != filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING) ||
                $_POST['oldpassword'] != filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header("Location: ./change-passowrd.php");
            }
            
            $newPassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
            $oldPassword = filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING);
            $userid = $_SESSION['user_id'];
            
            if ($oldPassword == $_SESSION['password']) //if old password matches.
            {
                $update = 'UPDATE USER SET password = "'.$newPassword.'" WHERE user_id = "'.$_SESSION['user_id'].'"';
                
                if ($conn->query($update) === TRUE) 
                { 
                    $_SESSION['password'] = $newPassword;
                
                    header("Location: ./vehicles.php");
                }
                else
                {
                    $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                    header("Location: ./change-password.php");
                }
            }
            else
            {
                $_SESSION["err"] = "The old password you entered was incorrect.";
                header("Location: ./change-password.php");
            }
        }
        
        //delete the account.
        public function deleteAccount()
        {
            session_start();
            
            $conn = new DBConnect();
            $conn = $conn->connect();
            
            if ($_POST['password'] != filter_var($_POST['password'], FILTER_SANITIZE_STRING))
            {
                $_SESSION["err"] = "Error! Potentially harmful text was found in your input.";
                header("Location: ./delete-account.php");
            }
            
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $userid = $_SESSION['user_id'];
            
            if ($password == $_SESSION['password']) //if old password matches.
            {
                $delete = 'UPDATE USER SET status = "0" WHERE user_id = "'.$_SESSION['user_id'].'"';
                
                if ($conn->query($delete) === TRUE) 
                { 
                    session_unset();
                    session_destroy();
                    header("Location: ./index.php");
                }
                
                else
                {
                    $_SESSION["err"] = "Error! Something went wrong when connecting to the database.";
                    header("Location: ./delete-account.php");
                }
            }
            else
            {
                $_SESSION["err"] = "The password you entered was incorrect.";
                header("Location: ./delete-account.php");
            }
        }
    }
?>