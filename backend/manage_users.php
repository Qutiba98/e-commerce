<?php
require './dbqutipa.php';

// Fetch users
function fetchUsers()
{
    global $conn;
    $query = "SELECT * FROM users";
    return mysqli_query($conn, $query);
}

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roleId;
    if($_POST['role'] == "user"){
        $roleId =2;
    }else{
        $roleId=1;
    }
    if (isset($_POST['add_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $query = "INSERT INTO users (name, email, role_id) VALUES ('$username', '$email','$roleId')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['edit_user'])) {
        $id = intval($_POST['id']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $query = "UPDATE users SET name='$username', email='$email' WHERE user_id='$id'";
        mysqli_query($conn, $query); 
    } elseif (isset($_POST['delete_user'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM users WHERE user_id='$id'";
        mysqli_query($conn, $query);
    }
}

$users = fetchUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <div class="container">
        <h2>Manage Users</h2>

        <form id="user-form" method="POST" action="">
            <input type="hidden" name="id" id="user-id">
            <input type="text" name="username" id="user-username" placeholder="Username" required>
            <input type="email" name="email" id="user-email" placeholder="Email" required>
            <select name="role" id="user-role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
            <button type="submit" name="add_user" id="add-user-btn">Add User</button>
            <button type="submit" name="edit_user" id="edit-user-btn" style="display: none;">Edit User</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['role_id']; ?></td>
                        <td>
                            <button class="edit-btn" id="edit" onclick="editUser(<?php echo $user['user_id']; ?>)">Edit</button>
                            <button class="delete-btn" onclick="confirmDelete(<?php echo $user['user_id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editUser(id) {
            // Fetch user details and fill the form
            fetch(`./fetch_user.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user-id').value = data.user_id;
                    document.getElementById('user-username').value = data.name;
                    document.getElementById('user-email').value = data.email;
                    document.getElementById('user-role').value = data.role; // Uncomment if role is used
                    document.getElementById('add-user-btn').style.display = 'none';
                    document.getElementById('edit-user-btn').style.display = 'inline';
                });
        }

        function confirmDelete(id) {
            // Confirm and send delete request
            if (confirm('Are you sure you want to delete this user?')) {
                fetch('./delete_user.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'id': id,
                            'delete_user': true
                        })
                    })
                    .then(response => response.text())
                    .then(result => {
                        // Optionally, you could reload the page or remove the row from the table
                        location.reload(); // Reload the page to see the changes
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>

</body>

</html>