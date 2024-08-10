<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';

if($_SERVER['REQUEST_METHOD'] =='GET'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
$sql = "SELECT product.*, comments.comment_text FROM product
        LEFT JOIN comments ON comments.product_id = product.id
        WHERE product.id = '$id'";

$result = $conn->query($sql);
$output = [];
$comments = [];

foreach ($result as $row) {
    if (empty($output)) {
        $output = [
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'comments' => []
        ];
    }
    if ($row['comment_text']) {
        $comments[] = $row['comment_text'];
    }
}

$output['comments'] = $comments;

echo json_encode($output, true);

}else{
    $data = [
        'error' => 'Method Not Allowed',
        'status' => false
    ];
    echo json_encode($data , true);
}
?>
