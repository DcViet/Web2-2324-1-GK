Để xây dựng tính năng cho trang chủ (home) với yêu cầu hiển thị thông tin người thực hiện dự án và kiểm tra tính hợp lệ của người dùng thông qua đăng nhập, bạn cần thực hiện các bước sau:

### 1. Kết nối Cơ sở Dữ liệu:

```php
<?php
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 2. Hiển thị Thông tin người thực hiện dự án:

```php
<?php
// Truy vấn SQL để lấy thông tin người thực hiện dự án
$sql = "SELECT * FROM project_creator";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị thông tin người thực hiện dự án
    while($row = $result->fetch_assoc()) {
        echo "Project Creator: " . $row["name"] . "<br>";
        // Thêm các thông tin khác nếu cần
    }
} else {
    echo "No project creator information available.";
}
?>
```

### 3. Kiểm tra Đăng nhập và Hiển thị Form Đăng nhập:

```php
<?php
session_start();

// Kiểm tra nếu session chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    // Hiển thị form đăng nhập
    echo '<form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
          </form>';
} else {
    // Hiển thị thông tin người dùng đã đăng nhập
    echo "Welcome, " . $_SESSION['username'] . "!";
    // Thêm các thông tin khác nếu cần
}
?>
```

### 4. Xử lý Đăng nhập (`login.php`):

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
        header("Location: home.php"); // Chuyển hướng đến trang chủ sau khi đăng nhập
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
```

Lưu ý rằng đoạn mã trên chỉ mang tính chất minh họa và cần được điều chỉnh để phản ánh cấu trúc cụ thể của cơ sở dữ liệu và yêu cầu của bạn. Đảm bảo sử dụng kỹ thuật bảo mật như "hashed passwords" để bảo vệ thông tin người dùng.