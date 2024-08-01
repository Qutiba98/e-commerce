<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';

if($_SERVER['REQUEST_METHOD'] =='GET'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $sql = "SELECT cart.user_id AS cartId,users.name AS userName,users.role_id AS userRole, cart_product.cart_id AS cartId ,product.id AS productId ,product.image AS productImage ,product.name as productName,product.description AS productDesc,product.price AS productPrice FROM cart_product 
INNER JOIN product ON product.id = cart_product.product_id
INNER JOIN cart ON cart.user_id=  cart_product.cart_id
INNER JOIN users ON users.user_id = cart.user_id
WHERE cart_product.cart_id ='$id'";
    $result = $conn->query($sql);
    $output = $result-> fetch(PDO::FETCH_ASSOC);
    echo json_encode($output ,true );

}else{
    $data = [
        'error' => 'Method Not Allowed',
        'status' => false
    ];
    echo json_encode($data , true);
}
?>