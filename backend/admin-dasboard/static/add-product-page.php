<?php 
					require'db.php';
global $conn;

// تعريف المتغيرات
$name = isset($_POST['name']) ? $_POST['name'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$categories_id = isset($_POST['categories_id']) ? $_POST['categories_id'] : "";

// دليل تحميل الملفات
$targetDir = "C:\\xampp\\htdocs\\project_php\\e-commerce\\backend\\images\\";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); // احصل على امتداد الملف وحوله إلى أحرف صغيرة

        // السماح بامتدادات معينة للملفات
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

				$sql = "INSERT INTO product (name, image, description, price, categories_id) VALUES (?, ?, ?, ?, ?)";
                
                if ($stmt = mysqli_prepare($conn, $sql)) {

					$price = floatval($price);
                    $categories_id = intval($categories_id);
                    mysqli_stmt_bind_param($stmt, "sssdi", $name, $fileName, $description, $price, $categories_id);
                    if (mysqli_stmt_execute($stmt)) {
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            echo "Product inserted successfully!";
                        } else {
                            echo "Product insertion failed! No rows affected.";
                        }
                    } else {
                        echo "Error in executing statement: " . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error in preparing statement: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    } else {
        echo "Please select a file to upload.";
    }
}

// ?>




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

					<h1 class="h3 mb-3">Add New User </h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									
<!-- --------------------------------------------------------------------------------------------------------- -->


<form action="add-product-page.php" method="post" enctype="multipart/form-data">
<div class="mb-3">
        <label class="form-label">Product Name:</label>
        <input class="form-control form-control-lg" type="text" name="name" id="product-name" placeholder="Enter product name" required />
    </div>

    <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea class="form-control form-control-lg" name="description" id="product-description" placeholder="Enter product description" required></textarea>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Price:</label>
        <input class="form-control form-control-lg" type="number" step="0.01" name="price" id="product-price" placeholder="Enter product price" required />
    </div>
    
    <div class="mb-3">
        <label class="form-label">Image:</label>
        <input class="form-control form-control-lg" type="file" name="image" id="product-image"  />
    </div>

	<div class="mb-3">
        <label class="form-label">categories id:</label>
        <input class="form-control form-control-lg" type="number" name="categories_id" id="categories_id"  />
    </div>
    <div class="d-grid gap-2 mt-3" style="width:100% ; display:flex ; justify-content:center ; align-items: center; ">
        <button type="submit" name="add_product" class="btn btn-lg btn-primary">Add Product</button>
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