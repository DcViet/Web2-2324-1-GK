Để thực hiện tính năng đăng nhập, hiển thị thông tin người dùng đã đăng nhập, và có chức năng đăng xuất, bạn có thể sử dụng session để theo dõi trạng thái đăng nhập của người dùng. Dưới đây là một số thay đổi cần thực hiện:

### 1. Kiểm tra và hiển thị thông tin người dùng đã đăng nhập:

```php
<?php
session_start();

// Kiểm tra nếu session đã đăng nhập
if (isset($_SESSION['user_id'])) {
    // Hiển thị thông tin người dùng đã đăng nhập
    echo "Welcome, " . $_SESSION['username'] . "! | ";
    echo "Logged in at " . $_SESSION['login_time'] . " | ";
    echo '<a href="logout.php">Logout</a>';
} else {
    // Hiển thị form đăng nhập nếu chưa đăng nhập
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

### 2. Xử lý đăng nhập và cập nhật session (`login.php`):

```php
<?php
session_start();

// Kết nối cơ sở dữ liệu
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['login_time'] = date("Y-m-d H:i:s");

        // Redirect to home.php or any other page after successful login
        header("Location: home.php");
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
```

### 3. Tính năng Đăng xuất (`logout.php`):

```php
<?php
session_start();

// Hủy bỏ session
session_destroy();

// Redirect về trang chủ sau khi đăng xuất
header("Location: home.php");
?>
```

Lưu ý: 
- Thay đổi `home.php` thành trang chủ thực tế của bạn.
- Đảm bảo rằng mọi trang yêu cầu đăng nhập đều kiểm tra session để đảm bảo người dùng đã đăng nhập mới có thể truy cập.
- Thực hiện bảo mật đối với thông tin đăng nhập, ví dụ như sử dụng "hashed passwords".