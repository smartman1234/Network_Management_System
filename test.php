<?php

require("daemon_scr/daemon_db_init.php");


$query = "SELECT 
  daemonsnmpegfavalue.ip
FROM 
  public.daemonsnmpegfavalue;";



		$result = pg_query($query) or die('Query failed: ' . pg_last_error());

		$number = pg_num_rows($result);


while ($row = pg_fetch_object($result)) {
var_dump($row->ip);



}






?>