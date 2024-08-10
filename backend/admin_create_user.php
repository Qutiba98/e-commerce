<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $name_parts = explode(' ', $full_name);
    
    $first_name = $name_parts[0];
    $middle_name = $name_parts[1];
    $last_name = $name_parts[2];
    $family_name = $name_parts[3];
    
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = $_POST['role_id']; // admin can set the role
    $image = 'uploads/' . basename($_FILES['image']['name']);
    
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    $stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, family_name, email, mobile, password, role_id, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssis", $first_name, $middle_name, $last_name, $family_name, $email, $mobile, $password, $role_id, $image);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="../frontend/style.css">
    <script>
        function validateForm() {
            const fullName = document.forms["createUserForm"]["full_name"].value;
            const nameParts = fullName.split(' ');

            if (nameParts.length < 4) {
                alert("Full Name must contain first name, second name, middle name, and last name.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        
        <form name="createUserForm" action="admin_create_user.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
            <h2>Create User</h2>
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id" required>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
            </div>
            <button type="submit" class="btn">Create User</button>
        </form>
    </div>
</body>
</html>
