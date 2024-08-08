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
</head>

<body>
  <header>
    <!-- TOP HEADER -->
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li><a href="#"><i class="fa fa-phone"></i> +962-779-199-880</a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> electrospark@gmail.com</a></li>
          <li><a href="#"><i class="fa fa-map-marker"></i> Amman-Jordan</a></li>
        </ul>
        <ul class="header-links pull-right">
          <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) :  ?>
            <li><a href="http://localhost/e-commerce/backend/logout.php"><i class="fa fa-dollar"></i> Logout</a></li>
          <?php endif; ?>
          <?php if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) :  ?>
            <li><a href="http://localhost/e-commerce/backend/login.php"><i class="fa fa-dollar"></i> login</a></li>
          <?php endif; ?>
          <li><a href="/backend/userProfile/veiw.php"><i class="fa fa-user-o"></i> My Account</a></li>
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
          <li><a href="http://localhost/e-commerce/backend/store.php?page=4&category=4#">Pieces For PC </a></li>

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
  <script>
    document.getElementById('category-select').addEventListener('change', function() {
      var url = this.options[this.selectedIndex].getAttribute('data-url');
      if (url) {
        window.location.href = url;
      }
    });
  </script>
  <script src="../frontend/js/jquery.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
  <script src="../frontend/js/slick.min.js"></script>
  <script src="../frontend/js/nouislider.min.js"></script>
  <script src="../frontend/js/jquery.zoom.min.js"></script>
  <script src="../frontend/js/main.js"></script>

</body>

</html>