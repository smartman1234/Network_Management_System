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

require("daemon_db_init.php");
require("daemon_getDeviceIdPerIp.php");
$deviceid = getDeviceIdPerIp($_GET['ip']);


echo "<b>Status Values of EGFA.</b><br>";


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

?>



<table>

<tr>
<td>Time </td>
<td> <?php  echo $time;         ?></td>	
</tr>

<tr>
<td>description </td>
<td> <?php  echo $description;         ?></td>	
</tr>

<tr>
<td>oids </td>
<td> <?php  echo $oids;         ?></td>	
</tr>

<tr>
<td>uptime </td>
<td> <?php  echo $uptime;         ?></td>	
</tr>

<tr>
<td>contact </td>
<td> <?php  echo $contact;         ?></td>	
</tr>

<tr>
<td>name </td>
<td> <?php  echo $name;         ?></td>	
</tr>

<tr>
<td>location </td>
<td> <?php  echo $location;         ?></td>	
</tr>

<tr>
<td>service </td>
<td> <?php  echo $service;         ?></td>	
</tr>

<tr>
<td>ip </td>
<td> <?php  echo $ip;         ?></td>	
</tr>

<tr>
<td>outputopticalpower </td>
<td> <?php  echo $outputopticalpower;         ?></td>	
</tr>

<tr>
<td>inputopticalpower </td>
<td> <?php  echo $inputopticalpower;         ?></td>	
</tr>

<tr>
<td>mac </td>
<td> <?php  echo $mac;         ?></td>	
</tr>

<tr>
<td>pumptemp1 </td>
<td> <?php  echo $pumptemp1;         ?></td>	
</tr>

<tr>
<td>pumptemp2 </td>
<td> <?php  echo $pumptemp2;         ?></td>	
</tr>

<tr>
<td>dcpsnumber </td>
<td> <?php  echo $dcpsnumber;         ?></td>	
</tr>

<tr>
<td>pumptemp3 </td>
<td> <?php  echo $pumptemp3;         ?></td>	
</tr>

<tr>
<td>dcpsmode </td>
<td> <?php  echo $dcpsmode;         ?></td>	
</tr>

<tr>
<td>dc5v </td>
<td> <?php  echo $dc5v;         ?></td>	
</tr>

<tr>
<td>dcminor5v </td>
<td> <?php  echo $dcminor5v;         ?></td>	
</tr>

<tr>
<td>dc12v </td>
<td> <?php  echo $dc12v;         ?></td>	
</tr>

<tr>
<td>dc33v </td>
<td> <?php  echo $dc33v;         ?></td>	
</tr>

<tr>
<td>left5v </td>
<td> <?php  echo $left5v;         ?></td>	
</tr>

<tr>
<td>right5v </td>
<td> <?php  echo $right5v;         ?></td>	
</tr>


<tr>
<td>leftminor5v </td>
<td> <?php  echo $leftminor5v;         ?></td>	
</tr>

<tr>
<td>rightminor5v </td>
<td> <?php  echo $rightminor5v;         ?></td>	
</tr>

<tr>
<td>manudate </td>
<td> <?php  echo $manudate;         ?></td>	
</tr>

<tr>
<td>firmware </td>
<td> <?php  echo $firmware;         ?></td>	
</tr>

<tr>
<td>model </td>
<td> <?php  echo $model;         ?></td>	
</tr>

<tr>
<td>sn </td>
<td> <?php  echo $sn;         ?></td>	
</tr>


<tr>
<td>vendor </td>
<td> <?php  echo $vendor;         ?></td>	
</tr>

<tr>
<td>checkcode </td>
<td> <?php  echo $checkcode;         ?></td>	
</tr>

<tr>
<td>tamperstatus </td>
<td> <?php  echo $tamperstatus;         ?></td>	
</tr>

<tr>
<td>internaltemp </td>
<td> <?php  echo $internaltemp;         ?></td>	
</tr>

<tr>
<td>craftstatus </td>
<td> <?php  echo $craftstatus;         ?></td>	
</tr>




</table>


</body>
</html>

