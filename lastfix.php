<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("UTC");
include ("node/config.php");
if (isset($_GET['ID']))
        {
        $ID = strtoupper($_GET['ID']);
        $query="SELECT  * FROM `GLIDERS_POSITIONS` where flarmId = '".$ID."' ORDER BY lastFixTx DESC ;";
        }
elseif (isset($_GET['id']))
        {
        $ID = strtoupper($_GET['id']);
        $query="SELECT  * FROM `GLIDERS_POSITIONS` where flarmId = '".$ID."' ORDER BY lastFixTx DESC ;";
        }
elseif (isset($_GET['REG']))
        {
        $REG = strtoupper($_GET['REG']);
        }
elseif (isset($_GET['reg']))
        {
        $REG = strtoupper($_GET['reg']);
        }
else
        {
        $query="SELECT  * FROM `GLIDERS_POSITIONS` ORDER BY lastFixTx DESC ;";
        }
$db = new mysqli($servername, $DBuser, $DBpasswd, $dbname);

if (isset($_GET['REG']) or isset($_GET['reg']))
        {
        $query1="SELECT  idglider FROM `GLIDERS` where registration = '".$REG."' ;";
        $results = $db->query($query1);
        if ($results->num_rows > 0) 
            {
            $row=$results->fetch_array() ;
            //echo $row[0];
            $ID=$row[0];
            $query2="SELECT  * FROM `GLIDERS_POSITIONS` where substr(flarmId,4) = '".$ID."' ORDER BY lastFixTx DESC ;";
            $results = $db->query($query2);
            }
        }
else
        {
        $results = $db->query($query);
        }
$last[0]="";
$i=0;
if ($results->num_rows > 0) 
   {
   while($row=$results->fetch_assoc()) {
	//$jsondata =json_encode($row);
	//echo $jsondata;

	$last[$i]=$row;
	$i = $i+1;
   	}
   }	
echo '{"lastfix":';
$jsondata =json_encode($last);
echo $jsondata;
echo '}';


$db->close(); 
?>

