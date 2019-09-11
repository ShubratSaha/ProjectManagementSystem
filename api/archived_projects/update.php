<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/ArchivedProjects.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $ap = new ArchivedProjects($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $ap->id = $data->id;
    $ap->name = $data->name;
    $ap->start_date = $data->start_date;
    $ap->completion_date = $data->completion_date;
    $ap->achievement = $data->achievement;
    $ap->cid = $data->cid;
    $ap->did = $data->did;

    $result = $ap->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($ap->update()){
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
            array('message' => 'Such Project does not exist...')
        );
    }
    
?>