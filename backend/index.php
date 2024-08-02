
<?php 

session_start();
$id=$_SESSION['user_id'];
//API 

//qutiba
// $input0 = file_get_contents("http://localhost/pref%204/e-commerce/backend/products_API/read.php");
$input0 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/products_API/read.php");
$result0 = json_decode($input0, true);

//img pc 
// $input = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=54");
$input = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=54");
$result = json_decode($input, true);
$showImage = $result['image'];


//img laptop 
// $input2 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=64");
$input2 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=64");
$result2 = json_decode($input2, true);
$showImage2 = $result2['image'];


//img  Accessories 
$input3 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/productapi/getbyid.php?id=69");
// $input3 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=69");
$result3 = json_decode($input3, true);
$showImage3 = $result3['image'];

//----------------------------------------------------------------------------------

//laptop
$categoryIDLaptop = 1;
// $inputLaptop = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
$inputLaptop = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
$resultLaptop = json_decode($inputLaptop, true);

// ا(PC)
$categoryIDPC = 2;
// $inputPC = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
$inputPC = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
$resultPC = json_decode($inputPC, true);

// Accessories
$categoryIDAccessories = 3;
// $inputAccessories = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
$inputAccessories = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
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
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700"
      rel="stylesheet"
    />

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
              <a href="#"
                ><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a
              >
            </li>
          </ul>
          <ul class="header-links pull-right">
            <li>
              <a href="#"><i class="fa fa-dollar"></i> JOR</a>
            </li>
            <li>
              <a href="../backend/userProfile/veiw.php?user_id=<?php echo $id?>"
                ><i class="fa fa-user-o"></i> account </a
              >
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
                <li>
                  <div>
                    <h3>02</h3>
                    <span>Days</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>10</h3>
                    <span>Hours</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>34</h3>
                    <span>Mins</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>60</h3>
                    <span>Secs</span>
                  </div>
                </li>
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

    </div>
    <div class="discount-section">
      <h2>Limited Time Offers</h2>
      <p>
        Discover our exclusive discounts and grab your favorite items at
        unbeatable prices!
      </p>

      <div class="discount-item">
        <img src="https://via.placeholder.com/120" alt="Product Image" />
        <div class="info">
          <h3>Stylish Jacket</h3>
          <p>
            Original Price: <span class="price"><s>$75.00</s></span>
          </p>
          <p class="discount">Now Only: $45.00</p>
        </div>
      </div>

      <div class="discount-item">
        <img src="https://via.placeholder.com/120" alt="Product Image" />
        <div class="info">
          <h3>Wireless Headphones</h3>
          <p>
            Original Price: <span class="price"><s>$150.00</s></span>
          </p>
          <p class="discount">Now Only: $99.00</p>
        </div>
      </div>

      <div class="discount-item">
        <img src="https://via.placeholder.com/120" alt="Product Image" />
        <div class="info">
          <h3>Smart Watch</h3>
          <p>
            Original Price: <span class="price"><s>$200.00</s></span>
          </p>
          <p class="discount">Now Only: $130.00</p>
        </div>
      </div>

      <div class="discount-button">
        <a href="discountproducts.php">Shop All Discounts</a>
      </div>
    </div>



<!-- //----------------------- -->




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
    <script src="../frontend/js/main.js"></script>
  </body>
</html>
