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
    $employee->name = $data->name;
    $employee->email = $data->email;
    $employee->phone = $data->phone;
    $employee->job_title = $data->job_title;
    $employee->pid = $data->pid;
    $employee->did = $data->did;

    if ($employee->create()){
        $employee->update_strength();
        echo json_encode(
            array('message' => 'Created')
        );
    }
    else{
        echo json_encode(
            array('message' => 'Not Able to Create')
        );
    }

?>