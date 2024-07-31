<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

$id = $_GET['id'];

if ($conn->query("DELETE FROM users WHERE id = $id") === TRUE) {
    header("Location: admin_dashboard.php");
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
