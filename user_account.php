<?php

// get post info 

$usernamep = $_POST["username"];
$passwordp = $_POST["password"];

$username_input = "'" . $_POST["username"] . "'";
$password_input = "'" . $_POST["password"] . "'";


// connect the db 
$dbconn = pg_connect("host=localhost dbname=vanguardhe user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());

// check if user table is existed 
$query_exist = "SELECT relname FROM pg_class 
WHERE relname = 'user';";

$result_exist = pg_query($query_exist) or die('Query failed: ' . pg_last_error());

while ($row_exist = pg_fetch_object($result_exist)){

	$exist = $row_exist->relname;

}

if ($exist != "user") {
	# code...
	$query_construct = "CREATE TABLE PUBLIC.USER(
		username TEXT PRIMARY KEY     NOT NULL,
		password           TEXT    NOT NULL,
		name            TEXT  ,
		email        TEXT,
		contact         TEXT
		);";

$result_construct = pg_query($query_construct) or die('Query failed: ' . pg_last_error());

$query_insert = "INSERT INTO PUBLIC.USER(username,password) VALUES ($username_input, $password_input);";

$result_insert = pg_query($query_insert) or die('Query failed: ' . pg_last_error());

}



$query = 'SELECT 
  "user".username, 
  "user".password
FROM 
  public."user";';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){

$username = $row->username;
$password = $row->password;

}

if ($usernamep == $username && $passwordp == $password) {

	session_start();
	header('Location: main.html');
}else{
	header('Location: login_error.html');
}



?>