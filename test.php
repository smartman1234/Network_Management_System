<?php


echo ifPingable("8.8.8.8");

echo "<br>";

$ip = "69.70.200.246";
$comm="public";
$oid=".1.3.6.1.2.1.1.1.0";

echo snmpget_generic($ip, $comm, $oid);





function ifPingable($host, $timeout = 3) {
	/* ICMP ping packet with a pre-calculated checksum */
	$package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
	$socket  = socket_create(AF_INET, SOCK_RAW, 1);
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



function snmpget_generic($ip, $comm, $oid) {
	$command = "C:\usr\bin\snmpget -Ov -v 1 -c " . $comm . " " . $ip . " " .  $oid . " 2>&1";
	$result = shell_exec ( $command );
	$result = ext ( $result );
	$result = removeQuotation($result);
	return $result;
}




?>