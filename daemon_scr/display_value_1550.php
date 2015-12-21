<!DOCTYPE html>
<html lang="en">
<head>
	<title>EG1550 Status Values</title>
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
// $target_ip = "'" . "10.100.0.50" . "%'";


	$_SESSION['deviceid'] = $deviceid;

	//echo $_SESSION['deviceid'];

	echo "<b>Status Values of EG1550.</b><br>";
	echo "<hr>";
	echo "<img src='images/EG1550TX_product.png' alt='EG1550TX Series' height='250', width='250'>";

// $query = "SELECT 
// 	dameonsnmp1550value.time
// 	FROM 
// 	public.dameonsnmp1550value;";

// $result = pg_query($query) or die('Query failed: ' . pg_last_error());

// while ($row = pg_fetch_object($result)) {
// 	$time = $row->time; 
	
// }

// $time = "'" . strval($time) .  "'"; 

	$query = "SELECT 
	dameonsnmp1550value.time, 
	dameonsnmp1550value.recordip, 
	dameonsnmp1550value.description, 
	dameonsnmp1550value.oids, 
	dameonsnmp1550value.uptime, 
	dameonsnmp1550value.contact, 
	dameonsnmp1550value.location, 
	dameonsnmp1550value.service, 
	dameonsnmp1550value.ip, 
	dameonsnmp1550value.name, 
	dameonsnmp1550value.statusindex, 
	dameonsnmp1550value.mac, 
	dameonsnmp1550value.idcode, 
	dameonsnmp1550value.subid, 
	dameonsnmp1550value.firmwareversion, 
	dameonsnmp1550value.laserim, 
	dameonsnmp1550value.lasertemperature, 
	dameonsnmp1550value.laserbias, 
	dameonsnmp1550value.rfmodulationlevel, 
	dameonsnmp1550value.dc24vvoltage, 
	dameonsnmp1550value.dc12vvoltage, 
	dameonsnmp1550value.dc5vvoltage, 
	dameonsnmp1550value.minor5vdcvoltage, 
	dameonsnmp1550value.txopticalpower, 
	dameonsnmp1550value.gaincontrolsetting, 
	dameonsnmp1550value.sbscontrolsetting, 
	dameonsnmp1550value.ctbcontrolsetting, 
	dameonsnmp1550value.txrfmodulelevel, 
	dameonsnmp1550value.presentacpower1status, 
	dameonsnmp1550value.presentacpower2status, 
	dameonsnmp1550value.txacpowersupplystatus
	FROM 
	public.dameonsnmp1550value
	WHERE dameonsnmp1550value.deviceid=$deviceid;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result)) {
		$time = $row->time; 
		$recordip = $row->recordip; 
		$description = $row->description; 
		$oids = $row->oids; 
		$uptime = $row->uptime; 
		$contact = $row->contact; 
		$location = $row->location; 
		$service = $row->service; 
		$ip = $row->ip; 
		$name = $row->name; 
		$statusindex = $row->statusindex; 
		$mac = $row->mac; 
		$idcode = $row->idcode; 
		$subid = $row->subid; 
		$firmwareversion = $row->firmwareversion; 
		$laserim = $row->laserim; 
		$lasertemperature = $row->lasertemperature; 
		$laserbias = $row->laserbias; 
		$rfmodulationlevel = $row->rfmodulationlevel; 
		$dc24vvoltage = $row->dc24vvoltage; 
		$dc12vvoltage = $row->dc12vvoltage; 
		$dc5vvoltage = $row->dc5vvoltage; 
		$minor5vdcvoltage = $row->minor5vdcvoltage; 
		$txopticalpower = $row->txopticalpower; 
		$gaincontrolsetting = $row->gaincontrolsetting; 
		$sbscontrolsetting = $row->sbscontrolsetting; 
		$ctbcontrolsetting = $row->ctbcontrolsetting; 
		$txrfmodulelevel = $row->txrfmodulelevel; 
		$presentacpower1status = $row->presentacpower1status; 
		$presentacpower2status = $row->presentacpower2status; 
		$txacpowersupplystatus = $row->txacpowersupplystatus;

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

	function VisStatusIndex($s){
		switch ($s) {
			case 1:
			# code...
			return "Normal";
			break;
			case 0:
			# code...
			return "Need Check";
			break;

			default:
			# code...
			return $s;
			break;
		}


	}



	?>



	<table width="80%" class="table table-striped table-bordered table-condensed">

		<tr>
			<td><b>Last Scaned Time </td>
			<td> <?php  echo displayTime($time);         ?></td>	
			<td>    </td>
		</tr>

		<tr>
			<td><b>Public IP </td>
			<td> <?php  echo $recordip;         ?></td>	
			<td>    </td>
		</tr>

		<tr>
			<td><b>Interal IP </td>
			<td> <?php  echo $ip;         ?></td>	
			<td>    </td>
		</tr>

		<tr>
			<td><b>MAC Address </td>
			<td> <?php  echo $mac;         ?></td>	
			<td>    </td>
		</tr>

		<tr>
			<td><b>Uptime  </td>
			<td> <?php  echo $uptime;         ?></td>	
			<td>    </td>
		</tr>



		<tr>
			<td><b>Working Status </td>
			<td> <?php  echo VisStatusIndex($statusindex);         ?></td>	
			<td>    </td>
		</tr>



		<tr>
			<td><b>Serial Number </td>
			<td> <?php  echo $idcode;         ?></td>	
			<td>    </td>
		</tr>



		<tr>
			<td><b>Firmware Version </td>
			<td> <?php  echo $firmwareversion;         ?></td>	
			<td>    </td>
		</tr>

		<tr class="success">
			<td><b>Laser IM (mA)</td>
			<td> <?php  echo floatval($laserim);         ?></td>	
			<td> <a href="displayGraph_1550.php?item=laserim" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>Laser Temperature (C) </td>
				<td> <?php  echo floatval($lasertemperature);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=lasertemperature" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>Laser Bias (mA)</td>
				<td> <?php  echo floatval($laserbias);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=laserbias" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>RF Modulation Level (dB)</td>
				<td> <?php  echo floatval($rfmodulationlevel);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=rfmodulationlevel" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>DC24V Voltage (V)</td>
				<td> <?php  echo floatval($dc24vvoltage);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=dc24vvoltage" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>DC12V Vvoltage (V)</td>
				<td> <?php  echo floatval($dc12vvoltage);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=dc12vvoltage" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>DC5V Voltage (V)</td>
				<td> <?php  echo floatval($dc5vvoltage);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=dc5vvoltage" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>

			<tr class="success">
				<td><b>DC -5V Voltage (V)</td>
				<td> <?php  echo floatval($minor5vdcvoltage);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=minor5vdcvoltage" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>


			<tr class="success">
				<td><b>TX Optical Power (dBm)</td>
				<td> <?php  echo floatval($txopticalpower);         ?></td>	
				<td> <a href="displayGraph_1550.php?item=txopticalpower" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
			</tr>



			<tr>
				<td><b>Gain Control  </td>
				<td> <?php  echo $gaincontrolsetting;         ?></td>	
				<td> </td>
			</tr>

			<tr class="success">
				<td><b>SBS Control  (dBm)</td>
				<td> <?php  echo floatval($sbscontrolsetting);         ?></td>	
				<td><a href="displayGraph_1550.php?item=sbscontrolsetting" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a> </td>
			</tr>

			<tr>
				<td><b>CTB Ccontrol  </td>
				<td> <?php  echo $ctbcontrolsetting;         ?></td>	
				<td> </td>
			</tr>

			<tr class="success">
				<td><b>TX RF Module Level (dB)</td>
				<td> <?php  echo floatval($txrfmodulelevel);         ?></td>	
				<td><a href="displayGraph_1550.php?item=txrfmodulelevel" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a> </td>
			</tr>


			<tr>
				<td><b>Present AC Power 1 Status </td>
				<td> <?php  echo $presentacpower1status;         ?></td>	
				<td> </td>
			</tr>

			<tr>
				<td><b>Present AC Power 1 Status </td>
				<td> <?php  echo $presentacpower2status;         ?></td>	
				<td> </td>
			</tr>

			<tr>
				<td><b>TX AC Power Supply Status </td>
				<td> <?php  echo $txacpowersupplystatus;         ?></td>	
				<td> </td>
			</tr>





		</table>


	</body>
	</html>

