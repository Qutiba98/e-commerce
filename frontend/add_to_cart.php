<?php
session_start(); // Start the session

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $productId = intval($_POST['product_id']);
    $productName = htmlspecialchars($_POST['product_name']);
    $productPrice = floatval($_POST['product_price']);
    $productImage = htmlspecialchars($_POST['product_image']);

    // Create product array
    $product = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage
    );

    // Check if cart already exists in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to cart
    $_SESSION['cart'][] = $product;

    // Redirect to cart page
    // header('Location:discountpage.php');
    exit();
}
