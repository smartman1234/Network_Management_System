<!DOCTYPE html>
<html lang="en">
<head>
	<title>Elink Headend Status Values</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

	<br><br>
<!-- 	<style>
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
	</style> -->

	<?php

	session_start();

	require("daemon_db_init.php");
	require("daemon_getDeviceIdPerIp.php");
	$deviceid = getDeviceIdPerIp($_GET['ip']);


	$_SESSION['deviceid'] = $deviceid;

	echo "<b>Status Values of Elink Headend.</b><br>";

	
	echo "<hr>";
	echo "<img src='images/elink_optical_transmission_platform_product.png' alt='ELink Optical Transmission Platform' height='250', width='250'>";

	$query = "SELECT 
	daemonsnmpelinkems.time, 
	daemonsnmpelinkems.slot, 
	daemonsnmpelinkems.description, 
	daemonsnmpelinkems.oids, 
	daemonsnmpelinkems.uptime, 
	daemonsnmpelinkems.contact, 
	daemonsnmpelinkems.name, 
	daemonsnmpelinkems.service, 
	daemonsnmpelinkems.ip, 
	daemonsnmpelinkems.location, 
	daemonsnmpelinkems.model, 
	daemonsnmpelinkems.alarm, 
	daemonsnmpelinkems.sn, 
	daemonsnmpelinkems.temp, 
	daemonsnmpelinkems.vendor, 
	daemonsnmpelinkems.alarmdetection, 
	daemonsnmpelinkems.checkcode, 
	daemonsnmpelinkems.tamperstatus, 
	daemonsnmpelinkems.ipaddress, 
	daemonsnmpelinkems.internaltemp, 
	daemonsnmpelinkems.craftstatus
	FROM 
	public.daemonsnmpelinkems
	WHERE daemonsnmpelinkems.deviceid=$deviceid;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result)) {
		$time = $row->time; 
		$slot = $row->slot; 
		$description = $row->description; 
		$oids = $row->oids; 
		$uptime = $row->uptime; 
		$contact = $row->contact; 
		$name = $row->name; 
		$service = $row->service; 
		$ip = $row->ip; 
		$location = $row->location; 
		$model = $row->model; 
		$alarm = $row->alarm; 
		$sn = $row->sn; 
		$temp = $row->temp; 
		$vendor = $row->vendor; 
		$alarmdetection = $row->alarmdetection; 
		$checkcode = $row->checkcode; 
		$tamperstatus = $row->tamperstatus; 
		$ipaddress = $row->ipaddress; 
		$internaltemp = $row->internaltemp; 
		$craftstatus = $row->craftstatus;
	}


	pg_free_result($result);
	pg_close($dbconn);

	function displayTime($t){

		if (strlen($t)==13) {
		# code...
			$year = substr($t, 0, 4);
			$month = substr($t, 4, 2);
			$day = substr($t, 6, 2);
			$hour = "0" . substr($t, 8, 1);
			$min = substr($t, 9, 2);
			$sec = substr($t, 11, 2);
		}

		if (strlen($t)==14) {
		# code...
			$year = substr($t, 0, 4);
			$month = substr($t, 4, 2);
			$day = substr($t, 6, 2);
			$hour = substr($t, 8, 1);
			$min = substr($t, 10, 2);
			$sec = substr($t, 12, 2);
		}

		return $year . "-" . $month . "-" . $day . "-" . $hour . "-" . $min . "-" . $sec;

	}

	?>


	<hr>
	<table width="80%" class="table table-striped table-bordered table-condensed">
		<p><b>EMS:</b></p>

		<tr>
			<td><b>Last Scanned Time </td>
			<td> <?php  echo displayTime($time);         ?></td>
			<td></td>
		</tr>

		<tr>
			<td><b>Slot </td>
			<td> <?php  echo $slot;         ?></td>	
			<td></td>
		</tr>

		<tr>
			<td><b>Uptime </td>
			<td> <?php  echo $uptime;         ?></td>	
			<td></td>
		</tr>

		<tr>
			<td><b>Model </td>
			<td> <?php  echo $model;         ?></td>	
			<td></td>
		</tr>

		<tr>
			<td><b>Device IP  </td>
			<td> <?php  echo $ip;         ?></td>	
			<td></td>
		</tr>

		<tr>
			<td><b>Platform Notice </td>
			<td> <?php  echo $alarm;         ?></td>	
			<td></td>
		</tr>

		<tr>
			<td><b>Serial Number </td>
			<td> <?php  echo $sn;         ?></td>	
			<td></td>
		</tr>

		<tr class="success">
			<td><b>Internal Temperature (C)</td>
			<td> <?php  echo $internaltemp;         ?></td>	
			<td> <a href="displayGraph_elink_ems.php?item=internaltemp" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

		</table>





		<?php

		require("daemon_db_init.php");
		$query = "SELECT 
		daemonsnmpelinkps.slot, 
		daemonsnmpelinkps.model, 
		daemonsnmpelinkps.sn, 
		daemonsnmpelinkps.temp, 
		daemonsnmpelinkps.inputv, 
		daemonsnmpelinkps.outputv, 
		daemonsnmpelinkps.outputma, 
		daemonsnmpelinkps.outputw
		FROM 
		public.daemonsnmpelinkps;";

		$result = pg_query($query) or die('Query failed: ' . pg_last_error());

		while ($row = pg_fetch_object($result)) {
			$slot = $row->slot; 
			$model = $row->model; 
			$sn = $row->sn; 
			$temp = $row->temp; 
			$inputv = $row->inputv; 
			$outputv = $row->outputv; 
			$outputma = $row->outputma; 
			$outputw = $row->outputw;
		}


		pg_free_result($result);
		pg_close($dbconn);

		?>


		<hr>
		<table width="80%" class="table table-striped table-bordered table-condensed">
			<p><b>Power Supply:</b></p>
			<tr>
				<td><b>Slot </td>
				<td> <?php  echo $slot;         ?></td>	
				<td></td>
			</tr>


			<tr>
				<td><b>Model </td>
				<td> <?php  echo $model;         ?></td>	
				<td></td>
			</tr>

			<tr>
				<td><b>Serial Number </td>
				<td> <?php  echo $sn;         ?></td>	
				<td></td>
			</tr>

			<tr>
				<td><b>Input (V) </td>
				<td> <?php  echo $inputv;         ?></td>	
				<td></td>
			</tr>

			<tr class="success">
				<td><b>Output (V) </td>
				<td> <?php  echo floatval($outputv);         ?></td>	
				<td> <a href="displayGraph_elink_ps.php?item=outputv" onclick="window.open(this.href, 'mywin',
					'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
				</tr>

				<tr class="success">
					<td><b>Output (mA) </td>
					<td> <?php  echo floatval($outputma);         ?></td>	
					<td> <a href="displayGraph_elink_ps.php?item=outputma" onclick="window.open(this.href, 'mywin',
						'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
					</tr>

					<tr class="success">
						<td><b>Output (W) </td>
						<td> <?php  echo floatval($outputw);         ?></td>
						<td> <a href="displayGraph_elink_ps.php?item=outputw" onclick="window.open(this.href, 'mywin',
							'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>	
						</tr>

					</table>





					<?php

					require("daemon_db_init.php");
					$query = "SELECT 
					daemonsnmpelinkfan.fan1, 
					daemonsnmpelinkfan.fan2, 
					daemonsnmpelinkfan.fan3, 
					daemonsnmpelinkfan.fan4, 
					daemonsnmpelinkfan.fan5, 
					daemonsnmpelinkfan.fan6, 
					daemonsnmpelinkfan.fan7, 
					daemonsnmpelinkfan.fan8
					FROM 
					public.daemonsnmpelinkfan;
					";

					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while ($row = pg_fetch_object($result)) {
						$fan1 = $row->fan1; 
						$fan2 = $row->fan2; 
						$fan3 = $row->fan3; 
						$fan4 = $row->fan4; 
						$fan5 = $row->fan5; 
						$fan6 = $row->fan6; 
						$fan7 = $row->fan7; 
						$fan8 = $row->fan8;
					}

					pg_free_result($result);
					pg_close($dbconn);

					function fanstatus($r){
						switch ($r) {
							case 1:
				# code...
							return "Working";
							break;
							case 0:
				# code...
							return "Stopped";
							break;
							case 2:
				# code...
							return "Stopped";
							break;

							default:
				# code...
							return $r;
							break;
						}


					}

					?>


					<hr>
					<table width="80%" class="table table-striped table-bordered table-condensed">
						<p><b>Fan System:</b></p>
						<tr>
							<td><b>Fan 1 </td>
							<td> <?php  echo fanstatus($fan1);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 2 </td>
							<td> <?php  echo fanstatus($fan2);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 3 </td>
							<td> <?php  echo fanstatus($fan3);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 4 </td>
							<td> <?php  echo fanstatus($fan4);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 5 </td>
							<td> <?php  echo fanstatus($fan5);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 6 </td>
							<td> <?php  echo fanstatus($fan6);         ?></td>	
						</tr>
						<tr>
							<td><b>Fan 7 </td>
							<td> <?php  echo fanstatus($fan7);         ?></td>	
						</tr>

						<tr>
							<td><b>Fan 8 </td>
							<td> <?php  echo fanstatus($fan8);         ?></td>	
						</tr>


					</table>



					<?php

					require("daemon_db_init.php");

					$query = "SELECT 
					daemonsnmpelinkrrx.time
					FROM 
					public.daemonsnmpelinkrrx;";

					$result = pg_query($query) or die('Query failed: ' . pg_last_error());

					while ($row = pg_fetch_object($result)) {
						$time = $row->time; 

					}

					$time = "'" . strval($time) .  "'"; 
					echo "<hr>";
					echo "<p><b>RRX:</b></p>";

					$query_rrx = "SELECT 
					daemonsnmpelinkrrx.slot, 
					daemonsnmpelinkrrx.model, 
					daemonsnmpelinkrrx.sn, 
					daemonsnmpelinkrrx.temp, 
					daemonsnmpelinkrrx.input1, 
					daemonsnmpelinkrrx.input2, 
					daemonsnmpelinkrrx.input3, 
					daemonsnmpelinkrrx.input4, 
					daemonsnmpelinkrrx.status1, 
					daemonsnmpelinkrrx.status2, 
					daemonsnmpelinkrrx.status3, 
					daemonsnmpelinkrrx.status4
					FROM 
					public.daemonsnmpelinkrrx
					WHERE daemonsnmpelinkrrx.time = $time;";

					$result_rrx = pg_query($query_rrx) or die('Query failed: ' . pg_last_error());

					while ($row_rrx = pg_fetch_object($result_rrx)) {
						$slot_rrx[] = $row_rrx->slot; 
						$model_rrx[] = $row_rrx->model; 
						$sn_rrx[] = $row_rrx->sn; 
						$temp_rrx[] = $row_rrx->temp; 
						$input1_rrx[] = $row_rrx->input1; 
						$input2_rrx[] = $row_rrx->input2; 
						$input3_rrx[] = $row_rrx->input3; 
						$input4_rrx[] = $row_rrx->input4; 
						$status1_rrx[] = $row_rrx->status1; 
						$status2_rrx[] = $row_rrx->status2; 
						$status3_rrx[] = $row_rrx->status3; 
						$status4_rrx[] = $row_rrx->status4;
					}


					pg_free_result($result_rrx);
					pg_close($dbconn);

					function rrxstatus($s){
						switch ($s) {
							case 1:
				# code...
							return "On";
							break;
							case 2:
				# code...
							return "Off";
							break;

							default:
				# code...
							return $s;
							break;
						}

					}



					for ($i=0; $i < sizeof($slot_rrx); $i++) { 

	# code...
						echo "	<table width='80%' class='table table-striped table-bordered table-condensed'>";
						echo "<tr><td><b>Slot</td><td>" . $slot_rrx[$i] . "</td>";
						echo "<td></td></tr>";
						echo "<tr><td><b>Model</td><td>" . $model_rrx[$i] . "</td>";
						echo "<td></td></tr>";
						echo "<tr><td><b>Serial Number</td><td>" . $sn_rrx[$i] . "</td>";
						echo "<td></td></tr>";
						echo "<tr class='success'><td><b>Input  Power 1 (dBm)</td><td>" . $input1_rrx[$i] . "</td>";
						echo "<td> <a href=displayGraph_elink_rrx.php?item=input1&slot=$slot_rrx[$i] onclick=window.open(this.href, mywin,
							left=20,top=20,width=800,height=600,toolbar=1,resizable=0); return false; >Graphing the Data Records</a></td></body></tr>";
