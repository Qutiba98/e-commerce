

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

                    // Return success response
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Account created successfully.'
                    ]);
                    exit();
                } else {
                    $this->errors['db'] = 'Error: ' . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }

        // Return error response
        echo json_encode([
            'status' => 'error',
            'errors' => $this->errors
        ]);
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
        <form id="signupForm" action="./signup.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <h2>Sign Up</h2>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" />
                <span class="error-message" id="nameError"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" />
                <span class="error-message" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="phone_number">Mobile:</label>
                <input type="text" id="phone_number" name="phone_number" />
                <span class="error-message" id="phoneNumberError"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" />
                <span class="error-message" id="passwordError"></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" />
                <span class="error-message" id="confirmPasswordError"></span>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*" />
                <span class="error-message" id="imageError"></span>
            </div>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting

            // Clear previous error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('phoneNumberError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('confirmPasswordError').textContent = '';
            document.getElementById('imageError').textContent = '';

            const formData = new FormData(this);

            fetch('./signup.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Welcome!",
                        text: data.message,
                        icon: "success",
                        customClass: {
                            confirmButton: 'swal-custom-button' // Custom class for the OK button
                        }
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fix the errors and try again.",
                        customClass: {
                            confirmButton: 'swal-custom-button' // Custom class for the OK button
                        }
                    });
                    if (data.errors) {
                        if (data.errors.name) {
                            document.getElementById('nameError').textContent = data.errors.name;
                        }
                        if (data.errors.email) {
                            document.getElementById('emailError').textContent = data.errors.email;
                        }
                        if (data.errors.phone_number) {
                            document.getElementById('phoneNumberError').textContent = data.errors.phone_number;
                        }
                        if (data.errors.password) {
                            document.getElementById('passwordError').textContent = data.errors.password;
                        }
                        if (data.errors.confirm_password) {
                            document.getElementById('confirmPasswordError').textContent = data.errors.confirm_password;
                        }
                        if (data.errors.image) {
                            document.getElementById('imageError').textContent = data.errors.image;
                        }
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
