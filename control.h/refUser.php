<?php
    include("../common.h/common.php");

    $pdo=null;
    $pdo=dB_connect();
    $sql_display = "SELECT * FROM `user_list`";
    $sql_user_select = "SELECT * FROM `user_list`";
    $displayArray = $pdo->query($sql_display);
    $userArray = $pdo->query($sql_user_select);

    if(isset($_POST['changeUser'])){
        $_SESSION['testUser']=$_POST['userSelect'];
    }

    $pdo=null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-管理者メニュー-ユーザー照会</title>
    <link rel="stylesheet" href="./refUser.css?ver=1.22">
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
    <div class="userSelectArea">
        <div class="userSelect">
            <div>
                <label>テストユーザー</label>
                <form method="POST">
                <select class="userSelect" name="userSelect">
                    <?php
                        foreach($userArray as $user){
                            echo '<option value="' . $user['name'] . '">' . $user['name'] . '</option>';
                        }
                    ?>
                </select>
                <button type="submit" class="changeBtn" name="changeUser">変更</a></button>
                </form>
            </div>
        <table>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>生年月日</th>
                <th>性別</th>
                <th>Password</th>
            </tr>
            <?php foreach ($displayArray as $display) : ?>
            <tr>
                <td><?php echo $display['UserID'] ?></td>
                <td><?php echo $display['name'] ?></td>
                <td><?php echo $display['birth'] ?></td>
                <td><?php echo $display['gender'] ?></td>
                <td><?php echo $display['pass'] ?></td>
            </tr>
		    <?php endforeach; ?>
	    </table>
        </div>
        <p class="testUser"><?php echo "テストユーザーは「".$_SESSION['testUser']."」です"?></p>
    </div>
</body>
</html>