echo "<tr class='success'><td><b>Input Power 2 (dBm)</td><td>" . $input2_rrx[$i] . "</td>";
echo "<td> <a href='displayGraph_elink_rrx.php?item=input2&slot=$slot_rrx[$i]' onclick='window.open(this.href, 'mywin',
	'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;' >Graphing the Data Records</a></td></body></tr>";
echo "<tr class='success'><td><b>Input Power 3 (dBm)</td><td>" . $input3_rrx[$i] . "</td>";
echo "<td> <a href='displayGraph_elink_rrx.php?item=input3&slot=$slot_rrx[$i]' onclick='window.open(this.href, 'mywin',
	'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;' >Graphing the Data Records</a></td></body></tr>";
echo "<tr class='success'><td><b>Input Power 4 (dBm)</td><td>" . $input4_rrx[$i] . "</td>";
echo "<td> <a href='displayGraph_elink_rrx.php?item=input4&slot=$slot_rrx[$i]' onclick='window.open(this.href, 'mywin',
	'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;' >Graphing the Data Records</a></td></body></tr>";
echo "<tr><td><b>Status 1</td><td>" . rrxstatus($status1_rrx[$i]) . "</td>";
echo "<td></td></tr>";
echo "<tr><td><b>Status 2</td><td>" . rrxstatus($status2_rrx[$i]) . "</td>";
echo "<td></td></tr>";
echo "<tr><td><b>Status 3</td><td>" . rrxstatus($status3_rrx[$i]) . "</td>";
echo "<td></td></tr>";
echo "<tr><td><b>Status 4</td><td>" . rrxstatus($status4_rrx[$i]) . "</td>";
echo "<td></td></tr>";
echo "</table>";
echo "<br>";
}


