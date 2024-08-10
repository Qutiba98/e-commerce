    <?php
    require '../connection_db_pdo.php';

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Method: POST');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : "";
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";

        if ($id && $name && $mobile && $email) {
            $sql = "UPDATE users SET name = :name, phone_number = :mobile, email = :email WHERE user_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo json_encode(['status' => true, 'message' => 'User updated successfully']);
                header("Location: http://localhost/e-commerce/backend/userProfile/veiw.php?user_id=$id");

            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to update user']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid input data']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Method Not Allowed']);
    }

    ?>
