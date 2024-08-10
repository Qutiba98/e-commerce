<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';
if ($_SERVER['REQUEST_METHOD'] == "POST"){


    $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : "";
    $productId = isset($_POST['productId']) ? $_POST['productId'] : "";


    $sql = "INSERT INTO `cart_product (`cart_id`, `product_id`) VALUES ('$cartId', '$productId');";
    $res = $conn -> exec($sql); 
    // $data = [
    //     "studentId" => $studentId,
    //     'subjectId'=> $subjectId,
    //     'message' => ' data added successfully'
    // ];

    echo json_encode($data , true);
}else{
    $data = [
        'error' => 'Method Not Allowed',
        'status' => false
    ];
    echo json_encode($data , true);
}
?>