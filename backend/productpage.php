<?php
include 'db.php';
session_start();

$id = $_GET['productId'] ? $_GET['productId'] : "";
$isInDatabase = false;
$_SESSION['currentProductId'] = $_GET['productId'];
$isInDatabase =false;
// Initialize the session variable if it doesn't exist
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

$input = file_get_contents("http://localhost/e-commerce/backend/productapi/getbyid.php?id=$id");
$result = json_decode($input, true);
$showImage = $result['image'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qua'])) {
    $quantity = $_POST['qua'];
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
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $_SESSION['products'][] = $productInfo;
    }

    // echo json_encode(['status' => 'success', 'message' => 'Product added to cart!']);
    // exit();
}
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
            margin-top: 25px;
        }

        .customer-reviews {
            background: #ffffff;
            padding: 20px;
            border-radius: 13px;
            border: 1px solid red;
            box-shadow: 0px 0px 19px -8px red;
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
            border-radius: 5px;
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
            background-color: white;
            color: black;
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

    <?php
    include './nav&footr/nav.php';
    ?>

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
                        <form id="addToCartForm" action="../backend/productpage.php?productId=<?php echo $_SESSION['currentProductId'] ?>" method="POST">
                            <div class="quantity">
                                <p class="qty-btn" onclick="decreaseQuantity()">-</p>
                                <input type="text" id="quantity" name="qua" value="1">
                                <p class="qty-btn" onclick="increaseQuantity()">+</p>
                                <br>
                            </div>
                            <!-- /Quantity -->

                            <br>
                            <!-- Add to Cart Button -->
                            <div class="product-actions">
                                <input type="submit" class="btn" style="background-color: #C9302C; border-color: #C9302C; color: #fff;" value="Add to Cart">
                            </div>
                        </form>
                        <!-- /Add to Cart Button -->
                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->

            // $_SESSION['user_id'] = 32; // Example user ID
            $_SESSION['product_id'] = $_GET['productId']; // Example product ID

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "e-commerce";

            $conn = new mysqli($servername, $username, $password, $dbname);
            $user_id = $_SESSION['user_id'];
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
// alert if not logged in  ------------------------------------------------------------------------------------
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['user_id']) {
                $product_id = $_SESSION['product_id'];
                $comment_text = isset($_POST['comment_text']) ? $_POST['comment_text'] : null;
                $name = $_SESSION['name'];
                // 0 "" 
                if ($product_id && $comment_text && $user_id) {
                    $stmt = $conn->prepare("INSERT INTO comments (comment_text,product_id,user_id) VALUES (?, ?, ?)");

                    $stmt->bind_param("sii", $comment_text, $product_id, $user_id);
                    $stmt->execute();
                    $stmt->close();
                }
            }





            $sql = "SELECT users.name, comments.comment_text FROM comments 
        INNER JOIN users ON comments.user_id = users.user_id
        WHERE comments.product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['product_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            // var_dump($result);
            $reviews = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $reviews[] = $row;
                }
            } 
            // $reviews = json_encode($reviews);    

            // print_r ($reviews[0]['name']);
            ?>
            <!-- Customer Reviews Section -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="customer-reviews">
                            <h3 class="reviews-title">Customer Reviews</h3>
                            <div class="reviews">
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "e-commerce";

                                $conn = new mysqli($servername, $username, $password, $dbname);
                                $user_id = $_SESSION['user_id'];

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_text'])) {
                                    $product_id = $_SESSION['product_id'];
                                    $comment_text = $_POST['comment_text'];
                                    $name = $_SESSION['name'];

                                    if ($product_id && $comment_text && $user_id) {
                                        $stmt = $conn->prepare("INSERT INTO comments (comment_text,product_id,user_id) VALUES (?, ?, ?)");
                                        $stmt->bind_param("sii", $comment_text, $product_id, $user_id);
                                        $stmt->execute();
                                        $stmt->close();
                                    }
                                }

                                $sql = "SELECT users.name, comments.comment_text FROM comments 
                                        INNER JOIN users ON comments.user_id = users.user_id
                                        WHERE comments.product_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $_SESSION['product_id']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $reviews = [];

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $reviews[] = $row;
                                    }
                                }
                                ?>

                                <?php foreach ($reviews as $review): ?>
                                    <div class="review">
                                        <div class="review-author">
                                            <strong><?php echo htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                        </div>
                                        <p class="review-text"><?php echo htmlspecialchars($review['comment_text'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Add Review Form -->
                            <div class="add-review-form">
                                <h4>Add Your Review</h4>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="review-text">Your Review:</label>
                                        <textarea id="review-text" name="comment_text" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn" style="background: #C9302C; color: white;">Submit Review</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function decreaseQuantity() {
            let quantity = parseInt(document.getElementById('quantity').value);
            if (quantity > 1) {
                document.getElementById('quantity').value = quantity - 1;
            }
        }

        function increaseQuantity() {
            let quantity = parseInt(document.getElementById('quantity').value);
            document.getElementById('quantity').value = quantity + 1;
        }

        $(document).ready(function() {
            $('#addToCartForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '../backend/productpage.php?productId=<?php echo $id ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was a problem adding the product to the cart.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was a problem with the server. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
