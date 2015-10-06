
<?php


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


// deprecated 
// function snmpget_egfa($ip, $oid) {
// 	$command = $command = "C:\usr\bin\snmpget -Ov -v 1 -c PUBLIC " . $ip . " " .  $oid . " 2>&1";
// 	$result = shell_exec ( $command );
// 	$result = ext ( $result );
// 	$result = removeQuotation($result);
// 	return $result;
// }

// function snmpget_elink($ip, $oid) {
// 	$command = $command = "C:\usr\bin\snmpget -Ov -v 1 -c public " . $ip . " " .  $oid . " 2>&1";
// 	$result = shell_exec ( $command );
// 	$result = ext ( $result );
// 	$result = removeQuotation($result);
// 	return $result;
// }

// function snmpget_1550($ip, $oid) {
// 	$command = $command = "C:\usr\bin\snmpget -Ov -v 1 -c public " . $ip . " " .  $oid . " 2>&1";
// 	$result = shell_exec ( $command );
// 	$result = ext ( $result );
// 	$result = removeQuotation($result);
// 	return $result;
// }


?>