?>




<?php

require("daemon_db_init.php");

$query = "SELECT 
daemonsnmpelinkftx.time
FROM 
public.daemonsnmpelinkftx;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
	$time = $row->time; 

}

$time = "'" . strval($time) .  "'"; 
echo "<hr>";
echo "<p><b>FTX:</b></p>";
$query_ftx = "SELECT 
daemonsnmpelinkftx.slot, 
daemonsnmpelinkftx.model, 
daemonsnmpelinkftx.sn, 
daemonsnmpelinkftx.temp, 
daemonsnmpelinkftx.rfinputpower, 
daemonsnmpelinkftx.agcmode, 
daemonsnmpelinkftx.lasertemp, 
daemonsnmpelinkftx.laserbiascurrent, 
daemonsnmpelinkftx.outputpower, 
daemonsnmpelinkftx.lasertype, 
daemonsnmpelinkftx.wavelength, 
daemonsnmpelinkftx.thccurrent
FROM 
public.daemonsnmpelinkftx
WHERE daemonsnmpelinkftx.time = $time;";

$result_ftx = pg_query($query_ftx) or die('Query failed: ' . pg_last_error());

while ($row_ftx = pg_fetch_object($result_ftx)) {
	$slot_ftx[] = $row_ftx->slot; 
	$model_ftx[] = $row_ftx->model; 
	$sn_ftx[] = $row_ftx->sn; 
	$temp_ftx[] = $row_ftx->temp; 
	$rfinputpower_ftx[] = $row_ftx->rfinputpower; 
	$agcmode_ftx[] = $row_ftx->agcmode; 
	$lasertemp_ftx[] = $row_ftx->lasertemp; 
	$laserbiascurrent_ftx[] = $row_ftx->laserbiascurrent; 
	$outputpower_ftx[] = $row_ftx->outputpower; 
	$lasertype_ftx[] = $row_ftx->lasertype; 
	$wavelength_ftx[] = $row_ftx->wavelength; 
	$thccurrent_ftx[] = $row_ftx->thccurrent;
}


