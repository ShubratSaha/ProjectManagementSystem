<?php
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Company.php';

    $database = new Database();
    $db = $database->connect();

    $company = new Company($db);

    $company->id = isset($_GET['id']) ? $_GET['id'] : die();

    $company->read_single();

    $post_arr = array(
        'id' => $company->id,
        'name' => $company->name,
        'address' => $company->address,
        'email' => $company->email,
        'phone' => $company->phone
    );

    if ($company->name != null){
        echo(json_encode($post_arr));
    }
    else{
        echo(json_encode(array('message' => 'Not Found...')));
    }

?>