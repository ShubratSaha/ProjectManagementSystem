<?php
    class Company {
        //DB Stuff
        private $conn;
        private $table = 'company';

        //Post Properties
        public $id;
        public $name;
        public $address;
        public $phone;
        public $email;


        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        public function create(){
            //Create query
            $query = "INSERT INTO $this->table SET id = NULL, name = :name, address = :address, phone = :phone, email = :email";
           
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));

            //Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            return false;
        }
        
        public function update(){
            //Create query
            $query = "UPDATE $this->table SET name = :name, address = :address, email = :email, phone = :phone WHERE id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));

            //Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':email', $this->email);

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
            $query = "SELECT id, name, address, phone, email FROM $this->table WHERE id = ?";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Data
            $stmt->bindParam(1, $this->id);

            //Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set Properties
            $this->name = $row['name'];
            $this->address = $row['address'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
        }

        public function check(){
            $query = "SELECT id, name, address, phone, email FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':id', $this->id);

            //Execute Query
            $stmt->execute();
            return $stmt;
        }

        public function read(){
            $query = "SELECT id, name, address, phone, email FROM $this->table";
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