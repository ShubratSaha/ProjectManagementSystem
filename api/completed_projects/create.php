<?php

    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/CompletedProjects.php';

    $database = new Database();
    $db = $database->connect();

    $cp = new CompletedProjects($db);

    $data = json_decode(file_get_contents("php://input"));
    $cp->name = $data->name;
    $cp->start_date = $data->start_date;
    $cp->completion_date = $data->completion_date;
    $cp->cid = $data->cid;
    $cp->did = $data->did;

    if ($cp->create()){
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