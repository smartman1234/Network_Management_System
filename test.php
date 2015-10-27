
<?php

$ip = "10.100.0.50";
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


// $value [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.18.1" );
// $value [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.19.1" );
// $value [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.20.1" );

// $value [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.21.1" );

// echo $value [0] . "<br>";
// echo $value [1] . "<br>";
// echo $value [2] . "<br>";



//$test = $value [3];

// $a = "aabbcc";
// $b = substr($a, 0,3);
// var_dump($b);

// // if ($test[0:11]=="(noSuchName)") {
// // 	# code...
// // 	echo "no";
// // }


// $t = substr(0, 11, $test);

// echo $t;



?>