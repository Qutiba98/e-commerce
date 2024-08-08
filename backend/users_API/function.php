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


function update_user($subjectInput, $subjectParams){
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

    if (isset($subjectParams['user_id'])) {
        $user_id = mysqli_real_escape_string($conn, $subjectParams['user_id']);

        $name = mysqli_real_escape_string($conn, $subjectInput['name']);
        $email = mysqli_real_escape_string($conn, $subjectInput['email']);
        $phone_number = mysqli_real_escape_string($conn, $subjectInput['phone_number']);
        $image = mysqli_real_escape_string($conn, $subjectInput['image']);
        $role_id = mysqli_real_escape_string($conn, $subjectInput['role_id']);

        $query = "UPDATE users SET name='$name', email='$email', phone_number='$phone_number', image='$image', role_id='$role_id' WHERE user_id='$user_id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'user updated Successfully',
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
            'message' => 'User ID is required',
        ];
        header('HTTP/1.0 400 Bad Request');
        return json_encode($data);
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
