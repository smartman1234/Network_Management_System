<?php

session_start();
$nodeid=$_SESSION['NODEID']; 


echo "All of the asset field values for the device " . $nodeid . " have been reset. Please refresh the inventory listview to check the change. ";


require "db_initialize.php";

$query = "UPDATE public.assets
SET
rack='',
dateinstalled='',
supportphone='',
comment='',
displaycategory='',

latitude=0.0,
longitude=0.0
WHERE assets.nodeid=$nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());




pg_free_result($result);
pg_close($dbconn);


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