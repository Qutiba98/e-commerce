<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
include('../db.php');
include("function.php");

if ($conn->connect_error) {
    die(json_encode([
        'status' => 500,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $inputData = $_POST; 
    $user_id = $_GET['user_id'] ?? null; 
    if ($user_id) {
        $updateSubject = update_user($inputData, $user_id);
        echo $updateSubject;
    } else {
        $data = [
            'status' => 400,
            'message' => 'User ID is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
    exit();
}

?>
