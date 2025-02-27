<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = '';
$errorMessage = '';
$userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$name = $email = $phone_number = '';


if ($userId > 0) {

    $stmt = $conn->prepare("SELECT `name`, `email`, `phone_number`,`image` FROM `users` WHERE `user_id`=? LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone_number, $image);
    $stmt->fetch();
    $stmt->close();
}

if (isset($_POST["submit"])) {
    $userId = intval($_POST["user_id"]);
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $name = $_POST['name'] ?? '';

    if (empty($name) || empty($email) || empty($phone_number)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("UPDATE `users` SET `name`=?, `email`=?, `phone_number`=? WHERE `user_id`=?");
        $stmt->bind_param("sssi", $name, $email, $phone_number, $userId);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $successMessage = "Data updated successfully";
            } else {
                $errorMessage = "No data updated. Please check if the user ID is correct.";
            }
        } else {
            $errorMessage = "Failed: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="edit.css">
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <?php if ($successMessage): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="http://localhost/e-commerce/backend/img/<?php echo htmlspecialchars($image); ?>">
                    <span class="font-weight-bold"><?php echo htmlspecialchars($name); ?></span>
                    <span class="text-black-50"><?php echo htmlspecialchars($email); ?></span>
                </div>
            </div>
            <div class="col-md-9 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form action="http://localhost/e-commerce/backend/users_API/updateProfile.php?id=<?php echo htmlspecialchars($userId); ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($userId); ?>">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo htmlspecialchars($phone_number); ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <a class="btn btn-secondary profile-button" style="  width: 17%;   border-radius: 8px;

  height:6vh;" href="./veiw.php?user_id=<?php echo htmlspecialchars($userId); ?>">Cancel</a>
  <button type="submit" class="btn btn-secondary profile-button"  style="  width: 17%;   border-radius: 8px;

height:6vh;">Save Changes</button>
                            <!-- <a class="btn btn-secondary profile-button" style="  width: 17%;  border-radius: 8px;

  height:5vh;" href="http://localhost/e-commerce/backend/admin_users_API/update.php?user_id=<?php echo htmlspecialchars($userId); ?>">Save Changes</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>