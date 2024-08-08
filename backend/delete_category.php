<?php
require './db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM categories WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "Category deleted successfully";
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
}
