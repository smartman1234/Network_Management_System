<?php


$dbconn = pg_connect("host=localhost dbname=vanguardhe user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());



$query = "CREATE TABLE PUBLIC.USER(
   username TEXT PRIMARY KEY     NOT NULL,
   password           TEXT    NOT NULL,
   name            TEXT  ,
   email        TEXT,
   contact         TEXT
);";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());








?>