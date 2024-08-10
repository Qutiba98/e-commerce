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
		require 'admin_nav.php';
	?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Product management</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
<!-- --------------------------------------------------------------------------------------------------------- -->
<?php
					require'db.php';

// Fetch products
function fetchProducts()
{
    global $conn;
    $query = "SELECT product.*, categories.name 
	FROM product
	INNER JOIN categories ON product.categories_id = categories.id; ";
    return mysqli_query($conn, $query);
}

$products = fetchProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Add your CSS path -->
</head>
<body>
    <div class="container">
        <div class="card">
								<div class="card-body" style="background-color:#09414a; border-radius:10px">
								<input type="text" id="search-input" class="form-control" placeholder="search" style="width:30%">
								</div>

								<div class="mb-3" style="margin-top:20px">
										<button onclick="GoToPage()" class="btn btn-secondary" style="float:right ; margin-bottom:20px">add Product </button>
								</div>
        
        </div>
        
        <table id="product-table" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($products)) : ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['price']; ?>$</td>
                        <td><?php echo $product['name']; ?></td>
                        <td>
                            <img src="http://localhost/e-commerce/backend/images/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 100px;">
                        </td>
                        <td>
                            <!-- Uncomment and update the links according to your needs -->
                            
                            <a href="update-product-page.php?id=<?php echo $product['id']; ?>" class="d-inline-block">
                                <svg style="color:#5bc0de" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </a>
                            <a href="#" class="d-inline-block" onclick="deleteProduct(<?php echo $product['id']; ?>); return false;">
                                <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </a>
                            
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>

    <!-- Add your JavaScript files here -->
   <script>
        function GoToPage(){

			window.location.href="./add-product-page.php";
		}


		function EditPage(){

		window.location.href="./update-product-page.php";
		}


function deleteProduct(userId) {
    fetch(`http://localhost/e-commerce/backend/products_API/delete.php?id=${userId}`, {
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
    document.getElementById('search-input').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#product-table tbody tr');

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