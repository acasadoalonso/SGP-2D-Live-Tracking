<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);
require_once 'config.php';
$today=date("ymd");

// Create connection
$connAPRSLOG = new mysqli($servername, $username, $password, $dbname);
//SELECT COUNT(station), ROUND(latitude,3) as lat, ROUND(longitude,3) as lon, station FROM `OGNDATA` WHERE station='SCLC' GROUP BY lat, lon, station
$FLAG="";$station=""; $date=$today;

if (isset($_GET['date'])) $date = $_GET['date'];
if (isset($_GET['FLAG'])) $FLAG = $_GET['FLAG'];
if (isset($_GET['station'])) $station = $_GET['station'];
if($FLAG=="STATION"&&$station!=""){
	$sqlString="SELECT latitude as lat, longitude as lon FROM `RECEIVERS` WHERE idrec='".$station."' LIMIT 0,1"; // order by weight desc;a
	if($station=="GLOBAL"){

	//	$sqlString="SELECT latitude as lat, longitude as lon FROM `RECEIVERS`  LIMIT 0,1"; // order by weight desc;a
        }

	$result2 = $connAPRSLOG->query($sqlString);
	if ($result2->num_rows > 0) {
		while($r2 = $result2->fetch_assoc()) {
			$rows['station'][] = $r2;
		}
	}else{
		$rows['station']=[];
	}
	echo json_encode($rows);
	die();
}

if($FLAG=="DATA"&&$station!=""){
	$sqlString="SELECT latitude as lat, longitude as lon FROM `OGNDATA` WHERE station='".$station."' and date='".$date."'" ; // order by weight desc;
	if($station=="GLOBAL"){
		//$sqlString="SELECT ROUND(latitude,2) as lat, ROUND(longitude,2) as lon FROM `OGNDATA` WHERE date='".$date."' ;" ; // order by weight desc;
		
	}
	$result2 = $connAPRSLOG->query($sqlString);
	if ($result2->num_rows > 0) {
		//echo $sqlString;
		while($r2 = $result2->fetch_assoc()) {
			$rows['heatmap'][] = $r2;
		}
	}else{
		$rows['heatmap']=[];
	}
	echo $rows;
	echo json_encode($rows);
	die();
}
$lat=$AppLat;
$lon=$AppLon;

?>
<!DOCTYPE html>
<html>
<head>
    <title>OGN heatmaps</title>
    <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">
  <script src="jquery.2.2.4.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=visualization&key=AIzaSyCKOPCAqnZW-OZvw3hzOjcKTldrZZN9wLo"></script>
<script src="jquery.cookie.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
    <link href='/node/js/kendo/styles/kendo.common.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.rtl.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.bootstrap.min.css' rel='stylesheet'>
    
    <script src='/node/js/kendo/js/kendo.all.min.js'></script>
    <script src='/node/js/kendo/js/cultures/kendo.culture.es-CL.min.js'></script>
<style>
html { height: 100% }
body { height: 100%; margin: 0px; padding: 0px; font-family:Arial, Helvetica, sans-serif;}
.datepicker{
	position:fixed;
	right:30px;
	top:10px;
	width:170px;
}
</style>
</head>
<body>
<div id="map" style="width:100%; height:100%;"></div>
<div class="datepicker">
<input type="text" id="datepicker" width="100px"  value="" /><br>
<select id="station" style="width: 170px;" >
<option value="">Station...</option>
<option value="GLOBAL">GLOBAL</option>
<?php
	$sqlString="select distinct idrec as station from RECEIVERS order by idrec";
	$rows = array();
	$result = $connAPRSLOG->query($sqlString);
	if ($result->num_rows > 0) {
		while($r = $result->fetch_assoc()) {
?>
    <option value="<?php echo $r["station"]?>"><?php echo $r["station"]?></option>
<?php
		}
	}

