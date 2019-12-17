<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("UTC");
include ("node/config.php");

$start="2017-01-01";
$end="2100-01-01";

if (isset($_GET['start']))
        $start = $_GET['start'];
if (isset($_GET['end']))
        $end = $_GET['end'];
	
$query="SELECT idrec as s, lati as lt, longi as lg, otime as ut , alti, version, cpu, temp, rf, status FROM `RECEIVERS_STATUS` where otime > '".$start."' and otime < '".$end."' ORDER BY `idrec` ;";
$db = new mysqli($servername, $DBuser, $DBpasswd, $dbname);

$results = $db->query($query);
$stations[0]="";
$i=0;
if ($results->num_rows > 0) 
   {
   while($row=$results->fetch_assoc()) {
	//$jsondata =json_encode($row);
	//echo $jsondata;

	$sta      =$row["s"];
	$lati     =$row["lt"];
	$long     =$row["lg"];
	$otime    =$row["ut"];
	$ttt      =date("Y-m-d H:i:s", strtotime($otime));
	$alti     =intval($row["alti"]);
	$version  =$row["version"];
	$cpu      =$row["cpu"];
	$temp     =$row["temp"];
	$rf       =$row["rf"];
	$status   =$row["status"];
	$station["s"] = $sta;
	$station["lt"] = $lati;
	$station["lg"] = $long;
	$station["ut"] = $ttt;
	$tsta     =strtotime($otime);
   	$tnow     =time() ;
   	$diff     =$tnow-$tsta;
	if ($diff > 7200)
		{
		$station["u"] ="D";
		}
	else
		{
		$station["u"] ="U";
		}
	
	$station["alti"] = $alti;
	$station["version"] = $version;
	$station["cpu"] = $cpu;
	$station["temp"] = $temp;
	$station["rf"] = $rf;
	//$station["status"] = $status;
	$stations[$i]=$station;
	$i = $i+1;
   	}
   }	
echo '{"stations":';
$jsondata =json_encode($stations);
echo $jsondata;
echo '}';


$db->close(); 
?>

