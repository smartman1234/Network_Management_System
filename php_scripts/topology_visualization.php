<style type="text/css">
    .tree li {
        margin: 0px 0;
        
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0px 5px;
    }

    .tree li::before{
        content: '';
        position: absolute; 
        top: 0;
        width: 1px; 
        height: 100%;
        right: auto; 
        left: -20px;
        border-left: 1px solid #ccc;
        bottom: 50px;
    }
    .tree li::after{
        content: '';
        position: absolute; 
        top: 30px; 
        width: 25px; 
        height: 20px;
        right: auto; 
        left: -20px;
        border-top: 1px solid #ccc;
    }
    .tree li a{
        display: inline-block;
        border: 1px solid #ccc;
        padding: 5px 10px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }

    /*Remove connectors before root*/
    .tree > ul > li::before, .tree > ul > li::after{
        border: 0;
    }
    /*Remove connectors after last child*/
    .tree li:last-child::before{ 
      height: 30px;
  }

  /*Time for some hover effects*/
  /*We will apply the hover effect the the lineage of the element also*/
  .tree li a:hover, .tree li a:hover+ul li a {
    background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
    border-color:  #94a0b4;
}


</style>


<div class="tree">
    <ul>
        <li>
            <a href="#">SNMP Master: </a>
            <ul>
                <li>
                    <a href="#">10.8.0.30</a>                   
                </li>
                <li>
                    <a href="#">10.8.0.58</a>
                </li>
                <li>
                    <a href="#">10.0.8.73</a>
                </li>
                <li>
                    <a href="#">10.0.8.74</a>
                </li>
                <li>
                    <a href="#">10.0.8.75</a>
                </li>
                <li>
                    <a href="#">10.0.8.76</a>
                </li>
                <li>
                    <a href="#">10.0.8.77</a>
                </li>
                <li>
                    <a href="#">10.0.8.82</a>
                </li>
                <li>
                    <a href="#">10.0.8.153</a>
                </li>
                <li>
                    <a href="#">10.0.8.154</a>
                </li>
                <li>
                    <a href="#">10.0.8.155</a>
                </li>
                <li>
                    <a href="#">10.0.8.156</a>
                </li>
                <li>
                    <a href="#">10.0.8.157</a>
                </li>
                <li>
                    <a href="#">10.0.8.158</a>
                </li>
                <li>
                    <a href="#">10.0.8.200</a>
                </li>
            </ul>
        </li>
    </ul>
</div>



<?php
//the method by CRUD
require "db_initialize.php";

$query = "SELECT 
  notifications.respondtime, 
  notifications.answeredby, 
  notifications.nodeid, 
  notifications.notifconfigname, 
  node.nodesysoid, 
  node.nodelabel
FROM 
  public.notifications, 
  public.node
WHERE 
  notifications.nodeid = node.nodeid AND
  notifications.respondtime IS NOT NULL AND
  notifications.answeredby != 'auto-acknowledged'  
ORDER BY
  notifications.respondtime DESC;";

$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$arr = pg_fetch_all($result);
$ack_number = count($arr);


pg_free_result($result);
pg_close($dbconn);
?>




