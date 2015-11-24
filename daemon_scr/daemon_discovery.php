<?php

// unit test --- begin
$ip[] = "69.70.200.246";
$ip[] = "69.70.200.249";
$ip[] = "69.70.200.250";
$ip[] = "69.70.200.232";

//echo sizeof(getAllOnlineDevice($ip));

for ($i=0; $i < sizeof($ip); $i++) { 
	# code..
	$sp = snmpget( $ip[$i], "public", ".1.3.6.1.2.1.1.2.0");
	if ($sp != false) {
		# code...
		$ipaddr[] = $ip[$i];
		$oid[] = $sp;
	}

	if ($sp == false) {
		# code...
		$bp = snmpget( $ip[$i], "PUBLIC", ".1.3.6.1.2.1.1.2.0");
		if ($bp!=false) {

			# code...
			$ipaddr[] = $ip[$i];
			$oid[] = $bp;

		}

	}

}


for ($i=0; $i < sizeof($ipaddr); $i++) { 
	# code...
	echo $ipaddr[$i] . " : " . $oid[$i] . "<br>";
}


// unit test --- end 


function getIpPool($l, $u){
	$lp=strripos($l, ".")+1;
	$up=strripos($u, ".")+1;
	$lnum=intval(substr($l, $lp));
	$unum=intval(substr($u, $up));
	$lrem=substr($l, 0, $lp);
	
	for ($i=$lnum; $i <= $unum; $i++) { 
		# code...
		$ipPool[] = $lrem . strval($i);
	}

	for ($i=0; $i < sizeof($ipPool); $i++) { 
		# code...
		echo $ipPool[$i] . "<br>";
	}










}




function getAllOnlineDevice($ipPool){
	for ($i=0; $i < sizeof($ipPool); $i++) { 
		# code...
		if (ifPingable($ipPool[$i])!=false) {
			$ipOnline[] = $ipPool[$i];
			# code...
		}
	}
	return $ipOnline;
}

// the helper function that double chekcs the device is really reachable 
function ifPingable($host, $timeout = 1) {
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

function getSnmpInfo($pingableIp){


	




}



function snmpget_smallp($ip, $oid) {
	return removeQuotation(ext(snmpget($ip, "public", $oid)));

}


function snmpget_bigP($ip, $oid) {
	return removeQuotation(ext(snmpget($ip, "PUBLIC", $oid)));

}

function ext($in) {
	$out = "";
	$index = strpos ( $in, ":" );
	if ($index != FALSE) {
		$out = substr ( $in, $index + 2 );
	}
	return $out;
}

function removeQuotation($in){
	$out = $in;
	if ($in[0] == '"') {
		# code...
		$out = ltrim($in, '"');
		$out = rtrim($out, '"');

	}
	return $out;
}


?>