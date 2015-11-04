<?php


// todo:  1) check if the threshold table exsits, if true, go ahead; 2) extract all value, and data treatment from alarm thres table, 3) extract all value, and data treatment from snmp table,  4) under the condition, compare the resutl, if abnormal, do an action 

function alarmCompare_1550($ip){

	require("daemon_db_init.php");

	// 1) check if the alarm thres 1550 table exist, if yes, go down the following codes	
	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemonalarmthres1550';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// only if existed, following function will perform  
	if ($exist == "daemonalarmthres1550") {

		// extract the alarm thres raw data 
		$query_at = "SELECT DISTINCT ON (ipinterface.nodeid)
		ipinterface.nodeid, 
		ipinterface.ipaddr,
		alarms.serviceid, 
		alarms.alarmid,
		alarms.alarmtype, 
		alarms.counter, 
		node.nodelabel, 
		alarms.firsteventtime, 
		alarms.lasteventtime, 
		alarms.logmsg, 
		node.nodeid,
		node.nodesysoid, 
		node.nodelabel, 
		alarms.severity
		FROM 
		public.alarms, 
		public.ipinterface, 
		public.node
		WHERE 
		alarms.nodeid = node.nodeid AND node.nodeid = ipinterface.nodeid;";
		$result = pg_query($query_at) or die('Query failed: ' . pg_last_error());




		
































	}

	pg_free_result($result_exist);
	pg_close($dbconn);

}


?>