<?php

//$path = 'C:\Program Files\OpenNMS\etc\discovery-configuration.xml';


$ipbegin[0] = $_POST["ipbegin1"];
$ipend[0] = $_POST["ipend1"];
$retries[0] = $_POST["retries1"];
$timeout[0] = $_POST["timeout1"];

$ipbegin[1] = $_POST["ipbegin2"];
$ipend[1] = $_POST["ipend2"];
$retries[1] = $_POST["retries2"];
$timeout[1] = $_POST["timeout2"];

$ipbegin[2] = $_POST["ipbegin3"];
$ipend[2] = $_POST["ipend3"];
$retries[2] = $_POST["retries3"];
$timeout[2] = $_POST["timeout3"];


for ($i=0; $i < 3; $i++) { 
	# code...
	if ($ipbegin[$i] != "" && $ipend[$i] != "") {
		# code...
		echo "The IP range from " . $ipbegin[$i] , " to " . $ipend[$i]. " has been supplemented into XML configuration file.";
		echo "<br>";
		addEntry($ipbegin[$i], $ipend[$i]);
	}

	
}

echo "<br>";

echo "<br>";
echo "System needs to take a while for synchorizaiton.";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";


function addEntry($file, $begin, $end){

	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
	require_once($genericSnmpPath);  // to initialize db 
	
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
			service   TEXT);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);

	}
	




}








?>


