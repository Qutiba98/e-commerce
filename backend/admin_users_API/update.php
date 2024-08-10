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
        $response = json_decode($updateSubject, true);
        
        if ($response['status'] == 200) {
            session_start();
            $_SESSION['success_message'] = "User updated successfully";
            header("Location:http://localhost:8080/project_php/e-commerce/frontend/admin-dasboard/static/pages-manage-users.php");
            exit(); // إنهاء تنفيذ الكود بعد إعادة التوجيه
        } else {
            echo $updateSubject; 
            exit(); // إنهاء تنفيذ الكود في حالة حدوث خطأ
        }
    } else {
        $data = [
            'status' => 400,
            'message' => 'User ID is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
        exit(); // إنهاء تنفيذ الكود بعد عرض الرسالة
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
    exit(); // إنهاء تنفيذ الكود بعد عرض الرسالة
}
?>
