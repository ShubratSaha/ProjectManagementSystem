<?php
    //Headers
    header('Access-Control-Allow-Origins: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Company.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog post object
    $company = new Company($db);

    //Blog Post Query
    $result = $company->read();
    //Get row count
    $num = $result->rowCount();

    //Check if any posts
    if ($num > 0){
        //Post array
        $posts_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $post_item = array(
                'id' => $id,
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
            );
            array_push($posts_arr, $post_item);
        }
        echo json_encode($posts_arr);
    } else {
        // No posts 
        echo json_encode(
            array('message' => 'No Companies')
        );
    }
?>