<?php

    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/OngoingProjects.php';

    $database = new Database();
    $db = $database->connect();

    $op = new OngoingProjects($db);

    $data = json_decode(file_get_contents("php://input"));
    $op->name = $data->name;
    $op->start_date = $data->start_date;
    $op->deadline = $data->deadline;
    $op->cid = $data->cid;
    $op->did = $data->did;

    if ($op->create()){
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