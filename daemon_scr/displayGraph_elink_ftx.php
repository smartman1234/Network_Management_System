<?php  

session_start();

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

require "jpgraphplot.php";

require("daemon_db_init.php");


$item = $_GET['item'];
$id = $_SESSION['deviceid'];
$slot = "'" . $_GET['slot'] . "'";

$query = "SELECT 
daemonsnmpelinkftx.time,
daemonsnmpelinkftx.$item
FROM 
public.daemonsnmpelinkftx
WHERE daemonsnmpelinkftx.deviceid=$id
AND daemonsnmpelinkftx.slot=$slot;";

$time=[];
$abc=[];


$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$number = count($arr);

while ($row = pg_fetch_object($result)) {
	$time[] = displayTime($row->time); 
	$abc[] = floatval($row->$item); 

}

pg_free_result($result);
pg_close($dbconn);

if ($number>=20) {
	# code...
	$time=array_slice($time, sizeof($time)-20);
	$abc=array_slice($abc, sizeof($abc)-20);
}


$file = "graphPool/smaple" . date('YmdGis') . ".jpg";
plotGraph($item, $time, $abc, $file);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Status Value Graph</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

	<img src="<?php  echo $file;  ?>">


</body>
</html>