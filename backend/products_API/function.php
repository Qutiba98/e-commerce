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
    $name_parts = explode(' ', $full_name);

    // تأكد من وجود 4 أجزاء للاسم
    if (count($name_parts) < 4) {
        $data = [
            'status' => 400,
            'message' => 'Full Name must contain first name, middle name, last name, and family name.',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }

    $first_name = $name_parts[0];
    $middle_name = $name_parts[1];
    $last_name = $name_parts[2];
    $family_name = $name_parts[3];

    $email = isset($user_input["email"]) ? mysqli_real_escape_string($conn, $user_input["email"]) : '';
    $mobile = isset($user_input["mobile"]) ? mysqli_real_escape_string($conn, $user_input["mobile"]) : '';
    $password = isset($user_input["password"]) ? password_hash($user_input["password"], PASSWORD_DEFAULT) : '';
    $role_id = isset($user_input["role_id"]) ? intval($user_input["role_id"]) : 2;


    // استعلام لإدخال البيانات في قاعدة البيانات
    $query = "INSERT INTO users (first_name, middle_name, last_name, family_name, email, mobile, password, role_id) 
            VALUES ('$first_name', '$middle_name', '$last_name', '$family_name', '$email', '$mobile', '$password', '$role_id')";

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
    $query = "SELECT * FROM phones";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Phones List Fetched Successfully',
                'data' => $res  // إضافة قائمة المستخدمين هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No phones Found',
            ];
            header("HTTP/1.0 404 No phones Found");
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

function  get_phone_by_id($phoneParams){
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



    $phone_name = mysqli_real_escape_string($conn, $phoneParams['type_name']);

    $query = "SELECT * FROM phones WHERE type_name = '$phone_name' ";

    $reult = mysqli_query($conn, $query);

    if ($reult) {
        if (mysqli_num_rows($reult) > 0) {
            $res = mysqli_fetch_all($reult, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'phone List Fetched Successfully',
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
?>
