<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="../frontend/css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="../frontend/css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="../frontend/css/style.css"/>

	<style>
/* Container styling */
/* Container styling */


/* Card styling */

/* Card image styling */
.product-img {
    width: 100%;
    height: auto;
    overflow: hidden;
}

.product-img img {
    width: 100%;
    height: 250px; /* Adjust the height as needed */
    object-fit: contain; /* Ensures the image is fully visible without being cropped */
}




	</style>

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +962 779 199 880</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> Qutiba@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Amman</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> JOR</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
							<form id="filterForm">
							<?php
									
									$api_url = 'http://localhost:8080/project_php/e-commerce/backend/categories_API/read.php';

								
									$response = file_get_contents($api_url);

									
									$categories = json_decode($response, true);

									
									if ($categories['status'] == 200) {
										$categories = $categories['data'];
									} else {
										$categories = [];
									}
									?>

									<select class="input-select" name="category" id="categorySelect" onchange="filterCategory()">
										<option value="">Select Category</option>
										<?php foreach ($categories as $category): ?>
											<option value="<?= $category['id'] ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $category['id']) echo 'selected'; ?>>
												<?= htmlspecialchars($category['name']) ?>
											</option>
										<?php endforeach; ?>
									</select>
								<input class="input" placeholder="Search here" id="searchInput" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
								<button type="button" class="search-btn" onclick="filterCategory()">Search</button>
							</form>

							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="http://localhost/pref%204/e-commerce/backend/index.php">Home</a></li>
						<li><a href="http://localhost/pref%204/e-commerce/backend/store.php?page=4#">Categories</a></li>
						<li><a href="http://localhost/pref%204/e-commerce/backend/store.php?page=4&category=2#">Laptops</a></li>
						<li><a href="http://localhost/pref%204/e-commerce/backend/store.php?page=4&category=1#">PC</a></li>
						<li><a href="http://localhost/pref%204/e-commerce/backend/store.php?page=4&category=3#">Accessories</a></li>
						<li><a href="http://localhost/pref%204/e-commerce/backend/store.php?page=4&category=4#">Pieces For PC </a></li>

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
					
						

						<!-- aside Widget -->
						<div class="aside">
							

							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
							<!-- <img src="../backend/images" alt=""> -->

							</div>
							
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">

							<div class="container">
								<div class="row">
								<?php
// تحديد رقم الصفحة (الافتراضي هو 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// تحقق من صحة رقم الصفحة
$page = $page > 0 ? $page : 1;

// تحديد المعلمات الأخرى
$categoryId = isset($_GET['category']) ? $_GET['category'] : '';
$searchName = isset($_GET['name']) ? trim($_GET['name']) : '';

// تحديد عنوان الـ API بناءً على المعلمات
if ($categoryId) {
    // $apiUrl = "http://localhost/pref%204/e-commerce/backend/products_API/read_by_Categorie_id.php?categories_id={$categoryId}";
    $apiUrl = "http://localhost/pref%204//e-commerce/backend/products_API/read_by_Categorie_id.php?categories_id={$categoryId}";
} elseif ($searchName) {
    // $apiUrl = "http://localhost/pref%204/e-commerce/backend/products_API/read_by_id.php?name=" . urlencode($searchName);
    $apiUrl = "http://localhost/pref%204/e-commerce/backend/products_API/read_by_id.php?name=" . urlencode($searchName);
} else {
    // $apiUrl = 'http://localhost/pref%204/e-commerce/backend/products_API/read.php';
    $apiUrl = 'http://localhost/pref%204/e-commerce/backend/products_API/read.php';
}

// جلب البيانات من الـ API
$response = @file_get_contents($apiUrl);

