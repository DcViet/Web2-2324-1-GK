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
