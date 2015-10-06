<?php

require "db_initialize.php";
require "service_id.php";
require 'severity_vis.php';
require "alarm_type.php";
require "device_category_from_OID.php";
require "notice_type.php";
require "assigned_profile_according_to_nodelablesource.php";




echo "<a href=node_asset_reset.php?node_edit_id=$nodeid><b><img src=images/reset-button-png-hi.png width=70 height=35></b></a>";
echo "<a href=node_delete.php?node_edit_id=$nodeid><b><img src=images/delete-button-png-hi.png width=70 height=35></b></a><br>";
echo "<br>";



$query = "SELECT 
node.nodeid, 
node.nodecreatetime, 
node.nodesysoid, 
node.nodesysdescription, 
node.nodesyslocation, 
node.nodesyscontact, 
assets.rack, 
assets.address1, 
assets.dateinstalled, 
assets.supportphone, 
assets.comment, 
assets.lastmodifieddate, 
assets.displaycategory, 
assets.longitude, 
assets.latitude
FROM 
public.assets, 
public.node
WHERE 
assets.nodeid = node.nodeid AND assets.nodeid = $nodeid;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());


echo "<table width=40%>\n";
echo "\t<tr>\n";
echo "<td align=left><b>Asset Field</b></td>";
echo "<td align=left><b>Value</b></td>";
echo "\t</tr>\n";



while ($row = pg_fetch_object($result)) {	

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Device ID:</b></td>";
  echo "\t\t<td align=left>$row->nodeid</td>";
  echo "\t<tr>\n";   

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Discovered Time:  </b></td>";
  echo "\t\t<td align=left>$row->nodecreatetime</td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>OID:   </b></td>";
  echo "\t\t<td align=left>$row->nodesysoid</td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";    
  echo "\t\t<td align=left><b>Description:  </b></td>";
  echo "\t\t<td align=left>$row->nodesysdescription</td>"; 
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>System Location:   </b></td>";
  echo "\t\t<td align=left>$row->nodesyslocation</td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>System Contact:   </b></td>";
  echo "\t\t<td align=left>$row->nodesyscontact</td>";
  echo "\t<tr>\n"; 


  echo "<form action=edit_asset_value_action.php method=post>";

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Rack:   </b></td>";
  echo "\t\t<td align=left><input type=text name=rack value=$row->rack ></td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Date Installed:   </b></td>";
  echo "\t\t<td align=left><input type=text name=dateinstalled value=$row->dateinstalled ></td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";    
  echo "\t\t<td align=left><b>Support Phone:  </b></td>";
  echo "\t\t<td align=left><input type=text name=supportphone value=$row->supportphone ></td>";
  echo "\t<tr>\n"; 



  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Comment:   </b></td>";
  echo "\t\t<td align=left><input type=text name=comment  value=$row->comment ></td>";
  echo "\t<tr>\n"; 



  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Last Modified Date:   </b></td>";
  echo "\t\t<td align=left><input type=text name=lastmodifieddate value=$row->lastmodifieddate > </td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Category:   </b></td>";
  echo "\t\t<td align=left><input type=text name=displaycategory value=$row->displaycategory > </td>";
  echo "\t<tr>\n"; 

  
  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Latitude:   </b></td>";
  echo "\t\t<td align=left><input type=number step=0.01 name=latitude value=$row->latitude ></td>";
  echo "\t<tr>\n"; 

  echo "\t<tr>\n";  
  echo "\t\t<td align=left><b>Longitude:   </b></td>";
  echo "\t\t<td align=left><input type=number step=0.01 name=longitude value=$row->longitude></td>";
  echo "\t<tr>\n"; 








  echo "\t</tr>\n";
}



echo "</table>\n";




echo "<br>";

echo "<input type=submit value=submit>";
echo "</form>";

echo "                                 ";
echo "<button onclick=closeWin()>Cancel</button>";
echo
"<script>
function closeWin() {
  window.close();
}
</script>";
echo "<br>";echo "<br>";echo "<br>";


pg_free_result($result);
pg_close($dbconn);

?>



