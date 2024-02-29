<?php
    echo "<script>alert('管理者メニューです');</script>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_value = $_POST["password"];
        if (!empty($input_value)) {
            if ($input_value == "12345678") {
                header('Location: ' . 'control.php', true , 301); 
                exit; 
            }else {
                echo "<script>alert('パスワードが間違っています');</script>";
            }
        } else {
            echo "<script>alert('パスワードを入力してください');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード確認</title>
    <link rel="stylesheet" href="./PassCheck.css">
</head>
<body>
    <header>
        <a href="../home.h/home.php" class="title">WorkLogs</a>
        <nav>
            <ul>
                <li><a href="../data.h/data.php">勤務管理</a></li>
                <li><a href="../apply.h/apply.php">申請</a></li>
                <li><a href="../control.h/PassCheck.php">管理メニュー</a></li>
            </ul>
        </nav>
    </header>
    <div class="blank">&nbsp;</div>
    <div class="loginForm">
        <p class="formTitle">Login</p>
        <form method="POST">
            <p>Password</p>
            <p class="pass">
            <input type="password" name="password" Value="12345678"/>
            </p>
            <p class="login">
            <button class="loginBtn" name="loginBtn">login</a></button>
            </p>
        </form>
    </div>
    <div>
        <p class="commnet">※passは12345678です</p>
    </div>
</body>
</html>
