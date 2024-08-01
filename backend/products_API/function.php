<?php

require "../db.php";



<<<<<<< HEAD
function storeUser($user_input)
{
=======
function storeProduct($product_input) {
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
    global $conn;

    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed: ' . $conn->connect_error,
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }

    // تنقية المدخلات
    $name = isset($product_input["name"]) && !empty($product_input["name"]) ? mysqli_real_escape_string($conn, $product_input["name"]) : null;
    $description = isset($product_input["description"]) && !empty($product_input["description"]) ? mysqli_real_escape_string($conn, $product_input["description"]) : null;
    $price = isset($product_input["price"]) && !empty($product_input["price"]) ? floatval($product_input["price"]) : null;
    $categories_id = isset($product_input["categories_id"]) && !empty($product_input["categories_id"]) ? intval($product_input["categories_id"]) : null;

    // التعامل مع الصورة
    $image = isset($product_input["image"]) && !empty($product_input["image"]) ? mysqli_real_escape_string($conn, $product_input["image"]) : null;

    // التحقق من أن جميع الحقول الضرورية ليست فارغة
    if (is_null($name) || is_null($description) || is_null($price) || is_null($categories_id)) {
        $data = [
            'status' => 400,
            'message' => 'All fields are required and cannot be empty.',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }

    // استعلام لإدخال البيانات في قاعدة البيانات
    $query = "INSERT INTO product (name, image, description, price, categories_id) 
            VALUES ('$name', '$image', '$description', '$price', '$categories_id')";

    if ($conn->query($query) === TRUE) {
        $data = [
            'status' => 200,
            'message' => 'New record created successfully',
        ];
    } else {
        $data = [
            'status' => 500,
            'message' => 'Error: ' . $query . '<br>' . $conn->error,
        ];
    }

    // إغلاق اتصال قاعدة البيانات
    $conn->close();
    return json_encode($data);
}

//  show user by id ---------------------------------------------------------------------------------------------------------
function getProductList() {
    global $conn;

<<<<<<< HEAD
//  show all users --------------------------------------------------------------------------------------------------------
function getUsersList()
{
=======
    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }

    $query = "SELECT * FROM product";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Phone List Fetched Successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Phone Found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }

    // إغلاق اتصال قاعدة البيانات
    $conn->close();
}

//  show user by id ---------------------------------------------------------------------------------------------------------

function  get_product_by_id($productParams){
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
    global $conn;

    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
        exit();
    }

<<<<<<< HEAD
    // تنفيذ الاستعلام
    $query = "SELECT * FROM product";
    $query_run = mysqli_query($conn, $query);
=======
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4


    $product_id = mysqli_real_escape_string($conn, $productParams['id']);

    $query = "SELECT * FROM product WHERE id = '$product_id' LIMIT 1 ";

    $reult = mysqli_query($conn, $query);

    if ($reult) {
        if (mysqli_num_rows($reult) > 0) {
            $res = mysqli_fetch_all($reult, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'product List Fetched Successfully',
                'data' => $res  // إضافة قائمة المستخدمين هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No phone Found',
            ];
            header("HTTP/1.0 404 No phone Found");
            echo json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }

    // إغلاق اتصال قاعدة البيانات
    $conn->close();
}
<<<<<<< HEAD


//  show user by id ---------------------------------------------------------------------------------------------------------
function get_user_by_id($user_id)
{
=======
// -------------------------------------------------------------------------------------------------
function  get_product_by_price($productParams){
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
    global $conn;

    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
        exit();
    }



    $product_price = mysqli_real_escape_string($conn, $productParams['price']);

    $query = "SELECT * FROM product WHERE price = '$product_price' LIMIT 1 ";

    $reult = mysqli_query($conn, $query);

    if ($reult) {
        if (mysqli_num_rows($reult) > 0) {
            $res = mysqli_fetch_all($reult, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'product List Fetched Successfully',
                'data' => $res  // إضافة قائمة المستخدمين هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No product Found',
            ];
            header("HTTP/1.0 404 No product Found");
            echo json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
    }

    // إغلاق اتصال قاعدة البيانات
    $conn->close();
}
// -------------------------------------------------------------------------------------------------

<<<<<<< HEAD

// ---------------------------------------------------------------------------------------


function update_user($subjectInput, $subjectParams)
{
=======
function updatePruduct($subjectInput, $subjectParams){
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
    global $conn;

    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
        exit();
    }

    if (isset($subjectParams['id'])) {
        $id = mysqli_real_escape_string($conn, $subjectParams['id']);
        $image = mysqli_real_escape_string($conn, $subjectInput['image']);
        $name = mysqli_real_escape_string($conn, $subjectInput['name']);
        $description = mysqli_real_escape_string($conn, $subjectInput['description']);
        $price = mysqli_real_escape_string($conn, $subjectInput['price']);
        $categories_id = mysqli_real_escape_string($conn, $subjectInput['categories_id']);

        $query = "UPDATE product SET name='$name',image='$image', description='$description', price='$price', categories_id='$categories_id', image='$image' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'pruduct updated Successfully',
            ];
            header('HTTP/1.0 200 Success');
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header('HTTP/1.0 500 Internal Server Error');
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 400,
            'message' => 'pruduct ID is required',
        ];
        header('HTTP/1.0 400 Bad Request');
        return json_encode($data);
    }
}
// -----------------------------------------------------------------------------------------------------------------------------


<<<<<<< HEAD
function delete_user($UsersParams)
{
=======
function delete_product($ProductParams) {
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
    global $conn;

    // التحقق من اتصال قاعدة البيانات
    if ($conn->connect_error) {
        $data = [
            'status' => 500,
            'message' => 'Database Connection Failed',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
        exit();
    }

    if (isset($ProductParams["id"])) {
        $product_id = mysqli_real_escape_string($conn, $ProductParams['id']);

        $query = "DELETE FROM product WHERE id = '$product_id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'User deleted successfully',
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No user found or failed to delete user',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 400,
            'message' => 'User ID is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }
}
<<<<<<< HEAD
=======

?>
>>>>>>> c24862573d82cf04ad7cfecd81025b7a8d27d0b4
