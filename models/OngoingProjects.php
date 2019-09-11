<?php
    class OngoingProjects {
        //DB Stuff
        private $conn;
        private $table = 'ongoing_projects';

        //Post Properties
        public $id;
        public $name;
        public $start_date;
        public $deadline;
        public $cid;
        public $did;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, start_date = :start_date, deadline = :deadline, cid = :cid, did = :did";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->start_date = htmlspecialchars(strip_tags($this->start_date));
            $this->deadline = htmlspecialchars(strip_tags($this->deadline));
            $this->cid = htmlspecialchars(strip_tags($this->cid));
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':start_date', $this->start_date);
            $stmt->bindParam(':deadline', $this->deadline);
            $stmt->bindParam(':cid', $this->cid);
            $stmt->bindParam(':did', $this->did);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
        
        public function check(){
            $query = "SELECT id, name, start_date, deadline, cid, did FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':id', $this->id);

            //Execute Query
            $stmt->execute();
            return $stmt;
        }

        public function update(){
            //Create query
            $query = "UPDATE $this->table SET name = :name, start_date = :start_date, deadline = :deadline, cid = :cid, did = :did WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->start_date = htmlspecialchars(strip_tags($this->start_date));
            $this->deadline = htmlspecialchars(strip_tags($this->deadline));
            $this->cid = htmlspecialchars(strip_tags($this->cid));
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':start_date', $this->start_date);
            $stmt->bindParam(':deadline', $this->deadline);
            $stmt->bindParam(':cid', $this->cid);
            $stmt->bindParam(':did', $this->did);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }

        public function read_single(){
            //Create query
            $query = "SELECT id, name, start_date, deadline, cid, did FROM $this->table WHERE id = ?";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Data
            $stmt->bindParam(1, $this->id);

            //Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set Properties
            $this->name = $row['name'];
            $this->start_date = $row['start_date'];
            $this->deadline = $row['deadline'];
            $this->cid = $row['cid'];
            $this->did = $row['did'];
        }

        public function read(){
            $query = "SELECT id, name, start_date, deadline, cid, did FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function delete(){
            //Create query
            $query = "DELETE FROM $this->table WHERE id = ?";
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Data
            $stmt->bindParam(1, $this->id);
            
            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            //printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>