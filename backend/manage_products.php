<?php
require './db.php';

// Fetch products
function fetchProducts()
{
    global $conn;
    $query = "SELECT * FROM product";
    return mysqli_query($conn, $query);
}

// Handle CRUD operations (Create, Read, Update, Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = floatval($_POST['price']);
        $categories_id = intval($_POST['categories_id']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "INSERT INTO product (name, description, price, categories_id, image) VALUES ('$name', '$description', '$price', '$categories_id', '$image')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['edit_product'])) {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = floatval($_POST['price']);
        $categories_id = intval($_POST['categories_id']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "UPDATE product SET name='$name', description='$description', price='$price', categories_id='$categories_id', image='$image' WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_product'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM product WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

$products = fetchProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="products.css">
</head>

<body>
    <div class="container">
        <h2>Manage Products</h2>

        <form id="product-form" method="POST" action="">
            <input type="hidden" name="id" id="product-id">
            <input type="text" name="name" id="product-name" placeholder="Product Name" required>
            <textarea name="description" id="product-description" placeholder="Description" required></textarea>
            <input type="number" name="price" id="product-price" step="0.01" placeholder="Price" required>
            <input type="number" name="categories_id" id="product-categories_id" placeholder="Category ID" required>
            <input type="text" name="image" id="product-image" placeholder="Image URL">
            <button type="submit" name="add_product" id="add-product-btn">Add Product</button>
            <button type="submit" name="edit_product" id="edit-product-btn" style="display: none;">Edit Product</button>
            <button type="submit" name="delete_product" id="delete-product-btn" style="display: none;">Delete Product</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($products)) : ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['categories_id']; ?></td>
                        <td><img src="./images/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 100px;"></td>
                        <td>
                            <button class="edit-btn" onclick="editProduct(<?php echo $product['id']; ?>)">Edit</button>
                            <button class="delete-btn" onclick="confirmDelete(<?php echo $product['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
        function editProduct(id) {
            // Fetch product details and fill the form
            fetch(`fetch_product.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('product-id').value = data.id;
                    document.getElementById('product-name').value = data.name;
                    document.getElementById('product-description').value = data.description;
                    document.getElementById('product-price').value = data.price;
                    document.getElementById('product-categories_id').value = data.categories_id;
                    document.getElementById('product-image').value = data.image;
                    document.getElementById('add-product-btn').style.display = 'none';
                    document.getElementById('edit-product-btn').style.display = 'inline';
                    document.getElementById('delete-product-btn').style.display = 'inline';
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function confirmDelete(id) {
            // Confirm and send delete request
            if (confirm('Are you sure you want to delete this product?')) {
                fetch('delete_product.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'id': id
                        })
                    })
                    .then(response => response.text())
                    .then(result => {
                        alert(result); // Optionally show a success message
                        location.reload(); // Reload the page to see the changes
                    })
                    .catch(error => console.error('Error deleting product:', error));
            }
        }
    </script>

</body>

</html>