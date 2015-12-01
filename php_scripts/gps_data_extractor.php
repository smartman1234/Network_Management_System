<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 


$query = "SELECT 
  daemondevice.ip, 
  daemondevice.longtitude, 
  daemondevice.latitude, 
  daemondevice.mac
FROM 
  public.daemondevice;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total = pg_num_rows($result);

$lo = [];
$la = [];
$ip = [];
$mac = [];

while ($row = pg_fetch_object($result)) {	

	$lo[] = doubleval($row->longtitude);
	$la[] = doubleval($row->latitude);
	$ip[] = $row->ip;
  $mac[] = $row->mac;


}

$j = 0;
for ($i=0; $i < $total; $i++) { 
	# code...
  if ($lo[$i] > -100 && $la[$i] > -100 && $lo[$i] != 0 && $la[$i] != 0) {
    # code...
    $comment = $ip[$i] . " : " . $mac[$i];
    $data[$j] = [$comment, $lo[$i], $la[$i], 0.0];
    $j = $j + 1;
  }
	
}


$json = json_encode($data);



pg_free_result($result);
pg_close($dbconn);


?>




