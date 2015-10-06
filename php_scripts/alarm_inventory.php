<?php


function alarm_severity_for_inventory($id){
	require "nodeidInAlarmToArray.php";
	if (!in_array($id, $nodeid_alarm)) {
		return "No alarm";
	}else{

		require "db_initialize.php";
		$query = "SELECT 
		alarms.severity
		FROM 
		public.alarms
		WHERE
		alarms.nodeid = $id;";

		$result = pg_query($query) or die('Query failed: ' . pg_last_error());

		while ($row = pg_fetch_object($result)) {	

			return $row->severity; 
		}

	}


}



?>