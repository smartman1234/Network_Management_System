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

	?>

	<br><br>


	<form action="daemon_alarmT1550.php">

		<table >
			<tr>
				<td>Laser IM </td>
				<td>Low-Low: <input type="number" step="any" name="laserim1" > </td>
				<td>Low: <input type="number" step="any" name="laserim2"  </td> 
				<td>High: <input type="number" step="any" name="laserim3"  </td>
				<td>High-High: <input type="number" step="any" name="laserim4"  </td>
				<td>Deadbank: <input type="number" step="any" name="laserim7"  </td>
			</tr>

			<tr>
				<td>Laser Temperature </td>
				<td>Low-Low: <input type="number" step="any" name="lasertemperature1" > </td>
				<td>Low: <input type="number" step="any" name="lasertemperature2" > </td> 
				<td>High: <input type="number" step="any" name="lasertemperature3" > </td>
				<td>High-High: <input type="number" step="any" name="lasertemperature4" > </td>
				<td>Deadbank: <input type="number" step="any" name="lasertemperature7" > </td>
			</tr>

			<tr>
				<td>Laser Bias </td>
				<td>Low-Low: <input type="number" step="any" name="laserbias1"> </td>
				<td>Low: <input type="number" step="any" name="laserbias2"> </td> 
				<td>High: <input type="number" step="any" name="laserbias3"> </td>
				<td>High-High: <input type="number" step="any" name="laserbias4"> </td>
				<td>Deadbank: <input type="number" step="any" name="laserbias7"> </td>
			</tr>

			<tr>
				<td> RF Modulation Level</td>
				<td>Low-Low: <input type="number" step="any" name="rfmodulationlevel1" > </td>
				<td>Low: <input type="number" step="any" name="rfmodulationlevel2" > </td> 
				<td>High: <input type="number" step="any" name="rfmodulationlevel3" > </td>
				<td>High-High: <input type="number" step="any" name="rfmodulationlevel4" > </td>
				<td>Deadbank: <input type="number" step="any" name="rfmodulationlevel7" > </td>
			</tr>

			<tr>
				<td>DC 24V Voltage </td>
				<td>Low-Low: <input type="number" step="any" name="dc24vvoltage1" > </td>
				<td>Low: <input type="number" step="any" name="dc24vvoltage2" > </td> 
				<td>High: <input type="number" step="any" name="dc24vvoltage3" > </td>
				<td>High-High: <input type="number" step="any" name="dc24vvoltage4" > </td>
				<td>Deadbank: <input type="number" step="any" name="dc24vvoltage7" > </td>
			</tr>

			<tr>
				<td>DC 12V Voltage </td>
				<td>Low-Low: <input type="number" step="any" name="dc12vvoltage1" > </td>
				<td>Low: <input type="number" step="any" name="dc12vvoltage2" > </td> 
				<td>High: <input type="number" step="any" name="dc12vvoltage3" > </td>
				<td>High-High: <input type="number" step="any" name="dc12vvoltage4" > </td>
				<td>Deadbank: <input type="number" step="any" name="dc12vvoltage7" > </td>
			</tr>
			<tr>
				<td>DC 5V Voltage </td>
				<td>Low-Low: <input type="number" step="any" name="dc5vvoltage1" > </td>
				<td>Low: <input type="number" step="any" name="dc5vvoltage2" > </td> 
				<td>High: <input type="number" step="any" name="dc5vvoltage3" > </td>
				<td>High-High: <input type="number" step="any" name="dc5vvoltage4" > </td>
				<td>Deadbank: <input type="number" step="any" name="dc5vvoltage7" > </td>
			</tr>

			<tr>
				<td>DC -5V Voltage </td>
				<td>Low-Low: <input type="number" step="any" name="minor5vdcvoltage1" > </td>
				<td>Low: <input type="number" step="any" name="minor5vdcvoltage2" > </td> 
				<td>High: <input type="number" step="any" name="minor5vdcvoltage3" > </td>
				<td>High-High: <input type="number" step="any" name="minor5vdcvoltage4" > </td>
				<td>Deadbank: <input type="number" step="any" name="minor5vdcvoltage7" > </td>
			</tr>

			<tr>
				<td>TX Optical Power </td>
				<td>Low-Low: <input type="number" step="any" name="txopticalpower1" > </td>
				<td>Low: <input type="number" step="any" name="txopticalpower2" > </td> 
				<td>High: <input type="number" step="any" name="txopticalpower3" > </td>
				<td>High-High: <input type="number" step="any" name="txopticalpower4" > </td>
				<td>Deadbank: <input type="number" step="any" name="txopticalpower7" > </td>
			</tr>

			<tr>
				<td>TX RF Module Level </td>
				<td>Low-Low: <input type="number" step="any" name="txrfmodulelevel1" > </td>
				<td>Low: <input type="number" step="any" name="txrfmodulelevel2" > </td> 
				<td>High: <input type="number" step="any" name="txrfmodulelevel3" > </td>
				<td>High-High: <input type="number" step="any" name="txrfmodulelevel4" > </td>
				<td>Deadbank: <input type="number" step="any" name="txrfmodulelevel7" > </td>
			</tr>

			

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
