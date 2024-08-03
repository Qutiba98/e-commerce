
<?php 
require "./connection_db_pdo.php";
session_start();
$id = 0;
$input = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/cartApi/cartFetchData.php?id=21");
// $result = json_decode($input,true);
// unset($_SESSION['products'][0]);
$registerd = false;
$result = $_SESSION['products'];
$_SESSION['user'] = 1;
// var_dump($result);
// unset($result);
$cartId = 21; // Example cartId
    $productId = 54;
    // here to check if the item aleardy in database
if(isset($_SESSION['user'])){
  $registerd = true;
  foreach($result as &$row){
    if( !$row['isInDatabase'] ){
      
    $sql = "INSERT INTO cart_product (`cart_id`, `product_id`) VALUES ('$cartId', '$productId');";
    $res = $conn -> exec($sql); 
      $row['isInDatabase'] = true;
    }
  }
}

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
    </style>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google font -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700"
      rel="stylesheet"
    />

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
  </head>
  <body>
    <!-- HEADER -->
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
              <a href="#"
                ><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a
              >
            </li>
          </ul>
          <ul class="header-links pull-right">
            <li>
              <a href="#"><i class="fa fa-dollar"></i> USD</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-user-o"></i> My Account</a>
            </li>
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
                  <select class="input-select">
                    <option value="0">All Categories</option>
                    <option value="1">Category 01</option>
                    <option value="1">Category 02</option>
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
                    <i class="fa fa-heart-o"></i>
                    <span>Your Wishlist</span>
                    <div class="qty">2</div>
                  </a>
                </div>
                <!-- /Wishlist -->

                <!-- Cart -->
                <div class="dropdown">
                  <a
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    aria-expanded="true"
                  >
                    <i class="fa fa-shopping-cart"></i>
                    <span>Your Cart</span>
                    <div class="qty">3</div>
                  </a>
                  <div class="cart-dropdown">
                    <div class="cart-list">
                      <div class="product-widget">
                        <div class="product-img">
                          <img src="./img/product01.png" alt="" />
                        </div>
                        <div class="product-body">
                          <h3 class="product-name">
                            <a href="#">product name goes here</a>
                          </h3>
                          <h4 class="product-price">
                            <span class="qty">1x</span>$980.00
                          </h4>
                        </div>
                        <button class="delete">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>

                      <div class="product-widget">
                        <div class="product-img">
                          <img src="./img/product02.png" alt="" />
                        </div>
                        <div class="product-body">
                          <h3 class="product-name">
                            <a href="#">product name goes here</a>
                          </h3>
                          <h4 class="product-price">
                            <span class="qty">3x</span>$980.00
                          </h4>
                        </div>
                        <button class="delete">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>
                    </div>
                    <div class="cart-summary">
                      <small>3 Item(s) selected</small>
                      <h5>SUBTOTAL: $2940.00</h5>
                    </div>
                    <div class="cart-btns">
                      <a href="#">View Cart</a>
                      <a href="#"
                        >Checkout <i class="fa fa-arrow-circle-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
                <!-- /Cart -->

                <!-- Menu Toogle -->
                <div class="menu-toggle">
                  <a href="#">
                    <i class="fa fa-bars"></i>
                    <span>Menu</span>
                  </a>
                </div>
                <!-- /Menu Toogle -->
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

    <!-- start of cart des _______________________________________________________________________ -->
    
    <section class="h-100">
      <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="fw-normal mb-0">Shopping Cart</h3>
              <div>
                <p class="mb-0">
                  <span class="text-muted">Sort by:</span>
                  <a href="#!" class="text-body"
                    >price <i class="fas fa-angle-down mt-1"></i
                  ></a>
                </p>
              </div>
            </div>
            <!-- <form action="http://127.0.0.1/brief%203/e-commerce/backend/cart.php" method="POST"> -->
            <?php foreach($result as $row): ?>
                <?php
                $showImage=$row['image'];
                     ?>
                     
                
            <div class="card rounded-3 mb-4">
              <div class="card-body p-4">
                <div
                  class="row d-flex justify-content-between align-items-center"
                >
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <img
                      src="images/<?php echo $showImage ?>"
                      class="img-fluid rounded-3"
                      alt="Cotton T-shirt"
                    />
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
                  if ($registerd): ?>
                      <a href="" class="text-danger"
                        ><i class="fas fa-trash fa-lg">
                          </i
                    >
                    <?php endif; ?></a>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>

            <div class="card mb-4">
              <div class="card-body p-4 d-flex flex-row">
                <div data-mdb-input-init class="form-outline flex-fill">
                  <input
                    type="text"
                    id="form1"
                    class="form-control form-control-lg"
                  />
                  <label class="form-label" for="form1">Discound code</label>
                </div>
                <button
                  type="button"
                  data-mdb-button-init
                  data-mdb-ripple-init
                  class="btn btn-outline-warning btn-lg ms-3"
                >
                  Apply
                </button>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <a href="./checkout.php">
                <button
              href="./admin_create_user.php"
    type="submit"

    class="btn btn-warning btn-block btn-lg"
    value="Proceed to Pay"
  > procc </button>
                </a>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </form> -->
    </section>
    <!-- end of cart des _______________________________________________________________________ -->
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <h3 class="breadcrumb-header">Regular Page</h3>
            <ul class="breadcrumb-tree">
              <li><a href="#">Home</a></li>
              <li class="active">Blank</li>
            </ul>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    

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
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut.
                </p>
                <ul class="footer-links">
                  <li>
                    <a href="#"
                      ><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a
                    >
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a>
                  </li>
                  <li>
                    <a href="#"
                      ><i class="fa fa-envelope-o"></i>email@email.com</a
                    >
                  </li>
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
                <li>
                  <a href="#"><i class="fa fa-cc-visa"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-credit-card"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-paypal"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-mastercard"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-discover"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-cc-amex"></i></a>
                </li>
              </ul>
              <span class="copyright">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved | This template is made with
                <i class="fa fa-heart-o" aria-hidden="true"></i> by
                <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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
    <!-- MDB -->
    <script type="text/javascript" src="../frontend/js/mdb.umd.min.js"></script>
    <!--  -->
    <script src="js/main.js"></script>
  </body>
</html>