<?php

require "db_initialize.php";

$query = "SELECT DISTINCT ON (ipinterface.nodeid)
  assets.nodeid, 
  assets.longitude,
  assets.latitude,
  ipinterface.ipaddr
FROM 
  public.assets, 
  public.ipinterface
WHERE 
  assets.nodeid = ipinterface.nodeid;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$total = pg_num_rows($result);

while ($row = pg_fetch_object($result)) {	

	$lo[] = doubleval($row->longitude);
	$la[] = doubleval($row->latitude);
	$ip[] = $row->ipaddr;


}

$j = 0;
for ($i=0; $i < $total; $i++) { 
	# code...
if ($lo[$i] > -100 && $la[$i] > -100 && $lo[$i] != 0 && $la[$i] != 0) {
  # code...
  $data[$j] = [$ip[$i], $lo[$i], $la[$i], 0.0];
  $j = $j + 1;
}
	
}


$json = json_encode($data);



pg_free_result($result);
pg_close($dbconn);


?>




