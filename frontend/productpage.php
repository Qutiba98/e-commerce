<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>

    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

   
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    
    <link type="text/css" rel="stylesheet" href="css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

    
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

    
    <link rel="stylesheet" href="css/font-awesome.min.css">

    
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <style>
        .quantity {
            display: flex;
            align-items: center;
        }

.container {
    margin-top: 50px;
}

.customer-reviews {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px #D10024;
}

.reviews-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    border-bottom: 2px solid #D10024;
    padding-bottom: 10px;
}

.reviews {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 20px;
    padding-right: 10px;
}

.review {
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background: #f9f9f9;
}

.review-author {
    font-weight: bold;
    color: #D10024;
}

.review-text {
    margin-top: 10px;
    font-size: 16px;
    line-height: 1.5;
}

.add-review-form {
    margin-top: 30px;
}

.add-review-form h4 {
    font-size: 20px;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    border-radius: 5px;
}

.btn-primary {
    background-color: #D10024;
    border-color: black;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
}
        .quantity input {
            text-align: center;
            width: 50px;
            margin: 0 10px;
        }
        .quantity button {
            background: #f2f2f2;
            border: 1px solid #ddd;
            font-size: 18px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* .product-details{
            font-size: 18px;
        } */


/* 
.product-image{
    width: 320px !important;
} */

    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +962-779-199-880</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> Qutiba@gmail.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
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
                            <form>
                                <select class="input-select">
                                    <option value="0">All Categories</option>
                                    <option value="1">Category 01</option>
                                    <option value="1">Category 02</option>
                                </select>
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
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
                                                <h3 class="product-name"><a href="#">Product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./img/product02.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">Product name goes here</a></h3>
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

                            <!-- Menu Toggle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toggle -->
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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Hot Deals</a></li>
                    <li><a href="#">Categories</a></li>
                    <li><a href="#">Laptops</a></li>
                    <li><a href="#">Smartphones</a></li>
                    <li><a href="#">Cameras</a></li>
                    <li><a href="#">Accessories</a></li>
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
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li class="active">Product</li>
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
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="../frontend/img/product02.png" alt="Product Image" class="img-responsive">
                    </div>
                </div>
                <!-- /Product Image -->

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="product-details">
                        <h2 class="product-name">Product Name</h2>
                        <h3 class="product-price">$Price</h3>
                        <p class="product-description">Product description goes here. You can write detailed features and specifications of the product here.</p>
                        
                        <!-- Quantity -->
                        <div class="quantity">
                            <button class="qty-btn" onclick="changeQuantity(-1)">-</button>
                            <input type="text" id="quantity" value="1">
                            <button class="qty-btn" onclick="changeQuantity(1)">+</button>
							<br>

                        </div>
                        <!-- /Quantity -->
                        <br>
                        <!-- Add to Cart Button -->
						<div class="product-actions">
							<button class="btn" 
									style="background-color: #D10024; border-color: #D10024; color: #fff;"
									onclick="addToCart()">Add to Cart</button>
						</div>
												<!-- /Add to Cart Button -->
                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->

            <?php
// session_start();

$_SESSION['user_id'] = 21; // Example user ID
$_SESSION['product_id'] = 75; // Example product ID

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "e-commerce"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_SESSION['product_id'];
    $comment_text = isset($_POST['comment_text']) ? $_POST['comment_text'] : null;
    $user_id = $_SESSION['user_id'];

    if ($product_id && $comment_text && $user_id) {
        $stmt = $conn->prepare("INSERT INTO comments (comment_text,product_id,user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sii",$comment_text, $product_id , $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

$product_id = $_SESSION['product_id'];
$result = $conn->query("SELECT * FROM comments WHERE product_id = $product_id");
?>
<!-- Customer Reviews Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="customer-reviews">
                <h3 class="reviews-title">Customer Reviews</h3>
                <div class="reviews">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="review">
                        <div class="review-author">
                            <strong>User <?php echo $row['user_id']; ?></strong>
                        </div>
                        <p class="review-text"><?php echo $row['comment_text']; ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <!-- Add Review Form -->
                <div class="add-review-form">
                    <h4>Add Your Review</h4>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="review-text">Your Review:</label>
                            <textarea id="review-text" name="comment_text" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
                <!-- /Add Review Form -->
            </div>
        </div>
    </div>
</div>
            <!-- /Customer Reviews -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

		<!-- FOOTER -->
		<?php
        
        require '../frontend/footer.php';
        
        ?>
		<!-- /FOOTER -->


    <!-- jQuery Plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function changeQuantity(amount) {
            var qtyInput = document.getElementById('quantity');
            var currentQty = parseInt(qtyInput.value);
            if (currentQty + amount >= 1) { // Prevents quantity from going below 1
                qtyInput.value = currentQty + amount;
            }
        }

        function addToCart() {
            var qty = document.getElementById('quantity').value;
            alert('Added ' + qty + ' items to cart!');
            // Add logic to actually add the item to the cart
        }
    </script>
</body>
</html>

