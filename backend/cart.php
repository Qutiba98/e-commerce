<?php
// اتصال بقاعدة البيانات وبدء الجلسة
require "./connection_db_pdo.php";
session_start();
$_SESSION['totalPriceAfter']  = isset($_SESSION['totalPriceAfter'] ) ?$_SESSION['totalPriceAfter']  :"";
if (isset($_POST['delete_product'])) {
  $productIdToDelete = $_POST['product_id'];

  // Loop through the products in the session and remove the one with the matching ID
  foreach ($_SESSION['products'] as $key => $product) {
      if ($product['id'] == $productIdToDelete) {
          unset($_SESSION['products'][$key]);
          // Reindex the array to avoid gaps in the keys
          $_SESSION['products'] = array_values($_SESSION['products']);
          break;
      }
  }
}
$isEmptyDatabase = true;
$isEmptySesstion = false;
$discountCode = isset($_POST["discountCode"]) ? $_POST["discountCode"] : "";
$id = 0;
$_SESSION['cartId'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
$_SESSION['products'] = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$_SESSION['currentProductId'] = isset($_SESSION['currentProductId']) ? $_SESSION['currentProductId'] : "";
$result = $_SESSION['products'];
$cartId = $_SESSION['cartId'];

// $productId = $_SESSION['currentProductId'];
$registerd = false;

// Initialize the total price
$totalPrice = isset($totalPrice) ? $totalPrice : 0;
// var_dump($_SESSION['products']);

// Get the total price if the user is not logged in
if (!$registerd) {
    if (isset($_SESSION['products'])) {
      // echo "entered products";
      // Loop through each product in the session
      foreach ($_SESSION['products'] as $product) {
          // echo "entered products";
            // Calculate the total price for each product (price * quantity)
            $totalPrice += (float)$product['price'] * (int)$product['quantity'];
          }
        }
      }
    //   if ($totalPrice > 0) {
    //     $_SESSION['total'] = $totalPrice;
    // } else {
    //   $productIdSum =$_SESSION['product_id'];
    //     $sql = "SELECT SUM(product.price) as totalPrice
    //             FROM cart_product
    //             INNER JOIN product ON product.id = cart_product.product_id
    //             WHERE cart_product.product_id = '$productIdSum'";
        
    //     $resultOfSum = $conn->query($sql);
    //     $rows = $resultOfSum->fetchAll(PDO::FETCH_ASSOC);
    //     var_dump($rows);
    //     foreach ($rows as $row) {
    //       $totalPrice = $row['totalPrice']; // Sum up the total price for all products
    //   }
        
    //         // $_SESSION['total'] = $totalPrice;
            
      
    //     var_dump( $totalPrice);
    // }
// Check if the 'products' session is set and not empty
// if (isset($_SESSION['products']) && !empty($_SESSION['products'])) {
//   foreach ($_SESSION['products'] as $key => $product) {
//       // Check if the 'isInDatabase' key is false
//       if (isset($product['isInDatabase']) && $product['isInDatabase'] === false) {
//           // Remove the product from the session
//           unset($_SESSION['products'][$key]);
//       }
//   }
  
//   // Re-index the session array to remove any gaps in the keys
//   $_SESSION['products'] = array_values($_SESSION['products']);
// }
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $registerd = true;

    // تأكد من أن الكمية يتم تعيينها بشكل صحيح من الجلسة
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
                $conn->exec($sql);
                $row['isInDatabase'] = true;
                $isEmptyDatabase = false;
            } else {
                $sql = "UPDATE cart_product SET quantity = quantity + '$quantity' WHERE cart_id = '$cartId' AND product_id = '$productId'";
                $conn->exec($sql);
                $row['isInDatabase'] = true;
                $isEmptyDatabase = false;
            }
        }
    }

    // إزالة المنتجات التي تم إدخالها في قاعدة البيانات من الجلسة
    foreach ($result as $key => $row) {
        unset($_SESSION['products'][$key]);
        $isEmptySesstion = false;
    }
    // جلب بيانات السلة من قاعدة البيانات
    if (isset($_SESSION['user_id'])) {
        $cartFromDatabase = file_get_contents("http://localhost/e-commerce/backend/cartApi/cartFetchData.php?id=$user_id");
        $cartData = json_decode($cartFromDatabase, true);

        foreach ($cartData as $row) {
            $quantity = intval($row['quantity']);
            $price = floatval($row['price']);

            if ($quantity > 0) {
                $totalPrice += $quantity * $price;
            }
        }
        // تطبيق الكود الخصم إذا كان موجودًا
        $stmt = $conn->prepare("SELECT precantage FROM discount_copon WHERE discount_code = :discountCode");
        $stmt->bindParam(':discountCode', $discountCode);
        $_SESSION['totalPriceAfter'] = isset($_SESSION['totalPriceAfter']) ? $_SESSION['totalPriceAfter'] :"";
        $_SESSION['total'] = $totalPrice;
        if ($stmt->execute()) {
            $precantage = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($precantage !== false) {
                $discountAmount = ($precantage['precantage'] /100 ) * $totalPrice;
                // var_dump($totalPrice);
                $totalPriceAfter  = $totalPrice- $discountAmount;
                // var_dump($totalPriceAfter);
                $_SESSION['totalPriceAfter'] = $totalPriceAfter;
                // unset($_SESSION['totalPriceAfter']);
              } else {
                
                $dicountErr = "No discount found for the provided code.";
              }
            }
          }
          $cartFromDatabase = json_decode($cartFromDatabase, true);
        }
        // echo $_SESSION['totalPriceAfter'];
