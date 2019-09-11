<?php

    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Company.php';

    $database = new Database();
    $db = $database->connect();

    $company = new Company($db);

    $data = json_decode(file_get_contents("php://input"));
    $company->name = $data->name;
    $company->address = $data->address;
    $company->phone = $data->phone;
    $company->email = $data->email;

    if ($company->create()){
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