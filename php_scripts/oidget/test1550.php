
<?php

require("genericSnmp.php");

$ip = "10.100.0.50";


// session_start();
// $ip = $_GET["ip"];


$value [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.1.1" );
$value [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.2.1" );
$value [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.3.1" );
$value [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.4.1" );
$value [4] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.5.1" );
$value [5] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.6.1" );
$value [6] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.7.1" );
$value [7] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.8.1" );
$value [8] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.9.1" );
$value [9] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.10.1" );
$value [10] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.11.1" );
$value [11] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.12.1" );
$value [12] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.13.1" );
$value [13] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.14.1" );
$value [14] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.15.1" );
$value [15] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.16.1" );
$value [16] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.17.1" );
$value [17] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.18.1" );
$value [18] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.19.1" );
$value [19] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.3222.4.6.1.1.20.1" );

$lab [0] = "Status Index";
$lab [1] = "IDcode";
$lab [2] = "sub-ID";
$lab [3] = "Firmware Version";
$lab [4] = "Laser IM";
$lab [5] = "Laser Temperature";
$lab [6] = "Laser Bias";
$lab [7] = "RF Modulation Level";
$lab [8] = "DC24V Voltage";
$lab [9] = "DC12V Voltage";
$lab [10] = "DC5V Voltage";
$lab [11] = "-5VDC Voltage";
$lab [12] = "Tx Optical Power";
$lab [13] = "Gain Control Setting";
$lab [14] = "SBS CONTROL Setting";
$lab [15] = "CTB_CONTROL_Setting";
$lab [16] = "Tx RF Module Level";
$lab [17] = "Present AC Power 1 status";
$lab [18] = "Present AC Power 2 status";
$lab [19] = "Tx AC Power supply status";

$defaultIp = snmpget_smallp ( $ip, ".1.3.6.1.4.1.33826.3.1.1.0" );
$defaultMac = snmpget_smallp ( $ip, ".1.3.6.1.4.1.33826.3.1.5.0" );



/////////////////////////////////////////////// for asset values 
$sysDescr = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" );
$sysObjectID = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" );
$sysUpTime = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" );
$sysContact = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" );
$sysName = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" );
$sysLocation = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0" );
$sysService = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" );


// for testing purpose
echo "EG 1550 Transmitter <br>";
echo "------------------------------------------------<br>";
echo "IP address : " . $defaultIp . "<br>";
echo "MAC : " . $defaultMac. "<br>";
for($i = 0; $i < 20; $i ++) {
	echo $lab [$i] . " : " . $value [$i]. "<br>";
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