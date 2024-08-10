<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, php, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.php" />

	<title>Electro </title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS from CDN -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy9v2Y2EM/rU2wBX9E7k0ZZA3cs+IN6hmRNVzH4"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz4fnFO9x04p5kND8X5L5kKJ0Jf7kFsl6oWc9a4sEw5W4Wu0HeWqB2E4kT"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-7yWQ4+d8R5yW/7rC6Gm8kCRdLC/mZ8sO3w4lM3Zg2pfL5bX7t5zdJg8dT58E3Jk8"
		crossorigin="anonymous"></script>
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
							<i class="align-middle" data-feather="sliders"></i> <span
								class="align-middle">Dashboard</span>
						</a>
					</li>


					<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-users.php">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage
								Users</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-categories.php">
							<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Manage
								categories</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-view-sales.php">
							<i class="align-middle" data-feather="package"></i> <span class="align-middle">View
								Sales</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-products.php">
							<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Manage
								Products</span>
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
				<div class="container-fluid p-0">
					<?php if (isset($_SESSION['success_message'])): ?>

						<!-- --------------------------------------------------------------------------------- success_message alert  -->
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?php
							echo $_SESSION['success_message'];
							unset($_SESSION['success_message']);
							?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>
					<!-- --------------------------------------------------------------------------------- error_message alert  -->

					<?php if (isset($_SESSION['error_message'])): ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?php
							echo $_SESSION['error_message'];
							unset($_SESSION['error_message']);
							?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>


					<!-- --------------------------------------------------------------------------------- -->


					<h1 class="h3 mb-3">user management</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
									<!-- --------------------------------------------------------------------------------------------------------- -->
									<?php
									require 'C:\xampp\htdocs\e-commerce\backend\db.php';

									// Fetch users
									function fetchUsers()
									{
										global $conn;
										$query = "SELECT * FROM users WHERE role_id=2";
										return mysqli_query($conn, $query);
									}

									function fetchPrudoct()
									{
										global $conn;
										$query = "SELECT * FROM users";
										return mysqli_query($conn, $query);
									}

									$role = 1;


									// Handle CRUD operations
									if ($_SERVER['REQUEST_METHOD'] === 'POST') {
										$roleId;
										if ($_POST['role'] == "user") {
											$roleId = 2;
										} else {
											$roleId = 1;
										}
										if (isset($_POST['add_user'])) {
											$username = mysqli_real_escape_string($conn, $_POST['username']);
											$email = mysqli_real_escape_string($conn, $_POST['email']);
											$role = mysqli_real_escape_string($conn, $_POST['role']);
											$query = "INSERT INTO users (name, email, role_id) VALUES ('$username', '$email','$roleId')";
											mysqli_query($conn, $query);
										} elseif (isset($_POST['edit_user'])) {
											$id = intval($_POST['id']);
											$username = mysqli_real_escape_string($conn, $_POST['username']);
											$email = mysqli_real_escape_string($conn, $_POST['email']);
											$role = mysqli_real_escape_string($conn, $_POST['role']);
											$query = "UPDATE users SET name='$username', email='$email' WHERE user_id='$id'";
											mysqli_query($conn, $query);
										} elseif (isset($_POST['delete_user'])) {
											$id = intval($_POST['id']);
											$query = "DELETE FROM users WHERE user_id='$id'";
											mysqli_query($conn, $query);
										}
									}
									$users = fetchUsers();
									?>


									<div class="card-body" style="background-color:#09414a; border-radius:10px">
										<input type="text" id="search-input" class="form-control" placeholder="search"
											style="width:30%">
									</div>

									<div class="mb-3" style="margin-top:20px">
										<button onclick="GoToPage()" class="btn btn-secondary"
											style="float:right ; margin-bottom:20px">add user</button>
									</div>



									<table id="user-table" class="table table-hover my-0">
										<thead>
											<tr>
												<th>ID</th>
												<th>Username</th>
												<th>Role</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php while ($user = mysqli_fetch_assoc($users)): ?>
												<tr>
													<td><?php echo $user['user_id']; ?></td>
													<td><?php echo $user['name']; ?></td>
													<td>
														<?php
														if ($user['role_id'] == 1) {
															echo "admin";
														} elseif ($user['role_id'] == 2) {
															echo "user";
														} else {
															echo "unknown role";
														}
														?>
													</td>
													<td>
														<i>


															<a href="http://localhost/e-commerce/frontend/admin-dasboard/static/update-user-page.php?user_id=<?php echo $user['user_id']; ?>"
																class="d-inline-block">
																<svg style="color:#5bc0de" id="edit"
																	onclick="editUser(<?php echo $user['user_id']; ?>)"
																	xmlns="http://www.w3.org/2000/svg" width="24"
																	height="24" viewBox="0 0 24 24" fill="none"
																	stroke="currentColor" stroke-width="2"
																	stroke-linecap="round" stroke-linejoin="round"
																	class="feather feather-edit align-middle me-2">
																	<path
																		d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
																	</path>
																	<path
																		d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
																	</path>
																</svg>
															</a>



														</i>

														<a href="#" class="d-inline-block"
															onclick="deleteUser(<?php echo $user['user_id']; ?>); return false;">
															<svg style="color:red" xmlns="http://www.w3.org/2000/svg"
																width="24" height="24" viewBox="0 0 24 24" fill="none"
																stroke="currentColor" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round"
																class="feather feather-trash-2 align-middle me-2">
																<polyline points="3 6 5 6 21 6"></polyline>
																<path
																	d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
																</path>
																<line x1="10" y1="11" x2="10" y2="17"></line>
																<line x1="14" y1="11" x2="14" y2="17"></line>
															</svg>
														</a>
													</td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>


		</div>
	</div>



	<script>
		function GoToPage() {

			window.location.href = "./add-user-page.php";
		}


		function EditPage() {

			window.location.href = "./update-user-page.php";
		}


		function deleteUser(userId) {
			fetch(`http://localhost/e-commerce/backend/admin_users_API/delete.php?user_id=${userId}`, {
				method: 'DELETE'
			})
				.then(response => {
					if (response.ok) {
						// Handle success
						alert('User deleted successfully');
						// Optionally, you might want to reload the page or remove the user from the UI
					} else {
						// Handle errors
						alert('Failed to delete user');
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
		}



		function editUser(id) {
			// Fetch user details and fill the form
			fetch(`./fetch_user.php?id=${id}`)
				.then(response => response.json())
				.then(data => {
					document.getElementById('user-id').value = data.user_id;
					document.getElementById('user-username').value = data.name;
					document.getElementById('user-email').value = data.email;
					document.getElementById('user-role').value = data.role; // Uncomment if role is used
					document.getElementById('add-user-btn').style.display = 'none';
					document.getElementById('edit-user-btn').style.display = 'inline';
				});
		}


	</script>
	<script>
		document.getElementById('search-input').addEventListener('input', function () {
			const searchTerm = this.value.toLowerCase();
			const rows = document.querySelectorAll('#user-table tbody tr');

			rows.forEach(row => {
				const cells = row.querySelectorAll('td');
				let found = false;

				cells.forEach(cell => {
					if (cell.textContent.toLowerCase().includes(searchTerm)) {
						found = true;
					}
				});

				row.style.display = found ? '' : 'none';
			});
		});
	</script>


	<script src="js/app.js"></script>

</body>

</php>