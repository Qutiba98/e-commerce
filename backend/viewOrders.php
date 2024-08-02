<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM payment_recipe";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../backend/style.css">
    <link rel="stylesheet" href="../backend/viewOrders.css">

  
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Your Orders</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Payment Date</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Zip Code</th>
                    <th>Telephone</th>
                    <th>Amount</th>
                    <th>Cart ID</th>
                </tr>
            </thead>
            <tbody>

   
    </div>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['payment_date']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['country']}</td>
                                <td>{$row['zip_code']}</td>
                                <td>{$row['telephone']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['cart_id']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
