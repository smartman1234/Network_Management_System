<!DOCTYPE html>
<html lang="en">
<head>
	<title>EGFA Alarm Setup</title>
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
	echo "<b>Setup the alarm threshold of EGFA.</b><br>";
	echo "Leaving the space blank will disable the alarm function of this item.<br>";
	require("daemon_db_init.php");
	$query_value = "SELECT 
		daemonsnmpegfavalue.outputopticalpower, 
		daemonsnmpegfavalue.inputopticalpower, 
		daemonsnmpegfavalue.pumptemp1, 
		daemonsnmpegfavalue.pumptemp2, 
		daemonsnmpegfavalue.pumptemp3, 
		daemonsnmpegfavalue.dcpsnumber, 
		daemonsnmpegfavalue.dcpsmode, 
		daemonsnmpegfavalue.dc33v, 
		daemonsnmpegfavalue.dc12v, 
		daemonsnmpegfavalue.dcminor5v, 
		daemonsnmpegfavalue.dc5v, 
		daemonsnmpegfavalue.left5v, 
		daemonsnmpegfavalue.right5v, 
		daemonsnmpegfavalue.leftminor5v, 
		daemonsnmpegfavalue.rightminor5v
		FROM 
		public.daemonsnmpegfavalue;";
	$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());
	while ($row = pg_fetch_object($result_value)) {	
		$outputopticalpower = floatval($row->outputopticalpower);
		$inputopticalpower = floatval($row->inputopticalpower);
		$pumptemp1 = floatval($row->pumptemp1);
		$pumptemp2 = floatval($row->pumptemp2);
		$pumptemp3 = floatval($row->pumptemp3);
		$dc5v = floatval($row->dc5v);
		$dcminor5v = floatval($row->dcminor5v);
		$dc33v = floatval($row->dc33v);
		$dc12v = floatval($row->dc12v);
		$left5v = floatval($row->left5v);
		$right5v = $row->right5v;
		$leftminor5v = $row->leftminor5v;
		$rightminor5v = $row->rightminor5v;
	}
	pg_free_result($result_value);

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthresegfa';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){
	$exist = $row_exist->relname;
	}

	if ($exist == "daemonalarmthresegfa") {
		$query_t = "SELECT 
			  daemonalarmthresegfa.loutputopticalpower1, 
			  daemonalarmthresegfa.inputopticalpower1, 
			  daemonalarmthresegfa.pumptemp11, 
			  daemonalarmthresegfa.pumptemp21, 
			  daemonalarmthresegfa.pumptemp31, 
			  daemonalarmthresegfa.dc5v1, 
			  daemonalarmthresegfa.dcminor5v1, 
			  daemonalarmthresegfa.dc33v1, 
			  daemonalarmthresegfa.dc12v1, 
			  daemonalarmthresegfa.left5v1, 
			  daemonalarmthresegfa.right5v1, 
			  daemonalarmthresegfa.leftminor5v1, 
			  daemonalarmthresegfa.rightminor5v1, 
			  daemonalarmthresegfa.loutputopticalpower2,
			  daemonalarmthresegfa.inputopticalpower2, 
			  daemonalarmthresegfa.pumptemp12, 
			  daemonalarmthresegfa.pumptemp22, 
			  daemonalarmthresegfa.pumptemp32, 
			  daemonalarmthresegfa.dc5v2, 
			  daemonalarmthresegfa.dcminor5v2, 
			  daemonalarmthresegfa.right5v2, 
			  daemonalarmthresegfa.dc12v2, 
			  daemonalarmthresegfa.left5v2,
			  daemonalarmthresegfa.dc33v2, 
			  daemonalarmthresegfa.leftminor5v2, 
			  daemonalarmthresegfa.rightminor5v2,
			  daemonalarmthresegfa.loutputopticalpower3,
			  daemonalarmthresegfa.inputopticalpower3, 
			  daemonalarmthresegfa.pumptemp13, 
			  daemonalarmthresegfa.pumptemp23, 
			  daemonalarmthresegfa.pumptemp33, 
			  daemonalarmthresegfa.dc5v3, 
			  daemonalarmthresegfa.dcminor5v3, 
			  daemonalarmthresegfa.right5v3, 
			  daemonalarmthresegfa.dc12v3, 
			  daemonalarmthresegfa.left5v3,
			  daemonalarmthresegfa.dc33v3, 
			  daemonalarmthresegfa.leftminor5v3, 
			  daemonalarmthresegfa.rightminor5v3,
			  daemonalarmthresegfa.loutputopticalpower4,
			  daemonalarmthresegfa.inputopticalpower4, 
			  daemonalarmthresegfa.pumptemp14, 
			  daemonalarmthresegfa.pumptemp24, 
			  daemonalarmthresegfa.pumptemp34, 
			  daemonalarmthresegfa.dc5v4, 
			  daemonalarmthresegfa.dcminor5v4, 
			  daemonalarmthresegfa.right5v4, 
			  daemonalarmthresegfa.dc12v4, 
			  daemonalarmthresegfa.left5v4,
			  daemonalarmthresegfa.dc33v4, 
			  daemonalarmthresegfa.leftminor5v4, 
			  daemonalarmthresegfa.rightminor5v4,
			  daemonalarmthresegfa.loutputopticalpower5,
			  daemonalarmthresegfa.inputopticalpower5,
			  daemonalarmthresegfa.pumptemp15,
			  daemonalarmthresegfa.pumptemp25, 
			  daemonalarmthresegfa.pumptemp35, 
			  daemonalarmthresegfa.dc5v5,
			  daemonalarmthresegfa.dcminor5v5, 
			  daemonalarmthresegfa.right5v5,
			  daemonalarmthresegfa.dc12v5,
			  daemonalarmthresegfa.left5v5,
			  daemonalarmthresegfa.dc33v5,
			  daemonalarmthresegfa.leftminor5v5, 
			  daemonalarmthresegfa.rightminor5v5
			FROM  public.daemonalarmthresegfa;";
		$result_t = pg_query($query_t) or die('Query failed: ' . pg_last_error());
		while ($row = pg_fetch_object($result_t)) {
			$loutputopticalpower_1 = $row->loutputopticalpower1;
			$inputopticalpower_1 = $row->inputopticalpower1;
			$pumptemp1_1 = $row->pumptemp11;
			$pumptemp2_1 = $row->pumptemp21;
			$pumptemp3_1 = $row->pumptemp31;
			$dc5v_1 = $row->dc5v1;
			$dcminor5v_1 = $row->dcminor5v1;
			$dc33v_1 = $row->dc33v1;
			$dc12v_1 = $row->dc12v1;
			$left5v_1 = $row->left5v1;
			$right5v_1 = $row->right5v1;
			$leftminor5v_1 = $row->leftminor5v1;
			$rightminor5v_1 = $row->rightminor5v1;
			$loutputopticalpower_2 = $row->loutputopticalpower2;
			$inputopticalpower_2 = $row->inputopticalpower2;
			$pumptemp1_2 = $row->pumptemp12;
			$pumptemp2_2 = $row->pumptemp22;
			$pumptemp3_2 = $row->pumptemp32;
			$dc5v_2 = $row->dc5v2;
			$dcminor5v_2 = $row->dcminor5v2;
			$dc33v_2 = $row->dc33v2;
			$dc12v_2 = $row->dc12v2;
			$left5v_2 = $row->left5v2;
			$right5v_2 = $row->right5v2;
			$leftminor5v_2 = $row->leftminor5v2;
			$rightminor5v_2 = $row->rightminor5v2;
			$loutputopticalpower_3 = $row->loutputopticalpower3;
			$inputopticalpower_3 = $row->inputopticalpower3;
			$pumptemp1_3 = $row->pumptemp13;
			$pumptemp2_3 = $row->pumptemp23;
			$pumptemp3_3 = $row->pumptemp33;
			$dc5v_3 = $row->dc5v3;
			$dcminor5v_3 = $row->dcminor5v3;
			$dc33v_3 = $row->dc33v3;
			$dc12v_3 = $row->dc12v3;
			$left5v_3 = $row->left5v3;
			$right5v_3 = $row->right5v3;
			$leftminor5v_3 = $row->leftminor5v3;
			$rightminor5v_3 = $row->rightminor5v3;
			$loutputopticalpower_4 = $row->loutputopticalpower4;
			$inputopticalpower_4 = $row->inputopticalpower4;
			$pumptemp1_4 = $row->pumptemp14;
			$pumptemp2_4 = $row->pumptemp24;
			$pumptemp3_4 = $row->pumptemp34;
			$dc5v_4 = $row->dc5v4;
			$dcminor5v_4 = $row->dcminor5v4;
			$dc33v_4 = $row->dc33v4;
			$dc12v_4 = $row->dc12v4;
			$left5v_4 = $row->left5v4;
			$right5v_4 = $row->right5v4;
			$leftminor5v_4 = $row->leftminor5v4;
			$rightminor5v_4 = $row->rightminor5v4;
			$loutputopticalpower_5 = $row->loutputopticalpower5;
			$inputopticalpower_5 = $row->inputopticalpower5;
			$pumptemp1_5 = $row->pumptemp15;
			$pumptemp2_5 = $row->pumptemp25;
			$pumptemp3_5 = $row->pumptemp35;
			$dc5v_5 = $row->dc5v5;
			$dcminor5v_5 = $row->dcminor5v5;
			$dc33v_5 = $row->dc33v5;
			$dc12v_5 = $row->dc12v5;
			$left5v_5 = $row->left5v5;
			$right5v_5 = $row->right5v5;
			$leftminor5v_5 = $row->leftminor5v5;
			$rightminor5v_5 = $row->rightminor5v5;
		}
		pg_free_result($result_t);
	}
	pg_close($dbconn);
	?>

	<br><br>


	<form action="daemon_alarmTegfa.php" method="POST">

		<table >
			<tr>
				<td>Output optical power </td>
				<td>Current Value: <?php echo $outputopticalpower;?></td>
				<td>Low-Low: <input type="number" step="any" name="loutputopticalpower1" value=<?php echo $loutputopticalpower_1;?>></td>
				<td>Low: <input type="number" step="any" name="loutputopticalpower2" value=<?php echo $loutputopticalpower_2;?>></td> 
				<td>High: <input type="number" step="any" name="loutputopticalpower3" value=<?php echo $loutputopticalpower_3;?>></td>
				<td>High-High: <input type="number" step="any" name="loutputopticalpower4" value=<?php echo $loutputopticalpower_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="loutputopticalpower7" value=<?php echo $loutputopticalpower_5;?>></td>
			</tr>

			<tr>
				<td>Input optical power </td>
				<td>Current Value: <?php echo $inputopticalpower;?></td>
				<td>Low-Low: <input type="number" step="any" name="inputopticalpower1" value=<?php echo $inputopticalpower_1;?>></td>
				<td>Low: <input type="number" step="any" name="inputopticalpower2" value=<?php echo $inputopticalpower_2;?>></td> 
				<td>High: <input type="number" step="any" name="inputopticalpower3" value=<?php echo $inputopticalpower_3;?>></td>
				<td>High-High: <input type="number" step="any" name="inputopticalpower4" value=<?php echo $inputopticalpower_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="inputopticalpower7" value=<?php echo $inputopticalpower_5;?>></td>
			</tr>

			<tr>
				<td>Pump Temperature 1 </td>
				<td>Current Value: <?php echo $pumptemp1;?></td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp11" value=<?php echo $pumptemp1_1;?>></td>
				<td>Low: <input type="number" step="any" name="pumptemp12" value=<?php echo $pumptemp1_2;?>></td> 
				<td>High: <input type="number" step="any" name="pumptemp13" value=<?php echo $pumptemp1_3;?>></td>
				<td>High-High: <input type="number" step="any" name="pumptemp14" value=<?php echo $pumptemp1_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="pumptemp17" value=<?php echo $pumptemp1_5;?>></td>
			</tr>

			<tr>
				<td> Pump Temperature 2</td>
				<td>Current Value: <?php echo $pumptemp2;?></td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp21" value=<?php echo $pumptemp2_1;?>></td>
				<td>Low: <input type="number" step="any" name="pumptemp22" value=<?php echo $pumptemp2_2;?>></td> 
				<td>High: <input type="number" step="any" name="pumptemp23" value=<?php echo $pumptemp2_3;?>></td>
				<td>High-High: <input type="number" step="any" name="pumptemp24" value=<?php echo $pumptemp2_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="pumptemp27" value=<?php echo $pumptemp2_5;?>></td>
			</tr>

			<tr>
				<td>Pump Temperature 3 </td>
				<td>Current Value: <?php echo $pumptemp3;?></td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp31" value=<?php echo $pumptemp3_1;?>></td>
				<td>Low: <input type="number" step="any" name="pumptemp32" value=<?php echo $pumptemp3_2;?>></td> 
				<td>High: <input type="number" step="any" name="pumptemp33" value=<?php echo $pumptemp3_3;?>></td>
				<td>High-High: <input type="number" step="any" name="pumptemp34" value=<?php echo $pumptemp3_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="pumptemp37" value=<?php echo $pumptemp3_5;?>></td>
			</tr>

			<tr>
				<td>DC5v </td>
				<td>Current Value: <?php echo $dc5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="dc5v1" value=<?php echo $dc5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="dc5v2" value=<?php echo $dc5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="dc5v3" value=<?php echo $dc5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="dc5v4" value=<?php echo $dc5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="dc5v7" value=<?php echo $dc5v_5;?>></td>
			</tr>
			<tr>
				<td>DC -5v </td>
				<td>Current Value: <?php echo $dcminor5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="dcminor5v1" value=<?php echo $dcminor5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="dcminor5v2" value=<?php echo $dcminor5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="dcminor5v3" value=<?php echo $dcminor5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="dcminor5v4" value=<?php echo $dcminor5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="dcminor5v7" value=<?php echo $dcminor5v_5;?>></td>
			</tr>

			<tr>
				<td>DC 33v </td>
				<td>Current Value: <?php echo $dc33v;?></td>
				<td>Low-Low: <input type="number" step="any" name="dc33v1" value=<?php echo $dc33v_1;?>></td>
				<td>Low: <input type="number" step="any" name="dc33v2" value=<?php echo $dc33v_2;?>></td> 
				<td>High: <input type="number" step="any" name="dc33v3" value=<?php echo $dc33v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="dc33v4" value=<?php echo $dc33v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="dc33v7" value=<?php echo $dc33v_5;?>></td>
			</tr>

			<tr>
				<td>DC 12v </td>
				<td>Current Value: <?php echo $dc12v;?></td>
				<td>Low-Low: <input type="number" step="any" name="dc12v1" value=<?php echo $dc12v_1;?>></td>
				<td>Low: <input type="number" step="any" name="dc12v2" value=<?php echo $dc12v_2;?>></td> 
				<td>High: <input type="number" step="any" name="dc12v3" value=<?php echo $dc12v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="dc12v4" value=<?php echo $dc12v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="dc12v7" value=<?php echo $dc12v_5;?>></td>
			</tr>

			<tr>
				<td>Left 5v </td>
				<td>Current Value: <?php echo $left5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="left5v1" value=<?php echo $left5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="left5v2" value=<?php echo $left5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="left5v3" value=<?php echo $left5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="left5v4" value=<?php echo $left5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="left5v7" value=<?php echo $left5v_5;?>></td>
			</tr>

			<tr>
				<td>Right 5v </td>
				<td>Current Value: <?php echo $right5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="right5v1" value=<?php echo $right5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="right5v2" value=<?php echo $right5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="right5v3" value=<?php echo $right5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="right5v4" value=<?php echo $right5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="right5v7" value=<?php echo $right5v_5;?>></td>
			</tr>

			<tr>
				<td>Left -5v </td>
				<td>Current Value: <?php echo $leftminor5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="leftminor5v1" value=<?php echo $leftminor5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="leftminor5v2" value=<?php echo $leftminor5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="leftminor5v3" value=<?php echo $leftminor5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="leftminor5v4" value=<?php echo $leftminor5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="leftminor5v7" value=<?php echo $leftminor5v_5;?>></td>
			</tr>

			<tr>
				<td>Right -5v </td>
				<td>Current Value: <?php echo $rightminor5v;?></td>
				<td>Low-Low: <input type="number" step="any" name="rightminor5v1" value=<?php echo $rightminor5v_1;?>></td>
				<td>Low: <input type="number" step="any" name="rightminor5v2" value=<?php echo $rightminor5v_2;?>></td> 
				<td>High: <input type="number" step="any" name="rightminor5v3" value=<?php echo $rightminor5v_3;?>></td>
				<td>High-High: <input type="number" step="any" name="rightminor5v4" value=<?php echo $rightminor5v_4;?>></td>
				<td>Deadband: <input type="number" step="any" name="rightminor5v7" value=<?php echo $rightminor5v_5;?>></td>
			</tr>

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
