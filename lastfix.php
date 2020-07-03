<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("UTC");
include ("node/config.php");

	
$query="SELECT  * FROM `GLIDERS_POSITIONS` ORDER BY lastFixTx DESC ;";
$db = new mysqli($servername, $DBuser, $DBpasswd, $dbname);

$results = $db->query($query);
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

