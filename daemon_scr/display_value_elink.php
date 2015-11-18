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
$target_ip = "'" . $_GET['ip'] . "%'";



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
	public.daemonsnmpelinkems
	WHERE daemonsnmpelinkems.ip LIKE $target_ip;";

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

$query = "SELECT 
	daemonsnmpelinkrrx.time
	FROM 
	public.daemonsnmpelinkrrx;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)) {
	$time = $row->time; 
	
}

$time = "'" . strval($time) .  "'"; 

echo "RRX:";

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


for ($i=0; $i < sizeof($slot_rrx); $i++) { 
	# code...
	echo "<table>";
	echo "<tr><td>Slot</td><td>" . $slot_rrx[$i] . "</td></tr>";
	echo "<tr><td>Model</td><td>" . $model_rrx[$i] . "</td></tr>";
	echo "<tr><td>Sn</td><td>" . $sn_rrx[$i] . "</td></tr>";
	echo "<tr><td>Temperature</td><td>" . $temp_rrx[$i] . "</td></tr>";
	echo "<tr><td>Input 1</td><td>" . $input1_rrx[$i] . "</td></tr>";
	echo "<tr><td>Input 2</td><td>" . $input2_rrx[$i] . "</td></tr>";
	echo "<tr><td>Input 3</td><td>" . $input3_rrx[$i] . "</td></tr>";
	echo "<tr><td>Input 4</td><td>" . $input4_rrx[$i] . "</td></tr>";
	echo "<tr><td>Status 1</td><td>" . $status1_rrx[$i] . "</td></tr>";
	echo "<tr><td>Status 2</td><td>" . $status2_rrx[$i] . "</td></tr>";
	echo "<tr><td>Status 3</td><td>" . $status3_rrx[$i] . "</td></tr>";
	echo "<tr><td>Status 4</td><td>" . $status4_rrx[$i] . "</td></tr>";
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

echo "FTX:";
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
	echo "<table>";
	echo "<tr><td>Slot</td><td>" . $slot_ftx[$i] . "</td></tr>";
	echo "<tr><td>Model</td><td>" . $model_ftx[$i] . "</td></tr>";
	echo "<tr><td>Sn</td><td>" . $sn_ftx[$i] . "</td></tr>";
	echo "<tr><td>Temperature</td><td>" . $temp_ftx[$i] . "</td></tr>";
	echo "<tr><td>RF Input Power</td><td>" . $rfinputpower_ftx[$i] . "</td></tr>";
	echo "<tr><td>AGC Mode</td><td>" . $agcmode_ftx[$i] . "</td></tr>";
	echo "<tr><td>Laser Temperature</td><td>" . $lasertemp_ftx[$i] . "</td></tr>";
	echo "<tr><td>Laser Bias Current</td><td>" . $laserbiascurrent_ftx[$i] . "</td></tr>";
	echo "<tr><td>Output Power</td><td>" . $outputpower_ftx[$i] . "</td></tr>";
	echo "<tr><td>Laser Type</td><td>" . $lasertype_ftx[$i] . "</td></tr>";
	echo "<tr><td>Wave Length</td><td>" . $wavelength_ftx[$i] . "</td></tr>";
	echo "<tr><td>THC Current</td><td>" . $thccurrent_ftx[$i] . "</td></tr>";
	echo "</table>";
	echo "<br>";
}
	

?>



</body>
</html>

