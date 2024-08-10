<?php 

require "../db.php";



function storeUser($user_input) {
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
    $full_name = isset($user_input["full_name"]) ? mysqli_real_escape_string($conn, $user_input["full_name"]) : '';
    $email = isset($user_input["email"]) ? mysqli_real_escape_string($conn, $user_input["email"]) : '';
    $mobile = isset($user_input["mobile"]) ? mysqli_real_escape_string($conn, $user_input["mobile"]) : '';
    $password = isset($user_input["password"]) ? password_hash($user_input["password"], PASSWORD_DEFAULT) : '';
    $role_id = isset($user_input["role_id"]) ? intval($user_input["role_id"]) : 2;

    // تحميل الصورة وتخزين المسار
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // التحقق من نوع الملف
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
        }

        // التحقق من حجم الملف
        if ($_FILES['image']['size'] > 5000000) {
            $uploadOk = 0;
        }

        // السماح بأنواع الملفات المعينة
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        // تحميل الملف
        if ($uploadOk == 1 && move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    // استعلام لإدخال البيانات في قاعدة البيانات
    $query = "INSERT INTO users (name, email, phone_number, password, role_id, image) 
            VALUES ('$full_name', '$email', '$mobile', '$password', '$role_id', '$imagePath')";

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


//  show all users --------------------------------------------------------------------------------------------------------
function getUsersList(){
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

    // تنفيذ الاستعلام
    $query = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Users List Fetched Successfully',
                'data' => $res  // إضافة قائمة المستخدمين هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No User Found',
            ];
            header("HTTP/1.0 404 No User Found");
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


//  show user by id ---------------------------------------------------------------------------------------------------------
function get_user_by_id($user_id){
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

    // تأمين المدخلات
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $query = "SELECT * FROM users WHERE user_id = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'User Found Successfully',
                'data' => $user  // إضافة بيانات المستخدم هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No User Found',
            ];
            header("HTTP/1.0 404 Not Found");
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


// ---------------------------------------------------------------------------------------
function update_user($inputData, $user_id) {
    global $conn;

    if (isset($inputData['username']) && isset($inputData['email']) && isset($inputData['password']) && isset($inputData['role_id'])) {
        $username = $inputData['username'];
        $email = $inputData['email'];
        $password = password_hash($inputData['password'], PASSWORD_DEFAULT);
        $role_id = $inputData['role_id'];

        // استعلام التحديث مع استخدام prepared statement
        $sql = "UPDATE users SET name=?, email=?, password=?, role_id=? WHERE user_id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            return json_encode([
                'status' => 500,
                'message' => 'Failed to prepare statement: ' . $conn->error
            ]);
        }

        mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $password, $role_id, $user_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                return json_encode([
                    'status' => 200,
                    'message' => 'User updated successfully'
                ]);
            } else {
                return json_encode([
                    'status' => 400,
                    'message' => 'No rows were updated'
                ]);
            }
        } else {
            return json_encode([
                'status' => 500,
                'message' => 'Failed to execute statement: ' . mysqli_stmt_error($stmt)
            ]);
        }

        mysqli_stmt_close($stmt);
    } else {
        return json_encode([
            'status' => 400,
            'message' => 'All fields are required'
        ]);
    }
}


// ----------------------------------------------------------------------------------------------------

function update_categorie($inputData, $category_id){
    global $conn;

    if (isset($inputData['name']) ) {

        $name = $inputData['name'];
      


        

        // استعلام التحديث مع استخدام prepared statement
        $sql = "UPDATE categories SET name=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            return json_encode([
                'status' => 500,
                'message' => 'Failed to prepare statement: ' . $conn->error
            ]);
        }

        mysqli_stmt_bind_param($stmt, "si", $name, $category_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                return json_encode([
                    'status' => 200,
                    'message' => 'category name updated successfully'
                ]);
            } else {
                return json_encode([
                    'status' => 400,
                    'message' => 'No rows were updated'
                ]);
            }
        } else {
            return json_encode([
                'status' => 500,
                'message' => 'Failed to execute statement: ' . mysqli_stmt_error($stmt)
            ]);
        }

        mysqli_stmt_close($stmt);
    } else {
        return json_encode([
            'status' => 400,
            'message' => 'All fields are required'
        ]);
    }
}


// ----------------------------------------------------------------------------------------------------

function delete_user($UsersParams) {
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

    if (isset($UsersParams["user_id"])) {
        $user_id = mysqli_real_escape_string($conn, $UsersParams['user_id']);

        $query = "DELETE FROM users WHERE user_id = '$user_id' LIMIT 1";
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


?>
