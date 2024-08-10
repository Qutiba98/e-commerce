<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
require 'db.php';

include("function.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (empty($inputData)) {
        $inputData = $_POST;
    }

    // طباعة المدخلات للتأكد من استلام البيانات
    error_log("Input Data: " . print_r($inputData, true));

    $storeCategorie = storeCategorie($inputData);
    echo $storeCategorie;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
    exit();
}
