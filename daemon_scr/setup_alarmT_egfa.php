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

	?>

	<br><br>


	<form action="daemon_alarmTegfa.php">

		<table >
			<tr>
				<td>Output optical power </td>
				<td>Low-Low: <input type="number" step="any" name="loutputopticalpower1"></td>
				<td>Low: <input type="number" step="any" name="loutputopticalpower2"></td> 
				<td>High: <input type="number" step="any" name="loutputopticalpower3"></td>
				<td>High-High: <input type="number" step="any" name="loutputopticalpower4"></td>
				<td>Deadbank: <input type="number" step="any" name="loutputopticalpower7"></td>
			</tr>

			<tr>
				<td>Input optical power </td>
				<td>Low-Low: <input type="number" step="any" name="inputopticalpower1"></td>
				<td>Low: <input type="number" step="any" name="inputopticalpower2"></td> 
				<td>High: <input type="number" step="any" name="inputopticalpower3"></td>
				<td>High-High: <input type="number" step="any" name="inputopticalpower4"></td>
				<td>Deadbank: <input type="number" step="any" name="inputopticalpower7"></td>
			</tr>

			<tr>
				<td>Pump Temperature 1 </td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp11"></td>
				<td>Low: <input type="number" step="any" name="pumptemp12"></td> 
				<td>High: <input type="number" step="any" name="pumptemp13"></td>
				<td>High-High: <input type="number" step="any" name="pumptemp14"></td>
				<td>Deadbank: <input type="number" step="any" name="pumptemp17"></td>
			</tr>

			<tr>
				<td> Pump Temperature 2</td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp21"></td>
				<td>Low: <input type="number" step="any" name="pumptemp22"></td> 
				<td>High: <input type="number" step="any" name="pumptemp23"></td>
				<td>High-High: <input type="number" step="any" name="pumptemp24"></td>
				<td>Deadbank: <input type="number" step="any" name="pumptemp27"></td>
			</tr>

			<tr>
				<td>Pump Temperature 3 </td>
				<td>Low-Low: <input type="number" step="any" name="pumptemp31"></td>
				<td>Low: <input type="number" step="any" name="pumptemp32"></td> 
				<td>High: <input type="number" step="any" name="pumptemp33"></td>
				<td>High-High: <input type="number" step="any" name="pumptemp34"></td>
				<td>Deadbank: <input type="number" step="any" name="pumptemp37"></td>
			</tr>

			<tr>
				<td>DC5v </td>
				<td>Low-Low: <input type="number" step="any" name="dc5v1"></td>
				<td>Low: <input type="number" step="any" name="dc5v2"></td> 
				<td>High: <input type="number" step="any" name="dc5v3"></td>
				<td>High-High: <input type="number" step="any" name="dc5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="dc5v7"></td>
			</tr>
			<tr>
				<td>DC -5v </td>
				<td>Low-Low: <input type="number" step="any" name="dcminor5v1"></td>
				<td>Low: <input type="number" step="any" name="dcminor5v2"></td> 
				<td>High: <input type="number" step="any" name="dcminor5v3"></td>
				<td>High-High: <input type="number" step="any" name="dcminor5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="dcminor5v7"></td>
			</tr>

			<tr>
				<td>DC 33v </td>
				<td>Low-Low: <input type="number" step="any" name="dc33v1"></td>
				<td>Low: <input type="number" step="any" name="dc33v2"></td> 
				<td>High: <input type="number" step="any" name="dc33v3"></td>
				<td>High-High: <input type="number" step="any" name="dc33v4"></td>
				<td>Deadbank: <input type="number" step="any" name="dc33v7"></td>
			</tr>

			<tr>
				<td>DC 12v </td>
				<td>Low-Low: <input type="number" step="any" name="dc12v1"></td>
				<td>Low: <input type="number" step="any" name="dc12v2"></td> 
				<td>High: <input type="number" step="any" name="dc12v3"></td>
				<td>High-High: <input type="number" step="any" name="dc12v4"></td>
				<td>Deadbank: <input type="number" step="any" name="dc12v7"></td>
			</tr>

			<tr>
				<td>Left 5v </td>
				<td>Low-Low: <input type="number" step="any" name="left5v1"></td>
				<td>Low: <input type="number" step="any" name="left5v2"></td> 
				<td>High: <input type="number" step="any" name="left5v3"></td>
				<td>High-High: <input type="number" step="any" name="left5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="left5v7"></td>
			</tr>

			<tr>
				<td>Right 5v </td>
				<td>Low-Low: <input type="number" step="any" name="right5v1"></td>
				<td>Low: <input type="number" step="any" name="right5v2"></td> 
				<td>High: <input type="number" step="any" name="right5v3"></td>
				<td>High-High: <input type="number" step="any" name="right5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="right5v7"></td>
			</tr>

			<tr>
				<td>Left -5v </td>
				<td>Low-Low: <input type="number" step="any" name="leftminor5v1"></td>
				<td>Low: <input type="number" step="any" name="leftminor5v2"></td> 
				<td>High: <input type="number" step="any" name="leftminor5v3"></td>
				<td>High-High: <input type="number" step="any" name="leftminor5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="leftminor5v7"></td>
			</tr>

			<tr>
				<td>Right -5v </td>
				<td>Low-Low: <input type="number" step="any" name="rightminor5v1"></td>
				<td>Low: <input type="number" step="any" name="rightminor5v2"></td> 
				<td>High: <input type="number" step="any" name="rightminor5v3"></td>
				<td>High-High: <input type="number" step="any" name="rightminor5v4"></td>
				<td>Deadbank: <input type="number" step="any" name="rightminor5v7"></td>
			</tr>

		</table>


		<br><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>
