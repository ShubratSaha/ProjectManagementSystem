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

    $cp->id = $data->id;

    $result = $cp->check();
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        if ($cp->delete()){
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