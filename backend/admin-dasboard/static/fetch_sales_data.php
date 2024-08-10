<?php
					require'db.php';
global $conn;

$salesQuery = "SELECT payment_date, SUM(amount) as total_sales FROM payment_recipe GROUP BY payment_date";
$salesResult = $conn->query($salesQuery);

$dates = [];
$sales = [];

while($row = $salesResult->fetch_assoc()) {
    $dates[] = $row['payment_date'];
    $sales[] = $row['total_sales'];
}

echo json_encode(['dates' => $dates, 'sales' => $sales]);
?>
