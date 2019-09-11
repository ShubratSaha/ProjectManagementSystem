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

    $op->id = $data->id;

    $result = $op->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        if ($op->delete()){
            echo json_encode(
                array('message' => 'Deleted')
            );
        }
        else{
            echo json_encode(
                array('message' => 'Not Deleted')
            );
        }
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'Such Project does not exist...')
        );
    }
?>