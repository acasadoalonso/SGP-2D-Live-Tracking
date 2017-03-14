<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "ognread";
$password = "ognread";
$dbname = "APRSLOG";
$today=date("ymd");
$now=gmdate("His");

require_once 'SRTMGeoTIFFReader.php';
$lat=0; $lon=0; $clients=0; $activeFlarm=""; $offset=0;

if (isset($_GET['lat'])) $lat = $_GET['lat'];
if (isset($_GET['lon'])) $lon = $_GET['lon'];

if (isset($_GET['clients'])) $clients = $_GET['clients'];
if (isset($_GET['activeFlarm'])) $activeFlarm = $_GET['activeFlarm'];
if (isset($_GET['interpolate'])) $interpolate = $_GET['interpolate'];  
if (isset($_GET['offset'])) $offset = $_GET['offset']; 

$date=$today;
$station="";
if (isset($_GET['date'])) $date = $_GET['date'];
if (isset($_GET['station'])) $station = $_GET['station'];

$dataReader = new SRTMGeoTIFFReader("hgt"); // directory containing SRTM data files

// Create connection
$connSWIFACE = new mysqli($servername, $username, $password, $dbname);
$connAPRSLOG = new mysqli($servername, $username, $password, "APRSLOG");
$connOGNDB = new mysqli($servername, $username, $password, "OGNDB");

if(1==1){
	$sqlString="select DISTINCT(idflarm) as idflarm, max(time) as time from OGNDATA where date='".$today."' GROUP BY idflarm";
	$result = $connSWIFACE->query($sqlString);
	while($r2 = $result->fetch_assoc()) {
		$time=$r2["time"];
		$date=substr($today, 0,2)."/".substr($today, 2,2)."/".substr($today, 4,2)." ".substr($r2["time"], 0,2).":".substr($r2["time"], 2,2).":".substr($r2["time"], 4,2);
		$fecha=date_create_from_format("y/m/d H:i:s", $date); //$today.$r2["time"]);
		date_add($fecha, date_interval_create_from_date_string("-20 seconds"));
		$time=$fecha->format("Hms");
		$sqlString="SELECT ROUND(AVG(roclimb),1) as roclimb from OGNDATA where idflarm='".$r2["idflarm"]."' and date='".$today."' and time>=".$time;
		//echo $sqlString;
		$result3 = $connSWIFACE->query($sqlString);
		while($r3 = $result3->fetch_assoc()) {
			
			$sqlString="update GLIDERS_POSITIONS set roclimb='".$r3["roclimb"]."' where idflarm='".$r2["idflarm"]."'";
			$connSWIFACE->query($sqlString);
		}
	}
}
/*
$ch = curl_init("http://ogn.planeadores.cl/node/agl.php");
curl_setopt_array($ch, array(
	CURLOPT_HEADER => 0,
	CURLOPT_RETURNTRANSFER =>true,
	CURLOPT_NOSIGNAL => 1, //to timeout immediately if the value is < 1000 ms
	CURLOPT_TIMEOUT_MS => 50, //The maximum number of mseconds to allow cURL functions to execute
	CURLOPT_VERBOSE => 1,
	CURLOPT_HEADER => 1
));
$out = curl_exec($ch);
curl_close($ch);
*/
//system("php /var/www/html/node/agl.php");
$FLAG="";
if (isset($_GET['FLAG'])) $FLAG=$_GET["FLAG"];

if($FLAG=='HEATMAP'){
	$sqlString="select DISTINCT station, date from OGNDATA";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		//echo $sqlString;
		while($r2 = $result2->fetch_assoc()) {
			$file="/var/www/html/node/heatmaps/".$r2["station"]."-".$r2["date"].".json";

			$sqlString="SELECT latitude as lat, longitude as lon FROM `OGNDATA` WHERE station='".$r2["station"]."'" ; // order by weight desc;
			$result3 = $connSWIFACE->query($sqlString);
			if ($result3->num_rows > 0) {
				//echo $sqlString;
				while($r3 = $result3->fetch_assoc()) {
					$rows['heatmap'][] = $r3;
					//echo $r2["waypoint"];
				}
			}else{
				$rows['heatmap']=[];
			}
			$heatmap=json_encode($rows);
			file_put_contents($file, $heatmap);
		}
	}
	die();
}

