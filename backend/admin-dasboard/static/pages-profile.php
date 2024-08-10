


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
	<style>
		        .profile-container {
            max-width: 600px;
            margin: 50px auto;
			
        }
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

	</style>
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


						<div class="col-12" >
							<div class="card" style="background-color:#222E3C ">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->



  
<div class="container" style="color:white">
    <div class="card-header" style="background-color:white ; border:2px solid white ;color:#222E3C ;margin-top:4px ;width:100%">
        <h3 style="color:#222E3C">Admin Profile</h3>
    </div>
    <div class="card-body">
        <div class="text-center">
            <img  style="margin-top:50px ; border:2px solid white" src="http://localhost/e-commerce/backend/img/<?php echo $row['image']; ?>" alt="Profile Image" class="profile-image rounded-circle" id="profileImage">
        </div>
        <div class="mt-3" >
            <p style="margin-top:50px"><strong>Name:</strong> <?php echo $row['name']?> <span id="profileName"></span></p>
            <p><strong>Email:</strong> <?php echo $row['email']?><span id="profileEmail"></span></p>
            <p><strong>Phone Number:</strong> <?php echo $row['phone_number']?> <span id="profilePhone"></span></p>
        </div>

		<div class="mb-3" style="margin-top:20px ;float:reight">

		<a  href="http://localhost/e-commerce/backend/admin-dasboard/static/update-user-page.php?user_id= <?php echo $row['user_id']?>" class="d-inline-block">
		<button   class="btn btn-secondary" style="float:right ; margin-bottom:20px">edit profile</button>
		</svg>
	</a>
										
		</div>
    </div>
</div>


<!-- ---------------------------------------------------------------------------------------------------------------------------- -->
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</php>