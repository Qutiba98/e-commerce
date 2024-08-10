<?php
require 'C:\xampp\htdocs\e-commerce\backend\db.php';
global $conn;

// استعلام لجلب البيانات للمبيعات حسب التاريخ
$salesQuery = "SELECT payment_date, SUM(amount) as total_sales FROM payment_recipe GROUP BY payment_date";
$salesResult = $conn->query($salesQuery);

// تحضير البيانات للعرض في الـ Chart.js
$dates = [];
$sales = [];

while($row = $salesResult->fetch_assoc()) {
    $dates[] = $row['payment_date'];
    $sales[] = $row['total_sales'];
}

// تحويل البيانات إلى JSON
echo json_encode(['dates' => $dates, 'sales' => $sales]);
?>
