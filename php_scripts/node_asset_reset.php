<?php


$nodeid = $_GET['node_edit_id'];



session_start();
$_SESSION['NODEID'] = $nodeid;


echo "Do you confirm to reset all of the asset field values of Device ". $nodeid . "?";

echo "<form action=node_asset_reset_action.php method=post>
<input type=submit value=Yes>";






echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
    window.close();
}
</script>";


?>




