<?php
    include("../common.h/common.php");

    if(isset($_SESSION['displayDate'])){
        $pdo=null;
        $pdo=dB_connect();
        $sql_date_select = "SELECT * FROM `worker_1` WHERE date = '{$_SESSION['displayDate']}'";
        $scheduleArray = $pdo->query($sql_date_select);
        
        if (isset($_POST['consentBtn'])) {
            $_SESSION['apply']--;
            $sql_consent = "UPDATE worker_1 SET
                start_at = :start_at, end_at = :end_at, break_time = :break_time, 
                total_time = :total_time, over_time = :over_time WHERE date = '{$_SESSION['displayDate']}'";
            $stmt_consent = $pdo->prepare($sql_consent);
            $params_correct_date = array(':start_at' => $_SESSION['correctStart'], ':end_at' => $_SESSION['correctEnd'],
            ':break_time' =>  $_SESSION['correctBreak'], ':total_time' =>  $_SESSION['correctTotal'],':over_time' => $_SESSION['correctOver']);
            $stmt_consent->execute($params_correct_date);
        }    
    }
    
    $pdo=null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-管理者メニュー-ユーザー照会</title>
    <link rel="stylesheet" href="./consent.css?ver=1.55">
    <style>
        <?php if($_SESSION['apply'] == 0) { ?>
        .oldTable,.newTable,.consentBtn{
            display: none;
        }
        <?php } ?>
    </style>
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
    <h2>
        <?php 
            if(isset($_SESSION['apply'])){
                echo "修正依頼が0件あります" 
            }else{
                echo "修正依頼が".$_SESSION['apply']."件あります" 
            }
        ?>
    </h2>
    <div>
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
                    <td><?php echo $_SESSION['displayDate'] ?></td>
                    <td><?php echo $_SESSION['correctStart'] ?></td>
                    <td><?php echo $_SESSION['correctEnd'] ?></td>
                    <td><?php echo $_SESSION['correctBreak'] ?></td>
                    <td><?php echo $_SESSION['correctTotal'] ?></td>
                    <td><?php echo $_SESSION['correctOver'] ?></td>
                </tr>
            </table>
            <div class="consentArea">
                <button type="submit" class="consentBtn" name="consentBtn">修正</button>
            </div>
    </div>
</body>
</html>

