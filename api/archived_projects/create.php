<?php

    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/ArchivedProjects.php';

    $database = new Database();
    $db = $database->connect();

    $ap = new ArchivedProjects($db);

    $data = json_decode(file_get_contents("php://input"));
    $ap->name = $data->name;
    $ap->start_date = $data->start_date;
    $ap->completion_date = $data->completion_date;
    $ap->achievement = $data->achievement;
    $ap->cid = $data->cid;
    $ap->did = $data->did;

    if ($ap->create()){
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