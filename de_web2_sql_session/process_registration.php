<!-- Trong trang process_registration.php -->
<?php
session_start();
include('ketnoidulieu.php'); // Kết nối đến cơ sở dữ liệu

// Xác minh đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Xử lý đăng ký lớp
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $user_id = $_SESSION['user_id'];

    // Kiểm tra xem người dùng đã đăng ký lớp chưa
    $check_registration_sql = "SELECT * FROM registrations WHERE class_id = $class_id AND user_id = $user_id";
    $registration_result = $conn->query($check_registration_sql);

    if ($registration_result->num_rows > 0) {
        echo "You have already registered for this class.";
    } else {
        // Thực hiện đăng ký lớp
        $register_sql = "INSERT INTO registrations (class_id, user_id) VALUES ($class_id, $user_id)";
        if ($conn->query($register_sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