if($FLAG=='MOREINFOSTATION'){
	$html='<div style="background-color:#008080; color:white; margin-bottom:3px; padding:3px; text-align:center">Station Records</div><div style="float:left"><strong>'.$station.'</strong>';
	
	$sqlString="select date, ROUND(mdist,0) as distance, ROUND(malt,0) as alt from STATIONS where idsta='".$station."' order by date desc LIMIT 0,7";
	// where waypointLat between ".$_GET['sw_lat']." and ".$_GET['ne_lat']." and  waypointLon between ".$_GET['sw_lon']." and ".$_GET['ne_lon']."";
	$result2 = $connOGNDB->query($sqlString);
	if ($result2->num_rows > 0) {
		$html=$html."<table width='100%'><tr><td align='center'>Date</td><td align='center'>Distance</td align='center'><td>Altitude</td></tr>";
		//echo $sqlString;
		while($r2 = $result2->fetch_assoc()) {
			$html=$html."<tr><td>".$r2["date"]."</td><td align='center'>".$r2["distance"]."km</td><td align='center'>".$r2["alt"]."m</td>";
		}
		
		$html=$html."</table>";
	}
	$html=$html.'</div>';
	echo $html;
	//connOGNDB
	
	die();
}
if($FLAG=='GETHEATMAP'){
	$today=date("ymd", time() - ((60 * 60 * 24 * -1)*$offset));
	$file="/var/www/html/node/heatmaps/".$station."-".$today.".json";
	if(file_exists($file)){
		echo file_get_contents($file);
	}else{
		echo '{"heatmap":[]}';	
	}
	die();
}

if($FLAG=='WAYPOINTS'){
	$sqlString="select idWaypoint, waypoint, waypointCountry, ROUND(waypointLat,3) as waypointLat, ROUND(waypointLon,3) as waypointLon, waypointType, 0 as altitude from WAYPOINTS";
	// where waypointLat between ".$_GET['sw_lat']." and ".$_GET['ne_lat']." and  waypointLon between ".$_GET['sw_lon']." and ".$_GET['ne_lon']."";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		//echo $sqlString;
		while($r2 = $result2->fetch_assoc()) {
			$r2["altitude"]=$dataReader->getElevation($r2["waypointLat"], $r2["waypointLon"], $interpolate=false);
			$rows['waypoints'][] = $r2;
			//echo $r2["waypoint"];
		}
	}else{
		$rows['waypoints']=[];
	}
	echo json_encode($rows);
}
if($FLAG=='LOGS'){
	$now=date("dmY");
	$url="http://flightlog.glidernet.org/index.php?a=SCLC&s=QNH&u=M&z=-3&p=&t=0&d=".$now."&j=1";
	$html=file_get_contents($url);
	echo $html;
	die();
}

if($FLAG=='TASK'){
	$files = array();
	foreach (glob("/var/www/html/cuc/*.json") as $file) {
  		$files[] = $file;
	}
	if(count($files)>0){
		$string = file_get_contents($files[0]);
		echo $string;
	}
	die();
}


