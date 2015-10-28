<?PHP




$ip ="10.100.0.80";
$good  = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.1.0" );
$bad  = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.3.0" );
var_dump($good);
var_dump($bad);
$sub = substr($bad, 0, 3);
if (substr($bad, 0, 3) == "(no") {
	# code...
	echo "dosnt existed";
}













function snmpget_bigP($ip, $oid) {
	$command = $command = "C:\usr\bin\snmpget -Ov -v 1 -c PUBLIC " . $ip . " " .  $oid . " 2>&1";
	$result = shell_exec ( $command );
	$result = ext ( $result );
	$result = removeQuotation($result);
	return $result;
}

function snmpget_smallp($ip, $oid) {
	$command = $command = "C:\usr\bin\snmpget -Ov -v 1 -c public " . $ip . " " .  $oid . " 2>&1";
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

?>