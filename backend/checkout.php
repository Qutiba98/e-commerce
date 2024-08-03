<?php
require "../backend/connection_db_pdo.php";
session_start();
// echo $_SESSION['total'];
// Enable error reporting for debugging
$_SESSION['emptyCart'] = false;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$firstNameErr = $lastNameErr = $emailErr = $addressErr = $cityErr = $countryErr = $zipCodeErr = $telephoneErr = "";
$flag = true;
$firstName = $lastName = $email = $address = $city = $country = $zipCode = $tel = "";
$amount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $firstName = isset($_POST['first-name']) ? trim($_POST['first-name']) : "";
    if (empty($firstName) || !preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
        $firstNameErr = "First name is required and should only contain letters and spaces";
        $flag = false;
    }

    $lastName = isset($_POST['last-name']) ? trim($_POST['last-name']) : "";
    if (empty($lastName) || !preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        $lastNameErr = "Last name is required and should only contain letters and spaces";
        $flag = false;
    }

    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Valid email is required";
        $flag = false;
    }

    $address = isset($_POST['address']) ? trim($_POST['address']) : "";
    if (empty($address)) {
        $addressErr = "Address is required";
        $flag = false;
    }

    $city = isset($_POST['city']) ? trim($_POST['city']) : "";
    if (empty($city) || !preg_match("/^[a-zA-Z-' ]*$/", $city)) {
        $cityErr = "City is required and should only contain letters and spaces";
        $flag = false;
    }

    $country = isset($_POST['country']) ? trim($_POST['country']) : "";
    if (empty($country) || !preg_match("/^[a-zA-Z-' ]*$/", $country)) {
        $countryErr = "Country is required and should only contain letters and spaces";
        $flag = false;
    }

    $zipCode = isset($_POST['zip-code']) ? trim($_POST['zip-code']) : "";
    if (empty($zipCode) || !preg_match("/^\d{5}(-\d{4})?$/", $zipCode)) {
        $zipCodeErr = "Valid ZIP code is required (e.g., 12345 or 12345-6789)";
        $flag = false;
    }

    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : "";
    if (empty($tel) || !preg_match("/^\+?[0-9]{10,15}$/", $tel)) {
        $telephoneErr = "Valid telephone number is required";
        $flag = false;
    }

    if ($flag) {
        // Calculate total amount from cart
        $total = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if (isset($item['price']) && isset($item['quantity'])) {
                    $total += $item['price'] * $item['quantity'];
                }
            }
        }

        // Insert order into database
        try {
            // Prepare and execute the INSERT query
            $sql = "INSERT INTO payment_recipe (payment_date, first_name, last_name, email, address, city, country, zip_code, telephone, amount, cart_id) 
                    VALUES (CURRENT_TIMESTAMP(), :firstName, :lastName, :email, :address, :city, :country, :zipCode, :tel, :amount, :cartId)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':email' => $email,
                ':address' => $address,
                ':city' => $city,
                ':country' => $country,
                ':zipCode' => $zipCode,
                ':tel' => $tel,
                ':amount' => $_SESSION['total'],
                ':cartId' => 21 // Adjust or retrieve dynamically
            ]);
        
            // Prepare and execute the DELETE query
            $deleteFromCart = "DELETE FROM cart_product WHERE cart_id = :cartId";
            $deleteStmt = $conn->prepare($deleteFromCart);
            $deleteStmt->execute([':cartId' => 21]);
            header('Location: http://127.0.0.1/brief%203/e-commerce/backend/index.php');
        
            // Check if rows were affected
            if ($deleteStmt->rowCount() > 0) {
                echo "Order placed successfully and cart cleared!";
            } else {
                echo "No items found to delete from the cart.";
            }
            
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }        
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
// fetch data from cart  -------------------------- make it dynamic
$input = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/cartApi/cartFetchData.php?id=21");
$result = json_decode($input,true);
// var_dump($result);
// delete from cart 
// -------------------- redo it to be as dynamic
?>


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
		.error{
			color :red;
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
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
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
                    <ul class="breadcrumb-tree">
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

    <!-- MAIN -->
    <div class="main">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Checkout -->
                <div id="checkout" class="col-md-12">
                    <!-- Checkout Form -->
                    <div class="checkout-form">
                        <form action="../backend/checkout.php" method="POST">
                            <div class="row">
							<div class="col-md-6">
                                    <div class="billing-details">
                                        <div class="section-title">
                                            <h3 class="title">Billing Address</h3>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="first-name" placeholder="First Name" value="<?php echo htmlspecialchars($firstName); ?>">
                                            <span class="error"><?php echo $firstNameErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="last-name" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName); ?>">
                                            <span class="error"><?php echo $lastNameErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                                            <span class="error"><?php echo $emailErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>">
                                            <span class="error"><?php echo $addressErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>">
                                            <span class="error"><?php echo $cityErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="country" placeholder="Country" value="<?php echo htmlspecialchars($country); ?>">
                                            <span class="error"><?php echo $countryErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="zip-code" placeholder="ZIP Code" value="<?php echo htmlspecialchars($zipCode); ?>">
                                            <span class="error"><?php echo $zipCodeErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="tel" name="tel" placeholder="Telephone" value="<?php echo htmlspecialchars($tel); ?>">
                                            <span class="error"><?php echo $telephoneErr; ?></span>
                                        </div>
                                       
                                        
                                       
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="order-summary">
                                        <div class="section-title">
                                            <h3 class="title">Your Order</h3>
                                        </div>
                                        <div class="order-summary">
    <?php foreach ($result as $row): ?>
        <p><?php echo htmlspecialchars($row['name']); ?> <span><b><?php echo ($row['price'] * $row['quantity']); ?><br> Quantity :<?php echo $row['quantity'] ?> </b></span></p>
        <!-- <p><?php echo htmlspecialchars($row['productDesc']); ?></p> -->
        <p></p>
        <?php endforeach; ?>
        <p>Total Price: <?php echo htmlspecialchars($_SESSION['total']); ?></p>
    <button class="primary-btn order-submit">Place Order</button>
</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Checkout Form -->
                </div>
                <!-- /Checkout -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /MAIN -->

    <!-- FOOTER -->
    <footer id="footer" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Footer Widget -->
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, dolorum, hic voluptatibus labore tenetur.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Footer Widget -->

                <!-- Footer Widget -->
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">Categories</h3>
                        <ul class="footer-links">
                            <li><a href="#">Laptops</a></li>
                            <li><a href="#">Smartphones</a></li>
                            <li><a href="#">Cameras</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Footer Widget -->

                <!-- Footer Widget -->
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /Footer Widget -->

                <!-- Footer Widget -->
                <div class="col-md-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">Newsletter</h3>
                        <form>
                            <input class="input" type="email" placeholder="Enter your email">
                            <button class="newsletter-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
                <!-- /Footer Widget -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="../frontend/js/jquery.min.js"></script>
    <script src="../frontend/js/bootstrap.min.js"></script>
    <script src="../frontend/js/slick.min.js"></script>
    <script src="../frontend/js/nouislider.min.js"></script>
    <script src="../frontend/js/main.js"></script>
</body>
</html>
