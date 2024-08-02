<?php
require './db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);
    echo json_encode($category);
}
