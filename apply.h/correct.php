<?php
    include("../common.h/common.php");

    $pdo=null;
	$pdo=dB_connect();

    $_SESSION['displayDate']=$currentDate;
    if(isset($_POST["selectBtn"])) {
		$_SESSION['displayDate']=$_POST["selectDate"];
	}

    $sql_date_select = "SELECT * FROM `worker_1` WHERE date = '{$_SESSION['displayDate']}'";
	$scheduleArray = $pdo->query($sql_date_select);
    
    if (isset($_POST['applyBtn'])) {
        $_SESSION['correctStart']=$_POST["applyStart"];
        $_SESSION['correctEnd']=$_POST["applyEnd"];
        $_SESSION['correctBreak']=$_POST["applyBreak"];
        $_SESSION['correctTotal']=$_POST["applyTotal"];
        $_SESSION['correctOver']=$_POST["applyOver"];
        $_SESSION['apply']++;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"&&isset($_POST["applyBtn"])) {
        $redirect_url = "http://localhost/work_php/home.h";
        header("Location: " . $redirect_url);
        exit; 
    }
	
	$pdo=null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-申請-修正申請</title>
    <link rel="stylesheet" href="./correct.css?ver=1.06">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <header class="correctForm">
        <a href="../home.h/home.php" class="workTitle">WorkLogs</a>
        <nav>
            <ul>
                <li><a href="../data.h/data.php">勤務管理</a></li>
                <li><a href="../apply.h/apply.php">申請</a></li>
                <li><a href="../control.h/PassCheck.php">管理メニュー</a></li>
            </ul>
        </nav>
    </header>
    <div class="blank">&nbsp;</div>
    <form method = "POST"  class="correctForm">
        <div class="date">
            <input type="date" class="selectDate" name="selectDate" >
            <button type="submit" class="selectBtn" name="selectBtn">選択</a></button>
        </div>
    </form>
    <div class=container>
        <table class="oldTable">
            <tr>
                <th></th>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩(分)</th>
                <th>勤務時間(分)</th>
                <th>時間外(分)</th>
            </tr>
            <?php foreach ($scheduleArray as $schedule) : ?>
            <tr>
                <td class="oldData">修正前</td>
                <td><?php echo $schedule['date'] ?></td>
                <td><?php echo $schedule['start_at'] ?></td>
                <td><?php echo $schedule['end_at'] ?></td>
                <td><?php echo $schedule['break_time'] ?></td>
                <td><?php echo $schedule['total_time'] ?></td>
                <td><?php echo $schedule['over_time'] ?></td>
            </tr>
		    <?php endforeach; ?>
        </table>
        <br/>
        <table class="newTable">  
            <tr>
                <th></th>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩(分)</th>
                <th>勤務時間(分)</th>
                <th>時間外(分)</th>
            </tr>
            <form method="POST">
            <tr>
                <td class="newData">修正後</td>
                <td><?php echo $_SESSION['displayDate']?></td>
                <td><input type="time" class="apply" name="applyStart"></td>
                <td><input type="time" class="apply" name="applyEnd"></td>
                <td><input type="text" class="apply" name="applyBreak"></td>
                <td><input type="text" class="apply" name="applyTotal"></td>
                <td><input type="text" class="apply" name="applyOver"></td>
            </tr>
        </table>
            <div class="applyArea">
                <button type="submit" class="applyBtn" name="applyBtn">申請</a></button>
            </div>
            </form>
    </div>
</body>
</html>