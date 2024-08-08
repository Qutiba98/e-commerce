<?php
session_start();
require './dbqutipa.php';  // استيراد ملف التكوين

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserByEmail($email)
    {
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

class Auth
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function validateInput($data)
    {
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

    public function login($email, $password)
    {
        $user = $this->user->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role_id'] == 1 ? 'admin' : 'user';
            $_SESSION['image'] = $user['image'];

            return [
                'status' => 'success',
                'message' => 'Login successful',
                'role' => $_SESSION['role']
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ];
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
        $response = $auth->login($email, $password);
        echo json_encode($response);
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Validation errors',
            'emailErr' => $emailErr,
            'passwordErr' => $passwordErr
        ]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../frontend/css/login_signup.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            box-sizing: border-box;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            display: block;
        }

        .success-message {
            color: #28a745;
            font-size: 1em;
            text-align: center;
            margin-top: 20px;
        }

        button[type="submit"] {
            background: #d10024;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background: gray;
        }

        p {
            text-align: center;
        }

        a {
            color: #d10024;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="loginForm">
            <div class="form-group">
                <h2>Login</h2>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <span class="error-message" id="emailErr"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="error-message" id="passwordErr"></span>
            </div>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="./signup.php">Sign up here</a></p>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Clear previous error messages
            document.getElementById('emailErr').textContent = '';
            document.getElementById('passwordErr').textContent = '';

            if (!email || !password) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter both email and password.",
                    customClass: {
                        confirmButton: 'swal-custom-button' // Custom class for the OK button
                    }
                });
            } else {
                const formData = new FormData();
                formData.append('email', email);
                formData.append('password', password);

                fetch('login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: "Welcome!",
                            text: "Login successful",
                            icon: "success",
                            customClass: {
                                confirmButton: 'swal-custom-button' // Custom class for the OK button
                            }
                        }).then(() => {
                            window.location.href = data.role === 'admin' ? 'admin.php' : 'index.php';
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.message,
                            customClass: {
                                confirmButton: 'swal-custom-button' // Custom class for the OK button
                            }
                        });
                        if (data.emailErr) {
                            document.getElementById('emailErr').textContent = data.emailErr;
                        }
                        if (data.passwordErr) {
                            document.getElementById('passwordErr').textContent = data.passwordErr;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>

</html>


