<<<<<<< HEAD
<?php

=======

<?php 
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
session_start();

// $id=$_SESSION['user_id'];
//API 
$_SESSION['total'] = 0;
//qutiba
// $input0 = file_get_contents("http://localhost/pref%204/e-commerce/backend/products_API/read.php");
<<<<<<< HEAD
$input0 = file_get_contents("http://localhost/last/e-commerce/backend/products_API/read.php");
=======
$input0 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/products_API/read.php");
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$result0 = json_decode($input0, true);

//img pc 
// $input = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=54");
<<<<<<< HEAD
$input = file_get_contents("http://localhost/last/e-commerce/backend/productapi/getbyid.php?id=54");
=======
$input = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=54");
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$result = json_decode($input, true);
$showImage = $result['image'];


//img laptop 
// $input2 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=64");
<<<<<<< HEAD
$input2 = file_get_contents("http://localhost/last/e-commerce/backend/productapi/getbyid.php?id=64");
=======
$input2 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=64");
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$result2 = json_decode($input2, true);
$showImage2 = $result2['image'];


//img  Accessories 
<<<<<<< HEAD
$input3 = file_get_contents("http://localhost/last/e-commerce/backend/productapi/getbyid.php?id=69");
=======
$input3 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=69");
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
// $input3 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=69");
$result3 = json_decode($input3, true);
$showImage3 = $result3['image'];

//----------------------------------------------------------------------------------

