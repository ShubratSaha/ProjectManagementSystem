<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/OngoingProjects.php';

    $database = new Database();
    $db = $database->connect();

    $op = new OngoingProjects($db);

    $op->id = isset($_GET['id']) ? $_GET['id'] : die();

    $op->read_single();

    $post_arr = array(
        'id' => $op->id,
        'name' => $op->name,
        'start_date' => $op->start_date,
        'deadline' => $op->deadline,
        'cid' => $op->cid,
        'did' => $op->did
    );

    if ($op->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>