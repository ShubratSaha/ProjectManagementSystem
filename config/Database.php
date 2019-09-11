<?php
    class Database{
        //DB Parameters
        private $host = "localhost";
        private $db_name = "project_mgmt_system";
        private $username = "root";
        private $password = "serverdb";
        private $conn;
        
        //DB Connect
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            } catch(Exception $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>