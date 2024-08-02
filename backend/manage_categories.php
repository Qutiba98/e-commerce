<?php
require './db.php';

// Fetch categories
function fetchCategories()
{
    global $conn;
    $query = "SELECT * FROM categories";
    return mysqli_query($conn, $query);
}

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $query = "INSERT INTO categories (name) VALUES ('$name')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['edit_category'])) {
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $query = "UPDATE categories SET name='$name' WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_category'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM categories WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

$categories = fetchCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link rel="stylesheet" href="category.css">
</head>

<body>
    <div class="container">
        <h2>Manage Categories</h2>
        <form id="category-form" method="POST" action="">
            <input type="hidden" name="id" id="category-id">
            <input type="text" name="name" id="category-name" placeholder="Category Name" required>
            <button type="submit" name="add_category" id="add-category-btn">Add Category</button>
            <button type="submit" name="edit_category" id="edit-category-btn" style="display: none;">Edit Category</button>
        </form>


        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <button class="edit-btn" onclick="editCategory(<?php echo $category['id']; ?>)">Edit</button>
                            <button class="delete-btn" onclick="confirmDelete(<?php echo $category['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editCategory(id) {
            // Fetch category details and fill the form
            fetch(`fetch_category.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('category-id').value = data.id;
                    document.getElementById('category-name').value = data.name;
                    document.getElementById('add-category-btn').style.display = 'none';
                    document.getElementById('edit-category-btn').style.display = 'inline';
                    document.getElementById('delete-category-btn').style.display = 'inline';
                })
                .catch(error => console.error('Error fetching category:', error));
        }

        function confirmDelete(id) {
            // Confirm and send delete request
            if (confirm('Are you sure you want to delete this category?')) {
                fetch('delete_category.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'id': id,
                            'delete_category': 'true' // Ensure the flag is a string
                        })
                    })
                    .then(response => response.text())
                    .then(result => {
                        alert(result);
                        location.reload(); // Reload the page to see the changes
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>


</body>

</html>