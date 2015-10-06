<?php

$ipadress = $_POST["ipadress"];
$label = $_POST["label"];
$macaddress = $_POST["macaddress"];


echo $ipadress . " has been added for further provisioning. It will be shown in discovered inventory once the successful provisioning.";



echo "<br>";
echo "<br>";


echo "<button onclick=closeWin()>Close</button>";
echo
"<script>
function closeWin() {
    window.close();
}
</script>";

?>




