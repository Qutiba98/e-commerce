<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <link rel="stylesheet" href="../frontend/css/bootstrap.min.css">
</head>
<body>
<?php
session_start();


$_SESSION['user_id'] = 22; // Example user ID
$_SESSION['product_id'] = 75; // Example product ID

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "e-commerce"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_SESSION['product_id'];
    $comment_text = isset($_POST['comment_text']) ? $_POST['comment_text'] : null;
    $user_id = $_SESSION['user_id'];

    if ($product_id && $comment_text && $user_id) {
        $stmt = $conn->prepare("INSERT INTO comments (product_id, comment_text, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $product_id, $comment_text, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT users.name, comments.comment_text FROM comments 
        INNER JOIN users ON comments.user_id = users.user_id
        WHERE comments.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
} else {
    echo "No reviews found.";
}
$stmt->close();
$conn->close();
?>

<!-- Customer Reviews -->
<div class="row">
    <div class="col-md-12">
        <div class="customer-reviews">
            <h3 class="reviews-title">Customer Reviews</h3>
            <div class="reviews">
                <?php foreach($reviews as $review): ?>
                <div class="review">
                    <div class="review-author">
                        <strong><?php echo htmlspecialchars($review['name']); ?></strong> <span>4.5/5</span>
                    </div>
                    <p class="review-text"><?php echo htmlspecialchars($review['comment_text']); ?></p>
                </div>
                <?php endforeach; ?>
                <!-- Add Review Form -->
                <div class="add-review-form">
                    <h4>Add Your Review</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="review-text">Your Review:</label>
                            <textarea id="review-text" name="comment_text" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
                <!-- /Add Review Form -->
            </div>
        </div>
    </div>
</div>
<!-- /Customer Reviews -->

<script src="path/to/your/js/bootstrap.min.js"></script>
</body>
</html>