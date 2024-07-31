<?php
session_start();
require 'db.php';

// Initialize error variables
$emailErr = $passwordErr = $loginErr = "";
$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate email
    if (empty(trim($_POST['email']))) {
        $emailErr = "Email is required.";
    } else {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $passwordErr = "Password is required.";
    } else {
        $password = trim($_POST['password']);
    }

    // Proceed if there are no validation errors
    if (empty($emailErr) && empty($passwordErr)) {
        $stmt = $conn->prepare("SELECT user_id, name, email, password, role_id, image FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role_id'] == 1 ? 'admin' : 'user';
                $_SESSION['image'] = $user['image'];

                // Redirect based on user role
                if ($_SESSION['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: welcome.php");
                }
                exit();
            } else {
                $loginErr = "Invalid email or password.";
            }
            $stmt->close();
        } else {
            $loginErr = "Database query failed.";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../frontend/css/login signup.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <div class="form-group">
                <h2>Login</h2>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="./signup.php">Sign up here</a></p>
            <span class="error"><?php echo $loginErr; ?></span>
        </form>
    </div>
</body>
</html>
