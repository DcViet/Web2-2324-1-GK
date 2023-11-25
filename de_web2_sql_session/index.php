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
