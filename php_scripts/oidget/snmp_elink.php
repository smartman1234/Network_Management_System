<?php



function get_elink($ip){
	require("genericSnmp.php");
	$device [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.1" );
	$device [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.4" );
	$device [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.6" );
	$device [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.8" );
	$device [4] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.11" );
	$device [5] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.14" );
	$device [6] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.3.16" );

	$sn [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.1" );
	$sn [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.4" );
	$sn [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.6" );
	$sn [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.8" );
	$sn [4] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.11" );
	$sn [5] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.14" );
	$sn [6] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.4.16" );

	$temp [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.1.0" );
	$temp [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.4.0" );
	$temp [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.6.0" );
	$temp [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.8.0" );
	$temp [4] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.11.0" );
	$temp [5] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.14.0" );
	$temp [6] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.16.0" );

$value [0] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.5.0" ); // need to change the oids
$value [1] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.8.0" );
$value [2] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.9.0" );
$value [3] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.10.0" );
$value [4] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.12.0" );
$value [5] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.13.0" );
$value [6] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.17.0" );

$ipadd = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.3.1.9.0" );
$lab [0] = "Vendor";
$lab [1] = "Alarm Detection";
$lab [2] = "IP";
$lab [3] = "Check Code";
$lab [4] = "Tamper Status";
$lab [5] = "Internal Temperature";
$lab [6] = "Craft Status";

$value [7] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.8.1" );
$value [8] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.8.2" );
$lab [7] = "RF Input Power 1";
$lab [8] = "RF Input Power 2";

$value [9] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.8.0" );
$value [10] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.11.0" );
$lab [9] = "Automatic Gain Control Mode 1";
$lab [10] = "Automatic Gain Control Mode 2";

$value [11] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.8.0" );
$value [12] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.11.0" );
$lab [11] = "Transmitter Laser Temperature 1";
$lab [12] = "Transmitter Laser Temperature 2";

$value [13] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.8.0" );
$value [14] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.11.0" );
$lab [13] = "Transmitter Laser Bias Current 1";
$lab [14] = "Transmitter Laser Bias Current 2";

$value [15] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.8.0" );
$value [16] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.11.0" );
$lab [15] = "Laser Output Power 1";
$lab [16] = "Laser Output Power 2";

$value [17] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.8.0" );
$value [18] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.11.0" );
$lab [17] = "Laser Thermo Electric Cooler Current 1";
$lab [18] = "Laser Thermo Electric Cooler Current 2";

$value [19] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.8.0" );
$value [20] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.11.0" );
$lab [19] = "Laser Type 1";
$lab [20] = "Laser Type 2";

$value [21] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.8.0" );
$value [22] = snmpget_smallp ( $ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.11.0" );
$lab [21] = "Laser Wavelength 1";
$lab [22] = "Laser Wavelength 2";






/////////////////////////////////////////////// for asset values 
$sysDescr = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" );
$sysObjectID = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" );
$sysUpTime = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" );
$sysContact = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" );
$sysName = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" );
$sysLocation = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0" );
$sysService = snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" );




// for testing purpose
echo "ELink Optical Headend Platform <br>
";


	echo "
	<style>


table {
    width:100%;
}

table, th , td {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 5px;
}

th {
    text-align: left; 
}

table tr:nth-child(odd) {
    background-color: #f1f1f1;
}
table tr:nth-child(even) {
    background-color: #ffffff;
}









	</style>
	";

echo "<table style=width:50%>";
echo "<tr>";
echo "<td>Description</td>";
echo "<td>" . $sysDescr ."</td>";
echo "</tr><tr>";
echo "<td>ObjectID</td>";
echo "<td>" . $sysObjectID ."</td>";
echo "</tr><tr>";
echo "<td>IP</td>";
echo "<td>" . $ipadd ."</td>";
echo "</tr><tr>";

echo "<td>Up Time</td>";
echo "<td>" . $sysUpTime ."</td>";
echo "</tr><tr>";
echo "<td>Contact</td>";
echo "<td>" . $sysContact ."</td>";
echo "</tr><tr>";
echo "<td>Name</td>";
echo "<td>" . $sysName ."</td>";
echo "</tr><tr>";
echo "<td>Location</td>";
echo "<td>" . $sysLocation ."</td>";
echo "</tr><tr>";
echo "<td>Service</td>";
echo "<td>" . $sysService ."</td>";
echo "</tr>";





for($i = 0; $i
	< 7; $i ++) {

	echo "<tr>";
echo "<td>" . $device [$i] .  " (" . $sn [$i] .  " ) "  ."</td>";

echo "<td>" . $temp [$i] ."</td>";
echo "</tr>";

}




for($i = 0; $i
	< 23; $i ++) {

	echo "<tr>";
echo "<td>" . $lab [$i] ."</td>";
echo "<td>" . $value [$i] ."</td>";
echo "</tr>";


}



echo "</table>";










}


















?>