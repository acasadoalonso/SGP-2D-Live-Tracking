<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);

$today=date("ymd");
require_once 'config.php';
$connAPRSLOG = new mysqli($servername, $username, $password, $dbname);

$FLAG="";$station=""; $date=$today;

if (isset($_GET['date'])) $date = $_GET['date'];
if (isset($_GET['FLAG'])) $FLAG = $_GET['FLAG'];
if (isset($_GET['station'])) $station = $_GET['station'];

if($FLAG=="DATA"&&$station!=""){
	$sqlString="SELECT latitude as lat, longitude as lon FROM `OGNDATA` WHERE station='".$station."'" ; // order by weight desc;
	$result2 = $connAPRSLOG->query($sqlString);
	if ($result2->num_rows > 0) {
		//echo $sqlString;
		while($r2 = $result2->fetch_assoc()) {
			$rows['heatmap'][] = $r2;
			//echo $r2["waypoint"];
		}
	}else{
		$rows['heatmap']=[];
	}
	echo json_encode($rows);
	die();
}

$sqlString="select DISTINCT station, date from OGNDATA";
$result2 = $connAPRSLOG->query($sqlString);
if ($result2->num_rows > 0) {
	//echo $sqlString;
	while($r2 = $result2->fetch_assoc()) {
		$file="/var/www/html/node/heatmaps/".$r2["station"]."-".$r2["date"].".json";
		//if(!file_exists($file)){
			$url="http://localhost/node/heatmap.php?FLAG=DATA&station=".$r2["station"]."&date=".$r2["date"];
			$json=file_get_contents($url);
			file_put_contents($file, $json);
		
		//}
	}
}
