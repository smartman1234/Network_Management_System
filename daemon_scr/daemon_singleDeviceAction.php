<?php


function addDevice($ip, $comm, $mac, $sn, $lati, $long){

	$deco_ip= "'" . $ip . "'";

	if ($mac=="") {
		# code...
		$mac = "NA";
	}

	if ($sn=="") {
		# code...
		$sn = "NA";
	}

	if ($lati=="") {
		# code...
		$lati = "0.0";
	}

	if ($long=="") {
		# code...
		$long = "0.0";
	}

	$deco_mac= "'" . $mac . "'";
	$deco_sn= "'" . $sn . "'";

	$timestamp = "'" . date('YmdGis') . "'";
	$status = "'" . "online" . "'";

	if ($comm=="public") {
			# code...
		$sysDescr = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.1.0" ). "'";
		$sysObjectID = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.2.0" ). "'";
		$sysUpTime = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.3.0" ). "'";
		$sysContact = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.4.0" ). "'";
		$sysName = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.5.0" ). "'";
		$sysLocation = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.6.0"). "'";
		$sysService = "'" . snmpget_smallp ( $ip, ".1.3.6.1.2.1.1.7.0" ). "'";
	}

	if ($comm=="PUBLIC") {
			# code...
		$sysDescr = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.1.0" ). "'";
		$sysObjectID = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.2.0" ). "'";
		$sysUpTime = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.3.0" ). "'";
		$sysContact = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.4.0" ). "'";
		$sysName = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.5.0" ). "'";
		$sysLocation = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.6.0"). "'";
		$sysService = "'" . snmpget_bigP ( $ip, ".1.3.6.1.2.1.1.7.0" ). "'";
	}

	require_once("daemon_db_init.phpdaemon_db_init.php");

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
			sn TEXT,
			provision TEXT);";

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

	$method = "'" . "add" . "'";

	if ($number==0) {
		# code...
		$query_insert = "INSERT INTO PUBLIC.daemondevice (time, ip, status, description, mib, uptime, contact, name, location, service, latitude, longtitude, MAC, sn, provision) VALUES ($timestamp, $deco_ip, $status, $sysDescr, $sysObjectID, $sysUpTime, $sysContact, $sysName, $sysLocation, $sysService, $lati, $long, $deco_mac, $deco_sn, $method);";

		$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_insert);
		echo $deco_ip . " has been inserted!<br>";

	}

	if ($number==1) {

		$query_update = "UPDATE PUBLIC.daemondevice SET 
			time= $timestamp, 
			ip= $deco_ip, 
			status = $statis.
			description = $sysDescr,
			mib= $sysObjectID,
			uptime = $sysUpTime,
			contact = $sysContact,
			name = $sysName,
			location= $sysLocation,
			service = $sysService,
			latitude=$lati,
			longtitude= $long,
			MAC = $deco_mac,
			sn=$deco_sn,
			provision = $method
			WHERE daemondevice.ip=$deco_ip;";

		$result_update = pg_query($query_update) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_update);
		echo $deco_ip . " has been updated!<br>";

	}

	pg_free_result($result_exist);
	pg_free_result($result_value);
	
	pg_close($dbconn);

}


function deleteDevice($ip){
	$deco_ip= "'" . $ip . "'";

	require_once("daemon_db_init.php");

	$query = "DELETE FROM PUBLIC.daemondevice
	WHERE daemondevice.ip = $deco_ip;";

	$result = pg_query($query) or die('Query failed: ' . pg_last_error());

	pg_free_result($result);
	
	pg_close($dbconn);

}

?>