<!DOCTYPE html>
<html lang="en">
<head>
	<title>EGFA Status Values</title>
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


	echo "<b>Status Values of EGFA.</b><br>";
	$_SESSION['deviceid'] = $deviceid;


	$query = "SELECT 
	daemonsnmpegfavalue.time,
	daemonsnmpegfavalue.description, 
	daemonsnmpegfavalue.oids, 
	daemonsnmpegfavalue.uptime, 
	daemonsnmpegfavalue.contact, 
	daemonsnmpegfavalue.name, 
	daemonsnmpegfavalue.location, 
	daemonsnmpegfavalue.service, 
	daemonsnmpegfavalue.ip, 
	daemonsnmpegfavalue.outputopticalpower, 
	daemonsnmpegfavalue.inputopticalpower, 
	daemonsnmpegfavalue.mac, 
	daemonsnmpegfavalue.pumptemp1, 
	daemonsnmpegfavalue.pumptemp2, 
	daemonsnmpegfavalue.dcpsnumber, 
	daemonsnmpegfavalue.pumptemp3, 
	daemonsnmpegfavalue.dcpsmode, 
	daemonsnmpegfavalue.dc5v, 
	daemonsnmpegfavalue.dcminor5v, 
	daemonsnmpegfavalue.dc12v, 
	daemonsnmpegfavalue.dc33v, 
	daemonsnmpegfavalue.left5v, 
	daemonsnmpegfavalue.right5v, 
	daemonsnmpegfavalue.leftminor5v, 
	daemonsnmpegfavalue.rightminor5v, 
	daemonsnmpegfavalue.manudate, 
	daemonsnmpegfavalue.firmware, 
	daemonsnmpegfavalue.model, 
	daemonsnmpegfavalue.sn, 
	daemonsnmpegfavalue.vendor, 
	daemonsnmpegfavalue.checkcode, 
	daemonsnmpegfavalue.tamperstatus, 
	daemonsnmpegfavalue.internaltemp, 
	daemonsnmpegfavalue.craftstatus
	FROM 
	public.daemonsnmpegfavalue
	WHERE daemonsnmpegfavalue.deviceid=$deviceid;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	while ($row = pg_fetch_object($result)) {
		$time = $row->time;
		$description = $row->description; 
		$oids = $row->oids; 
		$uptime = $row->uptime; 
		$contact = $row->contact; 
		$name = $row->name; 
		$location = $row->location; 
		$service = $row->service; 
		$ip = $row->ip; 
		$outputopticalpower = $row->outputopticalpower; 
		$inputopticalpower = $row->inputopticalpower; 
		$mac = $row->mac; 
		$pumptemp1 = $row->pumptemp1; 
		$pumptemp2 = $row->pumptemp2; 
		$dcpsnumber = $row->dcpsnumber; 
		$pumptemp3 = $row->pumptemp3; 
		$dcpsmode = $row->dcpsmode; 
		$dc5v = $row->dc5v; 
		$dcminor5v = $row->dcminor5v; 
		$dc12v = $row->dc12v; 
		$dc33v = $row->dc33v; 
		$left5v = $row->left5v; 
		$right5v = $row->right5v; 
		$leftminor5v = $row->leftminor5v; 
		$rightminor5v = $row->rightminor5v; 
		$manudate = $row->manudate; 
		$firmware = $row->firmware; 
		$model = $row->model; 
		$sn = $row->sn; 
		$vendor = $row->vendor; 
		$checkcode = $row->checkcode; 
		$tamperstatus = $row->tamperstatus; 
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
			<td></td>	
		</tr>



		<tr>
			<td><b>Uptime </td>
			<td> <?php  echo $uptime;         ?></td>	
			<td></td>	
		</tr>


		<tr>
			<td><b>Device IP </td>
			<td> <?php  echo $ip;         ?></td>	
			<td></td>	
		</tr>

		<tr>
			<td><b>MAC Address </td>
			<td> <?php  echo $mac;         ?></td>	
			<td></td>	
		</tr>

		<tr>
			<td><b>Manufacturing Date </td>
			<td> <?php  echo $manudate;         ?></td>	
			<td></td>	
		</tr>

		<tr>
			<td><b>Firmware </td>
			<td> <?php  echo $firmware;         ?></td>	
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



		<tr class="success">
			<td><b>Internal Tempearture (C) </td>
			<td> <?php  echo floatval($internaltemp);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=internaltemp" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Output Optical Power (dBm)</td>
			<td> <?php  echo floatval($outputopticalpower);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=outputopticalpower" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Input Optical Power (dBm)</td>
			<td> <?php  echo floatval($inputopticalpower);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=inputopticalpower" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>



		<tr class="success">
			<td><b>Pump Temeperature 1 (C)</td>
			<td> <?php  echo floatval($pumptemp1);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=pumptemp1" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Pump Temeperature 2 (C) </td>
			<td> <?php  echo floatval($pumptemp2);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=pumptemp2" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>



		<tr class="success">
			<td><b>Pump Temeperature 3 (C) </td>
			<td> <?php  echo floatval($pumptemp3);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=pumptemp3" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>DCPS Number </td>
			<td> <?php  echo floatval($dcpsnumber);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=dcpsnumber" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>



		<tr class="success">
			<td><b>DC5V (V)</td>
			<td> <?php  echo floatval($dc5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=dc5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>DC -5V (V)</td>
			<td> <?php  echo floatval($dcminor5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=dcminor5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>DC12V (V)</td>
			<td> <?php  echo floatval($dc12v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=dc12v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>DC33V (V)</td>
			<td> <?php  echo floatval($dc33v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=dc33v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Left 5V (V)</td>
			<td> <?php  echo floatval($left5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=left5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Right 5V (V)</td>
			<td> <?php  echo floatval($right5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=right5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>


		<tr class="success">
			<td><b>Left -5V (V)</td>
			<td> <?php  echo floatval($leftminor5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=leftminor5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>

		<tr class="success">
			<td><b>Right -5V (V)</td>
			<td> <?php  echo floatval($rightminor5v);         ?></td>	
			<td> <a href="displayGraph_egfa.php?item=rightminor5v" onclick="window.open(this.href, 'mywin',
				'left=20,top=20,width=800,height=600,toolbar=1,resizable=0'); return false;" >Graphing the Data Records</a>   </td>
		</tr>







	</table>


</body>
</html>

