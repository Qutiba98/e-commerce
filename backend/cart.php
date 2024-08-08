<?php
// try group by and user id product id
require "./connection_db_pdo.php";
session_start();
$totalPrice = 0;
$isEmptyDatabase = true;
$isEmptySesstion = false;
$discountCode = isset($_POST["discountCode"]) ? $_POST["discountCode"] : "";
$id = 0;
$_SESSION['cartId'] = isset($_SESSION['user_id']) ? ($_SESSION['user_id']) : "";
$user_id = isset($_SESSION['user_id']) ? ($_SESSION['user_id']) : "";
// $input = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/cartApi/cartFetchData.php?id=21");
$_SESSION['products'] = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$_SESSION['currentProductId'] = isset($_SESSION['currentProductId']) ? $_SESSION['currentProductId'] : "";
$result = $_SESSION['products'];

// change it to make the things appear
// $_SESSION['user'] ;
// $cartId = isset($_SESSION['user_id']) ? isset($_SESSION['user_id']) : ""; // Example cartId ------- change it
$cartId = $_SESSION['cartId'];
// echo $_SESSION['user_id'];
$productId = $_SESSION['currentProductId']; // Example productId
$registerd = false;


if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
  $registerd = true;

  // Ensure that the quantity is properly assigned from the session
  foreach ($result as &$row) {
    $productId = $row['id'];
    $quantity = isset($row['quantity']) ? $row['quantity'] : 0;
    $checkSql = "SELECT COUNT(*) FROM cart_product WHERE cart_id = '$cartId' AND product_id = '$productId'";
    $stmt = $conn->prepare($checkSql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if (!$row['isInDatabase']) {

      if ($count == 0) {
        $sql = "INSERT INTO cart_product (cart_id, product_id, quantity) VALUES ('$cartId', '$productId', '$quantity')";
        $res = $conn->exec($sql);
        $row['isInDatabase'] = true;
        $isEmptyDatabase = false;
      } else {
        // Product exists, update the quantity
        $sql = "UPDATE cart_product 
                SET quantity = quantity + '$quantity' 
                WHERE cart_id = '$cartId' AND product_id = '$productId'";
        $res = $conn->exec($sql);
        $row['isInDatabase'] = true;
        $isEmptyDatabase = false;
      }
    }
  }


  // Remove products that are in the database from the session
  foreach ($result as $key => $row) {
    unset($_SESSION['products'][$key]);
    $isEmptySesstion = false;
  }

  // dont forget to make dynamic based on id of the user
  if ($_SESSION['user_id']) {

    $cartFromDatabase = file_get_contents("http://localhost/e-commerce/backend/cartApi/cartFetchData.php?id=$user_id");
    $cartData = json_decode($cartFromDatabase, true);
    // var_dump($cartData);
    // var_dump($cartData);
    foreach ($cartData as $row) {
      // Ensure quantity and price are integers and floats respectively
      $quantity = intval($row['quantity']);
      $price = floatval($row['price']);

      // If quantity is greater than 0, multiply price by quantity and add to total
      if ($quantity > 0) {
        $totalPrice += $quantity * $price;
      }
    }
    // echo  $totalPrice;
    // Prepare the SQL statement discount sec ---------------
    $stmt = $conn->prepare("SELECT precantage FROM discount_copon WHERE discount_code = :discountCode");
    $stmt->bindParam(':discountCode', $discountCode);

    // Execute the query for 
    if ($stmt->execute()) {

      $precantage = $stmt->fetch(PDO::FETCH_ASSOC);

      // Check if a result was returned
      if ($precantage !== false) {

        $totalPriceAfter = $totalPrice - ($precantage['precantage'] * $totalPrice);
        $_SESSION['total'] = $totalPriceAfter;
        // Print result for debugging
        // print_r($totalPriceAfter);
      } else {
        // Handle the case where no discount was found
        $dicountErr = "No discount found for the provided code.";
      }
    }
  }
  // var_dump($cartFromDatabase);
  // if(empty($cartFromDatabase)){
  //   echo 'entered if';
  //   $isEmptyDatabase = true;
  // }
  $cartFromDatabase = json_decode($cartFromDatabase, true);
}

// var_dump($isEmptyDatabase);
// var_dump($isEmptySesstion);