// unset( $_SESSION['totalPriceAfter']);



if (isset($_SESSION['products'])) {
    $_SESSION['products'] = array_values($_SESSION['products']);
}
?>


<!DOCTYPE html>
<html lang="en" style="font-size: 14px">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    #bigFont { font-size: 1rem !important; }
    .empty-cart {
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
    .h-100 { height: auto !important; }
    .totalPriceStyle {
      color: black;
      font-weight: bold;
      font-size: 18px;
      background-color: white;
      padding: 10px 20px;
      border-radius: 5px;
      margin-top: 20px;
    }
    .emptyCartImage { width: 50px; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .form-outline {
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    .form-control { margin-bottom: 10px; }
    .btn { width: 100%; }
    .quantity-controls {
      display: flex;
      align-items: center;
    }
    .quantity-controls button {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      padding: 5px 10px;
      cursor: pointer;
    }
    .quantity-controls input {
      text-align: center;
      width: 50px;
      border: 1px solid #ced4da;
      margin: 0 5px; /* Add space between the input and buttons */
    }
    .quantity-controls button:hover {
      background-color: #e9ecef;
    }
    .btn-red {
      background-color: #dc3545;
      color: white;
      border: none;
    }
    .btn-red:hover {
      background-color: #c82333;
    }
  </style>
  <title>Electro - HTML Ecommerce Template</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css" />
  <link rel="stylesheet" href="../frontend/css/mdb.min.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/nouislider.min.css" />
  <link rel="stylesheet" href="../frontend/css/font-awesome.min.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <header>
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
    <div id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="header-logo">
              <a href="#" class="logo">
                <img src="./img/logo.png" alt="" />
              </a>
            </div>
          </div>
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
          <div class="col-md-3 clearfix">
            <div class="header-ctn">
              <div>
                <a href="#">
                  <span></span>
                </a>
              </div>
              <div>
                <a href="./cart.php">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Your Cart</span>
                  <div class="qty">3</div>
                </a>
              </div>
              <div class="menu-toggle">
                <a href="#">
                  <i class="fa fa-bars"></i>
                  <span>Menu</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div id="breadcrumb" class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb-tree">
            <li><a href="http://localhost/e-commerce/backend/">Home</a></li>
            <li><a href="http://localhost/e-commerce/backend/store.php?page=4#">Category</a></li>
            <li class="active">Cart</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
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
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex quantity-controls">
                        <button type="button" class="btn-decrease">-</button>
                        <input type="number" class="form-control quantity" value="<?php echo $row['quantity'] ?>" min="1">
                        <button type="button" class="btn-increase">+</button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0 price" data-price="<?php echo $row['price'] ?>">$<?php echo $row['price'] * $row['quantity'] ?> </h5>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        
                        <?php if (!$registerd) : ?>
                          <form action="" method="POST" style="display:inline;">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <button type="submit" name="delete_product" class="btn btn-link text-danger p-0 m-0"><i class="fas fa-trash fa-lg"></i></button>
</form>

                        <?php endif; ?>
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
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex quantity-controls">
                        <button type="button" class="btn-decrease">-</button>
                        <input type="text" class="form-control quantity" value="<?php echo $row['quantity'] ?>" min="1">
                        <button type="button" class="btn-increase">+</button>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                        <h5 class="mb-0 price" data-price="<?php echo $row['price'] ?>">$<?php echo $row['price'] * $row['quantity'] ?> </h5>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <?php if ($registerd) : ?>
                          <a href="http://localhost/e-commerce/backend/cartapi/deleteFromCart.php?productId=<?php echo $row['productId'] ?>" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
            <div class="card mb-4">
              <form action="../backend/cart.php" method="POST">
                <?php if($registerd): ?>
              <div class="card-body p-4 d-flex flex-row">
                <div data-mdb-input-init class="form-outline flex-fill">
                    <input type="text" id="form1" name="discountCode" class="form-control form-control-lg" />
                    <label class="form-label" for="form1">Discount code</label>
                </div>
                <button type="submit" class="btn btn-warning btn-lg ms-3" style="width: 35%; background-color:#d10024">Apply</button>
              </div>
              <?php endif; ?>
              <span><?php echo isset($discountErr) ? htmlspecialchars($discountErr) : ''; ?></span>
              <?php if (!empty($totalPriceAfter)) : ?>
                <div class="totalPriceStyle">Total after discount: <?php echo number_format($totalPriceAfter, 2)?></div>
                <?php endif; ?>
              </form>
            <?php if($registerd): ?>
              <div class="totalPriceStyle">Total price: <span id="total-price"><?php echo number_format($totalPrice, 2)?></span></div>
              <input type="hidden" name="afterDiscount" value="<?php echo $_SESSION['total'] ?>" style="display : none;">
              <input type="hidden" name="beforeDiscount" value="<?php echo number_format($totalPriceAfter, 2) ?>" style="display : none;">
            </div>
            <?php endif; ?>
            <?php if(!$registerd): ?>
              <div class="totalPriceStyle">Total price: <span id="total-price"><?php echo $totalPrice ?></span></div>
              <input type="hidden" name="afterDiscount" value="<?php echo $_SESSION['total'] ?>" style="display : none;">
              <input type="hidden" name="beforeDiscount" value="<?php echo number_format($totalPriceAfter, 2) ?>" style="display : none;">
            </div>
            <?php endif; ?>
          <div class="card">
            <div class="card-body">
              <a href="./checkout.php">
                <button href="" type="submit" class="btn btn-warning btn-block btn-lg" value="Proceed to Pay"style=" background-color:#d10024">Check out</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <!-- Footer content -->
  </footer>
  <script src="../frontend/js/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
  <script src="../frontend/js/slick.min.js"></script>
  <script src="../frontend/js/nouislider.min.js"></script>
  <script src="../frontend/js/jquery.zoom.min.js"></script>
  <script type="text/javascript" src="../frontend/js/mdb.umd.min.js"></script>
  <script src="js/main.js"></script>
  <?php
  $alertMessage = "";
  $alertType = "error";
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['discountCode'])) {
    $stmt = $conn->prepare("SELECT precantage FROM discount_copon WHERE discount_code = :discountCode");
    $stmt->bindParam(':discountCode', $discountCode);
    if ($stmt->execute()) {
        $precantage = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($precantage !== false) {
            // $totalPriceAfter = $totalPrice - ($precantage['precantage'] * $totalPrice);
            $_SESSION['totalPriceAfter'] = $totalPriceAfter;
            $alertMessage = "Discount applied successfully! Total after discount: $" . number_format($totalPriceAfter,2);
            $alertType = "success";
        } else {
            $alertMessage = "No discount found for the provided code.";
            $alertType = "error";
        }
    }
  }
  ?>
  <section class="cart-section">
    <!-- Cart content -->
  </section>
  <script>
    <?php if (!empty($alertMessage)): ?>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertType === "success" ? "Success" : "Error"; ?>',
            text: '<?php echo $alertMessage; ?>',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'swal2-popup',
                title: 'swal2-title',
                icon: 'swal2-icon',
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel'
            }
        });
    <?php endif; ?>

    // JavaScript to handle quantity change and update price
    $(document).ready(function() {
      $('.btn-increase').click(function() {
        var $input = $(this).siblings('.quantity');
        var quantity = parseInt($input.val());
        $input.val(quantity + 1);
        updatePrice($(this));
      });

      $('.btn-decrease').click(function() {
        var $input = $(this).siblings('.quantity');
        var quantity = parseInt($input.val());
        if (quantity > 1) {
          $input.val(quantity - 1);
          updatePrice($(this));
        }
      });

      function updatePrice($element) {
        var $row = $element.closest('.row');
        var price = parseFloat($row.find('.price').data('price'));
        var quantity = parseInt($row.find('.quantity').val());
        var total = price * quantity;
        $row.find('.price').text('$' + total.toFixed(1));

        // Update total price
        var totalPrice = 0;
        $('.price').each(function() {
          totalPrice += parseFloat($(this).text().replace('$', ''));
        });
        $('#total-price').text(totalPrice.toFixed(1));
      }
    });
  </script>
</body>
</html>
