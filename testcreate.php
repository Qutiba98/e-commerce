<?php 




require "./connection_db_pdo.php";

$name = isset($_POST['name']) ? $_POST['name'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";

// File upload directory 
$targetDir = "images/";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (!empty($_FILES["image"]["name"])) { 
        $fileName = basename($_FILES["image"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); 
        if (in_array($fileType, $allowTypes)) { 
            // Upload file to server 
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) { 
                // Insert image file name into database 
                $sql = "INSERT INTO product (name, image, description, price, categories_id) VALUES ('$name', '$fileName', '$description', '$price', 4)";
                try {
                    $conn->exec($sql);
                    echo "Product inserted successfully!";
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    } else {
        echo "Please select a file to upload.";
    }
}



// Display status message 

// // show the image
// $sql= "SELECT image from product WHERE id =54";
// $images =$conn->query($sql);
// $result =$images->fetch(PDO::FETCH_ASSOC);
// $disImage=$result['image'];


// echo "<img src='images/$disImage' alt='' />";
// echo "showed";
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="file"],
        input[type="number"],
        textarea {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insert Product</h2>
        <form action="./testcreate.php" method="post" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" >

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" >

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" ></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" >

            <button type="submit">Insert Product</button>
        </form>
    </div>
    <!-- <img src=productsImages/<?php echo $disImage?> alt='' /> -->
</body>
</html>
