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

deleteExistedContent();


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


function deleteExistedContent(){
	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
	require_once($genericSnmpPath);  // to initialize db 

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemondiscoveryrange';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// // 3, if not existed, create it 
	if ($exist != "daemondiscoveryrange") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.daemondiscoveryrange(
			id SERIAL PRIMARY KEY,
			ipbegin           inet,
			ipend		inet);";

	$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_construct);

	}

	if ($exist == "daemondiscoveryrange") {


		$query_del = "DELETE FROM PUBLIC.daemondiscoveryrange;";
		$result_del = pg_query($query_del) or die('Query failed: ' . pg_last_error());
		pg_free_result($result_del);

	}
}


function addEntry($begin, $end){

	$genericSnmpPath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
	require_once($genericSnmpPath);  // to initialize db 

	$query_exist = "SELECT relname FROM pg_class 
	WHERE relname = 'daemondiscoveryrange';";

	$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

	$exist = '';
	while ($row_exist = pg_fetch_object($result_exist)){

		$exist = $row_exist->relname;

	}

	// // 3, if not existed, create it 
	if ($exist != "daemondiscoveryrange") {
	# code...
		$query_construct = "CREATE TABLE PUBLIC.daemondiscoveryrange(
			id SERIAL PRIMARY KEY,
			ipbegin           inet,
			ipend		inet);";

$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());
pg_free_result($result_construct);

}

$query_value = "SELECT 
daemondiscoveryrange.ipbegin, 
daemondiscoveryrange.ipend
FROM 
public.daemondiscoveryrange;";

$result_value = pg_query($query_value) or die('Query failed: ' . pg_last_error());
$ipbl=[];
$ipel=[];
while ($row = pg_fetch_object($result_value)) {	
	$ipbl[]=$row->ipbegin;
	$ipel[]=$row->ipend;

}

$isAdd = true;
for ($i=0; $i < sizeof($ipbl); $i++) { 
		# code...
	if ($ipbl[$i]==$begin && $ipel[$i]==$end) {
			# code...
		$isAdd=false;

	}
}




if ($isAdd) {
	# code...

	$begin = "'" . $begin . "'";
	$end = "'" . $end . "'";
	$query_insert = "INSERT INTO PUBLIC.daemondiscoveryrange (ipbegin, ipend) VALUES ($begin, $end);";

	$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());
	pg_free_result($result_insert);
}


}








?>


