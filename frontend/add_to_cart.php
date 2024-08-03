<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve product details from POST data
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image'];

    // Create a product array
    $product = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage
    );

    // Initialize cart in session if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }


    // Check if the product is already in the cart
    $product_exists = false;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['id'] === $product['id']) {
            $product_exists = true;
            break;
        }
    }

    // Add product to cart if it's not already there
    if (!$product_exists) {
        $_SESSION['cart'][] = $product;
        echo "Product added to cart!";
    } else {
        echo "Product is already in the cart!";
    }




    // header('Location: discountproducts.php');
    exit();
}