// Optionally reindex the session array to avoid gaps in the keys
if (isset($_SESSION['products']))
  $_SESSION['products'] = array_values($_SESSION['products']); // 0  1
// if(isset($_SESSION['products']))
// $isEmpty = true;

// var_dump($isEmpty);
?>

<!DOCTYPE html>
<html lang="en" style="font-size: 14px">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    #bigFont {
      font-size: 1rem !important;
    }

    .empty-cart {
      /* color: #d10024; Red color */
      /* background-color: #15161d; Dark blue background */
      /* border:1px solid black; */
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      font-size: 1.5em;
      font-weight: bold;
      margin: 20px auto;
      max-width: 400px;
      height: 30vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Electro - HTML Ecommerce Template</title>
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css" />

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css" />
  <!-- MDB -->
  <link rel="stylesheet" href="../frontend/css/mdb.min.css" />
  <!-- nouislider -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="../frontend/css/font-awesome.min.css" />

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/style.css" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    .h-100 {
      height: auto !important;
    }

    .totalPriceStyle {
      color: black;
      /* Red color */
      font-size: 14px;
      /* Font size */
      background-color: white;
      /* Dark blue background */
      padding: 10px 20px;
      /* Padding around the text */
      border-radius: 5px;
      /* Rounded corners */
      margin-top: 20px;
      /* Margin at the top */

    }

    .emptyCartImage {
      width: 50px;
    }
  </style>
</head>

