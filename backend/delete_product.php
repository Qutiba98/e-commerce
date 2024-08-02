<?php
require './db.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM product WHERE id='$id'";

        if (mysqli_query($conn, $query)) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "No ID provided";
    }
}
