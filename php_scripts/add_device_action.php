<?php

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require_once($dbpath);  // to initialize snmp 


$action = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_singleDeviceAction.php";
require_once($action);  // to initialize snmp 



$ip[0] = $_POST["ip1"];
$comm[0] = $_POST["lb1"];
$mac[0] = $_POST["mac1"];
$sn[0] = $_POST["sn1"];
$lati[0] = $_POST["lati1"];
$long[0] = $_POST["long1"];

$ip[1] = $_POST["ip2"];
$comm[1] = $_POST["lb2"];
$mac[1] = $_POST["mac2"];
$sn[1] = $_POST["sn2"];
$lati[1] = $_POST["lati2"];
$long[1] = $_POST["long2"];

$ip[2] = $_POST["ip3"];
$comm[2] = $_POST["lb3"];
$mac[2] = $_POST["mac3"];
$sn[2] = $_POST["sn3"];
$lati[2] = $_POST["lati3"];
$long[2] = $_POST["long3"];


for ($i=0; $i < 3; $i++) { 
	# code...
	if ($ip[$i] != "" && $comm[$i] != "") {
		# code...
		if (ifPingable($ip[$i])!=false) {
			# code...
			 addDevice($ip[$i], $comm[$i], $mac[$i], $sn[$i], $lati[$i], $long[$i]);
		}

		if (ifPingable($ip[$i])==false) {
			# code...
			 echo $ip[$i] . " is not reachable!<br>";
		}	
	}
	
}

echo "<br>";

echo "<br>";
echo "System needs to take a while for synchorizaiton.";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";


// the helper function that double chekcs the device is really reachable 
function ifPingable($host, $timeout = 1)
{
    /* ICMP ping packet with a pre-calculated checksum */
    $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
    $socket = socket_create(AF_INET, SOCK_RAW, 1);
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $timeout, 'usec' => 0));
    socket_connect($socket, $host, null);
    $ts = microtime(true);
    socket_send($socket, $package, strLen($package), 0);
    if (socket_read($socket, 255))
        $result = microtime(true) - $ts;
    else    $result = false;
    socket_close($socket);
    return $result;
}





?>