if($FLAG=='NEARBY'){
	$sqlString="select lati as lat, longi as lon from RECEIVERS_STATUS where idrec='".$_GET["station"]."'";
	$resultBase = $connSWIFACE->query($sqlString);
	if ($resultBase->num_rows > 0) {
		$rBase = $resultBase->fetch_assoc();
				
		$sqlString="select idrec as station, ROUND(time_to_sec((TIMEDIFF(NOW(), lastFixRx)))) as age from RECEIVERS_STATUS where idrec<>'".$_GET["station"]."' and GETDISTANCE(".$rBase["lat"].",".$rBase["lon"].", lati, longi)<0.6";
		$resultBase2 = $connSWIFACE->query($sqlString);
		if ($resultBase2->num_rows > 0) {
			//echo $sqlString;
			while($rBase2 = $resultBase2->fetch_assoc()) {
				$rows['nearbyStations'][] = $rBase2;
				//echo $r2["waypoint"];
			}
		} else {
			$rows['nearbyStations']=[];
		}
	}else{
		$rows['nearbyStations']=[];	
	}
	echo json_encode($rows);
}
if($FLAG==''){
	//;
	
	$sqlString="select idrec as station, lati as lat, longi as lon, ROUND(alti) as alt, cpu, temp, rf, status, version, ROUND(time_to_sec((TIMEDIFF(NOW(), lastFixRx)))) as age, (select count(*) from GLIDERS_POSITIONS where TIME_TO_SEC(TIMEDIFF(NOW(),lastFixTx))<25 and station=idrec) as trackingAircrafts, (select count(*) from OGNDATA where station=RECEIVERS_STATUS.idrec) as pkgs, ROUND(maxDistance,2) as maxDistance  from RECEIVERS_STATUS where lati<=".$_GET['ne_lat']." and lati>=".$_GET['sw_lat']." and  longi<=".$_GET['ne_lon']." and longi>=".$_GET['sw_lon']." order by idrec";
	$rows = array();
	$result = $connSWIFACE->query($sqlString);
	
	if ($result->num_rows > 0) {
		while($r = $result->fetch_assoc()) {
			$rows['stations'][] = $r;
		}
	}else{
		$rows["stations"]=[];
	}
	$sqlString="select count(*) as waypointsCount from WAYPOINTS where waypointLat between ".$_GET['sw_lat']." and ".$_GET['ne_lat']." and  waypointLon between ".$_GET['sw_lon']." and ".$_GET['ne_lon'];
	//echo $sqlString;
	$result = $connSWIFACE->query($sqlString);
	if ($result->num_rows > 0) {
		while($r = $result->fetch_assoc()) {
			$rows['waypointsCount'] = $r["waypointsCount"];
		}
	}else{
		$rows["waypointsCount"]=0;
	}
	$sqlString="SELECT distinct flarmId FROM `GLIDERS_POSITIONS` where lat<=".$_GET['ne_lat']." and lat>=".$_GET['sw_lat']." and  lon<=".$_GET['ne_lon']." and lon>=".$_GET['sw_lon']." and date='".$today."'";
	$todaysFlarms="and flarmId in ('GGGGGG'";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			$todaysFlarms=$todaysFlarms.", '".$r2["flarmId"]."'";
		}
	}
	$todaysFlarms=$todaysFlarms.") ";
	$visible="";
	$v="";
	if (isset($_GET['visible'])) $v=$_GET["visible"];
	if($v=="online"){
		$visible=" and TIME_TO_SEC(TIMEDIFF(NOW(),lastFixTx))<300 ";	
	}
	//(select AGL from GEOMETRY where lat>=GLIDERS_POSITIONS.lat and lon>=GLIDERS_POSITIONS.lon order by lat asc, lon asc LIMIT 0,1)
	$sqlString="select *, flarmId as flarm, TIME_TO_SEC(TIMEDIFF(NOW(),lastFixTx)) as age, ifnull((select registration from GLIDERS where idglider=RIGHT(flarmId,6)),'') as registration, ". 
	"ifnull((select cn from GLIDERS where idglider=RIGHT(flarmId,6)),'') as competitionName, ifnull((select Pilot from GLIDERS_PILOT where cn=competitionName),'') as pilot, ".
	"ifnull((select type from GLIDERS where idglider=RIGHT(flarmId,6)),'') as aircraft, (select lati from RECEIVERS_STATUS where idrec=station) as stationLat , (select longi from RECEIVERS_STATUS where idrec=station) as stationLon , (select ROUND(alti) from RECEIVERS_STATUS where idrec=station) as stationAlt, 0 as ground from GLIDERS_POSITIONS where lat<=".$_GET['ne_lat']." and lat>=".$_GET['sw_lat']." and  lon<=".$_GET['ne_lon']." and lon>=".$_GET['sw_lon']." and date='".$today."' ".$todaysFlarms."".$visible." order by time desc";
	//echo $sqlString;
	//echo $sqlString;
	$result2 = $connSWIFACE->query($sqlString);
	$lat=0; $lon=0;
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			if ($activeFlarm==$r2["flarm"]){
				
				$lat=$r2["lat"];
				$lon=$r2["lon"];
			}
			if($r2["source"]=="SPOT"||$r2["source"]=="SPIDER"||$r2["source"]=="LT24"){
				$r2["station"]=$r2["source"];
				$r2["distance"]=0;
			}
			$r2["climb"]=round($r2["climb"]*0.00508,1);
			$r2["agl"]=$r2["altitude"] - ($dataReader->getElevation($r2["lat"], $r2["lon"], $interpolate=false));
			$r2["ground"]=($dataReader->getElevation($r2["lat"], $r2["lon"], $interpolate=false));
			$rows['aircrafts'][] = $r2;
		}
	} else {
		$rows['aircrafts']=[];
	}
	
		

	if ($activeFlarm!=""&&$lat!=0&&$lon!=0){
		$sqlString="SELECT idWaypoint, waypoint, waypointType, waypointCountry, waypointLat, waypointLon, 0 as altitude, 0 as altitudeDelta , ROUND(GETDISTANCE(".$lat.",".$lon.", waypointLat, waypointLon),1) as distance, GETBEARINGROSE(".$lat.",".$lon.", waypointLat, waypointLon) as bearingRose FROM `WAYPOINTS` order by GETDISTANCE(".$lat.",".$lon.", waypointLat, waypointLon) asc LIMIT 0,6";

		$resultWP = $connSWIFACE->query($sqlString);
		if($resultWP->num_rows>0){
		
			while($r3 = $resultWP->fetch_assoc()) {
				$altitude=$dataReader->getElevation($r3["waypointLat"], $r3["waypointLon"], $interpolate=false);
				$r3["altitude"]=$altitude;
				
				
				$r3["altitudeDelta"]=($dataReader->getElevation($lat, $lon, $interpolate=false))-$altitude;
				$rows['activeWaypoints'][] = $r3;
			}
		} else {
			$rows['activeWaypoints']=[];
		}
		$sqlString="select registration from GLIDERS where idglider=RIGHT('".$activeFlarm."',6);";
		$result2 = $connSWIFACE->query($sqlString);
		if ($result2->num_rows > 0) {
			$r2 = $result2->fetch_assoc();
			file_get_contents("http://localhost/node/registration.php?reg=".$r2["registration"]);
		}		
		
			
	}else{
		$rows['activeWaypoints']=[];
	}
	$rows['clients']=$clients;
	print json_encode($rows);
}elseif($_GET['FLAG']=="TRACK"){
	$minTime="000000";
	$sqlString="SELECT time FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and speed>25 and  speed<55 and date=DATE_FORMAT(NOW(), '%y%m%d') order by time desc LIMIT 0, 1";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		$r2 = $result2->fetch_assoc();
		$minTime=$r2["time"];
	}
	$sqlString="SELECT time, ROUND(altitude,0) as alt, latitude as lat, longitude as lon, ROUND(speed,0) as speed, ROUND(roclimb*0.00508,1) as vario FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and time>='".$minTime."' and date=DATE_FORMAT(NOW(), '%y%m%d') order by time asc";	
	//echo $sqlString;
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			$rows['track'][] = $r2;
		}
	} else {
		$rows['track']=[];
	}
	print json_encode($rows);
	
	

}elseif($FLAG=="COVERAGE"){
	$sqlString="SELECT count(station) as signals, CAST(latitude as CHAR(6)) as lat, CAST(longitude as CHAR(6)) as lon FROM `OGNDATA` WHERE station='".$_GET["station"]."'  and date=DATE_FORMAT(NOW(), '%y%m%d') group by lat, lon having signals>0";
	$max=0;
	$resultCover = $connSWIFACE->query($sqlString);
	if ($resultCover->num_rows > 0) {
	
		while($r2 = $resultCover->fetch_assoc()) {
			if($max<$r2["signals"]){
				//echo $max."<br>"; 
				$max=$r2["signals"];
				
			}
			$rows['coverage'][] = $r2;
		}
	} else {
		$rows['coverage']=[];
	}
	$rows['max']=$max;
	print json_encode($rows);	
	
}elseif($FLAG=="ALT"){
	$minTime="000000";
	$sqlString="SELECT time, speed FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and speed>25 and  speed<55 and date=DATE_FORMAT(NOW(), '%y%m%d') order by time desc LIMIT 0, 1";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		$r2 = $result2->fetch_assoc();
		$minTime=$r2["time"];
	}
	$sqlString="SELECT CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0') as time, ROUND(AVG(altitude),0) as altitude, 0 as ground, latitude as lat, longitude as lon FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and time>='".$minTime."' and date=DATE_FORMAT(NOW(), '%y%m%d') group by CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0'), latitude, longitude order by date desc, time desc";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			$r2["ground"] = ($dataReader->getElevation($r2["lat"], $r2["lon"], $interpolate=false));
			$rows['track'][] = $r2;
		}
	} else {
		$rows['track']=[];
	}
	print json_encode($rows);	
}elseif($FLAG=="VARIO"){
	$minTime="000000";
	$sqlString="SELECT time, speed FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and speed>25 and  speed<55 and date=DATE_FORMAT(NOW(), '%y%m%d') order by time desc LIMIT 0, 1";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		$r2 = $result2->fetch_assoc();
		$minTime=$r2["time"];
	}
	$sqlString="SELECT CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0') as time, AVG(ROUND(roclimb*0.00508,1)) as vario FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and time>='".$minTime."' and date=DATE_FORMAT(NOW(), '%y%m%d') group by CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0') order by date desc, time desc LIMIT 0, 1000";	
	//echo $sqlString;
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			$rows['vario'][] = $r2;
		}
	} else {
		$rows['vario']=[];
	}
	print json_encode($rows);	
}elseif($FLAG=="SPEED"){
	$minTime="000000";
	$sqlString="SELECT time, speed FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and speed>25 and  speed<55 and date=DATE_FORMAT(NOW(), '%y%m%d') order by time desc LIMIT 0, 1";
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
		$r2 = $result2->fetch_assoc();
		$minTime=$r2["time"];
	}
	$sqlString="SELECT CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0') as time, ROUND(AVG(speed),0) as speed FROM `OGNDATA` WHERE idflarm='".$_GET['FLARM']."' and time>='".$minTime."' and date=DATE_FORMAT(NOW(), '%y%m%d') group by CONCAT(MID(time,1,2),':', MID(time,3,2), ':', MID(time,5,1), '0') order by date desc, time desc";	
	$result2 = $connSWIFACE->query($sqlString);
	if ($result2->num_rows > 0) {
	
		while($r2 = $result2->fetch_assoc()) {
			$rows['speed'][] = $r2;
		}
	} else {
		$rows['speed']=[];
	}
	print json_encode($rows);	
}
$connSWIFACE->close();

?>