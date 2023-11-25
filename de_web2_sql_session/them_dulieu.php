<?php
include('ketnoidulieu.php'); // Kết nối đến cơ sở dữ liệu

// Thêm một lớp học mới
$class_name = "Hip-Hop Dance Class";
$class_date = "2023-11-27";
$total_slots = 20;

$sql = "INSERT INTO classes (class_name, class_date, total_slots) VALUES ('$class_name', '$class_date', $total_slots)";

if ($conn->query($sql) === TRUE) {
    echo "New class added successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
