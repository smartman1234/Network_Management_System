<?php



require "db_initialize.php";

$query = "
COPY(
  SELECT DISTINCT ON (ipinterface.nodeid)
ipinterface.nodeid, 
ipinterface.ipaddr,
assets.nodeid, 
assets.serialnumber, 
assets.description,
node.nodecreatetime, 
node.nodesysoid, 
node.nodelabel, 
node.nodeid,
node.nodelabelsource, 
node.lastcapsdpoll
FROM 
public.assets, 
public.ipinterface, 
public.node
WHERE 
assets.nodeid = node.nodeid AND assets.nodeid = ipinterface.nodeid
ORDER BY
ipinterface.nodeid ASC) 
TO 'C:/rapidnms/data_inv.csv' With CSV HEADER;
";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

if(file_exists("C:/rapidnms/data_inv.csv")){
  
  $myfile = fopen("C:/rapidnms/data_inv.csv", "a+") or die("Unable to open file!");
  fwrite($myfile, "System time: ". date('Y-m-d H:i:s')."\n");
  fwrite($myfile, "These data are generated by Electroline Rapid NMS Portal"."\n");
  fwrite($myfile, "2015 Electroline Equipment Inc. All rights reserved."."\n");
  fclose($myfile);
  file_downloading();


}




function file_downloading($file="C:/rapidnms/data_inv.csv"){
  if(file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
  }
}



?>