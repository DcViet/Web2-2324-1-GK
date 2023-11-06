<?php
#Khởi tạo các biến vùng dữ liệu 
$privateMainContent = "";
$privateWebNav = "";
$publicWebTitle = "";

#Nạp dữ liệu biến dùng chung
include("./public-21880291/publicWebTitle.php");
$publicWebTitle = $temp1;

#Xác định chủ đề trang web thông qua truyền dữ liêu URL
$p = "home";
if (isset($_GET['page'])) {
    $p = $_GET['page'];
}
#Nạp dữ liệu vùng riêng theo chủ đề
switch ($p) {
    case '21880291_form':
}
?>