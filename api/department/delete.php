<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Department.php';

    $database = new Database();
    $db = $database->connect();

    $department = new Department($db);

    $data = json_decode(file_get_contents("php://input"));

    $department->id = $data->id;

    $result = $department->check();
    $num = $result->rowCount();

    if ($num > 0){
        if ($department->delete()){
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
            array('message' => 'Such Department does not exist...')
        );
    }


?>