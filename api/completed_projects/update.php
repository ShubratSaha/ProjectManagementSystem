<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/CompletedProjects.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $cp = new CompletedProjects($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $cp->id = $data->id;
    $cp->name = $data->name;
    $cp->start_date = $data->start_date;
    $cp->completion_date = $data->completion_date;
    $cp->cid = $data->cid;
    $cp->did = $data->did;

    $result = $cp->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($cp->update()){
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