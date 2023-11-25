<?php
include('ketnoidulieu.php'); // Kết nối đến cơ sở dữ liệu

// Sửa thông tin lớp học
$class_id_to_update = 1; // ID của lớp học cần sửa
$new_class_name = "Updated Dance Class";
$new_class_date = "2023-12-01";
$new_total_slots = 25;

$sql = "UPDATE classes SET class_name='$new_class_name', class_date='$new_class_date', total_slots=$new_total_slots WHERE class_id=$class_id_to_update";

if ($conn->query($sql) === TRUE) {
    echo "Class updated successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
