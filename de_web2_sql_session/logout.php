<?php
session_start();

// Hủy bỏ session
session_destroy();

// Chuyển hướng về trang chính sau khi đăng xuất
header("Location: index.php");
exit();
?>
