<?php

$path = "'" . getcwd()."\DataFolder\data_alarm.csv" . "'";

$dbpath = $_SERVER["DOCUMENT_ROOT"] . "/vanguardhe/daemon_scr/daemon_db_init.php";
require($dbpath);  // to initialize snmp 

$query = "
  COPY(
  SELECT 
  daemonalarm.alarmid, 
  daemonalarm.time, 
  daemonalarm.deviceid, 
  daemonalarm.description, 
  daemonalarm.mac, 
  daemonalarm.severity, 
  daemonalarm.logs,
  daemonalarm.ip, 
  daemonalarm.ack
  FROM 
  public.daemonalarm) 
  TO $path With CSV HEADER;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

if(file_exists("DataFolder\data_alarm.csv")){

  $myfile = fopen("DataFolder\data_alarm.csv", "a+") or die("Unable to open file!");
  fwrite($myfile, "System time: ". date('Y-m-d H:i:s')."\n");
  fwrite($myfile, "These data are generated by Electroline Vanguard-HE NMS Portal"."\n");
  fwrite($myfile, "2015 Electroline Equipment Inc. All rights reserved."."\n");
  fclose($myfile);
  file_downloading();


}




function file_downloading($file="DataFolder\data_alarm.csv"){
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