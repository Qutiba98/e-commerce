<?php
require './db.php'; // Include database connection

// Check user session and role
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar">
        <h2 style="color: white;">Admin Dashboard</h2>
        <ul>
            <li><a href="?section=products" class="<?php echo $section === 'products' ? 'active' : ''; ?>">Manage Products</a></li>
            <li><a href="?section=categories" class="<?php echo $section === 'categories' ? 'active' : ''; ?>">Manage Categories</a></li>
            <li><a href="?section=users" class="<?php echo $section === 'users' ? 'active' : ''; ?>">Manage Users</a></li>
            <li><a href="?section=viewSales" class="<?php echo $section === 'viewSales' ? 'active' : ''; ?>">View Sales</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <?php
        $section = isset($_GET['section']) ? $_GET['section'] : 'products';

        switch ($section) {
            case 'products':
                include 'manage_products.php';
                break;
            case 'categories':
                include 'manage_categories.php';
                break;
            case 'users':
                include 'manage_users.php';
                break;
            case 'viewSales':
                include 'viewOrders.php';
                break;
            default:
                include 'manage_products.php';
                break;
        }
        ?>
    </div>
</body>

</html>