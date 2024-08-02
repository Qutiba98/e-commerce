<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include("function.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    // الحصول على رقم الصفحة من المعلمات في URL، افتراضياً 1 إذا لم يتم تحديده
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    // عدد العناصر لكل صفحة
    $items_per_page = 9;
    
    // جلب قائمة المنتجات مع التصفح
    $phones_list = getProductList_pagination($page, $items_per_page);
    echo $phones_list;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>