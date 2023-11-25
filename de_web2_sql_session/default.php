<!-- Trong trang index.php hoặc default.php -->
<?php
session_start();
include('ketnoidulieu.php');

// Xác minh đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    <!-- Add your CSS links or styles here -->
</head>
<body>

    <h1>Welcome to My App</h1>

    <?php
    // Hiển thị thông tin người dùng đã đăng nhập
    echo "Welcome, " . $_SESSION['username'] . "! | ";
    echo "Logged in at " . $_SESSION['login_time'] . " | ";
    echo '<a href="logout.php">Logout</a>';
    ?>

    <section>
        <h2>My Features</h2>
        <ul>
            <li><a href="display_classes.php">View Class Schedule</a></li>
            <li><a href="register_class.php">Register for Class</a></li>
            <!-- Thêm các chức năng khác tại đây -->
        </ul>
    </section>

    <section>
        <h2>Admin Features</h2>
        <!-- Phần này chỉ hiển thị nếu người dùng là admin -->
        <?php if ($_SESSION['is_admin']) : ?>
            <ul>
                <li><a href="admin_manage_classes.php">Manage Classes</a></li>
                <li><a href="admin_manage_users.php">Manage Users</a></li>
                <!-- Thêm các chức năng quản trị khác tại đây -->
            </ul>
        <?php endif; ?>
    </section>

    <!-- Add your JavaScript links or scripts here -->

</body>
</html>
