<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Department.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $department = new Department($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $department->id = $data->id;
    $department->name = $data->name;
    $department->strength = $data->strength;
    $department->email = $data->email;

    $result = $department->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($department->update()){
            echo json_encode(
                array('message' => 'Updated')
            );
        }
        else{
            echo json_encode(
                array('message' => 'Not Updated')
            );
        }
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Such Department does not exist...')
        );
    }
    
?>