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
            $this->server = "127.0.0.1";
            $this->username = "carcaral47";
            $this->password = "";
            $this->dbname = "vehiclemaintenance";
            $conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);     
    
            return $conn;
        }
        
    }
?>