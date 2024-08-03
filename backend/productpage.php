<?php
include 'db.php';
session_start();

<<<<<<< HEAD
$id = $_GET['id'] ? $_GET['id'] : "";
=======
$id =$_GET['productId']? $_GET['productId'] :"";
// var_dump ($_GET['productId']);
$_SESSION['currentProductId'] = $_GET['productId'];
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
// // Initialize the session variable if it doesn't exist
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}
$isInDatabase = false;
$quantity = isset($_POST['qua']) ? $_POST['qua'] : 0;

$input = file_get_contents("http://localhost//last/e-commerce/backend/productapi/getbyid.php?id=$id");
$result = json_decode($input, true);

if ($result) {
    $productId = $result['id'];
    $productInfo = [
        'id' => $productId,
        'name' => $result['name'],
        'price' => $result['price'],
        'description' => $result['description'],
        'image' => $result['image'],
        'quantity' => $quantity,
        'isInDatabase' => $isInDatabase
    ];


    $productExists = false;


    foreach ($_SESSION['products'] as &$product) {
        if ($product['id'] === $productId) {
            $product['quantity'] += $quantity;
            // $_SESSION['quaProduct'][] = $quantity;
            $productExists = true;
            break;
        }
    }

    // Add the product if it doesn't exist
    if (!$productExists) {
        $_SESSION['products'][] = $productInfo;
    }
}

// Debug: Display the session products array
print_r($_SESSION['products']);

$showImage = $result['image'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>

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


        .qty-btn {
            display: inline-block;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            font-size: 18px;
            cursor: pointer;
            border: 1px solid #d10024;
            border-radius: 5px;
            background-color: #15161d;
            color: white;
            transition: background-color 0.3s, transform 0.3s;
            margin: 0
        }

        .qty-btn:hover {
            background-color: #d10024;
            transform: scale(1.1);
        }

        #quantity {
            width: 60px;
            height: 30px;
            text-align: center;
            border: 1px solid #d10024;
            border-radius: 5px;
            font-size: 18px;
            color: #15161d;
            background-color: white;
        }

        #quantity:focus {
            outline: none;
            border-color: #d10024;
        }

        .quantity {
            display: flex;
            align-items: center;
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
                            <div>
                                <a href="./cart.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">3</div>
                                </a>
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
                        <img src="images/<?php echo $showImage ?>" alt="Product Image" class="img-responsive">
                    </div>
                </div>
                <!-- /Product Image -->

                <!-- Product Details -->
                <div class="col-md-6">

                    <div class="product-details">

                        <h2 class="product-name"><?php echo $result['name'] ?></h2>

                        <h3 class="product-price">$<?php echo $result['price'] ?></h3>

                        <p class="product-description"><?php echo $result['description'] ?></p>

                        <!-- Quantity -->
<<<<<<< HEAD
                        <form action="../backend/productpage.php" method="POST">
                            <div class="quantity">
                                <p class="qty-btn" onclick="decreaseQuantity()">-</p>
                                <input type="text" id="quantity" name="qua" value="1">
                                <p class="qty-btn" onclick="increaseQuantity()">+</p>
                                <br>
                            </div>
                            <!-- /Quantity -->

=======
                         <form action="../backend/productpage.php?productId=<?php echo $_SESSION['currentProductId'] ?>" method="POST" >
                        <div class="quantity">
                        <p class="qty-btn" onclick="decreaseQuantity()">-</p>
                        <input type="text" id="quantity" name="qua" value="1">
                        <p class="qty-btn" onclick="increaseQuantity()">+</p>
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
                            <br>
                            <!-- Add to Cart Button -->
                            <div class="product-actions">
                                <input type="submit" class="btn" style="background-color: #D10024; border-color: #D10024; color: #fff;" value="Add to Cart">
                            </div>
                        </form>
                        <!-- /Add to Cart Button -->
                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->
            <?php
            // session_start();

            $_SESSION['user_id'] = 21; // Example user ID
            // $_SESSION['product_id'] = 75; // Example product ID

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
                $name = $_SESSION['name'];

                if ($product_id && $comment_text && $user_id) {
                    $stmt = $conn->prepare("INSERT INTO comments (comment_text,product_id,user_id) VALUES (?, ?, ?)");

                    $stmt->bind_param("sii", $comment_text, $product_id, $user_id);
                    $stmt->execute();
                    $stmt->close();
                }
            }

            $user_id = $_SESSION['user_id'];



            $result = $conn->query(
                " SELECT comments.* ,users.name FROM comments
INNER JOIN users
USING (user_id)
WHERE comments.user_id =  $user_id"
            );
            ?>
            <!-- Customer Reviews Section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="customer-reviews">
                            <h3 class="reviews-title">Customer Reviews</h3>
                            <div class="reviews">
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <div class="review">
                                        <div class="review-author">
                                            <strong> <?php echo $row['name']; ?></strong>
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
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="../frontend/js/jquery.min.js"></script>
    <script src="../frontend/js/bootstrap.min.js"></script>
    <script src="../frontend/js/slick.min.js"></script>
    <script src="../frontend/js/nouislider.min.js"></script>
    <script src="../frontend/js/jquery.zoom.min.js"></script>
    <script src="../frontend/js/main.js"></script>
    <script src="../frontend/productPage.js"></script>

</body>

</html>