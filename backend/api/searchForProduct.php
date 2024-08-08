<?php 

// make for is check if is empty
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
require '../connection_db_pdo.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $search= isset($_GET['search']) ? $_GET['search']: "";
    try {
    $sql;
    if($search != ""){
        $sql = "SELECT name ,image ,description, price FROM product where product.name  LIKE '%$search%'";
    }else{
        $sql = "SELECT name ,image ,description, price FROM product ";
        
    }
    
     $stmt = $conn->query($sql);
     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

     foreach ($result as &$row) {
         if (isset($row['image'])) {
             $row['image'] = base64_encode($row['image']);
         }
     }
     $rowCount = count($result);
     if($rowCount > 0){
        $data = [
            "data" => $result,
            "rowcount" => $rowCount
         ];
     }else {
        $data = [
            "message" => "no product found",

         ];
     }
     
     echo json_encode($data , true );
    

} catch (Exception $e) {
    $data = [
        'error' => $e->getMessage(),
        'status' => 500
    ];
}
} else {
    $data = [
        'error' => "Method Not Allowed",
        'status' => 405
    ];
    echo json_encode($data);
}
?>