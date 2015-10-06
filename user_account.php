<?php

$username_input = $_POST["username"];
$password_input = $_POST["password"];

$dbconn = pg_connect("host=localhost dbname=account4rapidnms user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());

$query = "SELECT 
  account_user_information.username, 
  account_user_information.password, 
  account_user_information.name, 
  account_user_information.email, 
  account_user_information.contact
FROM 
  public.account_user_information;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_object($result)){

$username = $row->username;
$password = $row->password;
$name = $row->name;
$email = $row->email;
$contact = $row->contact;


}



if ($username_input == $username && $password_input == $password) {


	session_start();
	header('Location: main.html');
}else{
	header('Location: login_error.html');
}



?>