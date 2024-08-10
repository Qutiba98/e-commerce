<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="../frontend/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
        <p>Your email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <?php if (isset($_SESSION['image']) && !empty($_SESSION['image'])): ?>
            <img src="./img/<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="User Image" width="100" height="100">
        <?php else: ?>
            <p>No image available.</p>
        <?php endif; ?>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
