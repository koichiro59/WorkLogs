<?php
  include("../common.h/common.php");

  $pdo=null;
  $pdo=db_connect();

  if (isset($_POST['userAddBtn'])) {
    //user_listに新規ユーザー追加
    $sql_user_add= "INSERT INTO user_list (name, birth, gender, pass) VALUES (:name, :birth, :gender, :pass)";
    $stmt_user_add = $pdo->prepare($sql_user_add);
    $params_user_data = array(':name'=>$_POST["registName"], ':birth'=>$_POST["registBirth"], ':gender'=>$_POST["registGender"], ':pass'=>$_POST["registPass"]);
    $stmt_user_add->execute($params_user_data);

    //ユーザー数を計測
    $sql_user_count = "SELECT * FROM `user_list`";
    $user_list = $pdo->query($sql_user_count);
    $count=$user_list->rowCount();
    $table_name="worker_".$count;

    //ユーザー数からworker_XXテーブルを追加
    $sql_table_add = "CREATE TABLE $table_name(
      DateID INT(11) AUTO_INCREMENT PRIMARY KEY,
      date DATE,
      start_at TIME,
      end_at TIME,
      break_time INT(11),
      total_time INT(11),
      over_time INT(11),
      month VARCHAR(10),
      year INT(11)
  )";
  $table_add = $pdo->query($sql_table_add);

  $sql_create_calendar=create_calendar($table_name);
  $stmt_create_calendar = $pdo->prepare($sql_create_calendar);
  $stmt_create_calendar->execute();

    echo '登録完了しました';
  }
  $pdo=null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-管理者メニュー-新規ユーザー追加</title>
    <link rel="stylesheet" href="./newUser.css?ver=1.14">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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
  <div class="registForm">
    <p class="registTitle">登録フォーム</p>
    <form method="POST">
        <p>名前</p>
        <p class="regist">
        <input name="registName">
        </p>
        <p>生年月日</p>
        <p class="regist">
        <input name="registBirth"/>
        </p>
        <p>性別</p>
        <p class="regist">
        <label><input type="radio" name="registGender" value="男性">男性</label>
        <label><input type="radio" name="registGender" value="女性">女性</label>
        </p>
        <p>Password</p>
        <p class="regist">
        <input type="password" name="registPass"/>
        </p>
        <p class="submit">
        <button type="submit" class="registBtn" name="userAddBtn">追加</a></button>
        </p>
    </form>
  <div>
</body>
</html>
