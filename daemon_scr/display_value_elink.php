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
//$target_ip = "'" + $_GET['ip'] + "%'";

echo "<b>Status Values of Elink Headend.</b><br>";

echo "EMS:";
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
	public.daemonsnmpelinkems;";

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

?>



<table>

<tr>
<td>Time </td>
<td> <?php  echo $time;         ?></td>	
</tr>

<tr>
<td>slot </td>
<td> <?php  echo $slot;         ?></td>	
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
<td>model </td>
<td> <?php  echo $model;         ?></td>	
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
<td>name </td>
<td> <?php  echo $name;         ?></td>	
</tr>

<tr>
<td>alarm </td>
<td> <?php  echo $alarm;         ?></td>	
</tr>

<tr>
<td>sn </td>
<td> <?php  echo $sn;         ?></td>	
</tr>

<tr>
<td>temp </td>
<td> <?php  echo $temp;         ?></td>	
</tr>

<tr>
<td>vendor </td>
<td> <?php  echo $vendor;         ?></td>	
</tr>

<tr>
<td>alarmdetection </td>
<td> <?php  echo $alarmdetection;         ?></td>	
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
<td>ipaddress </td>
<td> <?php  echo $ipaddress;         ?></td>	
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





<?php

require("daemon_db_init.php");

echo "Power Supply:";
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



<table>

<tr>
<td>slot </td>
<td> <?php  echo $slot;         ?></td>	
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
<td>temp </td>
<td> <?php  echo $temp;         ?></td>	
</tr>

<tr>
<td>inputv </td>
<td> <?php  echo $inputv;         ?></td>	
</tr>

<tr>
<td>outputv </td>
<td> <?php  echo $outputv;         ?></td>	
</tr>

<tr>
<td>outputma </td>
<td> <?php  echo $outputma;         ?></td>	
</tr>

<tr>
<td>outputw </td>
<td> <?php  echo $outputw;         ?></td>	
</tr>

</table>





<?php

require("daemon_db_init.php");

echo "Fan:";
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

?>



<table>

<tr>
<td>fan1 </td>
<td> <?php  echo $fan1;         ?></td>	
</tr>

<tr>
<td>fan2 </td>
<td> <?php  echo $fan2;         ?></td>	
</tr>

<tr>
<td>fan3 </td>
<td> <?php  echo $fan3;         ?></td>	
</tr>

<tr>
<td>fan4 </td>
<td> <?php  echo $fan4;         ?></td>	
</tr>

<tr>
<td>fan5 </td>
<td> <?php  echo $fan5;         ?></td>	
</tr>

<tr>
<td>fan6 </td>
<td> <?php  echo $fan6;         ?></td>	
</tr>
<tr>
<td>fan7 </td>
<td> <?php  echo $fan7;         ?></td>	
</tr>

<tr>
<td>fan8 </td>
<td> <?php  echo $fan8;         ?></td>	
</tr>


</table>



<?php

require("daemon_db_init.php");

echo "RRX:";
$query = "SELECT 
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
  public.daemonsnmpelinkrrx;
";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
  $slot = $row->slot; 
  $model = $row->model; 
  $sn = $row->sn; 
  $temp = $row->temp; 
  $input1 = $row->input1; 
  $input2 = $row->input2; 
  $input3 = $row->input3; 
  $input4 = $row->input4; 
  $status1 = $row->status1; 
  $status2 = $row->status2; 
  $status3 = $row->status3; 
  $status4 = $row->status4;
}


pg_free_result($result);
pg_close($dbconn);

?>



<table>

<tr>
<td>slot </td>
<td> <?php  echo $slot;         ?></td>	
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
<td>temp </td>
<td> <?php  echo $temp;         ?></td>	
</tr>

<tr>
<td>input1 </td>
<td> <?php  echo $input1;         ?></td>	
</tr>

<tr>
<td>input2 </td>
<td> <?php  echo $input2;         ?></td>	
</tr>
<tr>
<td>input3 </td>
<td> <?php  echo $input3;         ?></td>	
</tr>

<tr>
<td>input4 </td>
<td> <?php  echo $input4;         ?></td>	
</tr>

<tr>
<td>status1 </td>
<td> <?php  echo $status1;         ?></td>	
</tr>

<tr>
<td>status2 </td>
<td> <?php  echo $status2;         ?></td>	
</tr>
<tr>
<td>status3 </td>
<td> <?php  echo $status3;         ?></td>	
</tr>

<tr>
<td>status4 </td>
<td> <?php  echo $status4;         ?></td>	
</tr>


</table>








<?php

require("daemon_db_init.php");

echo "FTX:";
$query = "SELECT 
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
  public.daemonsnmpelinkftx;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
	$slot = $row->slot; 
	$model = $row->model; 
	$sn = $row->sn; 
	$temp = $row->temp; 
	$rfinputpower = $row->rfinputpower; 
	$agcmode = $row->agcmode; 
	$lasertemp = $row->lasertemp; 
	$laserbiascurrent = $row->laserbiascurrent; 
	$outputpower = $row->outputpower; 
	$lasertype = $row->lasertype; 
	$wavelength = $row->wavelength; 
	$thccurrent = $row->thccurrent;
}


pg_free_result($result);
pg_close($dbconn);

?>



<table>

<tr>
<td>slot </td>
<td> <?php  echo $slot;         ?></td>	
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
<td>temp </td>
<td> <?php  echo $temp;         ?></td>	
</tr>

<tr>
<td>rfinputpower </td>
<td> <?php  echo $rfinputpower;         ?></td>	
</tr>

<tr>
<td>agcmode </td>
<td> <?php  echo $agcmode;         ?></td>	
</tr>
<tr>
<td>lasertemp </td>
<td> <?php  echo $lasertemp;         ?></td>	
</tr>

<tr>
<td>laserbiascurrent </td>
<td> <?php  echo $laserbiascurrent;         ?></td>	
</tr>

<tr>
<td>outputpower </td>
<td> <?php  echo $outputpower;         ?></td>	
</tr>

<tr>
<td>lasertype </td>
<td> <?php  echo $lasertype;         ?></td>	
</tr>
<tr>
<td>wavelength </td>
<td> <?php  echo $wavelength;         ?></td>	
</tr>

<tr>
<td>thccurrent </td>
<td> <?php  echo $thccurrent;         ?></td>	
</tr>


</table>







</body>
</html>

