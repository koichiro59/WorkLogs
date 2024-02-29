<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-管理者メニュー</title>
    <link rel="stylesheet" href="./control.css">
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
  <div class="sideNavi">
    <ul>
      <li>
        <a href="#">
          <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
          <span class="item"></span>
        </a>
      </li>
      <li>
        <a href="./newUser.php">
          <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
          <span class="item">新規ユーザー追加</span>
        </a>
      </li>
      <li>
        <a href="./refUser.php">
          <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
          <span class="item">ユーザー照会</span>
        </a>
      </li>
      <li>
        <a href="./consent.php">
          <span class="icon"><ion-icon name="construct-outline"></ion-icon></span>
          <span class="item">修正依頼</span>
        </a>
      </li>
    </ul>
  </div>
</body>
</html>