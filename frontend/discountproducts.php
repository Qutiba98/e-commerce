<!-- Updated HTML Code -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discounted Products</title>
    <link rel="stylesheet" href="discountproducts.css"> <!-- Link to the CSS file -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li>
                        <a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a>
                    </li>
                </ul>
                <ul class="header-links pull-right">
                    <li>
                        <a href="#"><i class="fa fa-dollar"></i> USD</a>
                    </li>
                    <li>
                        <a href="../backend/userProfile/veiw.php"><i class="fa fa-user-o"></i> My Account</a>
                    </li>
                </ul>
            </div>
        </div>

          <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Home -->
                <div class="col-md-6 ">
                    <div class=" home-icon">
                        <a href="index.html">
                            <i class="fa fa-home homestyle"></i><br>
                            <span>Home</span>
                        </a>
                    </div>
                </div>
                <!-- /Home -->

                <!-- Cart -->
                <div class="col-md-6 clearfix">
                    <div class="header-ctn cart-icon">
                        <div class="dropdown cart-icon">
                            <a href="cart.html">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">3</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Cart -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /MAIN HEADER -->

        <div class="discount-section">
            <div class="container">
                <h1>Discounted Products</h1>
                <div class="grid">

                    <?php
                    // Database configuration
                    $host = 'localhost';
                    $dbname = 'e-commerce';
                    $user = 'root';
                    $pass = '';

                    // Create a connection to the MySQL database
                    $conn = new mysqli($host, $user, $pass, $dbname);

                    // Check the connection
                    if ($conn->connect_error) {
                        die('Connection failed: ' . $conn->connect_error);
                    }

                    // Fetch discounted products from the database
                    $sql = "SELECT d.id, p.name, p.price, p.image, d.discount_amount
                            FROM discount d
                            JOIN product p ON d.product_id = p.id";
                    $result = $conn->query($sql);

                    // Check if the query was successful
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            // Calculate the discounted price
                            $originalPrice = $row['price'];
                            $discountAmount = $row['discount_amount'];
                            $discountedPrice = $originalPrice * $discountAmount;


                            echo '<div class="card">';
                            echo '<img src="./images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '<div class="card-content">';
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<p class="price">$' . number_format($originalPrice, 2) . '</p>';
                            echo '<p class="discount">Discount: $' . number_format($discountAmount, 2) . '</p>';
                            echo '<p class="sale-price">Sale Price: $' . number_format($discountedPrice, 2) . '</p>';
                            echo '<form action="add_to_cart.php" method="POST">'; // Form to add to cart
                            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($row['name']) . '">';
                            echo '<input type="hidden" name="product_price" value="' . $discountedPrice . '">';
                            echo '<input type="hidden" name="product_image" value="' . htmlspecialchars($row['image']) . '">';
                            echo '<button type="submit" class="button">Add to Cart</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No discounted products found.</p>';
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </header>
</body>

</html>