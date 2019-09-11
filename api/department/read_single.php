<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Department.php';

    $database = new Database();
    $db = $database->connect();

    $department = new Department($db);

    $department->id = isset($_GET['id']) ? $_GET['id'] : die();

    $department->read_single();

    $post_arr = array(
        'id' => $department->id,
        'name' => $department->name,
        'strength' => $department->strength,
        'email' => $department->email
    );

    if ($department->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>