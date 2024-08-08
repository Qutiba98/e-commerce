<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Electro - HTML Ecommerce Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../frontend/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../frontend/css/font-awesome.min.css">

	<!-- Custom stylesheet -->
	<link type="text/css" rel="stylesheet" href="../frontend/css/style.css" />

	<style>
		/* Card image styling */
		.product-img {
			width: 100%;
			height: auto;
			overflow: hidden;
		}

		.product-img img {
			width: 100%;
			height: 250px;
			object-fit: cover;
			/* Changed to cover for better alignment */
		}

		/* Store top filter */
		.store-filter .store-sort {
			float: right;
		}

		/* Ensure product cards align properly and have spacing */
		.product {
			margin-bottom: 30px;
			/* Space between rows */
		}

		.product-img img {
			height: 250px;
			object-fit: cover;
		}

		.container1 {
			justify-content: center;
			display: flex;
			margin-right: 280px;
			gap: 20px;
		}

		/* Additional styles for responsiveness */
		@media (max-width: 768px) {
			.product-img img {
				height: auto;
			}
		}


		.store-filter .store-sort select {
			width: 150px;
			height: 36px;
			border-radius: 4px;
			border: 1px solid #ddd;
			padding: 0 12px;
			font-size: 14px;
		}

		.store-filter .store-sort select:focus {
			border-color: #4CAF50;
			outline: none;
		}

		/* Additional styles to match provided example */
		.totalPriceStyle {
			color: black;
			font-size: 14px;
			background-color: white;
			padding: 10px 20px;
			border-radius: 5px;
			margin-top: 20px;
		}

		.emptyCartImage {
			width: 50px;
		}
	</style>

</head>

<body>

	<?php include './nav&footr/nav.php'; ?>

	<!-- store top filter -->
	<div class="store-filter clearfix">
		<div class="store-sort">
			<select id="sortSelect" class="form-control" onchange="sortProducts()">
				<option value="">Sort by Price</option>
				<option value="asc">Low to High</option>
				<option value="desc">High to Low</option>
			</select>
		</div>
	</div>
	<!-- /store top filter -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container1">
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside Widget -->
					<div class="aside">
						<!-- Add any aside widgets here if needed -->
					</div>
				</div>
				<!-- /ASIDE -->

				<!-- STORE -->
				<div id="store" class="col-md-9">
					<!-- store products -->
					<div class="row">

						<?php
						// Define the page number (default is 1)
						$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
						$page = $page > 0 ? $page : 1;

						// Get other parameters
						$categoryId = isset($_GET['category']) ? $_GET['category'] : '';
						$searchName = isset($_GET['name']) ? trim($_GET['name']) : '';
						$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : ''; // Get sort parameter

						// Build the API URL based on parameters
						if ($categoryId) {
							$apiUrl = "http://localhost/e-commerce/backend/products_API/read_by_Categorie_id.php?categories_id={$categoryId}";
						} elseif ($searchName) {
							$apiUrl = "http://localhost/e-commerce/backend/products_API/read_by_id.php?name=" . urlencode($searchName);
						} else {
							$apiUrl = 'http://localhost/e-commerce/backend/products_API/read.php';
						}

						// Fetch data from the API
						$response = @file_get_contents($apiUrl);

						if ($response === FALSE) {
							echo '<div class="col-12"><h1 class="error">Product not found.</h1></div>';
						} else {
							$data = json_decode($response, true);

							if ($data === null) {
								echo '<div class="col-12"><h1 class="error">Failed to decode JSON response.</h1></div>';
							} elseif (!isset($data['data']) || empty($data['data'])) {
								echo '<div class="col-12"><div class="error">Product not found.</div></div>';
							} else {
								// Sort products based on price
								if ($sortOrder === 'asc') {
									usort($data['data'], function ($a, $b) {
										return $a['price'] - $b['price'];
									});
								} elseif ($sortOrder === 'desc') {
									usort($data['data'], function ($a, $b) {
										return $b['price'] - $a['price'];
									});
								}

								// Display products
								foreach ($data['data'] as $product) {
									$productName = htmlspecialchars($product['name']);
									$imageName = htmlspecialchars($product['image']);
									$imagePath = 'http://localhost/e-commerce/backend/images/' . $imageName;

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

										$categoryName = isset($product['categoriesName']) ? htmlspecialchars($product['categoriesName']) : "No category";

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
										echo "<a href='http://localhost/e-commerce/backend/productpage.php?productId=" . $product['id'] . "' class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'> Quick View</span></a>";
										echo '</div>';
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
			</div>
			<!-- /store products -->
		</div>
		<!-- /STORE -->
	</div>
	<!-- /row -->


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
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
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
	<?php require '../frontend/footer.php'; ?>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script>
		function filterCategory() {
			var select = document.getElementById('categorySelect');
			var categoryId = select.value;
			var searchInput = document.getElementById('searchInput').value.trim();
			var url = new URL(window.location.href);

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

			window.location.href = url;
		}

		function sortProducts() {
			var sortSelect = document.getElementById('sortSelect');
			var sortOrder = sortSelect.value;
			var url = new URL(window.location.href);

			if (sortOrder) {
				url.searchParams.set('sort', sortOrder);
			} else {
				url.searchParams.delete('sort');
			}

			window.location.href = url.toString();
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