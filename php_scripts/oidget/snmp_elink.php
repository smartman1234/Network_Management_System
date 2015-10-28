<?php

function get_elink($ip)
{
    require("genericSnmp.php");
    // for summary table 
    $device[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.1");
    $device[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.4");
    $device[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.6");
    $device[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.8");
    $device[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.11");
    $device[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.14");
    $device[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.3.16");
    
    $sn[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.1");
    $sn[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.4");
    $sn[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.6");
    $sn[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.8");
    $sn[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.11");
    $sn[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.14");
    $sn[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.4.16");
    
    $temp[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.1.0");
    $temp[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.4.0");
    $temp[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.6.0");
    $temp[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.8.0");
    $temp[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.11.0");
    $temp[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.14.0");
    $temp[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.1.1.1.1.1.1.2.16.0");


    $temp[0] = rtrim($temp[0], "0");
    $temp[1] = rtrim($temp[1], "0");
    $temp[2] = rtrim($temp[2], "0");
    $temp[3] = rtrim($temp[3], "0");
    $temp[4] = rtrim($temp[4], "0");
    $temp[5] = rtrim($temp[5], "0");
    $temp[6] = rtrim($temp[6], "0");
    
    $sysDescr    = snmpget_smallp($ip, ".1.3.6.1.2.1.1.1.0");
    $sysObjectID = snmpget_smallp($ip, ".1.3.6.1.2.1.1.2.0");
    $sysUpTime   = snmpget_smallp($ip, ".1.3.6.1.2.1.1.3.0");
    $sysContact  = snmpget_smallp($ip, ".1.3.6.1.2.1.1.4.0");
    $sysName     = snmpget_smallp($ip, ".1.3.6.1.2.1.1.5.0");
    $sysLocation = snmpget_smallp($ip, ".1.3.6.1.2.1.1.6.0");
    $sysService  = snmpget_smallp($ip, ".1.3.6.1.2.1.1.7.0");
    $alarm       = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.2.4.0");
    $ipadd       = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0");
    // -------------------------------------------------------------------------------------------
    
    // for power supply status
    $ps[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.1.1.3.16.0");
    $ps[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.2.16.0");
    $ps[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.3.16.0");
    $ps[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.2.2.1.1.2.1.4.16.0");
    
    $psl[0] = "Input (V)";
    $psl[1] = "Output Voltage (V)";
    $psl[2] = "Output Current (mA)";
    $psl[3] = "Output Power (W)";
    
    // for NMS status 
    $nms[0] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.5.0");
    $nms[1] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.8.0");
    $nms[2] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.9.0");
    $nms[3] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.10.0");
    $nms[4] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.12.0");
    $nms[5] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.13.0");
    $nms[6] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.3.1.17.0");
    
    $nmsl[0] = "Vendor";
    $nmsl[1] = "Alarm Detection";
    $nmsl[2] = "IP";
    $nmsl[3] = "Check Code";
    $nmsl[4] = "Tamper Status";
    $nmsl[5] = "Internal Temperature";
    $nmsl[6] = "Craft Status";
    
    // for receiver status
    // input 
    $ri[0]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.4.1");
    $ri[1]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.4.2");
    $ri[2]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.4.3");
    $ri[3]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.4.4");
    $ri[4]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.6.1");
    $ri[5]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.6.2");
    $ri[6]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.6.3");
    $ri[7]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.6.4");
    $ri[8]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.14.1");
    $ri[9]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.14.2");
    $ri[10] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.14.3");
    $ri[11] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.2.14.4");
    
    // status 
    $rs[0]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.4.1");
    $rs[1]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.4.2");
    $rs[2]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.4.3");
    $rs[3]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.4.4");
    $rs[4]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.6.1");
    $rs[5]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.6.2");
    $rs[6]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.6.3");
    $rs[7]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.6.4");
    $rs[8]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.14.1");
    $rs[9]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.14.2");
    $rs[10] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.14.3");
    $rs[11] = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.2.1.1.1.1.4.14.4");
    
    // for transmiter status 
    $t[0]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.8.1");
    $t[1]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.2.11.1");
    $tl[0] = "RF Input Power 1 (dBm)";
    $tl[1] = "RF Input Power 2 (dBm)";
    
    $t[2]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.8.0");
    $t[3]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.2.1.4.11.0");
    $tl[2] = "Automatic Gain Control Mode 1";
    $tl[3] = "Automatic Gain Control Mode 2";
    
    $t[4]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.8.0");
    $t[5]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.2.11.0");
    $tl[4] = "Transmitter Laser Temperature 1 (C)";
    $tl[5] = "Transmitter Laser Temperature 2 (C)";
    
    $t[6]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.8.0");
    $t[7]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.3.11.0");
    $tl[6] = "Transmitter Laser Bias Current 1 (mA)";
    $tl[7] = "Transmitter Laser Bias Current 2 (mA)";
    
    $t[8]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.8.0");
    $t[9]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.4.11.0");
    $tl[8] = "Laser Output Power 1 (mW)";
    $tl[9] = "Laser Output Power 2 (mW)";
    
    $t[10]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.8.0");
    $t[11]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.5.11.0");
    $tl[10] = "Laser Thermo Electric Cooler Current 1 (mA)";
    $tl[11] = "Laser Thermo Electric Cooler Current 2 (mA)";
    
    $t[12]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.8.0");
    $t[13]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.6.11.0");
    $tl[12] = "Laser Type 1";
    $tl[13] = "Laser Type 2";
    
    $t[14]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.8.0");
    $t[15]  = snmpget_smallp($ip, ".1.3.6.1.4.1.5591.1.11.1.1.1.1.3.1.7.11.0");
    $tl[14] = "Laser Wavelength 1 (nm)";
    $tl[15] = "Laser Wavelength 2 (nm)";
    
    
    
    
    // output as a table 
    echo "<style>
	table {
		width:100%;
	}
	table, th , td {
		border: 1px solid grey;
		border-collapse: collapse;
		padding: 5px;
	}
	th {
		text-align: left; 
	}
	table tr:nth-child(odd) {
		background-color: #f1f1f1;
	}
	table tr:nth-child(even) {
		background-color: #ffffff;
	}</style>";
    
    // --------------------------------------
    echo "ELink Optical Headend Platform Summary<br>";
    echo "<table style=width:50%>";
    echo "<tr>";
    echo "<td>System</td>";
    echo "<td>" . $sysDescr . "</td>";
    echo "</tr><tr>";
    echo "<td>IP</td>";
    echo "<td>" . $ipadd . "</td>";
    echo "</tr><tr>";
    echo "<td>Up Time</td>";
    echo "<td>" . $sysUpTime . "</td>";
    echo "</tr><tr>";
    echo "<td>Contact</td>";
    echo "<td>" . $sysContact . "</td>";
    echo "</tr><tr>";
    echo "<td>Name</td>";
    echo "<td>" . $sysName . "</td>";
    echo "</tr><tr>";
    echo "<td>Location</td>";
    echo "<td>" . $sysLocation . "</td>";
    echo "</tr><tr>";
    echo "<td>Service</td>";
    echo "<td>" . $sysService . "</td>";
    echo "</tr>";
    echo "<td>Current Alarm</td>";
    echo "<td>" . $alarm . "</td>";
    echo "</tr>";
    
    for ($i = 0; $i < 7; $i++) {
        echo "<tr>";
        echo "<td>" . $device[$i] . "</td>";
        echo "<td>" . "Serial Number: " . $sn[$i] . "</td>";
        echo "</tr>";
    }
    // (Temperature: " . $temp[$i] . " C)"
    echo "</table>";
    echo "<br>";
    
    //----------------------------------------
    echo "Power Supply Status<br>";
    echo "<table style=width:50%>";
    for ($i = 0; $i < 4; $i++) {
        echo "<tr>";
        echo "<td>" . $psl[$i] . "</td>";
        echo "<td>" . $ps[$i] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    
    //------------------------------------
    echo "Network Management Status<br>";
    echo "<table style=width:50%>";
    for ($i = 0; $i < 7; $i++) {
        echo "<tr>";
        echo "<td>" . $nmsl[$i] . "</td>";
        echo "<td>" . $nms[$i] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    
    //------------------------------------
    echo "Optical Receiver Status<br>";
    echo "<table style=width:50%>";
    echo "<tr>";
    echo "<td>Input Power (RX1) (V)</td>";
    echo "<td>" . "1: " . $ri[0] . "; 2: " . $ri[1] . "; 3: " . $ri[2] . "; 4: " . $ri[3] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Input Power (RX2) (V)</td>";
    echo "<td>" . "1: " . $ri[4] . "; 2: " . $ri[5] . "; 3: " . $ri[6] . "; 4: " . $ri[7] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Input Power (RX3) (V)</td>";
    echo "<td>" . "1: " . $ri[8] . "; 2: " . $ri[9] . "; 3: " . $ri[10] . "; 4: " . $ri[11] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Status (RX1)</td>";
    echo "<td>" . "1: " . $rs[0] . "; 2: " . $rs[1] . "; 3: " . $rs[2] . "; 4: " . $rs[3] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Status (RX2)</td>";
    echo "<td>" . "1: " . $rs[4] . "; 2: " . $rs[5] . "; 3: " . $rs[6] . "; 4: " . $rs[7] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Status (RX3)</td>";
    echo "<td>" . "1: " . $rs[8] . "; 2: " . $rs[9] . "; 3: " . $rs[10] . "; 4: " . $rs[11] . "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    
    //------------------------------------
    echo "Optical Transmitter Status<br>";
    echo "<table style=width:50%>";
    for ($i = 0; $i < 16; $i++) {
        echo "<tr>";
        echo "<td>" . $tl[$i] . "</td>";
        echo "<td>" . $t[$i] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    
    
}

?>