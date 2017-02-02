<?php
$servername = "localhost";
$username = "ogn";
$password = "ogn";
$dbname = "SWIFACE";
$today=date("ymd");
// Create connection
$connSWIFACE = new mysqli($servername, $username, $password, $dbname);
$connAPRSLOG = new mysqli($servername, $username, $password, "APRSLOG");



$sqlString="select idflarm, date, time, latitude, longitude from OGNDATA_AGL where ground=-1 LIMIT 0,5";
$result = $connSWIFACE->query($sqlString);
$rows = array();
$pos="";
if ($result->num_rows > 0) {
	while($r = $result->fetch_assoc()) {
		$lat=number_format($r["latitude"],4);
		$lon=number_format($r["longitude"],4);
		$alt=0;
		
		$sqlString="SELECT AGL FROM GEOMETRY WHERE lat=".$lat." and lon=".$lon." LIMIT 0, 1";
		$resultAGL = $connSWIFACE->query($sqlString);
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
/*
			$json = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/elevation/json?locations='.$lat.','.$lon.'&key=AIzaSyB22PMW7XS-oPszB6jpLh_ilbd2rkBgEjI'),true);
			$alt=round($json["results"][0]["elevation"],0);
			$sqlString="insert into GEOMETRY (AGL, lat, lon) values ('".$alt."', '".$lat."', '".$lon."');";
			$connSWIFACE->query($sqlString);
			echo $sqlString."<br>";
		$sqlString="update OGNDATA_AGL set ground='".$alt."' where idflarm='".$r["idflarm"]."' and date='".$r["date"]."' and time='".$r["time"]."'";
		
		$connSWIFACE->query($sqlString);
			*/
?>