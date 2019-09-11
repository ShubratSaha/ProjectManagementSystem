<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Employee.php';

    $database = new Database();
    $db = $database->connect();

    $employee = new Employee($db);

    $employee->id = isset($_GET['id']) ? $_GET['id'] : die();

    $employee->read_single();

    $post_arr = array(
        'id' => $employee->id,
        'name' => $employee->name,
        'email' => $employee->email,
        'phone' => $employee->phone,
        'job_title' => $employee->job_title,
        'pid' => $employee->pid,
        'did' => $employee->did
    );

    if ($employee->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>