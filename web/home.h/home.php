<?php
    include("../common.h/common.php");

    $setOverTimestamp=strtotime("$currentDate"." 18:00:00");
    $setTotalTime=0;
    $setOverTime=0;
    $setBreakTime=0;

    $startColor = $_SESSION['startBool'] ? 'on' : 'off';
    $endColor = $_SESSION['endBool']? 'on' : 'off';
    $breakColor = $_SESSION['breakBool'] ? 'on' : 'off';

    $pdo=null;
    $pdo=db_connect();

    if (isset($_POST['startWork'])) {
        inverse();
        $_SESSION['startTimestamp']=strtotime("$currentTime");
        $sql_start_log = "UPDATE worker_1 SET start_at = :start_at WHERE date = '$currentDate'";
        $stmt_start_log = $pdo->prepare($sql_start_log);
        $params_start_log = array(':start_at' => $currentTime);
        $stmt_start_log->execute($params_start_log);

        header("Location:./home.php");
        exit();   
    }else if (isset($_POST['endWork'])) {
        inverse();
        $_SESSION['endTimestamp']=strtotime("$currentTime");
        $setTotalTime=($_SESSION['endTimestamp']-$_SESSION['startTimestamp'])/60;
        $setOverTime=($_SESSION['endTimestamp']-$setOverTimestamp)/60;
        if($setOverTime<0){
            $setOverTime=0;
        }
        $sql_end_log = "UPDATE worker_1 SET end_at = :end_at, total_time = :total_time, over_time = :over_time WHERE date = '$currentDate'";
        $stmt_end_log = $pdo->prepare($sql_end_log);
        $params_end_log = array(':end_at' => $currentTime, ':total_time' => $setTotalTime,':over_time' => $setOverTime);
        $stmt_end_log->execute($params_end_log);

        session_destroy();
        header("Location:./home.php");
        exit();   
    }else if (isset($_POST['breakWork'])){
        if($_SESSION['breakBool']==true){
            $_SESSION['breakupTimestamp']=strtotime("$currentTime");
        }else{
            $_SESSION['breakdownTimestamp']=strtotime("$currentTime");

            $setBreakTime=($_SESSION['breakdownTimestamp']-$_SESSION['breakupTimestamp'])/60;
            $sql_break_log= "UPDATE worker_1 SET break_time = :break_time WHERE date = '$currentDate'";
            $stmt_break_log = $pdo->prepare($sql_break_log);
            $params_break_log = array(':break_time' => $setBreakTime);
            $stmt_break_log->execute($params_break_log);
        }
        $_SESSION['breakBool'] =!$_SESSION['breakBool']; 

        header("Location:./home.php");
        exit();   
    }
    
    $pdo=null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="{{ mix('./home.css') }}">
    <title>WorkLogs</title>
</head>
<body>
    <header>
        <a href="./home.php" class="title">WorkLogs</a>
        <nav>
            <ul>
                <li><a href="../data.h/data.php">勤務管理</a></li>
                <li><a href="../apply.h/apply.php">申請</a></li>
                <li><a href="../control.h/PassCheck.php">管理メニュー</a></li>
            </ul>
        </nav>
    </header>
    <div class="blank">&nbsp;</div>
    <div class="container">
        <div class="clock">
            <p class="clockDate"><?php echo $currentDay;?></p>
            <p class="clockTime"><?php echo $currentTime;?></p>
        </div>
        <form class="btnArea" method="POST">
                <button type="submit" class="btn-<?php echo $startColor; ?>" name="startWork">出勤</a></button>
                <button type="submit" class="btn-<?php echo $endColor; ?>" name="endWork">退勤</a></button>
                <button type="submit" class="btn-<?php echo $breakColor; ?>" name="breakWork">休憩</a></button>
        </form>
        <p class="testUser"><?php echo "テストユーザーは「".$_SESSION['testUser']."」です"?></p>
    </div>
</body>
</html>
