<?php
# Kiem tra du lieu truyen ve
if (!isset($_POST["mssv"])) {
    header("Location: index.php");
    exit(); 
}

$mssv = $_POST['mssv'];
$taptin = $_FILES['myFile'];

# Xu ly tap tin
$tenmoi = "";
$ngaynop = date("ymd-His");

if (isset($taptin)) {
    $tengoc = $taptin["name"];
    $tenmoi = "$ngaynop-$tengoc";

    $loaitaptin = $taptin["type"];
    $kichthuoc = $taptin["size"] / 1024.0; // kb

    # Di chuyen tap tin
    move_uploaded_file($taptin["tmp_name"], $tenmoi);
}

# Ghi du lieu
$pFile = fopen("./lophoc.data", "a");
$newLine = "$ngaynop;$mssv;$tenmoi\n";
fwrite($pFile, $newLine);
fclose($pFile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin bài nộp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .delete-button {
            background-color: #ff5a5a;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thông tin bài nộp</h1>
            <a href="./index.php">Home</a>
        </div>
        <?php
        echo "<p><b>MSSV Nộp bài:</b> $mssv</p>";
        echo "<p><b>Tên tệp:</b> $tenmoi</p>";
        echo "<p><b>Loại tệp:</b> $loaitaptin</p>";
        echo "<p><b>Kích thước:</b> $kichthuoc KB</p>";
        ?>
<hr/>
<h2>Danh sách bài nộp</h2>
        <table>
            <thead>
                <tr>
                    <th>Ngày nộp</th>
                    <th>MSSV</th>
                    <th>Tên tệp</th>
                    <th>Tải xuống</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $arLines = file("lophoc.data");
                $arLines = array_reverse($arLines);

                foreach ($arLines as $index => $line) {
                    $data = explode(";", $line);
                    $ngaydanop = $data[0];
                    $mssvnop = $data[1];
                    $urlnop = $data[2];
                    ?>

                    <tr>
                        <td><?php echo $ngaydanop; ?></td>
                        <td><?php echo $mssvnop; ?></td>
                        <td><?php echo $urlnop; ?></td>
                        <td><a href="<?php echo $urlnop; ?>" download>Tải xuống</a></td>
                        <td>
                            <form action="xoa_nopbai.php" method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="delete-button">Xóa</button>
                            </form>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>

        <div class="footer">
            &copy; <?php echo date("Y"); ?> - Hệ thống nộp bài tập - 21880291
        </div>
    </div>
</body>
</html>