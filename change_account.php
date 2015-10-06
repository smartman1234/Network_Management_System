<?php



$new_username = "'" . $_POST["new_username"] . "'";
$new_password = "'" . $_POST["new_password"] . "'";
$new_name = "'" . $_POST["new_name"] . "'";
$new_email = "'" . $_POST["new_email"] . "'";
$new_contact = "'" . $_POST["new_contact"] . "'";




$dbconn = pg_connect("host=localhost dbname=account4rapidnms user=postgres password=admin")
or die('Could not connect: ' . pg_last_error());

$query = "UPDATE public.account_user_information
  SET username=$new_username, 
  password=$new_password, 
  name=$new_name, 
  email=$new_email, 
  contact=$new_contact;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


header('Location: account_management.html');


echo "
<script>

    alert(The change has been made and updated!);

</script>";


?>