<?php

require("daemon_db_init.php");
require("daemon_discovery.php");

$query = "SELECT 
	daemondiscoveryrange.ipbegin, 
	daemondiscoveryrange.ipend
	FROM 
	public.daemondiscoveryrange;";

$ipbegin=[];
$ipend=[];

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){

	$ipbegin[]=$row->ipbegin;
	$ipend[]=$row->ipend;


}

for ($i=0; $i < sizeof($ipbegin); $i++) { 
	# cod..
	if ($ipbegin[$i]!="" && $ipend[$i]!=""  ) {
		# code...
		echo $ipbegin[$i] . " : " . $ipend[$i] ; 
		//autoDiscovery($ipbegin[$i], $ipend[$i]);
	}


	
}

echo "<br>";

echo "<br>";
echo "The discovery has been done!";
echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
	window.close();
}
</script>";
















pg_free_result($result);
pg_close($dbconn);

?>