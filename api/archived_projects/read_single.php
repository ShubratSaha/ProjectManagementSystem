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

    $ap->id = isset($_GET['id']) ? $_GET['id'] : die();

    $ap->read_single();

    $post_arr = array(
        'id' => $ap->id,
        'name' => $ap->name,
        'start_date' => $ap->start_date,
        'completion_date' => $ap->completion_date,
        'achievement' => $ap->achievement,
        'cid' => $ap->cid,
        'did' => $ap->did
    );

    if ($ap->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>