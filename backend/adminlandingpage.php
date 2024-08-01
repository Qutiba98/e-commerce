<?php
require 'db.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="adminlandingpage.css" />
</head>

<body>
  <div class="container">
    <header>
      <h1>Admin Dashboard</h1>
      <nav>
        <ul>
          <li><a href="#" id="products-tab">Products</a></li>
          <li><a href="#" id="categories-tab">Categories</a></li>
          <li><a href="#" id="users-tab">Users</a></li>
          <li><a href="#" id="profile-tab">Profile</a></li>
        </ul>
      </nav>
    </header>

    <main id="main-content">
      <!-- Products Section -->
      <section id="products-section" class="tab-content">
        <h2>Manage Products</h2>
        <button id="add-product-btn">Add Product</button>
        <table id="products-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Price</th>
              <th>Description</th>
              <th>Category ID</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            if ($query_run > 0) {
              while ($row = $query_run->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["categories_id"] . "</td>";
                echo "<td>" . $row["image"] . "</td>";
                echo '<td><a href="read.php?id=' . $row["id"] . '">View</a> | <a href="update.php?id=' . $row["id"] . '">Update</a> | <a href="delete.php?id=' . $row["id"] . '">Delete</a></td>';
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            $conn->close(); ?>
          </tbody>
        </table>
      </section>

      <!-- Categories Section -->
      <section id="categories-section" class="tab-content">
        <h2>Manage Categories</h2>
        <button id="add-category-btn">Add Category</button>
        <table id="categories-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Category rows will be added here dynamically -->
          </tbody>
        </table>
      </section>

      <!-- Users Section -->
      <section id="users-section" class="tab-content">
        <h2>Manage Users</h2>
        <button id="add-user-btn">Add User</button>
        <table id="users-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- User rows will be added here dynamically -->
          </tbody>
        </table>
      </section>

      <!-- Profile Section -->
      <section id="profile-section" class="tab-content">
        <h2>Profile Information</h2>
        <div id="profile-info">
          <!-- Profile details will be displayed here -->
        </div>
        <button id="edit-profile-btn">Edit Profile</button>
        <table id="update-log">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Admin</th>
              <th>Update Type</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <!-- Update log rows will be added here dynamically -->
          </tbody>
        </table>
      </section>
    </main>

    <footer>
      <p>&copy; 2024 Admin Dashboard</p>
    </footer>
  </div>

  <!-- Modal for Adding/Editing Items -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2 id="modal-title">Add/Edit Item</h2>
      <form id="modal-form">
        <!-- Form fields will be dynamically added here -->
        <button type="submit">Save</button>
      </form>
    </div>
  </div>

  <script src="adminlandingpage.js"></script>
</body>

</html>