<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $employee = new Employee($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $employee->id = $data->id;
    $employee->name = $data->name;
    $employee->email = $data->email;
    $employee->phone = $data->phone;
    $employee->job_title = $data->job_title;
    $employee->pid = $data->pid;
    $employee->did = $data->did;

    $result = $employee->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($employee->update()){
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
            array('message' => 'Such Employee does not exist...')
        );
    }
    
?>