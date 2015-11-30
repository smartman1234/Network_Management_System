<?php



	// $sysDescr = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" );
	// $sysObjectID = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" );
	// $sysUpTime = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" );
	// $sysContact = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" );
	// $sysName = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" );
	// $sysLocation = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0" );
	// $sysService = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" );


$ip= "69.70.200.246";


$ip1= "69.70.200.232";


$ip2= "69.70.200.249";





$a =snmpget_bigP("69.70.200.246", ".1.3.6.1.2.1.1.1.0") . "<br>";

echo substr($a, 0, 2);

// echo snmpget_smallp($ip2, ".1.3.6.1.2.1.1.1.0") . "<br>";

// echo snmpget_smallp($ip2, ".1.3.6.1.2.1.1.2.0") . "<br>";

// echo snmpget_bigP($ip1, ".1.3.6.1.2.1.1.1.0") . "<br>";

// echo snmpget_bigP($ip1, ".1.3.6.1.2.1.1.2.0") . "<br>";







function snmpget_smallp($ip, $oid) {
	$command = $command = "snmpget -Ov -v 1 -c public " . $ip . " " .  $oid . " 2>&1";
	$result = shell_exec ( $command );
	$result = ext ( $result );
	$result = removeQuotation($result);
	return $result;
}

function snmpget_bigP($ip, $oid) {
	$command = $command = "snmpget -Ov -v 1 -c PUBLIC " . $ip . " " .  $oid . " 2>&1";
	$result = shell_exec ( $command );
	$result = ext ( $result );
	$result = removeQuotation($result);
	return $result;
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


function removeQuotation1($in){
	return rtrim(substr($in, 1), "'"); 
}


?>