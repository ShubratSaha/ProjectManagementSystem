<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Company.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $company = new Company($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $company->id = $data->id;
    $company->name = $data->name;
    $company->address = $data->address;
    $company->phone = $data->phone;
    $company->email = $data->email;

    $result = $company->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($company->update()){
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
            array('message' => 'Such Company does not exist...')
        );
    }
    
?>