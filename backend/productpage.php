<?php
// Include the database connection file
include 'db.php';

// Start the session to use session variables
session_start();

// Set the user_id session variable if it is not already set
$_SESSION['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

// Retrieve the productId from the GET request
$id = $_GET['productId'] ? $_GET['productId'] : "";

// Store the product ID in a session variable
$_SESSION['product_id'] = intval($id);
$_SESSION['currentProductId'] = $_GET['productId'];

// Initialize the products session array if it doesn't exist
if (!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Fetch product details from the API using file_get_contents
$input = file_get_contents("http://localhost/e-commerce/backend/productapi/getbyid.php?id=$id");
$result = json_decode($input, true);
$showImage = $result['image'];

// Check for a discount in the database
$discountQuery = $conn->prepare("SELECT discount_amount FROM discount WHERE product_id = ?");
$discountQuery->bind_param("i", $id);
$discountQuery->execute();
$discountResult = $discountQuery->get_result();
$discountAmount = 0;

// If a discount is found, store the discount amount
if ($discountResult->num_rows > 0) {
    $discountRow = $discountResult->fetch_assoc();
    $discountAmount = $discountRow['discount_amount'];
}

$discountQuery->close();

// Calculate the final price after applying the discount (if any)
$originalPrice = $result['price'];
$finalPrice = $originalPrice - ($originalPrice * ($discountAmount));

// Handle the form submission when the user adds the product to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qua'])) {
    $quantity = $_POST['qua'];
    $productId = $result['id'];

    // Store product details in an associative array
    $productInfo = [
        'id' => $productId,
        'name' => $result['name'],
        'price' => $finalPrice,  // Use the final (discounted) price
        'description' => $result['description'],
        'image' => $result['image'],
        'quantity' => $quantity,
        'isInDatabase' => false
    ];

    $productExists = false;

    // Check if the product already exists in the cart
    foreach ($_SESSION['products'] as &$product) {
        if ($product['id'] === $productId) {
            // If the product exists, increase the quantity
            $product['quantity'] += $quantity;
            $productExists = true;
            break;
        }
    }

    // If the product does not exist in the cart, add it
    if (!$productExists) {
        $_SESSION['products'][] = $productInfo;
    }

    // Return a success message as a JSON response
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

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
    // Include the navigation bar
    include '../backend/navAndFooter/navwithoutsearch.php';
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

                        <!-- Display the price based on whether there is a discount -->
                        <?php if ($discountAmount > 0): ?>
                            <h3 class="product-price">
                                $<?php echo number_format($finalPrice, 2); ?>
                            </h3>
                        <?php else: ?>
                            <h3 class="product-price">$<?php echo number_format($originalPrice, 2); ?></h3>
                        <?php endif; ?>

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
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <script>
        // JavaScript functions to handle quantity increase and decrease
        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }
    </script>

    <?php
    // Include the footer
    include '../backend/navAndFooter/footer.php';
    ?>

</body>

</html>