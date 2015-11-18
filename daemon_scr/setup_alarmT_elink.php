<!DOCTYPE html>
<html lang="en">
<head>
	<title>ELink Alarm Setup</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

	<br><br>
	<style>
		table, td, th {
			border: 1px solid #000000;
		}

		th {
			background-color: #000000;
			color: white;

		}

		td{
			height: 40px;
			padding: 10px;
		}
	</style>

	<?php
	echo "<b>Setup the alarm threshold of Elink Headend Platform.</b><br>";
	echo "Leaving the space blank will disable the alarm function of this item.<br>";
	require("daemon_db_init.php");
	$query_value = "SELECT 
		daemonsnmpelinkps.outputv, 
		daemonsnmpelinkps.outputma, 
		daemonsnmpelinkps.outputw, 
		daemonsnmpelinkrrx.input1, 
		daemonsnmpelinkrrx.input2, 
		daemonsnmpelinkrrx.input3, 
		daemonsnmpelinkrrx.input4, 
		daemonsnmpelinkftx.lasertemp, 
		daemonsnmpelinkftx.laserbiascurrent, 
		daemonsnmpelinkftx.outputpower, 
		daemonsnmpelinkftx.thccurrent
		FROM 
		public.daemonsnmpelinkftx, 
		public.daemonsnmpelinkps, 
		public.daemonsnmpelinkrrx;";

	$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result_value)) {	
		$outputv = floatval($row->outputv);    // 1
		$outputma = floatval($row->outputma);    // 2
		$outputw = floatval($row->outputw);    // 3
		$input1 = floatval($row->input1);    // 4
		$input2 = floatval($row->input2);    // 5
		$input3 = floatval($row->input3);    // 6
		$input4 = floatval($row->input4);     // 7
		$lasertemp = floatval($row->lasertemp);    // 8
		$laserbiascurrent = floatval($row->laserbiascurrent);    // 9
		$outputpower = floatval($row->outputpower);     // 10
		$thccurrent = floatval($row->thccurrent);
	}
	pg_free_result($result_value);	
	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthreselinkps';";
	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());
	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){
		$exist = $row_exist->relname;
	}
	// only if existed, following function will perform  
	if ($exist == "daemonalarmthreselinkps") {
		$query_t ="SELECT 
			daemonalarmthreselinkps.outputv1, 
			daemonalarmthreselinkps.outputv2, 
			daemonalarmthreselinkps.outputv3, 
			daemonalarmthreselinkps.outputv4, 
			daemonalarmthreselinkps.outputv5, 
			daemonalarmthreselinkps.outputma1, 
			daemonalarmthreselinkps.outputma2, 
			daemonalarmthreselinkps.outputma3, 
			daemonalarmthreselinkps.outputma4, 
			daemonalarmthreselinkps.outputma5, 
			daemonalarmthreselinkps.outputw1, 
			daemonalarmthreselinkps.outputw2, 
			daemonalarmthreselinkps.outputw3, 
			daemonalarmthreselinkps.outputw4, 
			daemonalarmthreselinkps.outputw5, 
			daemonalarmthreselinkrrx.input11, 
			daemonalarmthreselinkrrx.input12, 
			daemonalarmthreselinkrrx.input13, 
			daemonalarmthreselinkrrx.input14, 
			daemonalarmthreselinkrrx.input15, 
			daemonalarmthreselinkrrx.input21, 
			daemonalarmthreselinkrrx.input22, 
			daemonalarmthreselinkrrx.input23, 
			daemonalarmthreselinkrrx.input25, 
			daemonalarmthreselinkrrx.input31, 
			daemonalarmthreselinkrrx.input24, 
			daemonalarmthreselinkrrx.input32, 
			daemonalarmthreselinkrrx.input33, 
			daemonalarmthreselinkrrx.input34, 
			daemonalarmthreselinkrrx.input35, 
			daemonalarmthreselinkrrx.input42, 
			daemonalarmthreselinkrrx.input41, 
			daemonalarmthreselinkrrx.input43, 
			daemonalarmthreselinkrrx.input44, 
			daemonalarmthreselinkrrx.input45, 
			daemonalarmthreselinkftx.lasertemp1, 
			daemonalarmthreselinkftx.lasertemp2, 
			daemonalarmthreselinkftx.lasertemp3, 
			daemonalarmthreselinkftx.lasertemp4, 
			daemonalarmthreselinkftx.lasertemp5, 
			daemonalarmthreselinkftx.laserbiascurrent1, 
			daemonalarmthreselinkftx.laserbiascurrent2, 
			daemonalarmthreselinkftx.laserbiascurrent3, 
			daemonalarmthreselinkftx.laserbiascurrent4, 
			daemonalarmthreselinkftx.laserbiascurrent5, 
			daemonalarmthreselinkftx.outputpower1, 
			daemonalarmthreselinkftx.outputpower2, 
			daemonalarmthreselinkftx.outputpower3, 
			daemonalarmthreselinkftx.outputpower4, 
			daemonalarmthreselinkftx.outputpower5, 
			daemonalarmthreselinkftx.thccurrent1, 
			daemonalarmthreselinkftx.thccurrent2, 
			daemonalarmthreselinkftx.thccurrent3, 
			daemonalarmthreselinkftx.thccurrent4, 
			daemonalarmthreselinkftx.thccurrent5
			FROM 
			public.daemonalarmthreselinkftx, 
			public.daemonalarmthreselinkps, 
			public.daemonalarmthreselinkrrx;";
		$result_t = pg_query($query_t) or die('Query failed: ' . pg_last_error());
		while ($row = pg_fetch_object($result_t)) {
			$outputv_1 = $row->outputv1;
			$outputv_2 = $row->outputv2;
			$outputv_3 = $row->outputv3;
			$outputv_4 = $row->outputv4;
			$outputv_5 = $row->outputv5;
			$outputma_1 = $row->outputma1;
			$outputma_2 = $row->outputma2;
			$outputma_3 = $row->outputma3;
			$outputma_4 = $row->outputma4;
			$outputma_5 = $row->outputma5;
			$outputw_1 = $row->outputw1;
			$outputw_2 = $row->outputw2;
			$outputw_3 = $row->outputw3;
			$outputw_4 = $row->outputw4;
			$outputw_5 = $row->outputw5;
			$input1_1 = $row->input11;
			$input1_2 = $row->input12;
			$input1_3 = $row->input13;
			$input1_4 = $row->input14;
			$input1_5 = $row->input15;
			$input2_1 = $row->input21;
			$input2_2 = $row->input22;
			$input2_3 = $row->input23;
			$input2_4 = $row->input24;
			$input2_5 = $row->input25;
			$input3_1 = $row->input31;
			$input3_2 = $row->input32;
			$input3_3 = $row->input33;
			$input3_4 = $row->input34;
			$input3_5 = $row->input35;
			$input4_1 = $row->input41;
			$input4_2 = $row->input42;
			$input4_3 = $row->input43;
			$input4_4 = $row->input44;
			$input4_5 = $row->input45;
			$lasertemp_1 = $row->lasertemp1;
			$lasertemp_2 = $row->lasertemp2;
			$lasertemp_3 = $row->lasertemp3;
			$lasertemp_4 = $row->lasertemp4;
			$lasertemp_5 = $row->lasertemp5;
			$laserbiascurrent_1 = $row->laserbiascurrent1;
			$laserbiascurrent_2 = $row->laserbiascurrent2;
			$laserbiascurrent_3 = $row->laserbiascurrent3;
			$laserbiascurrent_4 = $row->laserbiascurrent4;
			$laserbiascurrent_5 = $row->laserbiascurrent5;
			$outputpower_1 = $row->outputpower1;
			$outputpower_2 = $row->outputpower2;
			$outputpower_3 = $row->outputpower3;
			$outputpower_4 = $row->outputpower4;
			$outputpower_5 = $row->outputpower5;
			$thccurrent_1 = $row->thccurrent1;
			$thccurrent_2 = $row->thccurrent2;
			$thccurrent_3 = $row->thccurrent3;
			$thccurrent_4 = $row->thccurrent4;
			$thccurrent_5 = $row->thccurrent5;
		}
		pg_free_result($result_t);
	}
	pg_close($dbconn);

	?>

	<br><br>


	<form action="daemon_alarmTelink.php" method="POST">

		<table >
			<tr>
				<td>Power Supply: Output (v)</td>
				<td>Current Value: <?php echo $outputv;?></td>	
				<td>Low-Low: <input type="number" step="any" name="outputv1" value=<?php echo $outputv_1;?>> </td>
				<td>Low: <input type="number" step="any" name="outputv2" value=<?php echo $outputv_2;?>> </td> 
				<td>High: <input type="number" step="any" name="outputv3" value=<?php echo $outputv_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="outputv4" value=<?php echo $outputv_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="outputv7" value=<?php echo $outputv_5;?>> </td>
			</tr>

			<tr>
				<td>Power Supply: Output (mA) </td>
				<td>Current Value: <?php echo $outputma;?></td>	
				<td>Low-Low: <input type="number" step="any" name="outputma1" value=<?php echo $outputma_1;?>> </td>
				<td>Low: <input type="number" step="any" name="outputma2" value=<?php echo $outputma_2;?>> </td> 
				<td>High: <input type="number" step="any" name="outputma3" value=<?php echo $outputma_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="outputma4" value=<?php echo $outputma_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="outputma7" value=<?php echo $outputma_5;?>> </td>
			</tr>

			<tr>
				<td>Power Supply: Output (W) </td>
				<td>Current Value: <?php echo $outputw;?></td>	
				<td>Low-Low: <input type="number" step="any" name="outputw1" value=<?php echo $outputw_1;?>> </td>
				<td>Low: <input type="number" step="any" name="outputw2" value=<?php echo $outputw_2;?>> </td> 
				<td>High: <input type="number" step="any" name="outputw3" value=<?php echo $outputw_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="outputw4" value=<?php echo $outputw_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="outputw7" value=<?php echo $outputw_5;?>> </td>
			</tr>




			<tr>
				<td>RRX: Input 1 </td>
				<td>Current Value: <?php echo $input1;?></td>	
				<td>Low-Low: <input type="number" step="any" name="input11" value=<?php echo $input1_1;?>> </td>
				<td>Low: <input type="number" step="any" name="input12" value=<?php echo $input1_2;?>> </td> 
				<td>High: <input type="number" step="any" name="input13" value=<?php echo $input1_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="input14" value=<?php echo $input1_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="input17" value=<?php echo $input1_5;?>> </td>
			</tr>

			<tr>
				<td>RRX: Input 2 </td>
				<td>Current Value: <?php echo $input2;?></td>	
				<td>Low-Low: <input type="number" step="any" name="input21" value=<?php echo $input2_1;?>> </td>
				<td>Low: <input type="number" step="any" name="input22" value=<?php echo $input2_2;?>> </td> 
				<td>High: <input type="number" step="any" name="input23" value=<?php echo $input2_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="input24" value=<?php echo $input2_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="input27" value=<?php echo $input2_5;?>> </td>
			</tr>

			<tr>
				<td>RRX: Input 3 </td>
				<td>Current Value: <?php echo $input3;?></td>	
				<td>Low-Low: <input type="number" step="any" name="input31" value=<?php echo $input3_1;?>> </td>
				<td>Low: <input type="number" step="any" name="input32" value=<?php echo $input3_2;?>> </td> 
				<td>High: <input type="number" step="any" name="input33" value=<?php echo $input3_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="input34" value=<?php echo $input3_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="input37" value=<?php echo $input3_5;?>> </td>
			</tr>
			<tr>
				<td>RRX: Input 4 </td>
				<td>Current Value: <?php echo $input4;?></td>	
				<td>Low-Low: <input type="number" step="any" name="input41" value=<?php echo $input4_1;?>> </td>
				<td>Low: <input type="number" step="any" name="input42" value=<?php echo $input4_2;?>> </td> 
				<td>High: <input type="number" step="any" name="input43" value=<?php echo $input4_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="input44" value=<?php echo $input4_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="input47" value=<?php echo $input4_5;?>> </td>
			</tr>





			<tr>
				<td>FTX: Laser Temperature </td>
				<td>Current Value: <?php echo $lasertemp;?></td>	
				<td>Low-Low: <input type="number" step="any" name="lasertemp1" value=<?php echo $lasertemp_1;?>> </td>
				<td>Low: <input type="number" step="any" name="lasertemp2" value=<?php echo $lasertemp_2;?>> </td> 
				<td>High: <input type="number" step="any" name="lasertemp3" value=<?php echo $lasertemp_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="lasertemp4" value=<?php echo $lasertemp_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="lasertemp7" value=<?php echo $lasertemp_5;?>> </td>
			</tr>

			<tr>
				<td>FTX: Laser Bias Current</td>
				<td>Current Value: <?php echo $laserbiascurrent;?></td>	
				<td>Low-Low: <input type="number" step="any" name="laserbiascurrent1" value=<?php echo $laserbiascurrent_1;?>> </td>
				<td>Low: <input type="number" step="any" name="laserbiascurrent2" value=<?php echo $laserbiascurrent_2;?>> </td> 
				<td>High: <input type="number" step="any" name="laserbiascurrent3" value=<?php echo $laserbiascurrent_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="laserbiascurrent4" value=<?php echo $laserbiascurrent_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="laserbiascurrent7" value=<?php echo $laserbiascurrent_5;?>> </td>
			</tr>

			<tr>
				<td>FTX: Output Power </td>
				<td>Current Value: <?php echo $outputpower;?></td>	
				<td>Low-Low: <input type="number" step="any" name="outputpower1" value=<?php echo $outputpower_1;?>> </td>
				<td>Low: <input type="number" step="any" name="outputpower2" value=<?php echo $outputpower_2;?>> </td> 
				<td>High: <input type="number" step="any" name="outputpower3" value=<?php echo $outputpower_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="outputpower4" value=<?php echo $outputpower_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="outputpower7" value=<?php echo $outputpower_5;?>> </td>
			</tr>

			<tr>
				<td>FTX: THC Current </td>
				<td>Current Value: <?php echo $thccurrent;?></td>	
				<td>Low-Low: <input type="number" step="any" name="thccurrent1" value=<?php echo $thccurrent_1;?>> </td>
				<td>Low: <input type="number" step="any" name="thccurrent2" value=<?php echo $thccurrent_2;?>> </td> 
				<td>High: <input type="number" step="any" name="thccurrent3" value=<?php echo $thccurrent_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="thccurrent4" value=<?php echo $thccurrent_4;?>> </td>
				<td>Deadbank: <input type="number" step="any" name="thccurrent7" value=<?php echo $thccurrent_5;?>> </td>
			</tr>

			

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
