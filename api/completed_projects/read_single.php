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

    $cp->id = isset($_GET['id']) ? $_GET['id'] : die();

    $cp->read_single();

    $post_arr = array(
        'id' => $cp->id,
        'name' => $cp->name,
        'start_date' => $cp->start_date,
        'completion_date' => $cp->completion_date,
        'cid' => $cp->cid,
        'did' => $cp->did
    );

    if ($cp->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>