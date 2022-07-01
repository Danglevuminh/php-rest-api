<?php
//Establish connection to the MySQL databse
    class Database{

        //Variable declaration
        private $host = 'localhost';

        //name of database
        private $db_name = 'myblog';

        //database username
        private $username = 'root';
        //password of the roots database
        private $password = "nature";
        private $conn;

        //Connection to database
        //The PHP Data Objects (PDO) extension defines a lightweight, consistent interface for accessing databases in PHP.
        public function connect(){
            $this->conn=null;

            //Creating a new PDO object and passing the stuffs that's needed
            //this try-catch block checks if the a connection can be established to the database
            try{
                //database type, host, database name
                //database username, password to access database
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,
                $this->username, $this->password); 
                //sets the attribute of the PDO object to error reporting mode, which will throw exceptions if there is
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOexception $e){ //catches an error raised by PDO
                echo 'Connection Error: '.$e->getMessage();
            }
            
            //end of function - return value of conn back to the value of the calling object
            return $this->conn;
        }
    }