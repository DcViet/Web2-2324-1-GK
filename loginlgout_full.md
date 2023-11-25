Dưới đây là mã nguồn minh họa cho các tính năng bạn yêu cầu:

### login.php
```php
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Nếu đã đăng nhập, chuyển hướng về trang chính
    header("Location: index.php");
    exit();
}

// Xử lý đăng nhập hệ thống
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối CSDL và kiểm tra thông tin đăng nhập
    // (Giả sử có kết nối CSDL trong file db_connection.php)
    include('db_connection.php');

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['login_time'] = date("Y-m-d H:i:s");

        // Chuyển hướng về trang chính
        header("Location: index.php");
        exit();
    } else {
        // Đăng nhập không thành công
        $error_message = "Invalid username or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your CSS links or styles here -->
</head>
<body>

    <h1>Login</h1>

    <?php
    // Hiển thị thông báo lỗi (nếu có)
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <!-- Add your JavaScript links or scripts here -->

</body>
</html>
```

### index.php
```php
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Nếu đã đăng nhập, hiển thị thông tin người dùng và link logout
    echo "Welcome, " . $_SESSION['username'] . "! | ";
    echo "Logged in at " . $_SESSION['login_time'] . " | ";
    echo '<a href="logout.php">Logout</a>';
} else {
    // Nếu chưa đăng nhập, hiển thị form đăng nhập
    echo '<form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>';
}
?>
```

### logout.php
```php
<?php
session_start();

// Hủy bỏ session
session_destroy();

// Chuyển hướng về trang chính sau khi đăng xuất
header("Location: index.php");
exit();
?>
```

Lưu ý: Bạn cần tạo bảng `users` trong CSDL để lưu thông tin về người dùng, và thay đổi các truy vấn SQL để phản ánh cấu trúc thực tế của CSDL bạn đang sử dụng. Đồng thời, hãy đảm bảo rằng thông tin đăng nhập được xử lý an toàn để tránh các tấn công bảo mật như SQL injection.