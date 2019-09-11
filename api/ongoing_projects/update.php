<?php

    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/OngoingProjects.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $op = new OngoingProjects($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    $op->id = $data->id;
    $op->name = $data->name;
    $op->start_date = $data->start_date;
    $op->deadline = $data->deadline;
    $op->cid = $data->cid;
    $op->did = $data->did;

    $result = $op->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        // Update Post
        if ($op->update()){
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