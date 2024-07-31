<?php
$api_url = 'http://localhost:8080/Advance-form-curd/products_API/read.php';

// تحقق مما إذا كان هناك بيانات تم إرسالها من نموذج البحث
if (isset($_GET['type_name']) && !empty($_GET['type_name'])) {
    $phoneName = $_GET['type_name'];
    $api_url = "http://localhost:8080/Advance-form-curd/products_API/read_by_id.php?type_name=" . urlencode($phoneName);
}

$curl = curl_init($api_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if(curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
}

curl_close($curl);

// تحويل JSON إلى مصفوفة
$decoded_data = json_decode($response, true);

// تأكد من أن البيانات هي مصفوفة من الكائنات
if (isset($decoded_data['data'])) {
    $list_data = $decoded_data['data'];
} else {
    // إذا كانت البيانات مباشرةً، استخدمها كما هي
    $list_data = $decoded_data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Phone | Orange Jordan E shop</title>
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/css/orange-helvetica.min.css" rel="stylesheet" integrity="sha384-ARRzqgHDBP0PQzxQoJtvyNn7Q8QQYr0XT+RXUFEPkQqkTB6gi43ZiL035dKWdkZe" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-Di/KMIVcO9Z2MJO3EsrZebWTNrgJTrzEDwAplhM5XnCFQ1aDhRNWrp6CWvVcn00c" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://boosted.orange.com/docs/5.1/assets/brand/orange-logo.svg" width="50" height="50" role="img" alt="Boosted" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="type_name">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
    <?php foreach ($list_data as $phone) : ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?php echo htmlspecialchars($phone['img_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($phone['name']); ?>">
          <div class="card-body" style="background-color: black; color: white;">
            <h5 class="card-title"><?php echo htmlspecialchars($phone['name']); ?></h5>
            <p class="card-text">Brand: <?php echo htmlspecialchars($phone['brand']); ?></p>
            <p class="card-text">Price: <?php echo htmlspecialchars($phone['price']); ?></p>
            <p class="card-text">Rating: <?php echo htmlspecialchars($phone['rate']); ?> stars</p>
            <?php if (isset($phone['is_out_of_stock']) && $phone['is_out_of_stock'] == '1') : ?>
              <p class="card-text text-danger">Out of Stock</p>
            <?php endif; ?>

            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="button">Button</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.bundle.min.js" integrity="sha384-5thbp4uNEqKgkl5m+rMBhqR+ZCs+3iAaLIghPWAgOv0VKvzGlYKR408MMbmCjmZF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/boosted@5.1.3/dist/js/boosted.min.js" integrity="sha384-mBRgv/ye1bG9U6wfppOiHvHVz1KlD7VdRcVZLfOCoQkohsL9P61pQxzobjI4XxNr" crossorigin="anonymous"></script>
</body>
</html>
