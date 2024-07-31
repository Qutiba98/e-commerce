<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}
require 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $name_parts = explode(' ', $full_name);
    
    $first_name = $name_parts[0];
    $middle_name = $name_parts[1];
    $last_name = $name_parts[2];
    $family_name = $name_parts[3];
    
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $role_id = $_POST['role_id'];
    $image = $user['image'];

    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $conn->prepare("UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, family_name = ?, email = ?, mobile = ?, role_id = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssssisi", $first_name, $middle_name, $last_name, $family_name, $email, $mobile, $role_id, $image, $id);

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
    <title>Edit User</title>
    <link rel="stylesheet" href="../frontend/style.css">
    <script>
        function validateForm() {
            const fullName = document.forms["editUserForm"]["full_name"].value;
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
        
        <form name="editUserForm" action="edit_user.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
              <h2>Edit User</h2>
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['family_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id" required>
                    <option value="1" <?php if($user['role_id'] == 1) echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if($user['role_id'] == 2) echo 'selected'; ?>>User</option>
                </select>
            </div>
            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</body>
</html>
