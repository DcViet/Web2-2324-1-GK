<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống nộp bài tập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            text-align: center;
        }
        h3 {
            margin-top: 0;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease-in-out;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hệ thống nộp bài tập</h1>
    </header>
    <div class="container">
        <h3>Hệ thống nộp bài tập</h3>
        <form action="./xuly_nopbai.php" method="POST" enctype="multipart/form-data">
            <label for="mssv">MSSV:</label>
            <input type="text" name="mssv" placeholder="Nhập MSSV" required>
            
            <label for="myFile">Chọn bài nộp:</label>
            <input type="file" name="myFile" />
            
            <input type="submit" value="Nộp bài" />
        </form>
    </div>
</body>
</html>
