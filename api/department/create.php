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
    $department->name = $data->name;
    $department->email = $data->email;
    $department->strength = $data->strength;

    if ($department->create()){
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