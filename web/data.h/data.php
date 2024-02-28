<?php
	include("../common.h/common.php");

	$yearTable = [
		['value' => 2020, 'text' => '2020年'],
		['value' => 2021, 'text' => '2021年'],
		['value' => 2022, 'text' => '2022年'],
		['value' => 2023, 'text' => '2023年'],
		['value' => 2024, 'text' => '2024年']
	];
	$monthTable = [
		['value' => 'January', 'text' => '1月'],
		['value' => 'February', 'text' => '2月'],
		['value' => 'March', 'text' => '3月'],
		['value' => 'April', 'text' => '4月'],
		['value' => 'May', 'text' => '5月'],
		['value' => 'June', 'text' => '6月'],
		['value' => 'July', 'text' => '7月'],
		['value' => 'August', 'text' => '8月'],
		['value' => 'September', 'text' => '9月'],
		['value' => 'October', 'text' => '10月'],
		['value' => 'November', 'text' => '11月'],
		['value' => 'December', 'text' => '12月'],
	];
	$selectYear=2020;
	$selectMonth='January';

    $pdo=null;
	$pdo=db_connect();
	if(isset($_POST["yearSelect"])&&isset($_POST["monthSelect"])) {
		$selectYear=$_POST["yearSelect"];
		$selectMonth=$_POST["monthSelect"];
	}
	$sql_date_select = "SELECT * FROM `worker_1` WHERE month = '$selectMonth' and year = $selectYear";
	$scheduleArray = $pdo->query($sql_date_select);
	$pdo=null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLogs-勤務管理</title>
    <link rel="stylesheet" href="../data.h/data.css?ver=1.14">
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
	<div class="container">
		<div class="dataArea">
			<form method = "POST">
				<select name="yearSelect">
					<?php
						foreach($yearTable as $year) {
							if ($_POST['yearSelect'] == $year['value']) {
								echo '<option value="' . $year['value'] . '" selected>' . $year['text'] . '</option>';
							} else {
								echo '<option value="' . $year['value'] . '">' . $year['text'] . '</option>';
							}
						}
					?>
				</select>
				<select name="monthSelect">
					<?php
						foreach($monthTable as $month) {
							if ($_POST['monthSelect'] == $month['value']) {
								echo '<option value="' . $month['value'] . '" selected>' . $month['text'] . '</option>';
							} else {
								echo '<option value="' . $month['value'] . '">' . $month['text'] . '</option>';
							}
						}
					?>
				</select>
				<input type="submit" name="workDisplay" value="表示"/>
			</form>
			<table>
				<tr>
					<th>日付</th>
					<th>出勤</th>
					<th>退勤</th>
					<th>休憩(分)</th>
					<th>勤務時間(分)</th>
					<th>時間外(分)</th>
				</tr>
				<?php foreach ($scheduleArray as $schedule) : ?>
				<tr>
					<td><?php echo $schedule['date'] ?></td>
					<td><?php echo $schedule['start_at'] ?></td>
					<td><?php echo $schedule['end_at'] ?></td>
					<td><?php echo $schedule['break_time'] ?></td>
					<td><?php echo $schedule['total_time'] ?></td>
					<td><?php echo $schedule['over_time'] ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="chartArea">
			<div>
				<canvas id="myChart" width="500" height="500"></canvas>
			</div>
			<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
			<script>
				const ctx = document.getElementById('myChart');
				new Chart(ctx, {
					type: 'bar',
					data: {
					labels: ['1月', '2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
					datasets: [{
						label: '月ごとの勤務時間(デモグラフ)',
						data: [12, 19, 3, 5, 2, 3,0,0,0,0,0,0],
						borderWidth: 1
					}]
					},
					options: {
					scales: {
						y: {
						beginAtZero: true
						}
					}
					}
				});
			</script>
		</div>
	</div>
</body>
</html>