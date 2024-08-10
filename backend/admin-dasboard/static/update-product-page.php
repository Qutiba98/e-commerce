<?php
					require'db.php';

// Fetch users

function fetchUsers()
{
    global $conn;
    $query = "SELECT * FROM product";
    return mysqli_query($conn, $query);
}

	$id = isset($_GET['id']) ?$_GET['id'] : "";
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
		require 'admin_nav.php';
	?>
			<main class="content">
			<div class="container-fluid p-0" style="width:70%">

					<h1 class="h3 mb-3">Update Product  Information</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									
<!-- --------------------------------------------------------------------------------------------------------- -->
<form id="user-form" method="POST" action="http://localhost/e-commerce/backend/products_API/update.php?id=<?php echo $id; ?>">
   
	<div class="mb-3">
        <label class="form-label">Product Name :</label>
        <input class="form-control form-control-lg" type="text"  name="name" id="product-name" placeholder="Product Name" required />
    </div>


	<div class="mb-3">
        <label class="form-label">Description :</label>
        <input class="form-control form-control-lg" type="text"  name="description" id="product-description" placeholder="Description" required />
    </div>


    <div class="mb-3">
        <label class="form-label">Price :</label>
        <input class="form-control form-control-lg" type="number" name="price" id="product-price" step="0.01" placeholder="Price"  required />
    </div>

    <div class="mb-3">
        <label class="form-label">Category ID :</label>
        <input class="form-control form-control-lg" type="number" name="categories_id" id="product-categories_id" placeholder="Category ID" required />
    </div>

    <div class="mb-3">
        <label class="form-label">pruduct Image :</label>
        <input class="form-control form-control-lg" type="file" id="image" name="image" accept="image/*" placeholder="Image" required />
    </div>


    <div class="d-grid gap-2 mt-3" style="width:100% ; display:flex ; justify-content:center ; align-items: center; ">
        <button type="submit" name="add_user" class="btn btn-lg btn-primary">Update</button>
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

	<script src="js/app.js"></script>

</body>

</php>