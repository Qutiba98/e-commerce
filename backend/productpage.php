

<?php
include 'db.php';
session_start();

$id = $_GET['productId'] ? $_GET['productId'] : "";
$_SESSION['currentProductId'] = $id;

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

    echo json_encode(['status' => 'success', 'message' => 'Product added to cart!']);
    exit();
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
    <link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../frontend/css/font-awesome.min.css">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/style.css"/>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Your existing CSS */
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
            background-color: black;
            color: black;
            transition: background-color 0.3s, transform 0.3s;
            margin :0
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
    </style>
</head>
<body>
    <?php include './nav&footr/nav.php'; ?>

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
                        <form id="addToCartForm">
                            <div class="quantity">
                                <button type="button" class="qty-btn" onclick="decreaseQuantity()">-</button>
                                <input type="text" id="quantity" name="qua" value="1">
                                <button type="button" class="qty-btn" onclick="increaseQuantity()">+</button>
                            </div>
                            <!-- /Quantity -->
   
                            <br>
                            <!-- Add to Cart Button -->
                            <div class="product-actions">
                                <button type="submit" class="btn" style="background-color: #D10024; border-color: #D10024; color: #fff;">
                                    Add to Cart
                                </button>
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

    <!-- FOOTER -->
    <footer id="footer">
        <!-- Your footer content -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="../frontend/js/jquery.min.js"></script>
    <script src="../frontend/js/bootstrap.min.js"></script>
    <script src="../frontend/js/slick.min.js"></script>
    <script src="../frontend/js/nouislider.min.js"></script>
    <script src="../frontend/js/jquery.zoom.min.js"></script>
    <script src="../frontend/js/main.js"></script>

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
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'swal-custom-button'
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was a problem adding the product to the cart.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'swal-custom-button'
                                }
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was a problem with the server. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'swal-custom-button'
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
