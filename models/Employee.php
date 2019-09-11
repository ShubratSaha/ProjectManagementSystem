<?php
    class Employee {
        //DB Stuff
        private $conn;
        private $table = 'employee';

        //Post Properties
        public $id;
        public $name;
        public $email;
        public $phone;
        public $job_title;
        public $pid;
        public $did;


        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, email = :email, phone = :phone, job_title = :job_title, pid = :pid, did = :did";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            $this->pid = htmlspecialchars(strip_tags($this->pid));
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':pid', $this->pid);
            $stmt->bindParam(':did', $this->did);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }

        public function update_strength(){
            $query = "SELECT * FROM $this->table WHERE did= :did";

            $stmt = $this->conn->prepare($query);

            $this->did = htmlspecialchars(strip_tags($this->did));

            $stmt->bindParam(':did', $this->did);

            $stmt->execute();

            $strength = $stmt->rowCount();

            $query = "UPDATE department SET strength = :strength WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':id', $this->did);
            $stmt->bindParam(':strength', $strength);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
        
        public function delete_strength(){
            $query = "SELECT strength FROM department WHERE id =:did";

            $stmt = $this->conn->prepare($query);

            $this->did = htmlspecialchars(strip_tags($this->did));

            $stmt->bindParam(':did', $this->did);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $strength = (int)$row['strength'];
            $strength -= 1;

            $query = "UPDATE department SET strength = :strength WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':id', $this->did);
            $stmt->bindParam(':strength', $strength);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }

        public function update(){
            //Create query
            $query = "UPDATE $this->table SET name = :name, email = :email, phone = :phone,  job_title = :job_title, pid = :pid, did = :did WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            $this->pid = htmlspecialchars(strip_tags($this->pid));
            $this->did = htmlspecialchars(strip_tags($this->did));

            //Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':pid', $this->pid);
            $stmt->bindParam(':did', $this->did);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            //Print error if something goes wrong
            //printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function read_single(){
            //Create query
            $query = "SELECT id, name, email, phone, job_title, pid, did FROM $this->table WHERE id = ?";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Data
            $stmt->bindParam(1, $this->id);

            //Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set Properties
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->job_title = $row['job_title'];
            $this->pid = $row['pid'];
            $this->did = $row['did'];
        }

        public function check(){
            $query = "SELECT id, name, email, phone, job_title, pid, did FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':id', $this->id);

            //Execute Query
            $stmt->execute();
            return $stmt;
        }

        public function read(){
            $query = "SELECT id, name, email, phone, job_title, pid, did FROM $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }


        public function delete(){
            //Create query
            $query = "DELETE FROM $this->table WHERE id = :id";
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':id', $this->id);
            
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