?>    
</select>
</div>
<script>
var bounds;
var urldata=""
function checkData(){
	var url="/node/heatmaps/" + station  + "-" + fDate + ".json";
	try{marker.setMap(null)}catch(e){};try{heatmap.setMap(null)}catch(e){};
	if(station!=""&&fDate!="000000"){  
		$.ajax({
			url:url,
			type:"GET",
			dataType:"json",
			contentType:"application/json",
			success: function(json){
				urldata=json
				loadStation(json, station)
			}
			
		});	
	}
}
function padZero(s,l){
	if(s!=""){
		s=Array(l).join("0") + s
 		s=s.substr(s.length-l)
	};
	return s
}
var fDate="000000", station="";
$(function(){
	$("#datepicker").kendoDatePicker({
		format: "dd-MM-yyyy",
		change: function() {
			var value = this.value();
			$.cookie("hmDate", this.value())
			fDate=padZero(value.getYear(),2) + padZero(value.getMonth()+1,2) + padZero(value.getDate(),2) 
			checkData();
		}		
	});
	 $("#station").kendoDropDownList({
		change: function(e) {
			$.cookie("hmStation", this.value())
			station=this.value();
			console.log(this.value())
			checkData();
		}		 
	});
	$("#station").val($.cookie("hmStation"));
	map = new google.maps.Map(document.getElementById('map'), {
		center: { lat: <?php echo $lat;?>, lng: <?php echo $lon;?>},
		zoom: 9,
		//mapTypeId:$.cookie("mapType"), //$.cookie("mapType"),
		//mapTypeControl: false,
		//scaleControl: false,
		//navigationControl: false,
		streetViewControl: false,
	});
	google.maps.event.addListenerOnce(map, 'tilesloaded', function () {
		bounds = new google.maps.LatLngBounds();
		

		//loadStation('<?php echo $_SERVER['QUERY_STRING']; ?>');
		google.maps.event.addListener(map, 'zoom_changed', function () {
			$(".menu").hide();
			$(".options").hide();
			$.cookie("zoom", map.getZoom())
		});
		
		google.maps.event.addListener(map, 'center_changed', function () {
			$.cookie("lat", map.getCenter().lat())
			$.cookie("lon", map.getCenter().lng())
		});	
	})
})
var marker, heatmap;
function loadStation(json2){
	
	$.ajax({
		url:"/node/showheatmaps.php",
		data: "FLAG=STATION&station=" + station,
		type:"POST",
		contentType:"application/json",
		dataType:"json",
		success: function(data){
			
			marker = new google.maps.Marker({
				position: { lat: parseFloat(data.station[0].lat), lng: parseFloat(data.station[0].lon)},
				title: "",
				map: map
			});
			bounds.extend(new google.maps.LatLng(parseFloat(data.station[0].lat), parseFloat(data.station[0].lon)));			
			
		}
		
	});	
	var json=(json2);
	var heatmapData=[];
	
	for(i=0;i<json.heatmap.length;i++){
		var data=json.heatmap[i];
		var position=new google.maps.LatLng(data.lat, data.lon)
		bounds.extend(position);
		//heatmapData.push({location:new google.maps.LatLng(data.lat, data.lon), weight: data.weight});
		heatmapData.push(position);
	}
	heatmap = new google.maps.visualization.HeatmapLayer({
		data: heatmapData
	});

	heatmap.setMap(map);
	map.fitBounds(bounds);
	heatmap.set('opacity',0.8)
	heatmap.set('radius', 10);
	
	var gradient = [
		'rgba(0, 255, 255, 0)',
		'rgba(0, 255, 255, 1)',
		'rgba(0, 191, 255, 1)',
		'rgba(0, 127, 255, 1)',
		'rgba(0, 63, 255, 1)',
		'rgba(0, 0, 255, 1)',
		'rgba(0, 0, 223, 1)',
		'rgba(0, 0, 191, 1)',
		'rgba(0, 0, 159, 1)',
		'rgba(0, 0, 127, 1)',
		'rgba(63, 0, 91, 1)',
		'rgba(127, 0, 63, 1)',
		'rgba(191, 0, 31, 1)',
		'rgba(255, 0, 0, 1)'
	]
	heatmap.set('gradient', heatmap.get('gradient') ? null : gradient)
  					

}
</script>
</body>
</html>
