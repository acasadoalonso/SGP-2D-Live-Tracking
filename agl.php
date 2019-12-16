<?php
require_once 'config.php';
$today=date("ymd");
// Create connection
$connAPRSLOG = new mysqli($servername, $username, $password, $dbname);

$sqlString="select idflarm, date, time, latitude, longitude from OGNDATA_AGL where ground=-1 LIMIT 0,5";
$result = $connAPRSLOG->query($sqlString);
$rows = array();
$pos="";
if ($result->num_rows > 0) {
	while($r = $result->fetch_assoc()) {
		$lat=number_format($r["latitude"],4);
		$lon=number_format($r["longitude"],4);
		$alt=0;
		
		$sqlString="SELECT AGL FROM GEOMETRY WHERE lat=".$lat." and lon=".$lon." LIMIT 0, 1";
		$resultAGL = $connAPRSLOG->query($sqlString);
		if ($resultAGL->num_rows > 0) {
			$alt=$resultAGL["AGL"];	
		}else{
			$pos=$pos.$lat.','.$lon."|";

		}
	}
	if($pos!==""){
		$pos=substr($pos, 0, strlen($pos)-1);
		echo "https://maps.googleapis.com/maps/api/elevation/json?locations=".$pos."&key=AIzaSyB22PMW7XS-oPszB6jpLh_ilbd2rkBgEjI";
	}
}
?>
