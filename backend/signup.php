<?php
include './dbqutipa.php';

class UserRegistration
{
    private $conn;
    private $errors = [];
    private $image;

    public function __construct($dbServer, $dbUsername, $dbPassword, $dbDatabase)
    {
        $this->conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbDatabase);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function validateInput($data, $files)
    {
        $this->validateName($data['name']);
        $this->validateEmail($data['email']);
        $this->validatePhoneNumber($data['phone_number']);
        $this->validatePasswords($data['password'], $data['confirm_password']);
        $this->validateImage($files['image']);
    }

    private function validateName($name)
    {
        $name = trim($name);
        if (empty($name)) {
            $this->errors['name'] = 'Full Name is required.';
        } else {
            $nameParts = explode(' ', $name);
            if (count($nameParts) < 4) {
                $this->errors['name'] = 'Full Name must contain first name, middle name, last name, and family name.';
            }
        }
    }

    private function validateEmail($email)
    {
        $email = trim($email);
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email format.';
        }
    }

    private function validatePhoneNumber($phoneNumber)
    {
        $phoneNumber = trim($phoneNumber);
        if (empty($phoneNumber) || !preg_match('/^\d{10}$/', $phoneNumber)) {
            $this->errors['phone_number'] = 'Invalid mobile number. It should be 10 digits.';
        }
    }

    private function validatePasswords($password, $confirmPassword)
    {
        if (empty($password)) {
            $this->errors['password'] = 'Password is required.';
        } elseif ($password !== $confirmPassword) {
            $this->errors['confirm_password'] = 'Passwords do not match.';
        } else {
            $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
            if (!preg_match($passwordPattern, $password)) {
                $this->errors['password'] = 'Password must be at least 8 characters long, include an upper case letter, a lower case letter, a number, and a special character.';
            }
        }
    }

    private function validateImage($image)
    {
        if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($image['type'], $allowedTypes)) {
                $imageName = uniqid() . '-' . basename($image['name']);
                $uploadDir = 'img/';
                $uploadFile = $uploadDir . $imageName;

                if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    $this->image = $imageName;
                } else {
                    $this->errors['image'] = 'Failed to upload image.';
                }
            } else {
                $this->errors['image'] = 'Only JPEG, PNG, and GIF files are allowed.';
            }
        }
    }

    public function checkExistingUser($email, $phoneNumber)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR phone_number = ?");
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $email, $phoneNumber);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $this->errors['existing'] = 'Email or mobile number already exists.';
        }
    }

    public function registerUser($data)
    {
        if (empty($this->errors)) {
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone_number, image, role_id) VALUES (?, ?, ?, ?, ?, ?)");

            if (!$stmt) {
                $this->errors['db'] = 'Prepare failed: ' . $this->conn->error;
            } else {
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                $roleId = 2; // Default role_id

                // Bind parameters
                $stmt->bind_param("sssssi", $data['name'], $data['email'], $hashedPassword, $data['phone_number'], $this->image, $roleId);

                // Execute the statement
                if ($stmt->execute()) {
                    $userId = $stmt->insert_id; // Get the ID of the newly inserted user
                    $this->addToCart($userId); // Add the user to the cart

                    // Close statement and connection
                    $stmt->close();
                    $this->conn->close();

                    // Redirect to login page with success message
                    echo "
<script>
    alert('Account Created');
    window.location.href = 'http://localhost/e-commerce/backend/login.php';
</script>
";
                    exit(); // Ensure no further code is executed
                } else {
                    $this->errors['db'] = 'Error: ' . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }

        // Store errors in session to display on form page
        session_start();
        $_SESSION['errors'] = $this->errors;
        header("Location: signup.php");
        exit();
    }

    private function addToCart($userId)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id) VALUES (?)");
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            $this->errors['cart'] = 'Error adding user to cart: ' . $stmt->error;
        }

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registration = new UserRegistration(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $registration->validateInput($_POST, $_FILES);
    $registration->checkExistingUser($_POST['email'], $_POST['phone_number']);
    $registration->registerUser($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../frontend/css/login_signup.css">
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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }

        input[type="text"]:focus,
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
        <?php
        session_start();
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) :
        ?>
            <div class="error-messages">
                <?php foreach ($_SESSION['errors'] as $key => $error) : ?>
                    <div class="error-message" id="<?php echo htmlspecialchars($key); ?>Error"><?php echo htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
            </div>
        <?php
            unset($_SESSION['errors']);
        endif;

        if (isset($_GET['registration']) && $_GET['registration'] == 'success') :
        ?>
            <div class="success-message">Registration successful! You can now <a href="login.php">login here</a>.</div>
        <?php endif; ?>

        <form id="signupForm" action="./signup.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <h2>Sign Up</h2>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['name']) ? htmlspecialchars($_SESSION['errors']['name']) : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['email']) ? htmlspecialchars($_SESSION['errors']['email']) : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="phone_number">Mobile:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : ''; ?>" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['phone_number']) ? htmlspecialchars($_SESSION['errors']['phone_number']) : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['password']) ? htmlspecialchars($_SESSION['errors']['password']) : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['confirm_password']) ? htmlspecialchars($_SESSION['errors']['confirm_password']) : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" />
                <span class="error-message"><?php echo isset($_SESSION['errors']['image']) ? htmlspecialchars($_SESSION['errors']['image']) : ''; ?></span>
            </div>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>

</html>