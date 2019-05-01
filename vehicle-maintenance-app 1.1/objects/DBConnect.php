<?php
    class DBConnect 
    {
        
        private $server;
        private $username;
        private $password;
        private $dbname;
        
        //connect to database
        function connect()
        {
            $this->server = "localhost:3306";
            $this->username = "root";
            $this->password = "Z4RXq8RUaU83";
            $this->dbname = "vehiclemaintenance";
            $conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);     
    
            return $conn;
        }
        
    }
?>