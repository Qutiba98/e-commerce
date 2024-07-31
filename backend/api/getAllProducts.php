<?php 


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $sql = 'SELECT * FROM product';
    // $sql = 'SELECT name,description,price  FROM product';
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    foreach ($result as &$row) {
        if (isset($row['image'])) {
            $row['image'] = base64_encode($row['image']);
        }
    }
    echo json_encode($result , true );
} else {
    $data = [
        'error' => "Method Not Allowed",
        'status' => 405
    ];
    echo json_encode($data);
}

?>