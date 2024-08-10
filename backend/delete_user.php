<?php
require './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM users WHERE user_id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
