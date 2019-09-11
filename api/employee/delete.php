<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';

    $database = new Database();
    $db = $database->connect();

    $employee = new Employee($db);

    $data = json_decode(file_get_contents("php://input"));

    $employee->id = $data->id;

    $result = $employee->check();
    $num = $result->rowCount();

    $row = $result->fetch(PDO::FETCH_ASSOC);
    $employee->did = $row['did'];

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($employee->delete()){
            $employee->update_strength();
            echo json_encode(
                array('message' => 'Deleted')
            );
        }
        else{
            echo json_encode(
                array('message' => 'Not Deleted')
            );
        }
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Such Employee does not exist...')
        );
    }

    

?>