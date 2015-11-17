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
	

	?>

	<br><br>


	<form action="daemon_alarmTelink.php">

		<table >
			<tr>
				<td>Output (v)</td>
				<td>Low-Low: <input type="number" step="any" name="outputv1"></td>
				<td>Low: <input type="number" step="any" name="outputv2"></td> 
				<td>High: <input type="number" step="any" name="outputv3"></td>
				<td>High-High: <input type="number" step="any" name="outputv4"></td>
				<td>Deadbank: <input type="number" step="any" name="outputv7"></td>
			</tr>

			<tr>
				<td>Output (mA) </td>
				<td>Low-Low: <input type="number" step="any" name="outputma1"></td>
				<td>Low: <input type="number" step="any" name="outputma2"></td> 
				<td>High: <input type="number" step="any" name="outputma3"></td>
				<td>High-High: <input type="number" step="any" name="outputma4"></td>
				<td>Deadbank: <input type="number" step="any" name="outputma7"></td>
			</tr>

			<tr>
				<td>Output (W) </td>
				<td>Low-Low: <input type="number" step="any" name="outputw1"></td>
				<td>Low: <input type="number" step="any" name="outputw2"></td> 
				<td>High: <input type="number" step="any" name="outputw3"></td>
				<td>High-High: <input type="number" step="any" name="outputw4"></td>
				<td>Deadbank: <input type="number" step="any" name="outputw7"></td>
			</tr>




			<tr>
				<td> Input 1 </td>
				<td>Low-Low: <input type="number" step="any" name="input11"></td>
				<td>Low: <input type="number" step="any" name="input12"></td> 
				<td>High: <input type="number" step="any" name="input13"></td>
				<td>High-High: <input type="number" step="any" name="input14"></td>
				<td>Deadbank: <input type="number" step="any" name="input17"></td>
			</tr>

			<tr>
				<td>Input 2 </td>
				<td>Low-Low: <input type="number" step="any" name="input21"></td>
				<td>Low: <input type="number" step="any" name="input22"></td> 
				<td>High: <input type="number" step="any" name="input23"></td>
				<td>High-High: <input type="number" step="any" name="input24"></td>
				<td>Deadbank: <input type="number" step="any" name="input27"></td>
			</tr>

			<tr>
				<td>Input 3 </td>
				<td>Low-Low: <input type="number" step="any" name="input31"></td>
				<td>Low: <input type="number" step="any" name="input32"></td> 
				<td>High: <input type="number" step="any" name="input33"></td>
				<td>High-High: <input type="number" step="any" name="input34"></td>
				<td>Deadbank: <input type="number" step="any" name="input37"></td>
			</tr>
			<tr>
				<td>Input 4 </td>
				<td>Low-Low: <input type="number" step="any" name="input41"></td>
				<td>Low: <input type="number" step="any" name="input42"></td> 
				<td>High: <input type="number" step="any" name="input43"></td>
				<td>High-High: <input type="number" step="any" name="input44"></td>
				<td>Deadbank: <input type="number" step="any" name="input47"></td>
			</tr>





			<tr>
				<td>Laser Temperature </td>
				<td>Low-Low: <input type="number" step="any" name="lasertemp1"></td>
				<td>Low: <input type="number" step="any" name="lasertemp2"></td> 
				<td>High: <input type="number" step="any" name="lasertemp3"></td>
				<td>High-High: <input type="number" step="any" name="lasertemp4"></td>
				<td>Deadbank: <input type="number" step="any" name="lasertemp7"></td>
			</tr>

			<tr>
				<td>Laser Bias Current</td>
				<td>Low-Low: <input type="number" step="any" name="laserbiascurrent1"></td>
				<td>Low: <input type="number" step="any" name="laserbiascurrent2"></td> 
				<td>High: <input type="number" step="any" name="laserbiascurrent3"></td>
				<td>High-High: <input type="number" step="any" name="laserbiascurrent4"></td>
				<td>Deadbank: <input type="number" step="any" name="laserbiascurrent7"></td>
			</tr>

			<tr>
				<td>Output Power </td>
				<td>Low-Low: <input type="number" step="any" name="outputpower1"></td>
				<td>Low: <input type="number" step="any" name="outputpower2"></td> 
				<td>High: <input type="number" step="any" name="outputpower3"></td>
				<td>High-High: <input type="number" step="any" name="outputpower4"></td>
				<td>Deadbank: <input type="number" step="any" name="outputpower7"></td>
			</tr>

			<tr>
				<td>THC Current </td>
				<td>Low-Low: <input type="number" step="any" name="thccurrent1"></td>
				<td>Low: <input type="number" step="any" name="thccurrent2"></td> 
				<td>High: <input type="number" step="any" name="thccurrent3"></td>
				<td>High-High: <input type="number" step="any" name="thccurrent4"></td>
				<td>Deadbank: <input type="number" step="any" name="thccurrent7"></td>
			</tr>

			

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
