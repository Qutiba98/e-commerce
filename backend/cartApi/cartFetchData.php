<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';

if($_SERVER['REQUEST_METHOD'] =='GET'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $sql = "SELECT cart_product.cart_id , cart_product.product_id as productId , product.name , product.image,product.description,product.price , product.categories_id ,users.user_id  , cart_product.quantity FROM cart_product 
INNER JOIN product ON product.id = cart_product.product_id
INNER JOIN cart ON cart.id = cart_product.cart_id
INNER JOIN users on users.user_id = cart.user_id
WHERE cart.user_id ='$id'";
    $result = $conn->query($sql);
    $output = $result-> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($output ,true );
}else{
    $data = [
        'error' => 'Method Not Allowed',
        'status' => false
    ];
    echo json_encode($data , true);
}
?>
