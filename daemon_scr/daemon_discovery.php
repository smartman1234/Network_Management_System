<?php


// unit test --- begin
// $ip[] = "69.70.200.246";   //50
// $ip[] = "69.70.200.249";   // 80
// $ip[] = "69.70.200.250";
// $ip[] = "69.70.200.232";   // 102
// $ip[] = "69.70.200.230";   // 70



// autoDiscovery("69.70.200.230", "69.70.200.250");
 // writeToDatabase("69.70.200.246", "public");
 // writeToDatabase("69.70.200.249", "public");
 // writeToDatabase("69.70.200.232", "PUBLIC");
 // writeToDatabase("69.70.200.235", "public");
/// unit test --- end 


function autoDiscovery($lower, $upper){
	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/php_scripts/oidget/genericSnmp.php";
	require_once($genericSnmpPath);  // to initialize snmp 
    // to do: 1) get all of ip into a list
    // 2) iterator over the ip list, and check the pingable.
    //3) in the pingable list, use public/PUBLIC, if has something, restore to the datasa

   	$reachableIpList = getAllOnlineDevice(getAllIp($lower, $upper));
    //$reachableIpList = getAllIp($lower, $upper);

    for ($i=0; $i < sizeof($reachableIpList); $i++) { 

    	# code...
    	$o = snmpget_smallp($reachableIpList[$i], ".1.3.6.1.2.1.1.2.0");   // oid 
    	$comm = "public";
    	if (substr($o, 0, 2)=="No") {
    		# code...
    		$o = snmpget_bigP($reachableIpList[$i], ".1.3.6.1.2.1.1.2.0");   // oid 
    		$comm = "PUBLIC";
    	}

    	if (substr($o, 0, 2)!="No") {
    		# code...
    		writeToDatabase($reachableIpList[$i], $comm);
    		echo $reachableIpList[$i]. " : " . $comm . " has been added into the database.<br>";


    	}

    }
}

// get ip list 
function getAllIp($l, $u)
{
    $lp = strripos($l, ".") + 1;
    $up = strripos($u, ".") + 1;
    $lnum = intval(substr($l, $lp));
    $unum = intval(substr($u, $up));
    $lrem = substr($l, 0, $lp);

    for ($i = $lnum; $i <= $unum; $i++) {
        # code...
        $ipPool[] = $lrem . strval($i);
    }

    return $ipPool;

}

// get all ip list 
function getAllOnlineDevice($ipPool){
	$ipOnline = array();

    for ($i = 0; $i < sizeof($ipPool); $i++) {
        # code...
        if (ifPingable($ipPool[$i]) != false) {
            $ipOnline[] = $ipPool[$i];
            # code...
        }
    }
    return $ipOnline;
}

// the helper function that double chekcs the device is really reachable 
function ifPingable($host, $timeout = 1)
{
    /* ICMP ping packet with a pre-calculated checksum */
    $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
    $socket = socket_create(AF_INET, SOCK_RAW, 1);
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

function writeToDatabase($ip, $s){
	$deco_ip= "'" . $ip . "'";

	$timestamp = "'" . date('YmdGis') . "'";
	$status = "'" . "online" . "'";
	if ($s=="public") {
			# code...
		$sysDescr = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" ). "'";
		$sysObjectID = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" ). "'";
		$sysUpTime = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" ). "'";
		$sysContact = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" ). "'";
		$sysName = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" ). "'";
		$sysLocation = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0"). "'";
		$sysService = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" ). "'";
	}

	if ($s=="PUBLIC") {
			# code...
		$sysDescr = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.1.0" ). "'";
		$sysObjectID = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.2.0" ). "'";
		$sysUpTime = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.3.0" ). "'";
		$sysContact = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.4.0" ). "'";
		$sysName = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.5.0" ). "'";
		$sysLocation = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.6.0"). "'";
		$sysService = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.7.0" ). "'";
	}

	require("daemon_db_init.php");

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemondevice';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// // 3, if not existed, create it 
	if ($exist != "daemondevice") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.daemondevice(
			id SERIAL PRIMARY KEY,
			time           TEXT    ,
			ip		inet,
			status   		TEXT,
			description            TEXT  ,
			mib    TEXT,
			uptime       TEXT,
			contact       TEXT,
			name         TEXT,
			location		TEXT,
			service   TEXT,
			latitude NUMERIC,
			longtitude NUMERIC,
			MAC macaddr,
			sn TEXT);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);

	}

	$query_value = "SELECT 
	  daemondevice.ip
	FROM 
	  public.daemondevice
	WHERE 
	  daemondevice.ip = $deco_ip;";

	$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());

	$number = pg_num_rows($result_value);    // the number of total device eg1550

	if ($number==0) {
		# code...
		$query_insert = "INSERT INTO PUBLIC.daemondevice (time, ip, status, description, mib, uptime, contact, name, location, service) VALUES ($timestamp, $deco_ip, $status, $sysDescr, $sysObjectID, $sysUpTime, $sysContact, $sysName, $sysLocation, $sysService);";

		$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_insert);

	}

	pg_free_result($result_exist);
	pg_free_result($result_value);
	
	pg_close($dbconn);

}
?>