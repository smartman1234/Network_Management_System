<?php

require("daemon_scr/daemon_db_init.php");



$query = 'SELECT 
"user".username, 
"user".password,
"user".name, 
"user".email,
"user".contact

FROM 
public."user";';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){

	$username = $row->username;
	$password = $row->password;
	$name = $row->name;
	$email = $row->email;
	$contact = $row->contact;

}











?>