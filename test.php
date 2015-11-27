<?php


	// $sysDescr = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" );
	// $sysObjectID = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" );
	// $sysUpTime = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" );
	// $sysContact = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" );
	// $sysName = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" );
	// $sysLocation = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0" );
	// $sysService = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" );


$ip= "69.70.200.246";
//echo snmpget($ip, "public", ".1.3.6.1.2.1.1.1.0");

$ip1= "69.70.200.232";
//echo snmpget($ip1, "PUBLIC", ".1.3.6.1.2.1.1.1.0");

$ip2= "69.70.200.249";
echo snmpget($ip2, "public", ".1.3.6.1.2.1.1.1.0");
echo snmpget($ip2, "public", ".1.3.6.1.2.1.1.2.0");
echo snmpget($ip2, "public", ".1.3.6.1.2.1.1.3.0");
?>