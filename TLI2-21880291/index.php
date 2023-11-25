<?php
#Khởi tạo  các biến vùng dữ liệu 
$publicWebTitle = "MSSV:21880291";
$publicWebSubject = "BT5 - kỹ thuật TLI2";
$publicMenu = "";
$publicNav = "";
$publicInfo = "";

$privateTitle = "";
$privateMainContent = "";
$privateRoomContent = "";
#Nạp dữ liệu biến dùng chung
include("./21880291-public/public_menu.php");
$publicMenu = $temp;
include("./21880291-public/public_info.php");
$publicInfo = $temp1;
include("./21880291-public/public_nav.php");
$publicNav = $temp2;

$publicWebSubject = "";
$publicWebTitle = "";

#Xác định chủ đề trang web thông qua truyền dữ liệu URL
$p = "home";
if (isset($_GET['page'])) {
    $p = $_GET['page'];
}

#Nạp dữ liệu vùng riêng theo chủ đề
switch ($p) {
    case '21880291_form':
        
        include("./MyCSSTemplate21880291/21880291_form.php");
        break;

    case 'myhost':
        $privateTitle = "Lập trình web2 &amp; BT5-Tuần 6, HOST";
        $privateMainContent = "";
        break;

    case "home":
    default:
        $privateTitle = "Lập trình web2 &amp; BT5-Tuần 6, TrungDuc-21880291";
        include("./21880291-private/21880291-exhibition/private_main_content.php");
        $privateMainContent = $temp;
        include("./21880291-private/21880291-exhibition/private_room_content.php");
        $privateMainContent = $temp3;
        break;
}
#Gọi giao diện gốc
include("./MyCSSTemplate21880291/GD1.php");
?>