<!DOCTYPE html>
<html lang="en">
<head>
	<title>EG1550 Alarm Setup</title>
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
	echo "<b>Setup the alarm threshold of EG1550.</b><br>";
	echo "Leaving the space blank will disable the alarm function of this item.<br>";
	require("daemon_db_init.php");
	$query_value = "SELECT 
		dameonsnmp1550value.laserim, 
		dameonsnmp1550value.lasertemperature, 
		dameonsnmp1550value.laserbias, 
		dameonsnmp1550value.rfmodulationlevel, 
		dameonsnmp1550value.dc24vvoltage, 
		dameonsnmp1550value.dc12vvoltage, 
		dameonsnmp1550value.dc5vvoltage, 
		dameonsnmp1550value.minor5vdcvoltage, 
		dameonsnmp1550value.txopticalpower, 
		dameonsnmp1550value.txrfmodulelevel
		FROM 
		public.dameonsnmp1550value;";

	$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result_value)) {	
		$laserim = floatval($row->laserim);    // 1
		$lasertemperature = floatval($row->lasertemperature);    // 2
		$laserbias = floatval($row->laserbias);    // 3
		$rfmodulationlevel = floatval($row->rfmodulationlevel);    // 4
		$dc24vvoltage = floatval($row->dc24vvoltage);    // 5
		$dc12vvoltage = floatval($row->dc12vvoltage);    // 6
		$dc5vvoltage = floatval($row->dc5vvoltage);     // 7
		$minor5vdcvoltage = floatval($row->minor5vdcvoltage);    // 8
		$txopticalpower = floatval($row->txopticalpower);    // 9
		$txrfmodulelevel = floatval($row->txrfmodulelevel);     // 10
	}
	pg_free_result($result_value);

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthres1550';";
	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());
	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){
		$exist = $row_exist->relname;
	}
	// only if existed, following function will perform  
	if ($exist == "daemonalarmthres1550") {

		$query_t = "SELECT 
			  daemonalarmthres1550.laserim1, 
			  daemonalarmthres1550.lasertemperature1, 
			  daemonalarmthres1550.laserbias1, 
			  daemonalarmthres1550.rfmodulationlevel1, 
			  daemonalarmthres1550.dc24vvoltage1, 
			  daemonalarmthres1550.dc12vvoltage1, 
			  daemonalarmthres1550.dc5vvoltage1, 
			  daemonalarmthres1550.minor5vdcvoltage1, 
			  daemonalarmthres1550.txopticalpower1, 
			  daemonalarmthres1550.txrfmodulelevel1,
			  daemonalarmthres1550.laserim2,
			  daemonalarmthres1550.lasertemperature2, 
			  daemonalarmthres1550.laserbias2, 
			  daemonalarmthres1550.rfmodulationlevel2, 
			  daemonalarmthres1550.dc24vvoltage2, 
			  daemonalarmthres1550.dc12vvoltage2, 
			  daemonalarmthres1550.dc5vvoltage2, 
			  daemonalarmthres1550.minor5vdcvoltage2, 
			  daemonalarmthres1550.txopticalpower2, 
			  daemonalarmthres1550.txrfmodulelevel2,
			  daemonalarmthres1550.laserim3, 
			  daemonalarmthres1550.lasertemperature3, 
			  daemonalarmthres1550.laserbias3, 
			  daemonalarmthres1550.rfmodulationlevel3, 
			  daemonalarmthres1550.dc24vvoltage3, 
			  daemonalarmthres1550.dc12vvoltage3, 
			  daemonalarmthres1550.dc5vvoltage3, 
			  daemonalarmthres1550.minor5vdcvoltage3, 
			  daemonalarmthres1550.txopticalpower3, 
			  daemonalarmthres1550.txrfmodulelevel3, 
			  daemonalarmthres1550.laserim4, 
			  daemonalarmthres1550.lasertemperature4, 
			  daemonalarmthres1550.laserbias4, 
			  daemonalarmthres1550.rfmodulationlevel4, 
			  daemonalarmthres1550.dc24vvoltage4, 
			  daemonalarmthres1550.dc12vvoltage4, 
			  daemonalarmthres1550.dc5vvoltage4, 
			  daemonalarmthres1550.minor5vdcvoltage4, 
			  daemonalarmthres1550.txopticalpower4, 
			  daemonalarmthres1550.txrfmodulelevel4,
			  daemonalarmthres1550.laserim5, 
			  daemonalarmthres1550.lasertemperature5, 
			  daemonalarmthres1550.laserbias5, 
			  daemonalarmthres1550.rfmodulationlevel5, 
			  daemonalarmthres1550.dc24vvoltage5, 
			  daemonalarmthres1550.dc12vvoltage5, 
			  daemonalarmthres1550.dc5vvoltage5, 
			  daemonalarmthres1550.minor5vdcvoltage5, 
			  daemonalarmthres1550.txopticalpower5, 
			  daemonalarmthres1550.txrfmodulelevel5
			FROM 
			  public.daemonalarmthres1550;";

		$result_t = pg_query($query_t) or die('Query failed: ' . pg_last_error());
		while ($row = pg_fetch_object($result_t)) {
			$laserim_1 = $row->laserim1;
			$lasertemperature_1 = $row->lasertemperature1;
			$laserbias_1 = $row->laserbias1;
			$rfmodulationlevel_1 = $row->rfmodulationlevel1;
			$dc24vvoltage_1 = $row->dc24vvoltage1;
			$dc12vvoltage_1 = $row->dc12vvoltage1;
			$dc5vvoltage_1 = $row->dc5vvoltage1;
			$minor5vdcvoltage_1 = $row->minor5vdcvoltage1;
			$txopticalpower_1 = $row->txopticalpower1;
			$txrfmodulelevel_1 = $row->txrfmodulelevel1;
			$laserim_2 = $row->laserim2;
			$lasertemperature_2 = $row->lasertemperature2;
			$laserbias_2 = $row->laserbias2;
			$rfmodulationlevel_2 = $row->rfmodulationlevel2;
			$dc24vvoltage_2 = $row->dc24vvoltage2;
			$dc12vvoltage_2 = $row->dc12vvoltage2;
			$dc5vvoltage_2 = $row->dc5vvoltage2;
			$minor5vdcvoltage_2 = $row->minor5vdcvoltage2;
			$txopticalpower_2 = $row->txopticalpower2;
			$txrfmodulelevel_2 = $row->txrfmodulelevel2;
			$laserim_3 = $row->laserim3;
			$lasertemperature_3 = $row->lasertemperature3;
			$laserbias_3 = $row->laserbias3;
			$rfmodulationlevel_3 = $row->rfmodulationlevel3;
			$dc24vvoltage_3 = $row->dc24vvoltage3;
			$dc12vvoltage_3 = $row->dc12vvoltage3;
			$dc5vvoltage_3 = $row->dc5vvoltage3;
			$minor5vdcvoltage_3 = $row->minor5vdcvoltage3;
			$txopticalpower_3 = $row->txopticalpower3;
			$txrfmodulelevel_3 = $row->txrfmodulelevel3;
			$laserim_4 = $row->laserim4;
			$lasertemperature_4 = $row->lasertemperature4;
			$laserbias_4 = $row->laserbias4;
			$rfmodulationlevel_4 = $row->rfmodulationlevel4;
			$dc24vvoltage_4 = $row->dc24vvoltage4;
			$dc12vvoltage_4 = $row->dc12vvoltage4;
			$dc5vvoltage_4 = $row->dc5vvoltage4;
			$minor5vdcvoltage_4 = $row->minor5vdcvoltage4;
			$txopticalpower_4 = $row->txopticalpower4;
			$txrfmodulelevel_4 = $row->txrfmodulelevel4;
			$laserim_5 = $row->laserim5;
			$lasertemperature_5 = $row->lasertemperature5;
			$laserbias_5 = $row->laserbias5;
			$rfmodulationlevel_5 = $row->rfmodulationlevel5;
			$dc24vvoltage_5 = $row->dc24vvoltage5;
			$dc12vvoltage_5 = $row->dc12vvoltage5;
			$dc5vvoltage_5 = $row->dc5vvoltage5;
			$minor5vdcvoltage_5 = $row->minor5vdcvoltage5;
			$txopticalpower_5 = $row->txopticalpower5;
			$txrfmodulelevel_5 = $row->txrfmodulelevel5;
		}
		pg_free_result($result_t);

	}
	pg_close($dbconn);

	?>

	<br><br>


	<form action="daemon_alarmT1550.php" method="POST">

		<table >
			<tr>
				<td>Laser IM </td>
				<td>Current Value: <?php echo $laserim;?></td>				
				<td>Low-Low: <input type="number" step="any" name="laserim1" value=<?php echo $laserim_1;?>> </td>
				<td>Low: <input type="number" step="any" name="laserim2"  value=<?php echo $laserim_2;?>></td> 
				<td>High: <input type="number" step="any" name="laserim3" value=<?php echo $laserim_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="laserim4" value=<?php echo $laserim_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="laserim7" value=<?php echo $laserim_5;?>> </td>
			</tr>

			<tr>
				<td>Laser Temperature </td>
				<td>Current Value: <?php echo $lasertemperature;?></td>					
				<td>Low-Low: <input type="number" step="any" name="lasertemperature1" value=<?php echo $lasertemperature_1;?>> </td>
				<td>Low: <input type="number" step="any" name="lasertemperature2" value=<?php echo $lasertemperature_2;?>> </td> 
				<td>High: <input type="number" step="any" name="lasertemperature3" value=<?php echo $lasertemperature_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="lasertemperature4" value=<?php echo $lasertemperature_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="lasertemperature7" value=<?php echo $lasertemperature_5;?>> </td>
			</tr>

			<tr>
				<td>Laser Bias </td>
				<td>Current Value: <?php echo $laserbias;?></td>					
				<td>Low-Low: <input type="number" step="any" name="laserbias1"value=<?php echo $laserbias_1;?>> </td>
				<td>Low: <input type="number" step="any" name="laserbias2"value=<?php echo $laserbias_2;?>> </td> 
				<td>High: <input type="number" step="any" name="laserbias3"value=<?php echo $laserbias_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="laserbias4"value=<?php echo $laserbias_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="laserbias7"value=<?php echo $laserbias_5;?>> </td>
			</tr>

			<tr>
				<td> RF Modulation Level</td>
				<td>Current Value: <?php echo $rfmodulationlevel;?></td>					
				<td>Low-Low: <input type="number" step="any" name="rfmodulationlevel1" value=<?php echo $rfmodulationlevel_1;?>> </td>
				<td>Low: <input type="number" step="any" name="rfmodulationlevel2" value=<?php echo $rfmodulationlevel_2;?>> </td> 
				<td>High: <input type="number" step="any" name="rfmodulationlevel3" value=<?php echo $rfmodulationlevel_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="rfmodulationlevel4" value=<?php echo $rfmodulationlevel_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="rfmodulationlevel7" value=<?php echo $rfmodulationlevel_5;?>> </td>
			</tr>

			<tr>
				<td>DC 24V Voltage </td>
				<td>Current Value: <?php echo $dc24vvoltage;?></td>					
				<td>Low-Low: <input type="number" step="any" name="dc24vvoltage1" value=<?php echo $dc24vvoltage_1;?>> </td>
				<td>Low: <input type="number" step="any" name="dc24vvoltage2" value=<?php echo $dc24vvoltage_2;?>> </td> 
				<td>High: <input type="number" step="any" name="dc24vvoltage3" value=<?php echo $dc24vvoltage_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="dc24vvoltage4" value=<?php echo $dc24vvoltage_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="dc24vvoltage7" value=<?php echo $dc24vvoltage_5;?>> </td>
			</tr>

			<tr>
				<td>DC 12V Voltage </td>
				<td>Current Value: <?php echo $dc12vvoltage;?></td>					
				<td>Low-Low: <input type="number" step="any" name="dc12vvoltage1" value=<?php echo $dc12vvoltage_1;?>> </td>
				<td>Low: <input type="number" step="any" name="dc12vvoltage2" value=<?php echo $dc12vvoltage_2;?>> </td> 
				<td>High: <input type="number" step="any" name="dc12vvoltage3" value=<?php echo $dc12vvoltage_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="dc12vvoltage4" value=<?php echo $dc12vvoltage_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="dc12vvoltage7" value=<?php echo $dc12vvoltage_5;?>> </td>
			</tr>
			<tr>
				<td>DC 5V Voltage </td>
				<td>Current Value: <?php echo $dc5vvoltage;?></td>					
				<td>Low-Low: <input type="number" step="any" name="dc5vvoltage1" value=<?php echo $dc5vvoltage_1;?>> </td>
				<td>Low: <input type="number" step="any" name="dc5vvoltage2" value=<?php echo $dc5vvoltage_2;?>> </td> 
				<td>High: <input type="number" step="any" name="dc5vvoltage3" value=<?php echo $dc5vvoltage_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="dc5vvoltage4" value=<?php echo $dc5vvoltage_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="dc5vvoltage7" value=<?php echo $dc5vvoltage_5;?>> </td>
			</tr>

			<tr>
				<td>DC -5V Voltage </td>
				<td>Current Value: <?php echo $minor5vdcvoltage;?></td>					
				<td>Low-Low: <input type="number" step="any" name="minor5vdcvoltage1" value=<?php echo $minor5vdcvoltage_1;?>> </td>
				<td>Low: <input type="number" step="any" name="minor5vdcvoltage2" value=<?php echo $minor5vdcvoltage_2;?>> </td> 
				<td>High: <input type="number" step="any" name="minor5vdcvoltage3" value=<?php echo $minor5vdcvoltage_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="minor5vdcvoltage4" value=<?php echo $minor5vdcvoltage_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="minor5vdcvoltage7" value=<?php echo $minor5vdcvoltage_5;?>> </td>
			</tr>

			<tr>
				<td>TX Optical Power </td>
				<td>Current Value: <?php echo $txopticalpower;?></td>					
				<td>Low-Low: <input type="number" step="any" name="txopticalpower1" value=<?php echo $txopticalpower_1;?>> </td>
				<td>Low: <input type="number" step="any" name="txopticalpower2" value=<?php echo $txopticalpower_2;?>> </td> 
				<td>High: <input type="number" step="any" name="txopticalpower3" value=<?php echo $txopticalpower_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="txopticalpower4" value=<?php echo $txopticalpower_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="txopticalpower7" value=<?php echo $txopticalpower_5;?>> </td>
			</tr>

			<tr>
				<td>TX RF Module Level </td>
				<td>Current Value: <?php echo $txrfmodulelevel;?></td>					
				<td>Low-Low: <input type="number" step="any" name="txrfmodulelevel1" value=<?php echo $txrfmodulelevel_1;?>> </td>
				<td>Low: <input type="number" step="any" name="txrfmodulelevel2" value=<?php echo $txrfmodulelevel_2;?>> </td> 
				<td>High: <input type="number" step="any" name="txrfmodulelevel3" value=<?php echo $txrfmodulelevel_3;?>> </td>
				<td>High-High: <input type="number" step="any" name="txrfmodulelevel4" value=<?php echo $txrfmodulelevel_4;?>> </td>
				<td>Deadband: <input type="number" step="any" name="txrfmodulelevel7" value=<?php echo $txrfmodulelevel_5;?>> </td>
			</tr>		

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
