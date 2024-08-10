<?php
session_start();

$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
// echo ($_SESSION['user_id']);
// var_dump($_SESSION['user_id']);
//API 
// var_dump($_SESSION['user_id']);
$_SESSION['total'] = 0;
//qutiba
$input0 = file_get_contents("http://localhost/e-commerce/backend/products_API/read.php");
// $input0 = file_get_contents("http://127.0.0.1/brief%203/e-commerce/backend/products_API/read.php");
$result0 = json_decode($input0, true);

//img pc 
// $input = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=54");
$input = file_get_contents("http://localhost/e-commerce/backend/productapi/getbyid.php?id=54");
$result = json_decode($input, true);
$showImage = $result['image'];


//img laptop 
// $input2 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=64");
$input2 = file_get_contents("http://localhost/e-commerce/backend/productapi/getbyid.php?id=64");
$result2 = json_decode($input2, true);
$showImage2 = $result2['image'];


//img  Accessories 
$input3 = file_get_contents("http://localhost/e-commerce/backend/productapi/getbyid.php?id=69");
// $input3 = file_get_contents("http://localhost/pref%204/e-commerce/backend/productapi/getbyid.php?id=69");
$result3 = json_decode($input3, true);
$showImage3 = $result3['image'];

//----------------------------------------------------------------------------------

//laptop
$categoryIDLaptop = 1;
// $inputLaptop = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
$inputLaptop = file_get_contents("http://localhost/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDLaptop);
$resultLaptop = json_decode($inputLaptop, true);

// ا(PC)
$categoryIDPC = 2;
// $inputPC = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
$inputPC = file_get_contents("http://localhost/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDPC);
$resultPC = json_decode($inputPC, true);

// Accessories
$categoryIDAccessories = 3;
// $inputAccessories = file_get_contents("http://localhost/pref%204/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
$inputAccessories = file_get_contents("http://localhost/e-commerce/backend/categories_API/read_by_id.php?id=" . $categoryIDAccessories);
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
    rel="stylesheet" />

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
    .imageCards {
      width: 300px !important;
    }

    .view-product-button {
      float: right;
      padding: 8px 12px;
      margin-top: 10px;
      color: #fff;
      background-color: #d10024;
      /* Blue background color */
      border: none;
      border-radius: 4px;
      text-decoration: none;
      text-align: center;
      transition: background-color 0.3s ease, transform 0.3s ease;
      text-align: center;
    }

    .view-product-button:hover {
      background-color: #ffffff;/ Darker blue on hover / transform: scale(1.05);/ Slight zoom effect on hover */
    }
  </style>

  <link rel="stylesheet" href="../frontend/css/style.css" />


</head>

<body>



  <?php

  include './navAndfooter/nav.php';
  ?>


  <div class="container">
    <div class="row d-flex justify-content-center">
      <!-- shop1 -->
      <div class="col-md-4 col-xs-5">
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
      <div class="col-md-4 col-xs-5">
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
      <div class="col-md-4 col-xs-5">
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
  </div>

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
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img class="imageCards" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price">$<?php echo htmlspecialchars($product['price']); ?> </h4>

                            <div class="product-btns">

                              <a href="http://localhost/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
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
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img class="imageCards" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price">$<?php echo htmlspecialchars($product['price']); ?> </h4>

                            <div class="product-btns">
                              <a href="http://localhost/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
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
                      $index = 3;
                      if (isset($result0['data'][$index])):
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img class="imageCards" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price">$<?php echo htmlspecialchars($product['price']); ?> </h4>

                            <div class="product-btns">
                              <a href="http://localhost/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
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
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img class="imageCards" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price">$<?php echo htmlspecialchars($product['price']); ?> </h4>

                            <div class="product-btns">
                              <a href="http://localhost/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
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
                      $index = 6;
                      if (isset($result0['data'][$index])):
                        $product = $result0['data'][$index]; ?>
                        <div class="product">
                          <div class="product-img">
                            <img class="imageCards" src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="product-label">
                              <span class="new">NEW</span>
                            </div>
                          </div>
                          <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars($product['categoriesName']); ?></p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($product['name']); ?></a></h3>
                            <h4 class="product-price">$<?php echo htmlspecialchars($product['price']); ?> </h4>

                            <div class="product-btns">
                              <a href="http://localhost/e-commerce/backend/productpage.php?productId=<?php echo $product['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"> Quick View</span></a>
                            </div>
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
  $sql = "SELECT p.id as productId, p.name, p.image as productImage, p.price, d.discount_amount
        FROM product p
        JOIN discount d ON p.id = d.product_id LIMIT 3";
  $result = $conn->query($sql);
  // var_dump($result);
  ?>


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
        $id = $row['productId'];
        $originalPrice = $row['price'];
        $discountAmount = $row['discount_amount'];
        $discountedPrice = $originalPrice * $discountAmount;
        $newPrice = $originalPrice  - $discountedPrice;
    ?>
        <div class="discount-item">
          <img src="./images/<?php echo htmlspecialchars($row['productImage']); ?>" alt="Product Image" width="120" height="120" />
          <div class="info">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>
              Original Price: <span class="price"><s>$<?php echo number_format($row['price'], 2); ?></s></span>
            </p>
            <p class="discount">Now Only: $<?php echo number_format($newPrice, 2); ?></p>
            <a class="view-product-button" href="productpage.php?productId=<?php echo $id; ?>">View</a>

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
  <div class="container">
    <div class="row">
      <div class="col-md-12 about-us-section">
        <div class="about-us-content">
          <h2 style="color:#d10024">About Us</h2>
          <p>
            Welcome to e-commerce Electro, your ultimate destination for technology enthusiasts and lovers of cutting-edge electronic devices. We specialize in providing the latest models of laptops, PCs, and their accessories at the best prices and highest quality. Thank you for choosing e-commerce lojw. We are here to meet your tech needs and make your life easier and better.
          </p>
        </div>
      </div>
    </div>
  </div>







  <!-- //----------------------- -->




  <!-- FOOTER -->
  <?php

  require '../backend/navAndfooter/footer.php';

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