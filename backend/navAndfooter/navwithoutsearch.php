<?php
// Fetch categories from API
$categoriesJson = file_get_contents("http://localhost/e-commerce/backend/categories_API/read.php");
$categories = json_decode($categoriesJson, true);

// Check if data is received
if (isset($categories['data'])) {
  $categoryData = $categories['data'];
} else {
  $categoryData = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Details</title>

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

  <!-- Custom stylesheet -->
  <link type="text/css" rel="stylesheet" href="../frontend/css/style.css" />

  <style>
    .main-nav {
      display: flex;
      flex-direction: row; 
      justify-content: flex-start; 
      gap: 20px; 
      list-style-type: none; 
      padding: 0; 
      margin: 0; 
    }

    .main-nav > li {
      display: inline; 
    }

    .header-ctn {
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }

    #navigation .container {
      max-width: 100%;
    }

    #navigation {
      background-color: #fff; 
      border-top: 3px solid #d10024; 
     
    }

    .main-nav > li > a {
     
      transition: all 0.3s; 
      display: block; 

    .main-nav > li > a:hover {
      color: #f53434; 
    }}
  </style>
</head>

<body>
  <header>
    <!-- MAIN HEADER -->
    <div id="header">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row align-items-center">
          <!-- LOGO -->
          <div class="col-md-4 d-flex justify-content-start">
            <div class="header-logo">
              <a href="#" class="logo">
                <img src="/e-commerce/backend/img/logooooooo.png" alt="Logo" style="max-width: 200px;margin-top: 5px" />
              </a>
            </div>
          </div>
          <!-- /LOGO -->

          <!-- ACCOUNT -->
          <div class="col-md-8 d-flex justify-content-end">
            <div class="header-ctn" style="margin-top: 5px;">
              <ul class="header-links">
                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) :  ?>
                  <li><a href="http://localhost/e-commerce/backend/logout.php"> Logout</a></li>
                  <li><a href="/backend/userProfile/veiw.php"><i class="fa fa-user-o"></i> My Account</a></li>
                <?php else : ?>
                  <li><a href="http://localhost/e-commerce/backend/login.php"> Login</a></li>
                  <li><a href="http://localhost/e-commerce/backend/signup.php"><i class="fa fa-user-o"></i> Sign up</a></li>
                <?php endif; ?>
                <li><a href="./cart.php"><i class="fa fa-shopping-cart"></i> Your Cart</a></li>
              </ul>
              
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

  <!-- NAVIGATION -->
  <nav id="navigation">
    <!-- container -->
    <div class="container">
      <!-- responsive-nav -->
      <div id="responsive-nav">
        <!-- NAV -->
        <ul class="main-nav nav navbar-nav">
          <li><a href="http://localhost/e-commerce/backend/index.php">Home</a></li>
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4#">Categories</a></li>
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4&category=2#">Laptops</a></li>
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4&category=1#">PC</a></li>
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4&category=3#">Accessories</a></li>
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4&category=4#">Pieces For PC</a></li>
        </ul>
        <!-- /NAV -->
      </div>
      <!-- /responsive-nav -->
    </div>
    <!-- /container -->
  </nav>
  <!-- /NAVIGATION -->

  <!-- Additional content goes here -->

  <!-- jQuery Plugins -->
  <script src="../frontend/js/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
  <script src="../frontend/js/slick.min.js"></script>
  <script src="../frontend/js/nouislider.min.js"></script>
  <script src="../frontend/js/jquery.zoom.min.js"></script>
  <script src="../frontend/js/main.js"></script>

</body>

</html>
