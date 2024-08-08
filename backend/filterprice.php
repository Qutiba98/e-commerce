<?php
require "./connection_db_pdo.php";

$minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : PHP_INT_MAX;

try {
    $sql = "SELECT * FROM products WHERE price BETWEEN :min_price AND :max_price";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':min_price', $minPrice);
    $stmt->bindParam(':max_price', $maxPrice);
    $stmt->execute();

    $filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Display the filtered products -->
<div class="product-list">
    <?php if ($filteredProducts) : ?>
        <?php foreach ($filteredProducts as $product) : ?>
            <div class="product">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>$<?php echo number_format($product['price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No products found within the specified price range.</p>
    <?php endif; ?>
</div>