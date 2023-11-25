<?php
include('ketnoidulieu.php'); // Kết nối đến cơ sở dữ liệu

// Xóa một lớp học
$class_id_to_delete = 1; // ID của lớp học cần xóa

$sql = "DELETE FROM classes WHERE class_id=$class_id_to_delete";

if ($conn->query($sql) === TRUE) {
    echo "Class deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
