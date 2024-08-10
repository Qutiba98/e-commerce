<?php
session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.html");
//     exit();
// }
require 'db.php';
$users = $conn->query("SELECT * FROM users");
var_dump($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="logout.php" class="btn">Logout</a>
        <a href="admin_create_user.php" class="btn">Create New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="./images/<?php echo $row['image']; ?>" alt="User Image" width="50" height="50" /></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
