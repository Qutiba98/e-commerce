<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch API Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        .product {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .product-name {
            font-weight: bold;
        }
        .product-price {
            color: #666;
        }
        .product-image {
            max-width: 100%;
            height: auto;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Fetch API Example</h1>
    <div id="products">
        <?php
        // URL للـ API
        $apiUrl = 'http://localhost:8080/project_php/e-commerce/backend/products_API/read.php';

        // جلب البيانات من الـ API
        $response = file_get_contents($apiUrl);

        if ($response === FALSE) {
            echo '<div class="error">There was an error fetching the products.</div>';
        } else {
            // تحويل الاستجابة إلى JSON
            $data = json_decode($response, true);

            // تحقق من وجود الحقل 'data'
            if (!isset($data['data'])) {
                echo '<div class="error">Data field is missing in the response.</div>';
            } else {
                // عرض البيانات في صفحة HTML
                foreach ($data['data'] as $product) {
                    echo '<div class="product">';
                    echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                    echo '<div class="product-name">Name: ' . htmlspecialchars($product['name']) . '</div>';
                    echo '<div class="product-price">Price: ' . htmlspecialchars($product['price']) . '</div>';
                    echo '<div class="product-description">Description: ' . htmlspecialchars($product['description']) . '</div>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</body>
</html>
