Để hiển thị danh sách các lớp học của ngày hiện tại và cung cấp các thông tin cần thiết cũng như tính năng đăng ký lớp cho khách hiện tại, bạn cần thực hiện một số bước sau:

### 1. Hiển Thị Danh Sách Các Lớp Học:

```php
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
```

### 2. Tính Năng Đăng Ký Lớp Cho Khách Hiện Tại:

```php
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
```

Lưu ý: Điều này giả sử bạn có một bảng `classes` để lưu trữ thông tin của các lớp học và một bảng `registrations` để lưu trữ thông tin về việc người dùng đăng ký lớp. Hãy điều chỉnh mã nếu bạn có cấu trúc cơ sở dữ liệu khác.