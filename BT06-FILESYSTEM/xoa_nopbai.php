<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["index"])) {
    $indexToDelete = $_POST["index"];
        
            $arLines = file("lophoc.data");
                
                    if (array_key_exists($indexToDelete, $arLines)) {
                            unset($arLines[$indexToDelete]);
                                    file_put_contents("lophoc.data", implode("", $arLines));
                                        }
                                        }

                                        header("Location: xuly_nopbai.php"); // Điều hướng trở lại trang thông tin bài đã nộp
                                        exit();
                                        ?>
                                        