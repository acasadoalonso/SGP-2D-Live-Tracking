<?php
require_once  'config.php';
// Create connection
$connAPRSLOG = new mysqli($servername, $DBuser, $DBpasswd, $dbname);

$fila = 1;
if (($gestor = fopen("wp.txt", "r")) !== FALSE) {
    while (($row = fgetcsv($gestor, 1000, ",")) !== FALSE) {
	if ($fila == 1){
		$fila++;
		continue;
		}
        $numero 	= count($row);
        $fila++;
     	$title 		= $row[0];
     	$code 		= $row[1];
     	$country 	= $row[2];
     	$lati 		= $row[3];
	$latitude = floatval(substr($lati,0,2))+floatval(substr($lati,2,6))/60;
	if ($lati{8} =='S'){
		$latitude *= -1;
		}
     	$long		= $row[4];
	$longitude= floatval(substr($long,0,3))+floatval(substr($long,3,6))/60;
	if ($long{9} == 'W'){
		$longitude *= -1;
		}
     	$alti		= $row[5];
	$altitude =intval(substr_replace($alti,"m",0));
     	$style 		= $row[6];
	//echo $title, " ", $code," ",  $country," ",  $latitude," ",  $longitude," ",  $altitude," ",  $style, "\n";
	$sqlString="INSERT INTO WAYPOINTS (idWaypoint, waypoint, waypointType, waypointCountry, waypointLat, waypointLon) values ('$fila','".$title."','".$style."','".$country."','".$latitude."','".$longitude."');";	
	$result = $connAPRSLOG->query($sqlString);	
	echo $sqlString, $result, "\n";
    }
    fclose($gestor);
}
$connAPRSLOG->close();

?>

