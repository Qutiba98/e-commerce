<?php
require 'C:\xampp\htdocs\e-commerce\backend\db.php';

// Fetch users
function fetchUsers()
{
    global $conn;
    $query = "SELECT * FROM users";
    return mysqli_query($conn, $query);
}

// Add user
if (isset($_POST['add_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $emailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        // Email exists, redirect to add-user-page.php with an error message
        session_start();
        $_SESSION['error_message'] = 'This email is already in use.';
        header('Location: http://localhost/e-commerce/frontend/admin-dasboard/static/add-user-page.php');
        exit();
    } else {
        // Email does not exist, proceed with insertion
        $query = "INSERT INTO users (name, email, password, role_id) VALUES ('$username', '$email', '$password', '$role_id')";
        $result = mysqli_query($conn, $query);
        session_start();
        if ($result) {
            $_SESSION['success_message'] = 'User added successfully';
            header('Location: http://localhost/e-commerce/frontend/admin-dasboard/static/pages-manage-users.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Failed to add user: ' . mysqli_error($conn);
            header('Location: http://localhost/e-commerce/frontend/admin-dasboard/static/add-user-page.php');
            exit();
        }
    }
}

// Delete user
if (isset($_POST['delete_user'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM users WHERE user_id='$id'";
    mysqli_query($conn, $query);
}

$users = fetchUsers();
?>




<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, php, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.php" />

    <title> Electro </title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom CSS -->
    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Electro</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->
					
	
<li class="sidebar-item">
	<a class="sidebar-link" href="pages-manage-users.php">
<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
</a>
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="pages-manage-categories.php">
<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Manage categories</span>
</a>
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="pages-manage-orders.php">
<i class="align-middle" data-feather="package"></i> <span class="align-middle">View Sales</span>
</a>
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="pages-manage-products.php">
<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Manage Products</span>
</a>
</li>

				
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->


				
				</ul>

				
			</div>
		</nav>

		<div class="main">
		<?php 
		require 'C:\xampp\htdocs\e-commerce\frontend\admin-dasboard\static\admin_nav.php';
	?>

			<main class="content">
				<div class="container-fluid p-0" style="width:70%">

					<h1 class="h3 mb-3">Add New User </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									
                                <?php
                                    if (isset($_SESSION['error_message'])) {
                                        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                                        unset($_SESSION['error_message']);
                                    }
                                    ?>
<!-- --------------------------------------------------------------------------------------------------------- -->

<form id="user-form" method="POST" action=""> 
    <div class="mb-3">
        <input class="form-control form-control-lg" type="hidden" name="id" id="user-id"  />
    </div>

    <div class="mb-3">
        <label class="form-label">Full name :</label>
        <input class="form-control form-control-lg" type="text"  name="username" id="user-username" placeholder="Enter your name" required />
    </div>

    <div class="mb-3">
        <label class="form-label">Email :</label>
        <input class="form-control form-control-lg" type="email"  name="email" id="user-email" placeholder="Enter your email" required />
    </div>
   
    <div class="mb-3">
        <label class="form-label">Password :</label>
        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter password" required />
    </div>
    
    <div class="mb-3">
        <label for="role_id" class="form-label">Role:</label>
        <select class="form-select mb-3" name="role_id" required>
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>
    </div>
    <div class="d-grid gap-2 mt-3" style="width:100% ; display:flex ; justify-content:center ; align-items: center; ">
        <button style="width:100%" type="submit" name="add_user" class="btn btn-lg btn-primary">add user</button>
    </div>
</form>


<!-- ----------------------------------------------------------------------------------------------------------- -->


<!-- --------------------------------------------------------------------------------------------------------------- -->
		</div>
	</div>






	<script>

		
        function validateForm() {
            const fullName = document.forms["createUserForm"]["full_name"].value;
            const nameParts = fullName.split(' ');

            if (nameParts.length < 4) {
                alert("Full Name must contain first name, second name, middle name, and last name.");
                return false;
            }
            return true;
        }
    </script>
  <!-- Bootstrap JS and Dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyQ8H/tb4ga5U9KQ6t2a3l/lqOATkkL5HgpfpX9w" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-mQ93WzjITt9l23V+bdMkQ2rI29gK2kB4D4/w6Q58J4p3CkKp65f9n4x6zD8dm/4K" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-5Cb70e1lE6Fq5+5GNCsE6Ff2ZCT/8hV1dF1vYajYDQzGZ6KLU4AtGThxF2+MFV5Jp" crossorigin="anonymous"></script>

	<script src="js/app.js"></script>

</body>

</php>