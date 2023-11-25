<!-- Trong trang display_classes.php -->
<?php
session_start();
include('ketnoidulieu.php'); // Kết nối đến cơ sở dữ liệu

// Xác minh đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy ngày hiện tại
$current_date = date("Y-m-d");

// Lấy danh sách các lớp học cho ngày hiện tại
$sql = "SELECT * FROM classes WHERE class_date = '$current_date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>{$row['class_name']}</h2>";
        echo "Class Date: {$row['class_date']}<br>";
        echo "Total Slots: {$row['total_slots']}<br>";

        // Kiểm tra xem khách hàng đã đăng ký lớp hay chưa
        $class_id = $row['class_id'];
        $user_id = $_SESSION['user_id'];
        $check_registration_sql = "SELECT * FROM registrations WHERE class_id = $class_id AND user_id = $user_id";
        $registration_result = $conn->query($check_registration_sql);

        if ($registration_result->num_rows > 0) {
            // Người dùng đã đăng ký lớp
            echo "You have already registered for this class.<br>";
        } else {
            // Người dùng chưa đăng ký lớp
            echo "<form action='process_registration.php' method='post'>";
            echo "<input type='hidden' name='class_id' value='$class_id'>";
            echo "<input type='submit' value='Register for Class'>";
            echo "</form>";
        }

        echo "<hr>";
    }
} else {
    echo "No classes available for today.";
}

$conn->close();
?>
