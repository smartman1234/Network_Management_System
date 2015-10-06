<?php


function quotation($text){
 return "'" . $text . "'";
}


function addzero($value){
  if ($value <= -1000) {
  return 0;
}else{
  return $value;
}
}
$nodeid = addzero($_POST["nodeid"]);
$rack =  quotation($_POST["rack"]);
$dateinstalled = quotation($_POST["dateinstalled"]);
$supportphone = quotation($_POST["supportphone"]);
$comment = quotation($_POST["comment"]);
$lastmodifieddate = quotation($_POST["lastmodifieddate"]);
$displaycategory = quotation($_POST["displaycategory"]);
$latitude = addzero($_POST["latitude"]);
$longitude = addzero($_POST["longitude"]);


session_start();


require "db_initialize.php";

$query = "UPDATE public.assets
SET
rack=$rack,
dateinstalled=$dateinstalled,
supportphone=$supportphone,
comment=$comment,
lastmodifieddate=$lastmodifieddate,
displaycategory=$displaycategory,
latitude=$latitude,
longitude=$longitude
WHERE assets.nodeid=$nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());




pg_free_result($result);
pg_close($dbconn);

echo "Successfully updated!";
echo "<br>
";
echo "
<br>
";
echo "
<button onclick=closeWin()>Close</button>
";
echo
"
<script>
function closeWin() {
    window.close();
}
</script>
";



pg_free_result($result);
pg_close($dbconn);


?>