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
						<a class="sidebar-link" href="pages-view-sales.php">
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
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Orders List</h1>

				
							
								
<!-- --------------------------------------------------------------------------------------------------------- -->
<?php
require 'C:\xampp\htdocs\e-commerce\backend\db.php';

// Fetch products
function fetchCategories()
{
    global $conn;
    $query = "SELECT * FROM payment_recipe ";
    return mysqli_query($conn, $query);
}

$categories = fetchCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Add your CSS path -->
</head>
<body>
    
        <div class="card" >
		<div class="card-body" style="background-color:#09414a; border-radius:10px">
		<input type="text" id="search-input" class="form-control" placeholder="search" style="width:30%">
		</div>				

								
            <div class="mb-3">
            </div>
            <?php
			require 'C:\xampp\htdocs\e-commerce\backend\db.php';

			// Fetch products
			
				global $conn;
				$sql = "SELECT * FROM payment_recipe";
				$result = $conn->query($sql);
			

			?>
        <table id="sales-table"class="table">
            <thead>
                <tr>
				<th>ID</th>
                    <th>Payment Date</th>
                    <th>First Name</th>
                    <!-- <th>Last Name</th> -->
                    <!-- <th>Email</th> -->
                    <th>Address</th>
                    <!-- <th>City</th> -->
                    <!-- <th>Country</th> -->
                    <!-- <th>Zip Code</th> -->
                    <th>Phone</th>
                    <th>Amount</th>
                    <!-- <th>Cart ID</th> -->
                </tr>
            </thead>
            <tbody>

   
    </div>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['payment_date']}</td>
                                <td>{$row['first_name']}</td>

                                <td>{$row['address']}</td>
                               
                               
                                <td>{$row['telephone']}</td>
                                <td>{$row['amount']}</td>
                              
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </>
    </div>

        </div>
      

    <!-- Add your JavaScript files here -->
   <script>
        function GoToPage(){

			window.location.href="./add-product-categories.php";
		}


		function EditPage(){

		window.location.href="./update-categiores-page.php";
		}


		function deleteProduct(userId) {
    fetch(`http://localhost:8080/project_php/e-commerce/backend/admin-categories_API/delete.php?id=${userId}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (response.ok) {
            // Handle success
            alert('category deleted successfully');
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
    document.getElementById('search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#sales-table tbody tr');

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


</body>
</html>



<script src="js/app.js"></script>

</body>

</php>