//laptop
$categoryIDLaptop = 1;
// $inputLaptop = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
<<<<<<< HEAD
$inputLaptop = file_get_contents("http://localhost/last/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
=======
$inputLaptop = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$resultLaptop = json_decode($inputLaptop, true);

// ا(PC)
$categoryIDPC = 2;
// $inputPC = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
<<<<<<< HEAD
$inputPC = file_get_contents("http://localhost/last/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
=======
$inputPC = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$resultPC = json_decode($inputPC, true);

// Accessories
$categoryIDAccessories = 3;
// $inputAccessories = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
<<<<<<< HEAD
$inputAccessories = file_get_contents("http://localhost/last/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
=======
$inputAccessories = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
$resultAccessories = json_decode($inputAccessories, true);



?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Electro - HTML Ecommerce Template</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/bootstrap.min.css" />

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick.css" />
  <link type="text/css" rel="stylesheet" href="../frontend/css/slick-theme.css" />

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
      .view-product-button {
  float: right;
  padding: 8px 12px;
  margin-top: 10px;
  color: #fff;
  background-color: #d10024; /* Blue background color */
  border: none;
  border-radius: 4px;
  text-decoration: none;
  text-align: center;
  transition: background-color 0.3s ease, transform 0.3s ease;
  text-align: center;
}

.view-product-button:hover {
  background-color: #ffffff; / Darker blue on hover /
  transform: scale(1.05); / Slight zoom effect on hover */
}
    </style>

  <link rel="stylesheet" href="../frontend/css/style.css" />


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
            <a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a>
          </li>
        </ul>
        <ul class="header-links pull-right">
          <li>
            <a href="#"><i class="fa fa-dollar"></i> JOR</a>
          </li>
          <li>
            <a href="../backend/userProfile/veiw.php?user_id=<?php echo $id ?>"><i class="fa fa-user-o"></i> account </a>
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
                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-shopping-cart"></i>
                  <span>Your Cart</span>
                  <div class="qty">3</div>
                </a>
                <div class="cart-dropdown">
                  <div class="cart-list">
                    <div class="product-widget">
                      <div class="product-img">
                        <img src="./backend/img/product01.png" alt="" />
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
                    <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
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
<<<<<<< HEAD
=======
        <!-- container -->
      </div>
      <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
      <!-- container -->
      <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
          <!-- NAV -->
          <ul class="main-nav nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="http://127.0.0.1/brief%203/e-commerce/backend/store.php?category=1">Categories</a></li>
            <li><a href="store.php">PC</a></li>
            <li><a href="http://127.0.0.1/brief%203/e-commerce/backend/store.php?category=2">Laptops</a></li>
            <li><a href="http://127.0.0.1/brief%203/e-commerce/backend/store.php?category=3">Accessories</a></li>
          </ul>
          <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
      </div>
      <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->

    <!-- SECTION -->
    <div class="section">
      <!-- container -->
      <div class="container">
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
  </header>
  <!-- /HEADER -->

  <!-- NAVIGATION -->
  <nav id="navigation">
    <!-- container -->
    <div class="container">
      <!-- responsive-nav -->
      <div id="responsive-nav">
        <!-- NAV -->
        <ul class="main-nav nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="http://localhost/pref%204/e-commerce/backend/store.php?category=1">Categories</a></li>
          <li><a href="store.php">PC</a></li>
          <li><a href="http://localhost/pref%204/e-commerce/backend/store.php?category=2">Laptops</a></li>
          <li><a href="http://localhost/pref%204/e-commerce/backend/store.php?category=3">Accessories</a></li>
        </ul>
        <!-- /NAV -->
      </div>
      <!-- /responsive-nav -->
    </div>
    <!-- /container -->
  </nav>
  <!-- /NAVIGATION -->

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">





        <!-- shop1 -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="images/<?php echo $showImage; ?>" alt="" />
            </div>
            <div class="shop-body">
              <h3><?php echo $resultLaptop['data']['name']; ?></h3>
              <a href="store.php?category=<?php echo $categoryIDLaptop; ?>" class="cta-btn">
                Shop now <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /shop1 -->




        <!-- shop2 -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">

              <img src="images/<?php echo $showImage2; ?>" alt="" />

            </div>
            <div class="shop-body">
              <h3><?php echo $resultPC['data']['name']; ?></h3>
              <a href="store.php?category=<?php echo $categoryIDPC; ?>" class="cta-btn">
                Shop now <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /shop2 -->




        <!-- shop3 -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="images/<?php echo $showImage3; ?>" alt="" />
            </div>
            <div class="shop-body">
              <h3><?php echo $resultAccessories['data']['name']; ?></h3>
              <a href="store.php?category=<?php echo $categoryIDAccessories; ?>" class="cta-btn">
                Shop now <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /shop3 -->

      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">New Products</h3>
            <div class="section-nav">
            </div>
          </div>
        </div>
        <!-- /section title -->

        <!-- Products tab & slick -->
        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">
              <!-- tab -->
              <div id="tab1" class="tab-pane active">
                <div class="products-slick" data-nav="#slick-nav-1">



                  <!-- product1 -->

                  <div class="products-container" id="products-list">
                    <?php
                    if (isset($result0['data']) && count($result0['data']) > 0) :
                      $index = 0;
                      if (isset($result0['data'][$index])) :
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="sale">-30%</span>
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                            <div class="product-rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="product-btns">

                              <a href="http://localhost/pref%204/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
                          </div>
                          <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      <?php
                      else :
                        echo '<p>No product found at the specified index.</p>';
                      endif;
                    else :
                      ?>
                      <p>No products to display.</p>
                    <?php endif; ?>
                  </div>
                  <!-- /product1 -->




                  <!-- product2 -->
                  <div class="products-container" id="products-list">
                    <?php
                    if (isset($result0['data']) && count($result0['data']) > 0) :
                      $index = 4;
                      if (isset($result0['data'][$index])) :
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="sale">-30%</span>
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                            <div class="product-rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="product-btns">
                              <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                              <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                              <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                            </div>
                          </div>
                          <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      <?php
                      else :
                        echo '<p>No product found at the specified index.</p>';
                      endif;
                    else :
                      ?>
                      <p>No products to display.</p>
                    <?php endif; ?>
                  </div>
                  <!-- /product2 -->



                  <!-- product3 -->
                  <div class="products-container" id="products-list">
                    <?php
                    if (isset($result0['data']) && count($result0['data']) > 0) :
                      $index = 7;
                      if (isset($result0['data'][$index])) :
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="sale">-30%</span>
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                            <div class="product-rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="product-btns">
                              <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                              <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                              <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                            </div>
                          </div>
                          <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      <?php
                      else :
                        echo '<p>No product found at the specified index.</p>';
                      endif;
                    else :
                      ?>
                      <p>No products to display.</p>
                    <?php endif; ?>
                  </div>
                  <!-- /product3 -->



                  <!-- product4 -->
                  <div class="products-container" id="products-list">
                    <?php
                    // تأكد من وجود بيانات
                    if (isset($result0['data']) && count($result0['data']) > 0) :
                      $index = 12;

                      if (isset($result0['data'][$index])) :
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="sale">-30%</span>
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                            <div class="product-rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="product-btns">
                              <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                              <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                              <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                            </div>
                          </div>
                          <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      <?php
                      else :
                        echo '<p>No product found at the specified index.</p>';
                      endif;
                    else :
                      ?>
                      <p>No products to display.</p>
                    <?php endif; ?>
                  </div>
                  <!-- /product4 -->

                  <!-- product5 -->
                  <div class="products-container" id="products-list">
                    <?php
                    if (isset($result0['data']) && count($result0['data']) > 0) :
                      $index = 16;
                      if (isset($result0['data'][$index])) :
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="sale">-30%</span>
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                            <div class="product-rating">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="product-btns">
                              <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                              <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                              <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                            </div>
                          </div>
                          <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                          </div>
                        </div>
                      <?php
                      else :
                        echo '<p>No product found at the specified index.</p>';
                      endif;
                    else :
                      ?>
                      <p>No products to display.</p>
                    <?php endif; ?>
                  </div>
                  <!-- /product5 -->



                </div>
                <div id="slick-nav-1" class="products-slick-nav"></div>
              </div>
<<<<<<< HEAD
              <!-- /tab -->
=======
            </div>
          </div>
          <!-- /section title -->

          <!-- Products tab & slick -->
          <div class="col-md-12">
            <div class="row">
              <div class="products-tabs">
                <!-- tab -->
                <div id="tab1" class="tab-pane active">
                  <div class="products-slick" data-nav="#slick-nav-1">



                    <!-- product1 -->
                     
                    <div class="products-container" id="products-list">
                     <?php 
                  if (isset($result0['data']) && count($result0['data']) > 0): 
                 $index = 0; 
             if (isset($result0['data'][$index])): 
            $product = $result0['data'][$index];?>
            <div class="product">
                <div class="product-img">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        
                        <a href="http://127.0.0.1/brief%203/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
    <?php 
        else:
            echo '<p>No product found at the specified index.</p>';
        endif;
    else: 
    ?>
        <p>No products to display.</p>
    <?php endif; ?>
</div>
                    <!-- /product1 -->




                    <!-- product2 -->
                    <div class="products-container" id="products-list">
                     <?php 
                  if (isset($result0['data']) && count($result0['data']) > 0): 
                 $index = 4;
             if (isset($result0['data'][$index])): 
            $product = $result0['data'][$index];?>
            <div class="product">
                <div class="product-img">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
    <?php 
        else:
            echo '<p>No product found at the specified index.</p>';
        endif;
    else: 
    ?>
        <p>No products to display.</p>
    <?php endif; ?>
</div>
                    <!-- /product2 -->


                    
                    <!-- product3 -->
                    <div class="products-container" id="products-list">
                     <?php 
                  if (isset($result0['data']) && count($result0['data']) > 0): 
                 $index = 7; 
             if (isset($result0['data'][$index])): 
            $product = $result0['data'][$index];?>
            <div class="product">
                <div class="product-img">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
    <?php 
        else:
            echo '<p>No product found at the specified index.</p>';
        endif;
    else: 
    ?>
        <p>No products to display.</p>
    <?php endif; ?>
</div>
                    <!-- /product3 -->



                    <!-- product4 -->
                    <div class="products-container" id="products-list">
                     <?php 
                     // تأكد من وجود بيانات
                  if (isset($result0['data']) && count($result0['data']) > 0): 
                 $index = 12; 

                 if (isset($result0['data'][$index])): 
            $product = $result0['data'][$index];?>
            <div class="product">
                <div class="product-img">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
    <?php 
        else:
            echo '<p>No product found at the specified index.</p>';
        endif;
    else: 
    ?>
        <p>No products to display.</p>
    <?php endif; ?>
</div>
                    <!-- /product4 -->

                    <!-- product5 -->
                    <div class="products-container" id="products-list">
                     <?php 
                  if (isset($result0['data']) && count($result0['data']) > 0): 
                 $index = 16; 
             if (isset($result0['data'][$index])): 
            $product = $result0['data'][$index];?>
            <div class="product">
                <div class="product-img">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                    <h4 class="product-price"><?php echo htmlspecialchars($product['price']); ?> JOD <del class="product-old-price">$90</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to Wishlist</span></button>
                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Add to Compare</span></button>
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
    <?php 
        else:
            echo '<p>No product found at the specified index.</p>';
        endif;
    else: 
    ?>
        <p>No products to display.</p>
    <?php endif; ?>
</div>
                    <!-- /product5 -->


                    
                </div>
                  <div id="slick-nav-1" class="products-slick-nav"></div>
                </div>
                <!-- /tab -->
              </div>
            </div>
          </div>
          <!-- Products tab & slick -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <div class="hot-deal">
              <ul class="hot-deal-countdown">
                
              </ul>
              <h2 class="text-uppercase">hot deal this week</h2>
              <p>New Collection Up to 50% OFF</p>
              <a class="primary-btn cta-btn" href="#">Shop now</a>
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
            </div>
          </div>
        </div>
        <!-- Products tab & slick -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- HOT DEAL SECTION -->
  <div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <div class="hot-deal">
            <ul class="hot-deal-countdown">

<<<<<<< HEAD
            </ul>
            <h2 class="text-uppercase">hot deal this week</h2>
            <p>New Collection Up to 50% OFF</p>
            <a class="primary-btn cta-btn" href="#">Shop now</a>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /HOT DEAL SECTION -->


  <!-- //------------------------ -->
  <?php
  include './db.php';

  // SQL query to fetch data
  $sql = "SELECT p.name, p.image, p.price, d.discount_amount
        FROM product p
        JOIN discount d ON p.id = d.product_id";
  $result = $conn->query($sql);

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Products</title>
    <link rel="stylesheet" href="styles.css"> <!-- Make sure to include your CSS -->
  </head>

  <body>
=======
<!-- //------------------------ -->

<?php
  include './db.php';

  // SQL query to fetch data
  $sql = "SELECT p.id as productId, p.name, p.image as productImage, p.price, d.discount_amount
        FROM product p
        JOIN discount d ON p.id = d.product_id";
  $result = $conn->query($sql);
      // var_dump($result);
  ?>

  
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
    <div class="discount-section">
      <h2>Limited Time Offers</h2>
      <p>
        Discover our exclusive discounts and grab your favorite items at
        unbeatable prices!
      </p>

      <?php
      // Check if there are results
      if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
<<<<<<< HEAD
          $id = $row['product_id'];
=======
          $id = $row['productId'];
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
          $originalPrice = $row['price'];
          $discountAmount = $row['discount_amount'];
          $discountedPrice = $originalPrice * $discountAmount;
          $newPrice = $originalPrice  - $discountedPrice;
      ?>
          <div class="discount-item">
<<<<<<< HEAD
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" width="120" height="120" />
=======
            <img src="./images/<?php echo htmlspecialchars($row['productImage']); ?>" alt="Product Image" width="120" height="120" />
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
            <div class="info">
              <h3><?php echo htmlspecialchars($row['name']); ?></h3>
              <p>
                Original Price: <span class="price"><s>$<?php echo number_format($row['price'], 2); ?></s></span>
              </p>
              <p class="discount">Now Only: $<?php echo number_format($newPrice, 2); ?></p>
<<<<<<< HEAD
              <a class="view-product-button" href="productpage.php?id=<?php echo $id; ?>">View</a>
=======
              <a class="view-product-button" href="productpage.php?productId=<?php echo $id; ?>">View</a>
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65

            </div>
          </div>
      <?php
        }
      } else {
        echo "No discount products available.";
      }

      $conn->close();
      ?>

      <div class="discount-button">
        <a href="discountproducts.php">Shop All Discounts</a>
      </div>
    </div>
<<<<<<< HEAD
=======





<!-- //----------------------- -->




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
    <script src="../frontend/js/main.js"></script>
>>>>>>> 548068a5c531ea9b06f259899e9e6ed9bdd81d65
  </body>

  </html>



  <!-- //----------------------- -->




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
  <script src="../frontend/js/main.js"></script>
</body>

</html>