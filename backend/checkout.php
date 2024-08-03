<?php
require "../backend/connection_db_pdo.php";
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$firstNameErr = $lastNameErr = $emailErr = $addressErr = $cityErr = $countryErr = $zipCodeErr = $telephoneErr = "";
$flag = true;
$firstName = $lastName = $email = $address = $city = $country = $zipCode = $tel = "";
$amount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Validate form data
	$firstName = isset($_POST['first-name']) ? trim($_POST['first-name']) : "";
	if (empty($firstName) || !preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
		$firstNameErr = "First name is required and should only contain letters and spaces";
		$flag = false;
	}

	$lastName = isset($_POST['last-name']) ? trim($_POST['last-name']) : "";
	if (empty($lastName) || !preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
		$lastNameErr = "Last name is required and should only contain letters and spaces";
		$flag = false;
	}

	$email = isset($_POST['email']) ? trim($_POST['email']) : "";
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Valid email is required";
		$flag = false;
	}

	$address = isset($_POST['address']) ? trim($_POST['address']) : "";
	if (empty($address)) {
		$addressErr = "Address is required";
		$flag = false;
	}

	$city = isset($_POST['city']) ? trim($_POST['city']) : "";
	if (empty($city) || !preg_match("/^[a-zA-Z-' ]*$/", $city)) {
		$cityErr = "City is required and should only contain letters and spaces";
		$flag = false;
	}

	$country = isset($_POST['country']) ? trim($_POST['country']) : "";
	if (empty($country) || !preg_match("/^[a-zA-Z-' ]*$/", $country)) {
		$countryErr = "Country is required and should only contain letters and spaces";
		$flag = false;
	}

	$zipCode = isset($_POST['zip-code']) ? trim($_POST['zip-code']) : "";
	if (empty($zipCode) || !preg_match("/^\d{5}(-\d{4})?$/", $zipCode)) {
		$zipCodeErr = "Valid ZIP code is required (e.g., 12345 or 12345-6789)";
		$flag = false;
	}

	$tel = isset($_POST['tel']) ? trim($_POST['tel']) : "";
	if (empty($tel) || !preg_match("/^\+?[0-9]{10,15}$/", $tel)) {
		$telephoneErr = "Valid telephone number is required";
		$flag = false;
	}

	if ($flag) {
		// Calculate total amount from cart
		$total = 0;
		if (!empty($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $item) {
				if (isset($item['price']) && isset($item['quantity'])) {
					$total += $item['price'] * $item['quantity'];
				}
			}
		}

		// Insert order into database
		try {
			$sql = "INSERT INTO payment_recipe (payment_date, first_name, last_name, email, address, city, country, zip_code, telephone, amount, cart_id) 
                    VALUES (CURRENT_TIMESTAMP(), :firstName, :lastName, :email, :address, :city, :country, :zipCode, :tel, :amount, :cartId)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([
				':firstName' => $firstName,
				':lastName' => $lastName,
				':email' => $email,
				':address' => $address,
				':city' => $city,
				':country' => $country,
				':zipCode' => $zipCode,
				':tel' => $tel,
				':amount' => $total,
				':cartId' => 21 // Adjust or retrieve dynamically
			]);

			echo "Order placed successfully!";
			exit;
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
} else {
	http_response_code(405);
	echo "Method Not Allowed";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Electro - HTML Ecommerce Template</title>
	<style>
		.errorValidCheckOut {
			color: red;
		}
	</style>
	<!-- Add your CSS links here -->
</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- Your header content -->
	</header>
	<!-- /HEADER -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="breadcrumb-header">Checkout</h3>
					<ul class="breadcrumb-tree">
						<li><a href="../frontend/index.html">Home</a></li>
						<li class="active">Checkout</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- SECTION -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<!-- Billing Details -->
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Billing address</h3>
						</div>
						<form action="../backend/checkout.php" method="POST">
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name" value="<?php echo htmlspecialchars($firstName); ?>" />
								<div class="errorValidCheckOut"><?php echo $firstNameErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name" value="<?php echo htmlspecialchars($lastName); ?>" />
								<div class="errorValidCheckOut"><?php echo $lastNameErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" />
								<div class="errorValidCheckOut"><?php echo $emailErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($address); ?>" />
								<div class="errorValidCheckOut"><?php echo $addressErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($city); ?>" />
								<div class="errorValidCheckOut"><?php echo $cityErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country" value="<?php echo htmlspecialchars($country); ?>" />
								<div class="errorValidCheckOut"><?php echo $countryErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code" value="<?php echo htmlspecialchars($zipCode); ?>" />
								<div class="errorValidCheckOut"><?php echo $zipCodeErr ?></div>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="tel" placeholder="Telephone" value="<?php echo htmlspecialchars($tel); ?>" />
								<div class="errorValidCheckOut"><?php echo $telephoneErr ?></div>
							</div>
							<!-- /Billing Details -->
							<!-- Order Details -->
							<div class="order-details">
								<div class="order-col">
									<div><strong>Order Details</strong></div>
									<div></div>
								</div>
								<div class="order-products">
									<?php
									// Display cart items
									if (!empty($_SESSION['cart'])) {
										foreach ($_SESSION['cart'] as $item) {
											$quantity = isset($item['quantity']) ? $item['quantity'] : 1;
											$price = isset($item['price']) ? $item['price'] : 0;
											$totalPrice = $quantity * $price;
											echo '<div class="order-col">';
											echo '<div>' . htmlspecialchars($item['name']) . ' x ' . htmlspecialchars($quantity) . '</div>';
											echo '<div>$' . number_format($totalPrice, 2) . '</div>';
											echo '</div>';
										}
									} else {
										echo '<p>No items in cart.</p>';
									}
									?>
								</div>
								<div class="order-col">
									<div><strong>Total</strong></div>
									<div><strong class="order-total">
											<?php
											// Calculate total amount
											if (!empty($_SESSION['cart'])) {
												foreach ($_SESSION['cart'] as $item) {
													if (isset($item['price']) && isset($item['quantity'])) {
														$amount += $item['price'] * $item['quantity'];
													}
												}
											}
											echo '$' . number_format($amount, 2);
											?>
										</strong></div>
								</div>
							</div>
							<!-- /Order Details -->
							<button type="submit" class="primary-btn order-submit">Place Order</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /SECTION -->

		

	<!-- Add your JavaScript links here -->
</body>

</html>