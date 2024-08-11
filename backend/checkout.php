<?php
require "../backend/connection_db_pdo.php";
session_start();
// var_dump($_SESSION['total']);
$totalpriceFromCart = $_SESSION['total'];
// echo $totalpriceFromCart;
if (empty($_SESSION['user_id'])) {
    header('Location: http://localhost/e-commerce/backend/login.php');
    exit();
}
$_SESSION['cart_id'] = $_SESSION['user_id'];
// echo $_SESSION['total'];
// Enable error reporting for debugging
$_SESSION['emptyCart'] = false;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$firstNameErr = $lastNameErr = $emailErr = $addressErr = $cityErr = $countryErr = $telephoneErr = "";
$flag = true;
$firstName = $lastName = $email = $address = $city = $country =  $tel = "";
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



    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : "";
    if (empty($tel) || !preg_match("/^\+?[0-9]{10,15}$/", $tel)) {
        $telephoneErr = "Valid telephone number is required";
        $flag = false;
    }

    if ($flag) {
        // Calculate total amount from cart
        // $total = 0;
        // if (!empty($_SESSION['cart'])) {
        //     foreach ($_SESSION['cart'] as $item) {
        //         if (isset($item['price']) && isset($item['quantity'])) {
        //             $total += $item['price'] * $item['quantity'];
        //         }
        //     }
        // }

        // Insert order into database
        try {
            // Prepare and execute the INSERT query
            $sql = "INSERT INTO payment_recipe (payment_date, first_name, last_name, email, address, city, country, telephone, amount, cart_id) 
                    VALUES (CURRENT_TIMESTAMP(), :firstName, :lastName, :email, :address, :city, :country,  :tel, :amount, :cartId)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':firstName' => $firstName,
                ':lastName' => $lastName,
                ':email' => $email,
                ':address' => $address,
                ':city' => $city,
                ':country' => $country,
                ':tel' => $tel,
                ':amount' => $_SESSION['total'],
                ':cartId' => $_SESSION['cart_id'] // Adjust or retrieve dynamically
            ]);

            // Prepare and execute the DELETE query
            $deleteFromCart = "DELETE FROM cart_product WHERE cart_id = :cartId";
            $deleteStmt = $conn->prepare($deleteFromCart);
            $deleteStmt->execute([':cartId' => $_SESSION['user_id']]);
            echo "
            <script>
alert('Payment Success');
window.location.href='http://localhost/e-commerce/backend/index.php';
</script>
            ";
            // header('Location: http://localhost/e-commerce/backend/index.php');

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
    echo "";
}
$id = $_SESSION['user_id'];
// fetch data from cart  -------------------------- make it dynamic
$input = file_get_contents("http://localhost/e-commerce/backend/cartApi/cartFetchData.php?id=$id");
$result = json_decode($input, true);
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
    <link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../frontend/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../frontend/css/style.css" />
    <style>
        .error {
            color: red;
        }
    </style>
    <?php require '../backend/navAndFooter/navwithoutsearch.php' ?>

</head>

<body>









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

                                                <p></p>
                                            <?php endforeach; ?>
                                            <p>Total Price: <b>
                                                    <?php
                                                    if (isset($_SESSION['totalPriceAfter']) && $_SESSION['totalPriceAfter']  > 0):

                                                        echo htmlspecialchars(number_format(floatval($_SESSION['totalPriceAfter']), 2)); ?>
                                                </b>
                                                <!-- <del><?php
                                                            echo htmlspecialchars(number_format($_SESSION['total'], 2));
                                                            // $totalpriceFromCart += $row['quantity'] *$row['price'];

                                                            ?></del> -->
                                            <?php else: ?>

                                                <?php
                                                        echo htmlspecialchars(number_format($totalpriceFromCart, 2));

                                                ?>
                                            <?php endif; ?>

                                            </p>
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

    <?php require '../backend/navAndFooter/footer.php' ?>
    <!-- jQuery Plugins -->
    <script src="../frontend/js/jquery.min.js"></script>
    <script src="../frontend/js/bootstrap.min.js"></script>
    <script src="../frontend/js/slick.min.js"></script>
    <script src="../frontend/js/nouislider.min.js"></script>
    <script src="../frontend/js/main.js"></script>
</body>

</html>