<body>
  <header>
    <!-- TOP HEADER -->
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li><a href="#"><i class="fa fa-phone"></i> +962-779-199-880</a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> Electrospark@gmail.com</a></li>
          <li><a href="#"><i class="fa fa-map-marker"></i> Amman-Jordan</a></li>
        </ul>
        <ul class="header-links pull-right">
          <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) :  ?>
            <li><a href="http://localhost/e-commerce/backend/logout.php"><i class="fa fa-dollar"></i> Logout</a></li>
          <?php endif; ?>
          <?php if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) :  ?>
            <li><a href="http://localhost/e-commerce/backend/login.php"><i class="fa fa-dollar"></i> login</a></li>
          <?php endif; ?>
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
                <img src="./img/logo.png" alt="" />
              </a>
            </div>
          </div>
          <!-- /LOGO -->

          <!-- SEARCH BAR -->
          <div class="col-md-6">
            <div class="header-search">
              <form>
                <select class="input-select" id="category-select">
                  <option value="0" data-url="#">All Categories</option>
                  <?php
                  foreach ($categoryData as $category) {
                    echo '<option value="' . htmlspecialchars($category['id']) . '" data-url="http://localhost/e-commerce/backend/store.php?category=' . htmlspecialchars($category['id']) . '">'
                      . htmlspecialchars($category['name']) . '</option>';
                  }
                  ?>
                </select>
                <input class="input" placeholder="Search here" />
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
                  <span></span>
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
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /MAIN HEADER -->
  </header>
  <!-- /HEADER -->




  <!-- BREADCRUMB -->
  <div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb-tree">
            <li><a href="http://localhost/e-commerce/backend/">Home</a></li>
            <li><a href="http://localhost/e-commerce/backend/store.php?page=4#">Category</a></li>
            <li class="active">Cart</li>
          </ul>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /BREADCRUMB -->





  <!-- start of cart des _______________________________________________________________________ -->

  <section class="h-100">
    <div class="container h-100 py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-10">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-normal mb-0">Shopping Cart</h3>

          </div>
          <form action="http://localhost/e-commerce/backend/cart.php" method="POST">
            <?php if (!$registerd) : ?>
              <?php $isEmptyDatabase = false; ?>
              <?php foreach ($result as $row) : ?>
                <div class="card rounded-3 mb-4">
                  <div class="card-body p-4">
                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img src="images/<?php echo $row['image'] ?>" class="img-fluid rounded-3" alt="Cotton T-shirt" />
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead fw-normal mb-2"><?php echo $row['name'] ?></p>
                        <p>
                          <span class="text-muted">description: <?php echo $row['description'] ?> </span>

                        </p>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0">$<?php echo $row['price'] ?> </h5>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <?php
                        if ($registerd) : ?>
                          <a href="http://localhost/e-commerce/backend/cartapi/deleteFromCart.php?product_id=<?php echo $row['productId'] ?>" class="text-danger"><i class="fas fa-trash fa-lg">
                            </i>
                          <?php endif; ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <?php foreach ($cartFromDatabase as $row) : ?>
                <div class="card rounded-3 mb-4">
                  <div class="card-body p-4">
                    <div class="row d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img src="images/<?php echo $row['image'] ?>" class="img-fluid rounded-3" alt="Cotton T-shirt" />
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <p class="lead fw-normal mb-2"><?php echo $row['name'] ?></p>
                        <p>
                          <span class="text-muted">description: <?php echo $row['description'] ?> </span>

                        </p>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <span class="text-muted">Quantity: <?php echo $row['quantity'] ?> </span>

                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0"><?php
                                          if ($row['quantity'] > 0)
                                            echo $row['price'] * ($row['quantity']) . "$" ?>
                          <?php
                          if ($row['quantity'] == 0)
                            echo $row['price'] . "$"  ?> </h5>

                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <?php
                        if ($registerd) : ?>
                          <a href="http://localhost/e-commerce/backend/cartapi/deleteFromCart.php?productId=<?php echo $row['productId'] ?>" class="text-danger"><i class="fas fa-trash fa-lg">

                            </i>
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
            <!-- <?php
                  if ($registerd) : ?>
            <?php
                    if ($isEmptyDatabase && !$isEmptySesstion) : ?>
                  <div class="empty-cart">
                    <img class="emptyCartImage" src="../backend/images/emptycart.png" alt="">empty cart
                  </div>
                    <?php endif; ?>
                    <?php endif; ?>
            <?php
            if (!$registerd) : ?>
            <?php
              if ($isEmptyDatabase) : ?>
                  <div class="empty-cart">
                    <img class="emptyCartImage" src="../backend/images/emptycart.png" alt="">empty cart
                  </div>
                    <?php endif; ?>
                    <?php endif; ?> -->

            <div class="card mb-4">
              <div class="card-body p-4 d-flex flex-row">
                <div data-mdb-input-init class="form-outline flex-fill">
                  <form action="../backend/cart.php" method="POST">


                    <input type="text" id="form1" name="discountCode" class="form-control form-control-lg" />
                    <label class="form-label" for="form1">Discound code</label>
                </div>
                <button type="submit" class="btn btn-outline-warning btn-lg ms-3">
                  Apply
                </button>
          </form>
        </div>
        <span><?php echo isset($discountErr) ? htmlspecialchars($discountErr) : ''; ?></span>
        <?php
        if (!empty($totalPriceAfter)) : ?>
          <div class="totalPriceStyle "> total after discount :
            <?php echo number_format($totalPriceAfter, 2) ?>
          </div>
        <?php endif; ?>
        <div class="totalPriceStyle">Total price :
          <?php echo $totalPrice ?>
        </div>
        <!-- hidden input to pass the values only  -->
        <input type="text" name="afterDiscount" value="<?php echo $totalPrice ?>" style="display : none;">
        <input type="text" name="beforeDiscount" value="<?php echo $totalPriceAfter ?>" style="display : none;">





        <!-- /hidden input to pass the values only  -->
      </div>

      <div class="card">
        <div class="card-body">
          <a href="./checkout.php">
            <button href="./admin_create_user.php" type="submit" class="btn btn-warning btn-block btn-lg" value="Proceed to Pay"> check out </button>
          </a>

        </div>
      </div>
    </div>
    </div>
    </div>
    </form>
  </section>
  <!-- end of cart des _______________________________________________________________________ -->



  <!-- FOOTER -->
  <?php

  require '../frontend/footer.php';

  ?>
  <!-- /FOOTER -->

  <!-- jQuery Plugins -->
  <script src="../frontend/js/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
  <script src="../frontend/js/slick.min.js"></script>
  <script src="../frontend/js/nouislider.min.js"></script>
  <script src="../frontend/js/jquery.zoom.min.js"></script>
  <!-- MDB -->
  <script type="text/javascript" src="../frontend/js/mdb.umd.min.js"></script>
  <!--  -->
  <script src="js/main.js"></script>
</body>

</html>