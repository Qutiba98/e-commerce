<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    header("location:http://127.0.0.1/brief%203/e-commerce/backend/login.php");
    echo "No ID provided!";
    exit;
}

$id = intval($_GET['user_id']);

$sql = "SELECT * FROM users WHERE user_id = $id";
$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit;
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No record found";
    exit;
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqk1wZ0/b3cY/ALsHYahzWj+nH2m0lQRMQ+iuMvi/+2Q277Fv3qSnowp+t0mHTtQ8Zz57cQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="veiw.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Profile Information</h2>
            <!-- Button added here -->
        </div>

        <div class="profile-container">
            <div class="profile-image">
                <img src="https://th.bing.com/th/id/OIP.Z306v3XdxhOaxBFGfHku7wHaHw?rs=1&pid=ImgDetMain"
                    alt="Profile Picture">
            </div>
            <div class="profile-details">
                <h5 class="profile-name">Name: <?php echo htmlspecialchars($row['name']); ?></h5><br>
                <h5 class="profile-email">Email: <?php echo htmlspecialchars($row['email']); ?></h5><br>
                <h5 class="profile-phone_number">Phone Number: <?php echo htmlspecialchars($row['phone_number']); ?></h5><br>
            </div>
        </div>
        <a href="./edit.php?user_id=<?php echo $id?>" class="btn btn-danger">Update My Profile</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

