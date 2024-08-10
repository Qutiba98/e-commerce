<?php
require './db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    echo json_encode($user);
}
?>