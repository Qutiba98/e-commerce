
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../frontend/style.css">
    <script>
        function validateForm() {
            const fullName = document.forms["signupForm"]["name"].value.trim();
            const nameParts = fullName.split(' ').filter(name => name.length > 0);
            const email = document.forms["signupForm"]["email"].value;
            const mobile = document.forms["signupForm"]["mobile"].value;
            const password = document.forms["signupForm"]["password"].value;
            const confirmPassword = document.forms["signupForm"]["confirm_password"].value;

            // Full name validation
            if (nameParts.length < 4) {
                alert("Full Name must contain first name, middle name, last name, and family name.");
                return false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Mobile validation
            const mobilePattern = /^\d{10}$/;
            if (!mobilePattern.test(mobile)) {
                alert("Mobile number must be 10 digits.");
                return false;
            }

            // Password validation
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, include an upper case letter, a lower case letter, a number, and a special character.");
                return false;
            }

            // Password match validation
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div class="container">
        <form name="signupForm" action="signup.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
            <div class="form-group">
                <h2>Sign Up</h2>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>

    <?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validate full name
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = 'Full Name is required.';
    }

    // Validate email
    $email = trim($_POST['email']);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate mobile number
    $phoneNumber = trim($_POST['mobile']);
    if (empty($phoneNumber) || !preg_match('/^\d{10}$/', $phoneNumber)) {
        $errors[] = 'Invalid mobile number. It should be 10 digits.';
    }

    // Validate passwords
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    if (empty($password) || $password !== $confirmPassword) {
        $errors[] = 'Passwords do not match or are empty.';
    }

    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
            $uploadDir = 'img/';
            $uploadFile = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image = $imageName;
            } else {
                $errors[] = 'Failed to upload image.';
            }
        } else {
            $errors[] = 'Only JPEG, PNG, and GIF files are allowed.';
        }
    }

    // Establish database connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email or phone number already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR phone_number = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $phoneNumber);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $errors[] = 'Email or mobile number already exists.';
    }

    // Handle errors or process the data
    if (empty($errors)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone_number, image, role_id) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Assume role_id is 1 by default
        $roleId = 2;

        // Bind parameters
        $stmt->bind_param("sssssi", $name, $email, $hashedPassword, $phoneNumber, $image, $roleId);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>

</body>
</html>
