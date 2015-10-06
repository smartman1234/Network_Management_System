<!DOCTYPE html>
<html lang="en">
<head>
  <title>Device Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<br><br>
<style>
table, td, th {
    border: 1px solid #000000;
}

th {
    background-color: #000000;
    color: white;

}

td{
  height: 40px;
  padding: 10px;
}
</style>

<?php

$nodeid = $_GET['nodeid'];
require "inventory_detail_per_nodeid.php";
?>



</body>
</html>