pg_free_result($result);
pg_close($dbconn);



for ($i=0; $i < sizeof($slot_ftx); $i++) { 

	# code...
	echo "	<table width='80%' class='table table-striped table-bordered table-condensed'>";
	echo "<tr><td><b>Slot</td><td>" . $slot_ftx[$i] . "</td>";
	echo "<td></td></tr>";
	echo "<tr><td><b>Model</td><td>" . $model_ftx[$i] . "</td>";
	echo "<td></td></tr>";
	echo "<tr><td><b>Serial Number</td><td>" . $sn_ftx[$i] . "</td>";
	echo "<td></td></tr>";
	echo "<tr class='success'><td><b>RF Input Power (dBm)</td><td>" . $rfinputpower_ftx[$i] . "</td>";
	echo "<td> <a href=displayGraph_elink_ftx.php?item=rfinputpower&slot=$slot_ftx[$i] onclick=window.open(this.href, mywin,
		left=20,top=20,width=800,height=600,toolbar=1,resizable=0); return false; >Graphing the Data Records</a></td></body></tr>";
echo "<tr class='success'><td><b>Laser Bias Current (mA)</td><td>" . $laserbiascurrent_ftx[$i] . "</td>";
echo "<td> <a href=displayGraph_elink_ftx.php?item=laserbiascurrent&slot=$slot_ftx[$i] onclick=window.open(this.href, mywin,
	left=20,top=20,width=800,height=600,toolbar=1,resizable=0); return false; >Graphing the Data Records</a></td></body></tr>";
echo "<tr class='success'><td><b>Output Power (dBm)</td><td>" . $outputpower_ftx[$i] . "</td>";
echo "<td> <a href=displayGraph_elink_ftx.php?item=outputpower&slot=$slot_ftx[$i] onclick=window.open(this.href, mywin,
	left=20,top=20,width=800,height=600,toolbar=1,resizable=0); return false; >Graphing the Data Records</a></td></body></tr>";
echo "<tr><td><b>Laser Type</td><td>" . $lasertype_ftx[$i] . "</td>";
echo "<td></td></tr>";
echo "<tr><td><b>Wave Length (nm)</td><td>" . $wavelength_ftx[$i] . "</td>";
echo "<td></td></tr>";
echo "<tr class='success'><td><b>THC Current (mA)</td><td>" . $thccurrent_ftx[$i] . "</td>";
echo "<td> <a href=displayGraph_elink_ftx.php?item=thccurrent&slot=$slot_ftx[$i] onclick=window.open(this.href, mywin,
	left=20,top=20,width=800,height=600,toolbar=1,resizable=0); return false; >Graphing the Data Records</a></td></body></tr>";
echo "</table>";
echo "<br>";
}


?>



</body>
</html>

