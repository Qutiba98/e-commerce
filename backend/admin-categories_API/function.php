<?php 

require "../db.php";




function storeCategorie($categorie_input) {
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

    // التحقق من وجود المدخلات وتنقيتها
    if (!isset($categorie_input['name']) || empty($categorie_input['name'])) {
        $data = [
            'status' => 400,
            'message' => 'Category name is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }

    $name = mysqli_real_escape_string($conn, $categorie_input['name']);

    // استعلام لإدخال البيانات في قاعدة البيانات
    $query = "INSERT INTO categories (name) VALUES ('$name')";

    if ($conn->query($query) === TRUE) {
        $data = [
            'status' => 200,
            'message' => 'New category created successfully',
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
function getCategories(){
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
    $query = "SELECT * FROM categories";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'categories List Fetched Successfully',
                'data' => $res  // إضافة قائمة المستخدمين هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No categories Found',
            ];
            header("HTTP/1.0 404 No categories Found");
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
function get_categorie_by_id($id){
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
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM categories WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $categorie = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'categorie Found Successfully',
                'data' => $categorie // إضافة بيانات المستخدم هنا
            ];
            header("HTTP/1.0 200 OK");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No categorie Found',
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

                session_start();
	$_SESSION['success_message'] = "category name updated successfully";
	header("Location:http://localhost/e-commerce/frontend/admin-dasboard/static/pages-manage-categories.php");
                // return json_encode([
                //     'status' => 200,
                //     'message' => 'category name updated successfully'
                // ]);
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

function delete_categorie($categorieParams) {
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

    if (isset($categorieParams["id"])) {
        $id = mysqli_real_escape_string($conn, $categorieParams['id']);

        $query = "DELETE FROM categories WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 200,
                'message' => 'categorie deleted successfully',
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No categorie found or failed to delete user',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 400,
            'message' => 'categorie ID is required',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }
}


?>
