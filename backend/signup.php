<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../frontend/css/login signup.css">
    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('mobileError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('confirmPasswordError').textContent = '';

            const fullName = document.forms["signupForm"]["name"].value.trim();
            const nameParts = fullName.split(' ').filter(name => name.length > 0);
            const email = document.forms["signupForm"]["email"].value;
            const mobile = document.forms["signupForm"]["phone_number"].value;
            const password = document.forms["signupForm"]["password"].value;
            const confirmPassword = document.forms["signupForm"]["confirm_password"].value;

            // Full name validation
            if (nameParts.length < 4) {
                document.getElementById('nameError').textContent = 'Full Name must contain first name, middle name, last name, and family name.';
                isValid = false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                isValid = false;
            }

            // Mobile validation
            const mobilePattern = /^\d{10}$/;
            if (!mobilePattern.test(mobile)) {
                document.getElementById('mobileError').textContent = 'Mobile number must be 10 digits.';
                isValid = false;
            }

            // Password validation
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(password)) {
                document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long, include an upper case letter, a lower case letter, a number, and a special character.';
                isValid = false;
            }

            // Password match validation
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
                isValid = false;
            }

            return isValid;
        }
    </script>

    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }

        .success-message {
            color: green;
            font-size: 1.2em;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
<div class="container">
      <form
        name="signupForm"
        action="./signup.php"
        method="POST"
        enctype="multipart/form-data"
        onsubmit="return validateForm();"
      >
        <div class="form-group">
          <h2>Sign Up</h2>
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name"  />
          <span id="nameError" class="error-message"></span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email"  />
          <span id="emailError" class="error-message"></span>
        </div>
        <div class="form-group">
          <label for="phone_number">Mobile:</label>
          <input type="text" id="phone_number" name="phone_number"  />
          <span id="mobileError" class="error-message"></span>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password"  />
          <span id="passwordError" class="error-message"></span>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password:</label>
          <input
            type="password"
            id="confirm_password"
            name="confirm_password"
            required
          />
          <span id="confirmPasswordError" class="error-message"></span>
        </div>
        <div class="form-group">
          <label for="image">Upload Image:</label>
          <input type="file" id="image" name="image" accept="image/*" />
        </div>
        <button type="submit" class="btn">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
      </form>

        <div id="successMessage" class="success-message"></div>
    </div>
</body>

</html>

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
            $this->errors[] = 'Full Name is required.';
        }
    }

    private function validateEmail($email)
    {
        $email = trim($email);
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Invalid email format.';
        }
    }

    private function validatePhoneNumber($phoneNumber)
    {
        $phoneNumber = trim($phoneNumber);
        if (empty($phoneNumber) || !preg_match('/^\d{10}$/', $phoneNumber)) {
            $this->errors[] = 'Invalid mobile number. It should be 10 digits.';
        }
    }

    private function validatePasswords($password, $confirmPassword)
    {
        if (empty($password) || $password !== $confirmPassword) {
            $this->errors[] = 'Passwords do not match or are empty.';
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
                    $this->errors[] = 'Failed to upload image.';
                }
            } else {
                $this->errors[] = 'Only JPEG, PNG, and GIF files are allowed.';
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
            $this->errors[] = 'Email or mobile number already exists.';
        }
    }

    public function registerUser($data)
    {
        if (empty($this->errors)) {
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone_number, image, role_id) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $this->conn->error);
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $roleId = 2; // Default role_id

            $stmt->bind_param("sssssi", $data['name'], $data['email'], $hashedPassword, $data['phone_number'], $this->image, $roleId);

            if ($stmt->execute()) {
                $userId = $stmt->insert_id; // Get the ID of the newly inserted user
                $this->addToCart($userId); // Add the user to the cart
                echo "RS!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $this->conn->close();
        } else {
            foreach ($this->errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    private function addToCart($userId) {
        $stmt = $this->conn->prepare("INSERT INTO cart (id, user_id) VALUES (?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $id, $userId);
        
        if (!$stmt->execute()) {
            echo "Error adding user to cart: " . $stmt->error;
        }
        
        $stmt->close();
    }
   
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $registration = new UserRegistration(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // $registration = new UserRegistration($servername, $username, $password, $dbname);

    $registration->validateInput($_POST, $_FILES);
    $registration->checkExistingUser($_POST['email'], $_POST['phone_number']);
    $registration->registerUser($_POST);
}
?>