if ($response === FALSE) {
    echo '<div class="col-12"><h1 class="error">Product not found.</h1></div>';
} else {
    $data = json_decode($response, true);

    // التحقق من محتوى البيانات
    if ($data === null) {
		echo '<div class="col-12"><h1 class="error">Failed to decode JSON response.</h1></div>';
	} elseif (!isset($data['data']) || empty($data['data'])) {
		echo '<div class="col-12"><div class="error">Product not found.</div></div>';
	} else {
		// عرض المنتجات
		foreach ($data['data'] as $product) {
			$productName = htmlspecialchars($product['name']);
			$imageName = htmlspecialchars($product['image']);
			$imagePath = 'http://localhost/pref%204/e-commerce/backend/images/' . $imageName; // src img
	
			if (stripos($productName, htmlspecialchars($searchName)) !== false) {
				echo '<div class="col-md-4 col-xs-6">';
				echo '<div class="product">';
				echo '<div class="product-img">';
				echo '<img src="' . $imagePath . '" alt="Product Image">';
				echo '<div class="product-label">';
				echo '<span class="sale">-30%</span>';
				echo '<span class="new">NEW</span>';
				echo '</div>'; 
				echo '</div>'; 
				echo '<div class="product-body">';
				
				// التحقق من وجود الفئة في بيانات المنتج
				if (isset($product['categoriesName'])) {
					$categoryName = htmlspecialchars($product['categoriesName']);
				} else {
					$categoryName = "No category"; 
				}
	
				echo '<p class="product-category">' . $categoryName . '</p>';
				echo '<h3 class="product-name"><a href="#">' . htmlspecialchars($product['name']) . '</a></h3>';
				echo '<h4 class="product-price">$' . htmlspecialchars($product['price']) . ' <del class="product-old-price">$990.00</del></h4>';
				echo '<div class="product-rating">';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '<i class="fa fa-star"></i>';
				echo '</div>';
				echo '<div class="product-btns">';
				echo '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>';
				echo '<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>';
				echo '<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>';
				echo '</div>'; 
				echo '</div>';
				echo '<div class="add-to-cart">';
				echo '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>';
				echo '</div>'; 
				echo '</div>'; 
				echo '</div>';
			}
		}
	}
	

	}

?>






								</div>
							</div>

						
							<!-- /product -->
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->

						<?php
						 // عرض عناصر التصفح (Pagination)
						 echo '<div class="store-filter clearfix">';
						 echo '<span class="store-qty">Showing page ' . htmlspecialchars($page) . '</span>';
						 echo '<ul class="store-pagination">';
				 
						 // عرض أرقام الصفحات (افتراضياً من 1 إلى 4)
						 for ($i = 1; $i <= 4; $i++) {
							 echo '<li class="' . ($page === $i ? 'active' : '') . '">';
							 echo '<a href="?page=' . $i . (isset($_GET['category']) ? '&category=' . urlencode($_GET['category']) : '') . (isset($_GET['name']) ? '&name=' . urlencode($_GET['name']) : '') . '">' . $i . '</a>';
							 echo '</li>';
						 }
				 
						 // رابط للانتقال للصفحة التالية
						 echo '<li>';
						 echo '<a href="?page=' . ($page + 1) . (isset($_GET['category']) ? '&category=' . urlencode($_GET['category']) : '') . (isset($_GET['name']) ? '&name=' . urlencode($_GET['name']) : '') . '"><i class="fa fa-angle-right"></i></a>';
						 echo '</li>';
				 
						 echo '</ul>';
						 echo '</div>';
					 
						
						?>
						
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

				<!-- FOOTER -->
		<?php
        
        require '../frontend/footer.php';
        
        ?>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script>
			
			function filterCategory() {
				var select = document.getElementById('categorySelect');
				var categoryId = select.value;
				var searchInput = document.getElementById('searchInput').value.trim();
				var url = new URL(window.location.href);
				
				// تحديث المعاملات في URL
				if (categoryId) {
					url.searchParams.set('category', categoryId);
				} else {
					url.searchParams.delete('category');
				}

				if (searchInput) {
					url.searchParams.set('name', searchInput);
				} else {
					url.searchParams.delete('name');
				}

				// إعادة توجيه المستخدم إلى URL الجديد
				window.location.href = url;
			}


		</script>
		<script src="../frontend/js/jquery.min.js"></script>
		<script src="../frontend/js/bootstrap.min.js"></script>
		<script src="../frontend/js/slick.min.js"></script>
		<script src="../frontend/js/nouislider.min.js"></script>
		<script src="../frontend/js/jquery.zoom.min.js"></script>
		<script src="../frontend/js/main.js"></script>

	</body>
</html>
