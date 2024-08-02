<?php
session_start();
require './dbqutipa.php';  // استيراد ملف التكوين

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT user_id, name, email, password, role_id, image FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();
            return $user;
        }
        return null;
    }
}

class Auth {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function validateInput($data) {
        $errors = ['emailErr' => '', 'passwordErr' => ''];

        if (empty(trim($data['email']))) {
            $errors['emailErr'] = "Email is required.";
        } else {
            $email = trim($data['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['emailErr'] = "Invalid email format.";
            }
        }

        if (empty(trim($data['password']))) {
            $errors['passwordErr'] = "Password is required.";
        }

        return $errors;
    }

    public function login($email, $password) {
        $user = $this->user->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role_id'] == 1 ? 'admin' : 'user';
            $_SESSION['image'] = $user['image'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: ./admin.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            return "Invalid email or password.";
        }
    }
}

$db = (new Database())->getConnection();
$user = new User($db);
$auth = new Auth($user);

$emailErr = $passwordErr = $loginErr = "";
$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = $auth->validateInput($_POST);
    $emailErr = $errors['emailErr'];
    $passwordErr = $errors['passwordErr'];

    if (empty($emailErr) && empty($passwordErr)) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $loginErr = $auth->login($email, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../frontend/css/login signup.css">
    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        function validateForm() {
            let email = document.getElementById('email').value.trim();
            let password = document.getElementById('password').value.trim();
            let emailErr = "";
            let passwordErr = "";
            let valid = true;

            if (email === "") {
                emailErr = "Email is required.";
                valid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                emailErr = "Invalid email format.";
                valid = false;
            }

            if (password === "") {
                passwordErr = "Password is required.";
                valid = false;
            }

            document.getElementById('emailErr').innerText = emailErr;
            document.getElementById('passwordErr').innerText = passwordErr;

            return valid;
        }
    </script>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <h2>Login</h2>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error" id="emailErr"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="error" id="passwordErr"><?php echo $passwordErr; ?></span>
            </div>
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="./signup.php">Sign up here</a></p>
            <span class="error"><?php echo $loginErr; ?></span>
        </form>
    </div>
</body>
</html>
