<?php
session_start();
// var_dump($_SESSION['user_id']);
var_dump($_SESSION['role']);
if($_SESSION['role'] != 1 || empty($_SESSION['user_id'])&&!isset($_SESSION['user_id'])){
	header("Location: http://localhost/e-commerce/backend/index.php");
	exit(); // Ensure no further code is executed after the redirect
}
// var_dump($_SESSION['user_id']);
// $_SESSION['user_id']=23;

// if (!isset($_SESSION['user_id']) ) {
//     echo json_encode(['success' => false, 'message' => 'Unauthorized']);
//     exit();
// }

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get admin data
$sql = "SELECT  * FROM users WHERE user_id = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
// var_dump($result);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // echo json_encode([
    //     'success' => true,
    //     'name' => $row['name'],
    //     'email' => $row['email'],
    //     'phone_number' => $row['phone_number'],
    //     'image' => $row['image']
    // ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Admin data not found']);
}


$stmt->close();
$conn->close();
?>


<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
					
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="http://localhost/e-commerce/backend/img/<?php echo $row['image']; ?>"  class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php echo $row['name']?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Log out</a>

							</div>
						</li>
					</ul>
				</div>
			</nav>
