<?php 


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = isset($_GET['id']) ? $_GET['id'] :"";
    $sql = "SELECT product.name as productName,product.image,product.description, product.price, categories.name as categoryName
FROM product 
INNER JOIN categories on categories.id = product.categories_id
WHERE product.categories_id = '$id' ";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$row) {
        if (isset($row['image'])) {
            $row['image'] = base64_encode($row['image']);
        }
    }
    // var_dump($result);
    echo json_encode($result , true );
} else {
    $data = [
        'error' => "Method Not Allowed",
        'status' => 405
    ];
    echo json_encode($data);
}

?>