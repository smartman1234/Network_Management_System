
<?php

require("genericSnmp.php");

$ip = "10.100.0.102";
// session_start();
// $ip = $_GET["ip"];





$mac = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.2.1.1.1.0" );
$ipadd = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.9.0" );

$value [0] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.2.0" );
$value [1] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.3.0" );
$value [2] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.1" );
$value [3] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.2" );
$value [4] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.4.1.4.3" );
$value [5] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.5.0" );
$value [6] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.6.0" );
$value [7] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.1" );
$value [8] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.2" );
$value [9] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.3" );
$value [10] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.4" );
$value [11] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.5" );
$value [12] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.6" );
$value [13] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.7" );
$value [14] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.11.7.1.2.8" );
$value [15] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.18.1" );
$value [16] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.3.2.2.1.19.1" );
$value [17] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.3.0" );
$value [18] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.4.0" );
$value [19] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.5.0" );
$value [20] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.10.0" );
$value [21] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.12.0" );
$value [22] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.13.0" );
$value [23] = snmpget_bigP ( $ip, ".1.3.6.1.4.1.17409.1.3.1.17.0" );


$lab [0] = "Output Optical Power";
$lab [1] = "Input Optical Power";
$lab [2] = "Pump Temperature 1";
$lab [3] = "Pump Temperature 2";
$lab [4] = "Pump Temperature 3";
$lab [5] = "Number of DC Power Supply";
$lab [6] = "DC Power Supply Mode";
$lab [7] = "DC +5V";
$lab [8] = "DC -5V";
$lab [9] = "DC +3.3V";
$lab [10] = "DC +12V";
$lab [11] = "Left +5V";
$lab [12] = "Right +5V";
$lab [13] = "Left -5V";
$lab [14] = "Right -5V";
$lab [15] = "Device Manufactoring Date";
$lab [16] = "Firmware Version";
$lab [17] = "Model";
$lab [18] = "Serial Number";
$lab [19] = "Vendor";
$lab [20] = "Check Code";
$lab [21] = "Tamper Status";
$lab [22] = "Internal Temperature";
$lab [23] = "Craft Status";






/////////////////////////////////////////////// for asset values 
$sysDescr = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.1.0" );
$sysObjectID = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.2.0" );
$sysUpTime = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.3.0" );
$sysContact = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.4.0" );
$sysName = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.5.0" );
$sysLocation = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.6.0" );
$sysService = snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.7.0" );















// for testing purpose
echo "EGFA Optical Amplifier <br>";
echo "------------------------------------------------<br>";
echo "IP Address: " . $ipadd . "<br>";
echo "MAC: " . $mac  . "<br>";
for($i = 0; $i < 24; $i ++) {
	echo $lab [$i] . " : " . $value [$i] . "<br>";
}


echo "------------------------------------------------<br>";
echo $sysDescr . "<br>";
echo $sysObjectID . "<br>";
echo $sysUpTime . "<br>";
echo $sysContact . "<br>";
echo $sysName . "<br>";
echo $sysLocation . "<br>";
echo $sysService . "<br>";











?>