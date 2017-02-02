<!DOCTYPE html>
<html>
<head>
    <title>APRS SCLC</title>
    <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">
  <script src="jquery-3.1.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKOPCAqnZW-OZvw3hzOjcKTldrZZN9wLo"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="jquery.cookie.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
    <link href='/node/js/kendo/styles/kendo.common.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.rtl.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.bootstrap.min.css' rel='stylesheet'>
    
    <script src='/node/js/kendo/js/kendo.all.min.js'></script>
    <script src='/node/js/kendo/js/cultures/kendo.culture.es-CL.min.js'></script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>

<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <style>
  html, body { 
	height: 100%;
	margin: 0;
	padding: 0;
  }
  #map {
	height: 100%;
  }
body,td,th {
font-family: Verdana, Geneva, sans-serif;
font-size: 12px;
	
}
.transmitersIcon{
	width:42px; height:42px;float:left; color:white; font-size:20px;font-weight:bold;
	-webkit-border-radius: 21px;-moz-border-radius: 21px;border-radius: 21px;text-align:center; margin:3px 5px;
}
.stationsIcon{
	width:42px; height:42px;float:left; color:white; font-size:20px;font-weight:bold;
	-webkit-border-radius: 21px;-moz-border-radius: 21px;border-radius: 21px;text-align:center; margin:3px 5px	
}
.break{
	clear:both;
}

.breakLine{
	clear:both;
	border-bottom:1px solid #bbb;
	padding-top:3px;
margin-bottom:3px;
}
#menu{
	width:300px;
	background-color:#eee;
	position:fixed;
	right:0;
	top:0;
	padding:3px;
	border-left:1px solid #bbb;
	display:none;
}
.round3{
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.roundIndicator{
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
	border:1px solid #999; 
	background-color:#ddd;
	padding:3px;
	overflow:hidden;
	height:40px;
	width:140px;
	margin:0 2px 3px 0;
	float:left;
}
.submenus{
	background-color:#ddd;
	color:black;
	font-size:11px;
	border:1px solid #999;
	padding:2px;
	margin-right:2px;
	float:left;
	cursor:pointer;
}
.stations{
	width:300px;
}

.station{
	width:300px;
	cursor:pointer;
	height:50px;
	border-top:1px solid #999;
}
.info{
	display:none;
width:100%;
float:left;
}
.receiversIcon{
	margin-top:3px;
	width:20px;
	height:20px;
	background-size:contain;
	float:right;
}
#trackingAircrafts{
	position:relative;
	left:60px; top:0;
	background-color:black;
	width:36px;
	height:29px;
	margin:5px;	
	text-align:center;
    -webkit-border-radius: 18px;
    -moz-border-radius: 18px;
    border-radius: 18px;
	color:white;
	font-size:18px;
	padding-top:7px;
}

.nearbyStation{
	color:#09C;
	font-size:10px;
	cursor:pointer;
	padding:2px;
	margin-right:3px;
}
.nearbyOn{
	background-color:#09C;
	color:white;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
	text-align:center;
}
.nearbyOff{
	background-color:red;
	color:white;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
	text-align:center;
}


.waypoints{
	width:300px; 
	overflow:auto;
}
.waypoint{
	padding:2px;
	height:30px;
	border-bottom:1px solid #999;
	cursor:pointer;
	overflow:hidden;
}

.waypointsIcon{
	width:20px;
	height:20px;
	margin-right:3px;
	background-size:contain;
	float:left;
	
}
.log{
width:300px;
float:left;
min-height:25px
}
.glide{
background-color:#CCCCFF;

}
.tow{
background-color:#CCFFCC;
}
.transmiter{
	cursor:pointer;
}
.logc1{
	width:75px;
	height:25px;
	float:left;
}
.logc2{
	width:75px;
	height:25px;
	float:left;
}
.logc3{
	width:75px;
	height:25px;
	float:left;
}
.logc4{
	width:75px;
	height:25px;
	float:left;
}
.logc5{
	margin-left:20px;
	width:130px;
	height:25px;
	float:left;
}

.button{
	color:#333;
	padding:2px;
	font-size:11px;
	text-align:center;
	margin:0 2px;
	float:left;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
	min-width:40px;
	cursor:pointer;
	background-color:#ddd;
	border:1px solid #333;
	
}
.buttonOn{
	background-color:#090;
	color:white;
}

.buttonChartsColor{
	background-color:#09F;
	color:white;
}

.buttonLock{
	background-color:yellow;
	color:black;
}
.buttonRadar{
	background-color:#0FF;
	color:#03F;
}
.buttonTrack{
	background-color:red;
	color:white;
}
.sup{ vertical-align: super }

.stationFocus{
	background-color:#0FF;
}
    </style>
  </head>
<body>
<style>


</style>


<!--<div class="receivers">
<div class="receiversTitle">Receivers: </div>
</div>-->



<div id="map"></div>
<img src="/node/img/menu.png" width="32" height="32" style="position:fixed; right:3px; top:3px; cursor:pointer;" id="openmenu">
<div id="menu">
	<img src="/node/img/close.png" width="20" height="20" style="position:fixed; right:3px; top:3px;cursor:pointer;" id="closemenu">
	<div class="submenus round3 mstations" type="stations">Stations</div>
	<div class="submenus round3 mtransmiters" type="transmiters">Aircrafts</div>
	<div class="submenus round3 mwaypoints" type="waypoints">Waypoints</div>
	<div class="submenus round3 mlogs" type="logs">Logs</div>
	<div class="submenus round3 moptions" type="options">Options</div>
	<div class="break" style="height:5px;"></div>
	<div id="stations" class="stations info"></div>
	<div id="transmiters" class="transmiters info"></div>
	<div id="waypoints" class="waypoints info"></div>
	<div id="logs" class="logs info">LOG</div>
    <div id="receiverDetail" class="receiverDetail info">
		<div style="float:left; height:20px;">
		    <div style="font-size:18px; font-weight:bold;max-width:175px; float:left; height:20px; margin-left:5px;" id="reg"></div>
        	<div style="font-size:18px; font-weight:bold;max-width:200px; float:left; height:20px; color:#999; margin-left:5px;" id="flarm"></div>
	    </div>
        
        <div style="clear:both"></div>
        
        <div style="float:left; height:20px; overflow:hidden; font-size:16px; font-weight:bold; color:#069; margin-left:5px;" id="aircraft"></div>
    	<div class="breakLine"></div>
        <div style="float:left; height:20px; overflow:hidden; margin-left:5px;">
        	<div style="height:20px; font-size:16px; float:left;"><span id="aprs" class="aprs">ROBLE1</span></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowL.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;"><span id="aprsDistance">25.5KM</span><sup>KM</sup></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowR.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;" id="aircraftType">GLIDER</div>
        </div>  
        
    	<div class="breakLine"></div>
         
        <div style="clear:both"></div>
        <div style="float:left;overflow:hidden;"> 
        	<div style="" class="roundIndicator">
        		<div style="float:left;"><img src="/node/img/rumbo.png" width="40" height="40" id="compass"></div>
        		<div style="font-size:20px; float:left;overflow:hidden;" id="course"></div>
            </div>
                        
        	<div style="" class="roundIndicator">
        		<div style="float:left;"><img src="/node/img/speed.png" width="40" height="40" class="click speed"></div>
        		<div style="font-size:20px; float:left;overflow:hidden;" class="click speed"><span id="speed">128</span><sup>KM/H</sup></div>
            </div>
        	<div style="" class="roundIndicator">            
        		<div style="float:left;"><img src="/node/img/altimeter.png" width="40" height="40" class="click altitude"></div>
	        	<div style="font-size:20px; float:left; overflow:hidden;" class="click altitude"><span id="altitude">1546</span><sup>M</sup></div>
            </div>
        	<div style="" class="roundIndicator">
				<div style="float:left;"><img src="/node/img/agl.png" width="40" height="40" class="click agl"></div>
				<div style="font-size:20px; float:left; overflow:hidden;" class="click agl"><span id="agl"></span><sup>M</sup></div>
            </div>
        	<div style="" class="roundIndicator"> 
	        	<div style="float:left;"><img src="/node/img/altitude0.png" width="40" height="40" id="verticalSpeedIcon" class="click verticalspeed"></div>
    	    	<div style="font-size:20px; float:left;overflow:hidden;" class="click verticalspeed"><span id="verticalspeed">+3.5</span><sup>m/s</sup></div>
            </div>
        	<div style="" class="roundIndicator"> 
            	<div style="float:left;"><img src="/node/img/sight.angle.png" width="40" height="40" class="click"></div>
	        	<div style="font-size:20px; float:left; overflow:hidden;" class="click"><span id="sight"></span><sup>º</sup></div>
            </div>
        	<div style="" class="roundIndicator">
            	<div style="float:left;"><img src="/node/img/sig.0.png" width="40" height="40" class="click" id="signalIcon"></div>
	        	<div style="font-size:20px; float:left; overflow:hidden;" class="click"><span id="signal"></span><sup>dB</sup></div>
    		</div>        
        </div>
        
        <div style="clear:both; height:3px;"></div>
        
        <div style="width:300px; float:left; overflow:hidden; margin-left:5px;">
        	<div id="btnSpeed" class="button buttonChart" type="SPEED">SPEED</div>
        	<div id="btnAltim" class="button buttonChart" type="ALTIM">ALTIM</div>
        	<div id="btnVario" class="button buttonChart" type="VARIO">VARIO</div>
        	<div id="btnLock" class="button" type="LOCK" lock="0" id="lock">LOCK</div>
        	<div id="btnRadar" class="button" type="RADAR">RADAR</div>
        	<div id="btnTrack" class="button" type="TRACK">TRACK</div>
            
        	<!--<div style="height:48px; float:left; padding-left:10px"><img src="/node/img/unlock.png" width="48" height="48" style="float:left" id="lock" lock="0"/></div>
        	<div style="height:48px; float:left; padding-left:10px"><img id="radar" src="/node/img/radar.0.png" width="48" height="48"></div>
        	<div style="height:48px; float:left; padding-left:10px"><img id="track" src="/node/img/track.0.png" width="48" height="48"></div>
        	-->
        </div> 
        <div class="breakLine"></div>
        
        <div style="float:left; width:80px;">Nearby WP:</div>
        <div style="clear:both; height:3px;"></div>
        <div style="float:left; overflow:hidden; font-size:12px; margin-left:5px; width:300px;" id="nearByWaypoints">
        </div>    
    </div>        
	<div id="options" class="options info">
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3"><strong>&nbsp;&nbsp;Map Type<span class="sup">[m]</span></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label><input type="radio" name="mapType" value="terrain" class="mapType" id="mpterrain">Terrain</label></td>
    <td><label><input type="radio" name="mapType" value="satellite" class="mapType" id="mpsatellite">Satellite</label></td>
    <td><label><input type="radio" name="mapType" value="hybrid" class="mapType" id="mphybrid">Hybrid</label></td>
    <td><label><input type="radio" name="mapType" value="roadmap" class="mapType" id="mproadmap">Roadmap</label></td>
  </tr>
  <tr>
    <td colspan="4"><div class="breakLine"></div></td>
  </tr>
  <tr>
    <td colspan="3"><strong>&nbsp;&nbsp;Visible Aircrafts<span class="sup">[v]</span></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label><input type="radio" name="visible" value="visible" class="visible" id="viewvisible">Online</label></td>
    <td><label><input type="radio" name="visible" value="all" class="visible" id="viewall">All</label></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4"><div class="breakLine"></div></td>
  </tr>
  <tr>
    <td colspan="3"><strong>&nbsp;&nbsp;Clustering</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Aircrafts<span class="sup">[a]</span></td>
    <td><label><input type="radio" name="clusterTX" value="1" class="clusterTX" id="clusterTX1">Yes</label></td>
    <td><label><input type="radio" name="clusterTX" value="0" class="clusterTX" id="clusterTX0">No</label></td>
    <td></td>
  </tr>
  <tr>
    <td>Receivers<span class="sup">[r]</span></td>
    <td><label><input type="radio" name="clusterRX" value="1" class="clusterRX" id="clusterRX1">Yes</label></td>
    <td><label><input type="radio" name="clusterRX" value="0" class="clusterRX" id="clusterRX0">No</label></td>
    <td></td>
  </tr>
</table>
    
    </div>
    <div id="stationDetail" class="stationDetail info">
            <div style="width:300px; float:left; height:40px;">
                <img src="/node/img/go.back.png" id="goBackRX" style="float:left; margin-top:4px;">
                <div style="font-size:18px; font-weight:bold;width:280px; float:left; height:20px;" id="station"></div>
                
                <div style="font-size:16px; font-weight:bold;width:300px; float:left; height:20px; color:#999" id="version"></div>
            </div>

            
            
            
            <div class="breakLine"></div>
            <div style="float:left; overflow:hidden;">
                <div style="float:left; height:20px; overflow:hidden;" class="nearbyStations"></div>
                <div class="break"></div>
                <div style="height:20px; font-size:16px; float:left;">Station Altitude: </div>
                <div style="height:20px; font-size:16px; float:left;" id="stationAltitude"></div>
                <div class="break"></div>

                <div style="height:20px; font-size:16px; float:left;">Total Fixes: </div>
                <div style="height:20px; font-size:16px; float:left;" id="pkgs"></div>
                <div style="height:20px; float:left; margin-left:10px;"><img src="/node/img/heat.map.png" width="20" height="20" id="heatMap"></div>
                <div class="break"></div>
                <div style="height:20px; font-size:16px; float:left;">Max Range: </div>
                <div style="height:20px; float:left;"><img src="/node/img/arrowL.png" width="30" height="20"></div>
                <div style="height:20px; font-size:16px; float:left;"><span id="maxDistance"></span><sup>KM</sup></div>
                <div style="height:20px; float:left;"><img src="/node/img/arrowR.png" width="30" height="20"></div>
            	<div class="break"></div>
                <div style="height:20px; font-size:16px; float:left;">Last PCK RX: </div>
                <div style="height:20px; font-size:16px; float:left;" id="stationAge"></div>
            </div>
            <div class="breakLine"></div>
            <div style="width:300px; float:left; overflow:hidden;" id="gauges">
                <div style="height:15px; width:140px; float:left; text-align:center;">CPU</div>
                <div style="height:15px; width:140px; float:left;text-align:center;">TEMP</div>
                <div style="height:140px; width:140px; float:left;" id="cpu"></div>
                <div style="height:140px; width:140px; float:left;" id="temp"></div>
            <div class="breakLine"></div>
                <div style="height:95px; width:95px; margin-left:100px; float:left; background-image:url(/node/img/tracking.aircrafts.png); background-size:contain;" id="">
                    <div id="trackingAircrafts">12</div>
                </div>
            </div>
            <div class="breakLine"></div>
            <div style="width:300px; float:left; height:50px; overflow:hidden; font-size:10px;">
                <div style="height:12px; color:#999; width:300px; overflow:hidden;" id="rf"></div>
                <div style="height:24px; color:#999; width:300px; overflow:hidden;" id="status"></div>
            </div>    
    </div>
</div>

<div class="chartOut chartOutW" id="chartOut" style="width: 100%; height: 90px; top:0px; left:0px; position:fixed; display:none;">
	<img src="/node/img/close.png" style="position:fixed;top:3px;right:6px; z-index:15000" width="24" height="24" class="closeChart chartOut">
	<div class="chartOut chartOutW" id="chartAltitude" style="width: 100%; height: 90px; top:0px; left:0px; position:fixed;">
	</div>
</div>
<script>

function setPointVario(objA, objB){
	var colors = ["blue", "cyan", "black", "yellow", "red"];	
	var j=2;
	var vario=objB.vario;
	if (vario>1&&vario<3) j=3
	else if (vario>=1) j=4
	else if (vario<-1&&vario>-3) j=1
	else if (vario<=-3) j=0	
	var trk = new google.maps.Polyline({
		path: [{lat:parseFloat(objA.lat),lng:parseFloat(objA.lon)}, {lat:parseFloat(objB.lat),lng:parseFloat(objB.lon)}],
		geodesic: true,
		strokeColor: colors[j],
		strokeOpacity: 1.0,
		strokeWeight: 2,
		map:map
	});
	return trk;
}
$(document).off('click', '.button').on('click', '.button', function(){
	if($(this).attr('type')=="RADAR"){
		radarOn = (radarOn==0) ? 1 : 0;
		(radarOn==0) ? $(this).removeClass("buttonRadar") : $(this).addClass("buttonRadar");
		$("#radar").attr("src", "/node/img/radar." + radarOn + ".png")
		if(radarOn==0) line.setPath([]);
	}else if($(this).attr('type')=="TRACK"){
		trackOn = (trackOn==0) ? 1 : 0;
		(trackOn==0) ? $(this).removeClass("buttonTrack") : $(this).addClass("buttonTrack");
		$("#track").attr("src", "/node/img/track." + trackOn + ".png")
		flightTrack.setPath([]);
		if(trackOn==1){
			$.ajax({
				url:"/node/data.php?FLAG=TRACK&FLARM=" + activeFlarm,
				data: "",
				type:"POST",
				dataType:"json",
				success: function(data){
					
					for (var i = 0; i < flightPath.length; i++) {
						try{flightPath[i].setMap(null);}catch(e){};
					}
					flightPath=[];		
					for(i=0;i<data.track.length-1;i++){

						var track=setPointVario(data.track[i], data.track[i+1])
						flightPath.push(track)
						//var j=1;
						//if (data.track[i].vario>1) j=2
						//else if (data.track[i].vario<1) j=0
						
						//stepPolyline.setOptions({
						//	strokeColor: colors[j]
      					//})
						//stepPolyline.getPath().push({lat:parseFloat(data.track[i].lat),lng:parseFloat(data.track[i].lon)})
						
						//flightPath.push({lat:parseFloat(data.track[i].lat),lng:parseFloat(data.track[i].lon), vario: parseFloat(data.vario)})
					}
					console.log("CONSTRUCTION")
					//flightTrack.setPath(stepPolyline);
				}
				
			});
		}
	}else if($(this).attr('type')=="ALTIM"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		setUpChart()
		drawChartAlt();
	}else if($(this).attr('type')=="SPEED"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		setUpChart()
		drawChartSpeed();
	}else if($(this).attr('type')=="VARIO"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		setUpChart()
		drawChartVario();
	}else if($(this).attr('type')=="LOCK"){
		($(this).attr('lock')=="1") ? $(this).attr('lock','0')	:  $(this).attr('lock','1');
		($(this).attr('lock')=="1") ? $(this).addClass("buttonLock") : $(this).removeClass("buttonLock");
	}
});
var onlineColor="#66FFFF", offlineColor="#996600", activeColor="#FF9900"; //onlineColor="black", offlineColor="#777", activeColor="magenta";
$('.visible').off('click').on('click', function(){
	busy=true
	$.cookie("visible", $(this).val())
	$.each(tx, function(i, item) {
		try{
			item.marker.setMap(null)
			delete(item)
		}catch(e){}
	});
	tx={};
	busy=false
});
$(document).off('click', '.mapType').on('click', '.mapType', function(){
	$.cookie("mapType", $(this).val())
	map.setMapTypeId($.cookie("mapType"))
});

$('#heatMap').off('click').on('click', function(){
	coverageLoad(activeStation);
});
function initMap() {
	setTimeout(function(){
		google.charts.load('current', {'packages':['corechart']});
		map = new google.maps.Map(document.getElementById('map'), {
			center: { lat: parseFloat($.cookie("lat")), lng: parseFloat($.cookie("lon"))},
			zoom: parseInt($.cookie("zoom")),
			mapTypeId:$.cookie("mapType"), //$.cookie("mapType"),
			mapTypeControl: false,
			scaleControl: false,
			navigationControl: false,
			streetViewControl: false,
			keyboardShortcuts: false
		});
		google.maps.event.addListenerOnce(map, 'tilesloaded', function () {
			getTask()
			calcMapSize()
			google.maps.event.addListener(map, 'zoom_changed', function () {
				$(".menu").hide();
				$(".options").hide();
				$.cookie("zoom", map.getZoom())
			});
			
			activeBounds=map.getBounds();
			mapLoaded=true;
			google.maps.event.addListener(map, 'center_changed', function () {
				//$(".menu").hide();
				//$(".options").hide();
				$.cookie("lat", map.getCenter().lat())
				$.cookie("lon", map.getCenter().lng())
				activeBounds=map.getBounds()
			});
			google.maps.event.addListener(map, 'click', function () {
				$(".menu").hide();
				$(".options").hide();
				clearTopLayer()
				clearAircrafts();
			});

			google.maps.event.addListener( map, 'maptypeid_changed', function() { 
			} );

			line = new google.maps.Polyline({
				path: [],
				strokeColor: "#00ccff",
				strokeOpacity: 1.0,
				strokeWeight: 3,
				map: map
			});
			
			flightTrack = new google.maps.Polyline({
				path: [],
				strokeColor: "#00ccff",
				strokeOpacity: 1.0,
				strokeWeight: 3,
				map: map
			});
			
			var rxOptions={
				styles: [{
					height: 53,
					url: '/node/img/markers/cluster/m2.png',
					width: 53
				}]
			}	
			var txOptions={
				styles: [{
					height: 53,
					url: '/node/img/markers/cluster/m1.png',
					width: 53
				}]
			}	
			timerMove=setTimeout(function(){
				markerClusterRX = new MarkerClusterer(map, clusterRX, rxOptions)
				markerClusterTX = new MarkerClusterer(map, clusterTX, txOptions);			
				$("#map").find('a').click();
				getAir();
			},1000)			
		}); 
	},1000);
}
var clusterRX=[];
var markerClusterRX;

var clusterTX=[];
var markerClusterTX;

$(document).off('click', '.clusterRX').on('click', '.clusterRX', function(){
	$.cookie("clusterRX", $(this).val())
	markerClusterRX.clearMarkers();
	$.each(rx, function(i, item) {
		if(item.hasMarker==1) try{item.marker.setMap(null);}catch(e){};
	});
	rx={};
});

$(document).keyup(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	var vMove=(activeBounds.getNorthEast().lat()>activeBounds.getSouthWest().lat()) ? activeBounds.getNorthEast().lat() - activeBounds.getSouthWest().lat() : activeBounds.getSouthWest().lat() - activeBounds.getNorthEast().lat();
	
	var hMove=(activeBounds.getNorthEast().lng()>activeBounds.getSouthWest().lng()) ? activeBounds.getNorthEast().lng() - activeBounds.getSouthWest().lng() : activeBounds.getSouthWest().lng() - activeBounds.getNorthEast().lng();	
	var factor=0.12
	switch(keycode){
	case 37:
		map.panTo(new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng()-(hMove*factor)))
		break;
	case 38:
		map.panTo(new google.maps.LatLng(map.getCenter().lat()+(vMove*factor), map.getCenter().lng()))
		break;
	case 39:
		map.panTo(new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng()+(hMove*factor)))
		break;
	case 40:
		map.panTo(new google.maps.LatLng(map.getCenter().lat()-(vMove*factor), map.getCenter().lng()))
		break;
	default:
		break;
	}	
    if(event.keyCode==27){
		if($("#chartOut").is(":visible")){
			$(".chartOut").hide();
			$(".button").removeClass("buttonChartsColor");
			return;
		}
		if($("#stations").is(":visible")){
			$(".info").hide();
			return;
		}
		if($("#transmiters").is(":visible")){
			$(".info").hide();
			return;
		}
		if($("#logs").is(":visible")){
			$(".info").hide();
			return;
		}
		if($("#waypoints").is(":visible")){
			$(".info").hide();
			return;
		}
		if($("#options").is(":visible")){
			$(".info").hide();
			return;
		}
		if($("#stationDetail").is(":visible")){
			clearTopLayer()
			$(".mstations").click();
			return;
		}
		if($("#receiverDetail").is(":visible")){
			console.log("receiverDetail")
			clearTopLayer()
			$(".mtransmiters").click();
			return;
		}
		$("#menu").is(":visible") ? $("#closemenu").click() : $("#openmenu").click();
		clearTopLayer()
		return;
    }	
});

$(document).keypress(function(event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	var key=String.fromCharCode(keycode);
	console.log(keycode + ":" + key)

	switch(key){
	case "i":
		try{map.setZoom(map.getZoom()+1)}catch(e){}
		break;
	case "o":
		try{map.setZoom(map.getZoom()-1)}catch(e){}
		break;
	default:
		break;
	}

	if($("#receiverDetail").is(":visible")){
		switch(key){
		case "s":
			$("#btnSpeed").click();
			break;
		case "a":
			$("#btnAltim").click();
			break;
		case "v":
			$("#btnVario").click();
			break;
		case "l":
			$("#btnLock").click();
			break;
		case "r":
			$("#btnRadar").click();
			break;
		case "t":
			$("#btnTrack").click();
			break;
		default:
			break;
		}
		return;	
	}
	

	if($("#stationDetail").is(":visible")){
		switch(key){
		case "f":
			$("#heatMap").click();
			break;
		default:
			break;
		}
		return;	
	}	
	if($("#stations").is(":visible")){
		if(!isNaN(key)){
			$(".station").each(function(index, element) {
				if(parseInt($(this).attr('stationnumber'))==key) $(this).click();		
			});	
		}
		return;
	}

	if($("#transmiters").is(":visible")){
		if(!isNaN(key)){
			$(".transmiter").each(function(index, element) {
				if(parseInt($(this).attr('transmiternumber'))==key) $(this).click();		
			});	
		}
		return;
	}
			
	if($(".options").is(":visible")){
		switch(key){
		case "m":
			if($("#mpterrain").is(":checked")){
				$("#mpsatellite").click();
			}else if($("#mpsatellite").is(":checked")){
				$("#mphybrid").click();
			}else if($("#mphybrid").is(":checked")){
				$("#mproadmap").click();
			}else if($("#mproadmap").is(":checked")){
				$("#mpterrain").click();
			}
			break;
		case "v":
			!$("#viewvisible").is(":checked") ? $("#viewvisible").click() : $("#viewall").click();
			break;
		case "a":
			$("#clusterTX1").is(":checked") ? $("#clusterTX0").click() : $("#clusterTX1").click();
			break;
		case "r":
			$("#clusterRX1").is(":checked") ? $("#clusterRX0").click() : $("#clusterRX1").click();
			break;
		default:
			break;
		}
		return;
	}

	if($("#menu").is(":visible")){
		switch(key){
		case "s":
			$(".mstations").click();
			break;
		case "a":
			$(".mtransmiters").click();
			break;
		case "l":
			$(".mlogs").click();
			break;
		case "p":
			$(".moptions").click();
			break;
		case "w":
			$(".mwaypoints").click();
			break;
		default:
			break;
		}		
	}		

});
$(document).off('click', '.clusterTX').on('click', '.clusterTX', function(){
	$.cookie("clusterTX", $(this).val())
	markerClusterTX.clearMarkers();
	$.each(tx, function(i, item) {
		if(item.hasMarker==1) try{item.marker.setMap(null);}catch(e){};
	});
	tx={};
});
var markersAircrafts=[];
var infowindow = new google.maps.InfoWindow();
function createStations(){
	var found=false;
	var html=''
	var jsonString=JSON.stringify(stations)
	var stationList="#blank "
	var reg = new RegExp('^[0-9]+$');
	$.each(rx, function(i, item) {
		var stationIcon=(item.age>60*5) ? 0 : 1;
		var distance=(Math.round(item.maxDistance*10)/10)
		
		var stationStatusColor=(item.age>60*5) ? "#ff0000" : "#6C9F43";
		var stationOpacity=(item.age>60*10) ? 0.3 : 1;
		var version=item.version.replace(/[^0-9]/g, "");
		var html='<div style="background-color:'+stationStatusColor+'; opacity:'+stationOpacity+'" class="stationsIcon" id="stationIcon' + item.station + '"><div style="padding-top:8px;" id="stationNumber'+item.station+'"></div></div>'+
		'<div class="receiversData"><div class="receiversStation"><strong>' + 
			item.station + '</strong><br>Max Dist: ' + distance + ' km<br>Fixes: ' + item.pkgs + '</div></div>';
			
		$node='<div class="station station' + item.station + '" station="' + item.station + '" id="station' + item.station + '" lat="' + item.lat + '" lon="' + item.lon + '">'+
		'</div>'
		if($('#station' + item.station).length==0){
			$(".stations").append($node);
		}else{
			$("#station"+item.station).html(html);
		}
		$(".stationIcon" + item.station).css('opacity', stationOpacity);
		var i=0;
		$(".station").each(function(index, element) {
        	i++;
            $(this).attr("stationNumber", i);
			$("#stationNumber" + $(this).attr('station')).text(i)
		});
		if(item.hasMarker==0){
			var myLatLng = {lat: parseFloat(item.lat), lng: parseFloat(item.lon)};
			var marker = new google.maps.Marker({
				position: myLatLng,
				title: item.station,
				icon: {
					url: parseInt(item.age>60*5) ? "/node/img/antenna0.png" : "/node/img/antenna1.png",
					size: new google.maps.Size(20,20),
					origin: new google.maps.Point(0,0),
					anchor: new google.maps.Point(10,10)
				},
				map: map
			});
			item.marker=marker;
			item.hasMarker=1;
			marker.addListener('click', function() {
				activeFlarm=item.flarmId
				$("#menu").show();
				clearTopLayer()
				activeStation=item.station;
				$(".info").hide();
				$("#stationDetail").show();
				infowindow.setContent(item.station);
				try{
					infowindow.open(map, rx[item.station].marker);
					map.panTo(new google.maps.LatLng(parseFloat(item.lat), parseFloat(item.lon)))
					
				}catch(e){}
				setupNearby(activeStation)
				
			});
			clusterRX.push(marker);
			if($.cookie("clusterRX")=="1"){
				markerClusterRX.addMarker(marker, false);			
			}
		}else{
			var marker=item.marker;
			marker.setIcon({
				//url:"/node/img/tow.svg",
				url: parseInt(item.age)>60*5 ? "/node/img/antenna0.png" : "/node/img/antenna1.png",
				size: new google.maps.Size(20,20),
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(10,10)
			})

		}
		if(activeStation==item.station){
			$("#station").text("Station: " + item.station)
			$("#version").text("SW Version: " + item.version)
			$("#rf").text(item.rf)
			$("#status").text(item.status)
			$("#gauges").css("display", "block")	
			$("#cpu").data("kendoRadialGauge").value(item.cpu);
			$("#temp").data("kendoRadialGauge").value(item.temp);
			$("#trackingAircrafts").text(item.trackingAircrafts);

			$("#stationAltitude").html(item.alt + "m");
			$("#pkgs").html(formatpkgs(item.pkgs))
			var distance=(Math.round(item.maxDistance*10)/10)
			$("#maxDistance").text(distance)
			$("#stationAge").text(formatAge(item.age))
			
		
			
			
		}
		
	});
	for(i=0;i<stations.length;i++){
		stationList+=", .station" + stations[i].station;
	}
	$(".station:not("+stationList+")").remove()
	if ($(".station").length==0) $(".stations").hide()
	//transmiters
	var transmitersList="#null "
	//onlineColor="white", offlineColor="#ddd", activeColor="magenta";	
	$.each(tx, function(i, item) {
		var distance=(Math.round(item.distance*10)/10)
		var transmitersIcon=(item.age>60) ? 0 : 1;
		
		var aircraftType=(item.aircraftType=="GLIDER") ? "G" : "T";
		var aircraftTypeColor=(item.aircraftType!="GLIDER") ? "red" : "#F90";
		
		

		
		var transmitersStatusColor=(item.age>60) ? "#ff0000" : "#6C9F43";
		var transmitersOpacity=(item.age>60) ? 0.3 : 1;
		var html='<strong>' + item.registration + ' ' + 
		item.aircraft + '</strong><br>Alt: ' + item.altitude + 'm Speed: ' + item.speed + 'km/h<br>Station: ' + item.station + '<sup>'+ distance +'km</sup>'
			
		$node='<div class="transmiter transmiter' + item.flarmId +'" flarmId="' + item.flarmId + '" id="transmiter' + item.flarmId + '" lat="' + item.lat + '" lon="' + item.lon + '">' +
		'<div class="breakLine"></div><div class="transmitersIcon" id="transmitersIcon' + item.flarmId + 
		'" style="background-color:'+aircraftTypeColor+'; opacity:'+transmitersOpacity+';"><div style="padding-top:8px;" id="transmitersNumber'+item.flarmId+'"></div></div>'+
		'<div class="transmitersData"><div class="transmitersStation" id="transmitersStation' + item.flarmId + '">'+html+'</div></div></div>'
		if($('#transmiter' + item.flarmId).length==0){
			$(".transmiters").append($node);
		}else{
			$('#transmitersStation' + item.flarmId).html(html)
		}
		$(".transmitersIcon" + item.flarmId).css('opacity', transmitersOpacity);
		
		var i=0;
		$(".transmiter").each(function(index, element) {
        	i++;
            $(this).attr("transmiterNumber", i);
			$("#transmitersNumber" + $(this).attr('flarmId')).text(i)
		});
		
		var rtMaster=(item.aircraftType=="TOW") ? -45 : 45;	
		var color=(item.age>300||item.speed<10) ? offlineColor : onlineColor;
		if(item.hasMarker==0){
			console.log("add Marker:" + item.flarmId);
			var myLatLng = {lat: item.lat, lng: item.lon};
			
			
			if(item.flarmId==activeFlarm) color=activeColor;
			var marker = new google.maps.Marker({
				position: myLatLng,
				title: item.registration,
				icon: {
					path: (item.aircraftType=="GLIDER") ? glider: tow,
					fillColor: color,
					fillOpacity: 1,
					strokeWeight: 1,
					strokeColor: color,
					size: new google.maps.Size(20,20),
					origin: new google.maps.Point(0,0),
					anchor: new google.maps.Point(19,15),	
					rotation: item.course+rtMaster //this is how to rotate the pointer
				},
				map: map
			});
			
			tx[item.flarmId].marker=marker;
			tx[item.flarmId].hasMarker=1;
			marker.addListener('click', function() {
				$("#menu").show();
				clearAircrafts();
				clearTopLayer();
				activeFlarm=tx[item.flarmId].flarmId
				displayData(tx[item.flarmId]);

				$(".info").hide();
				$("#receiverDetail").show();
				
				tx[item.flarmId].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
				zIndex++;
				calcMapSize();				
			});
			markersAircrafts.push(marker);
			clusterTX.push(marker);
			if($.cookie("clusterTX")=="1"){
				markerClusterTX.addMarker(marker, false);			
			}						
		}else{
			var marker=item.marker;
			marker.setPosition(new google.maps.LatLng(item.lat, item.lon));
		}
		
		var maxAge=($.cookie("visible")=="all") ? 30000 : 300;
		if(item.age>maxAge){
			if(tx[item.flarmId].hasMarker==1){
				try{item.marker.setMap(null); delete(item);}catch(e){}
			}
		}else{
			if(item.flarmId==activeFlarm){
				if($("#btnLock").attr('lock')=="1") try{map.panTo(new google.maps.LatLng(item.lat, item.lon))}catch(e){}
				if($("#receiverDetail").is(":visible")){
					displayData(item)

					tx[item.flarmId].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
					zIndex++;						
				}
				if(radarOn==1){
					var pathLine=[
						{lat:item.lat, lng:item.lon},
						{lat:item.stationLat, lng:item.stationLon}
					]
					line.setPath(pathLine)
					line.setMap(map)
				}
				if(trackOn==1){
					var last=flightPath[flightPath.length-1].getPath().getArray();
					console.log(flightPath[flightPath.length-1].getPath().getArray());
					var objA={lat:last[1].lat(), lon:last[1].lng(), vario:0}
					var objB={lat:item.lat, lon:item.lon, vario:item.rot}
					var track=setPointVario(objA, objB)
					flightPath.push(track)
						
					//flightPath.push({lat:item.lat,lng:item.lon, vario: item.vario})	
					//flightTrack.setPath(flightPath)
					//flightTrack.setMap(map)
				}
			}
			var color=(item.age>60||item.speed<10) ? offlineColor : onlineColor;
			if(item.flarmId==activeFlarm) color=activeColor
			item.marker.setIcon({
				path: (item.aircraftType=="GLIDER") ? glider: tow,//path:google.maps.SymbolPath.CIRCLE,
				fillColor: color,
				fillOpacity: 1,
				strokeWeight: 1,
				strokeColor: color,		
				size: new google.maps.Size(20,20),
				origin: new google.maps.Point(0,0),
				anchor: new google.maps.Point(19,15),		
				rotation: item.course+rtMaster
			})
		}
		
		
	});

	for(i=0;i<aircrafts.length;i++){
		transmitersList+=", #transmiter" + aircrafts[i].flarmId;
	}
	$(".transmiter:not("+transmitersList+")").each(function(index, element) {
        //console.log($(this).attr('flarmId'));
		try{markersAircrafts[$(this).attr('flarmId')].setMap(null);}catch(e){}	
		delete markersAircrafts[$(this).attr('flarmId')];
    });
	console.log(markersAircrafts.length);
	
	$(".transmiter:not("+transmitersList+")").remove();
	/*markerCluster = new MarkerClusterer(map, markersAircrafts,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
	);*/
}
$(document).off('click', '.transmiter').on('click', '.transmiter', function(){
	clearAircrafts();

	$(".info").hide();
	$("#receiverDetail").show();
	map.panTo(new google.maps.LatLng(parseFloat($(this).attr("lat")), parseFloat($(this).attr("lon"))))
	activeFlarm=$(this).attr("flarmId");
	
});

var stations=[];
var stationsIcons=[];
var activeWaypoints=[];
var map;
var waypoints=[]
var signals=[]
var aircrafts={};
var airIcons=[];
var timerMove, activeBounds, mapLoaded=false;
var headerHeight=0;
var activeStation="";
var activeFlarm=""
var flightTrack;
var flightPath = [];
var gotFlightTrack=0
var tx={}, rx={};
var busy=false;


function getAir(){
	if(mapLoaded==true&&busy==false){
		var data="ne_lat=" + activeBounds.getNorthEast().lat() + 
		"&ne_lon=" + activeBounds.getNorthEast().lng() + 
		"&sw_lat=" + activeBounds.getSouthWest().lat() + 
		"&sw_lon=" + activeBounds.getSouthWest().lng() + 
		"&activeFlarm=" + activeFlarm;
		
		$.ajax({
			url:"/node/data.php",
			data: data,
			type:"GET",
			dataType:"json",
			timeout:3000,
			 
			complete: function(){
				timerMove=setTimeout(function(){
					getAir();
				},1000)				
			},
			success: function(json){
				//(json.stations.length==0) ? $("#receiversCount").html("RX<br>0") : $("#receiversCount").html("RX<br>"+ json.stations.length +"");
				//(json.aircrafts.length==0) ? $("#transmitersCount").html("TX<br>0") : $("#transmitersCount").html("TX<br>"+ json.aircrafts.length +"");
				//(json.waypointsCount==0) ? $("#waypointsCount").html("WPS<br>0") : $("#waypointsCount").html("WPS<br>"+ json.waypointsCount +"");
				
				stations=json.stations;
				activeWaypoints=json.activeWaypoints;
				for(i=0;i<json.stations.length;i++){
					var obj={ 
						lat:parseFloat(json.stations[i].lat), 
						lon:parseFloat(json.stations[i].lon), 
						alt:parseInt(json.stations[i].alt), 
						pkgs:parseInt(json.stations[i].pkgs), 
						age:parseInt(json.stations[i].age), 
						cpu: (json.stations[i].status.indexOf("RPI-GPU")!=-1) ? parseFloat(json.stations[i].cpu)*50 : parseFloat(json.stations[i].cpu)*100,
						temp:parseFloat(json.stations[i].temp),
						maxDistance:parseFloat(json.stations[i].maxDistance),
						
						trackingAircrafts:parseInt(json.stations[i].trackingAircrafts),
						station:(json.stations[i].station),
						status:(json.stations[i].status),
						version:(json.stations[i].version),
						rf:(json.stations[i].rf)
					}
					
					if(rx[json.stations[i].station]){
						obj.marker=rx[json.stations[i].station].marker;
						obj.hasMarker=1;
					}else{
						obj.hasMarker=0;	
					}
					rx[json.stations[i].station]=obj
				}
				aircrafts=json.aircrafts
				for(i=0;i<json.aircrafts.length;i++){
					var flarmId=json.aircrafts[i].flarmId
					var aircraftType="GLIDER";
					if(json.aircrafts[i].aircraft.toLowerCase().indexOf("pa-18")>=0) aircraftType="TOW"
					aircrafts[i].aircraftType=aircraftType;
					aircrafts[i].flarmId=flarmId;
					var obj={ 
						flarmId:flarmId,
						lat:parseFloat(json.aircrafts[i].lat),  
						lon:parseFloat(json.aircrafts[i].lon), 
						altitude:parseInt(json.aircrafts[i].altitude),
						agl:parseInt(json.aircrafts[i].agl),
						course:parseInt(json.aircrafts[i].course), 
						station:json.aircrafts[i].station, 
						sensitivity:parseFloat(json.aircrafts[i].sensitivity),
						stationAlt:parseFloat(json.aircrafts[i].stationAlt),
						stationLat:parseFloat(json.aircrafts[i].stationLat), 
						stationLon:parseFloat(json.aircrafts[i].stationLon), 
						distance:parseFloat(json.aircrafts[i].distance), 
						speed:Math.round(json.aircrafts[i].speed), 
						climb:parseFloat(json.aircrafts[i].climb), 
						rot:parseFloat(json.aircrafts[i].rot),
						registration:json.aircrafts[i].registration,
						aircraft:json.aircrafts[i].aircraft,
						aircraftType:aircraftType,
						age:parseInt(json.aircrafts[i].age)
					}
					if(tx[flarmId]){
						obj.marker=tx[flarmId].marker;
						obj.hasMarker=1;
						obj.active=tx[flarmId].active;	
					}else{
						obj.hasMarker=0;
						obj.active=0;	
					}
					tx[flarmId]=obj;
					if(activeFlarm==flarmId){
						if($("#chartOut").is(":visible")){
							//if(chartType=="SPEED") chartDataDraw.addRows([ [json.aircrafts[i].time, parseFloat(json.aircrafts[i].speed)] ]);
							//if(chartType=="VARIO") chartDataDraw.addRows([ [json.aircrafts[i].time, obj.climb] ])
							//if(chartType=="ALT") drawChartAlt(); //chartDataDraw.addRows([ [json.aircrafts[i].time, parseFloat(json.aircrafts[i].altitude), parseFloat(json.aircrafts[i].ground)] ])
							//var data = google.visualization.arrayToDataTable(chartData);
							//try{chart.draw(chartDataDraw, chartOptions);}catch(e){}
										
						}
					}
				}				
				createStations();
				//createAircrafts()
				
			}
			
		});
	}
}

function distance(lat1, lon1, lat2, lon2) {
  var p = 0.017453292519943295;    // Math.PI / 180
  var c = Math.cos;
  var a = 0.5 - c((lat2 - lat1) * p)/2 + 
          c(lat1 * p) * c(lat2 * p) * 
          (1 - c((lon2 - lon1) * p))/2;

  return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}

var zIndex=1
var stationRangle
	
function setupNearby(station){
	rx[station].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
	//console.log(google.maps.Marker.MAX_ZINDEX + zIndex);
	zIndex++;
	
	$.ajax({
		url:"/node/data.php?FLAG=NEARBY&station="+activeStation,
		data: "",
		type:"POST",
		dataType:"json",
		success: function(json){
			var html=""
			for(i=0;i<json.nearbyStations.length;i++){
				var color=(json.nearbyStations[i].age<360) ? "nearbyOn" : "nearbyOff";
				html+='<span class="nearbyStation '+color+'" station="'+json.nearbyStations[i].station+'">' + json.nearbyStations[i].station + '</span>';
			}
			html=="" ? $(".nearbyStations").hide() : $(".nearbyStations").show().html("Nearby: " + html);
			calcMapSize();
		}
		
	});	
	
	stationRangle = new google.maps.Circle({
		strokeColor: '#9999CC',
		strokeOpacity: 0.5,
		strokeWeight: 2,
		fillColor: '#66FFFF',
		fillOpacity: 0.15,
		map: map,
		center: new google.maps.LatLng(rx[station].lat, rx[station].lon),
		radius: rx[station].maxDistance*1000
	});		
}
function formatpkgs(p){
	if(p<10000){
		return p		
	}else{
		return Math.round(p/100)/10 + "k";
	}
}

$(document).off('click', '.station, .nearbyStation').on('click', '.station, .nearbyStation', function(){
clearTopLayer()

	activeStation=$(this).attr("station");
	$(".info").hide();
	$("#stationDetail").show();	
	infowindow.setContent($(this).attr("station"));
	try{
		infowindow.open(map, rx[$(this).attr("station")].marker);
		map.panTo(new google.maps.LatLng(parseFloat(rx[$(this).attr("station")].lat), parseFloat(rx[$(this).attr("station")].lon)))
		
	}catch(e){}
	setupNearby(activeStation)
});
$('#openmenu').off('click').on('click', function(){
	$(".info").hide();
	$("#menu").show();
	calcMapSize()
	
});
$('#closemenu').off('click').on('click', function(){
	$("#menu").hide();
	calcMapSize()
});
$(document).off('click', '.submenus').on('click', '.submenus', function(){
	$(".info").hide();
	$(".closeChart").click();
	$("#" + $(this).attr("type")).show();
	if($(this).attr("type")=="stations"){
		$(".station").removeClass('stationFocus');
		$(".station").first().addClass('stationFocus');
	}
	if($(this).attr("type")=="waypoints") waypointsLoad();
	if($(this).attr("type")=="logs") logsLoad();
});
var ZoomLevel=100
$(function(){
	var reqZoom=parseInt($(document).width()*100/1300)
	console.log(reqZoom)
	//document.body.style.zoom = reqZoom + "%"
	setTimeout(function(){
		$("#map").width($(document).width())
		if(!$.cookie("lat")) $.cookie("lat", -33.380167)
		if(!$.cookie("lon")) $.cookie("lon", -70.5825)
		if(!$.cookie("zoom")) $.cookie("zoom", 12)
		if(!$.cookie("visible")) $.cookie("visible", "all")
		if(!$.cookie("clusterTX")) $.cookie("clusterTX", "1")
		if(!$.cookie("clusterRX")) $.cookie("clusterRX", "1")
		if(!$.cookie("mapType")) $.cookie("mapType", "roadmap")
		$("#mp" + $.cookie("mapType")).prop("checked", true);
		$("#view" + $.cookie("visible")).prop("checked", true);
		$("#clusterTX" + $.cookie("clusterTX")).prop("checked", true);
		$("#clusterRX" + $.cookie("clusterRX")).prop("checked", true);
		initMap();
		$("#cpu").kendoRadialGauge({
			pointer: {value: 0},
			scale: {
				minorUnit: 5,majorUnit: 20, startAngle: -90, endAngle: 180, max: 100, 
				minorTicks:{size:4},
				majorTicks:{size:7,visible: true},
				labels: {position: "inside", font:"14px Arial"},
				ranges: [
					{from: 0, to: 65, color: "#009933"
					}, {from: 65, to: 75, color: "#ffc700"
					}, {from: 75, to: 85, color: "#ff7a00"
					}, { from: 85, to: 100, color: "#c20000"
					}
				]
			}
		});
	
	
		$("#temp").kendoRadialGauge({
			pointer: {value: 0},
			scale: {
				minorUnit: 5, majorUnit: 25, startAngle: -90, endAngle: 180, max: 100,
				minorTicks:{size:4},
				majorTicks:{size:7, visible: true},
				labels: {position: "inside", font:"14px Arial"},
				ranges: [
					{from: 0, to: 35, color: "#009933"
					}, {from: 35, to: 55, color: "#ffc700"
					}, {from: 55, to: 75, color: "#ff7a00"
					}, {from: 75, to: 100, color: "#c20000"}
				]
			}
		});
	},1000)
})
window.addEventListener("resize", function() {
    // Announce the new orientation number
    calcMapSize()
}, false);
function calcMapSize(){
	var currCenter = map.getCenter();
	var ancho=$("#menu").css("display")=="none" ? 0 : 300;
	$("#map").width($(window).width()-ancho)
	$("#map").height($(window).height())
	$("#menu").height($(window).height());
	
	google.maps.event.trigger(map, 'resize');
	map.setCenter(currCenter);
}
var html
function logsLoad(){
	var data="FLAG=LOGS&ne_lat=" + activeBounds.getNorthEast().lat() + 
	"&ne_lon=" + activeBounds.getNorthEast().lng() + 
	"&sw_lat=" + activeBounds.getSouthWest().lat() + 
	"&sw_lon=" + activeBounds.getSouthWest().lng();

	html='<table width="100%" border="0" cellspacing="1" cellpadding="2" id="tblLogs">' + 
	  '<tr>' + 
	  '<td></td>' + 
	  '<td>Max Alt</td>' +
	  '<td>Takeoff</td>' + 
	  '<td>Landing</td>' + 
	  '<td>FL Time</td>' + 
	  '</tr>' + 
	  '</table>';
	$.ajax({
				
		url:"/node/data.php",
		data: data,
		type:"GET",
		dataType:"json",
		success: function(json){
			//$(".logs").empty();
			$(".logs").html(html);
			for(i=0;i<json.flights.length;i++){
				var data=json.flights[i];


				//var distance=(Math.round(item.distance*10)/10)
				//var transmitersIcon=(item.age>60) ? 0 : 1;
				//var transmitersStatusColor=(item.age>60) ? "#ff0000" : "#6C9F43";
				var ptime=json.flights[i].plane_time;
				var gtime=json.flights[i].glider_time;	
				if(ptime!="-----"){
					ptime=ptime.replace("h",":");
					ptime=ptime.replace("m",":");
					ptime=ptime.replace("s","");
					ptime=ptime.substr(0, ptime.length-3)
				}
				if(gtime!="-----"){
					gtime=gtime.replace("h",":");
					gtime=gtime.replace("m",":");
					gtime=gtime.replace("s","");
					gtime=gtime.substr(0, gtime.length-3)
				}
				if(json.flights[i].plane!==""&&json.flights[i].glider===""){
					var landed=json.flights[i].plane_landing!="" ? '<img src="/node/img/landed.png" style="float:right">' : '';
					html='<tr class="tow">' + 
					  '<td>' + json.flights[i].plane + '</td>' + 
					  '<td>' + json.flights[i].towplane_max_alt + '</td>' + 
					  '<td>' + json.flights[i].takeoff + '</td>' + 
					  '<td>' + json.flights[i].plane_landing + '</td>' + 
					  '<td>' + ptime + landed + '</td>' + 
					  '</tr>';
					  $('#tblLogs tr:last').after(html);
				}
				if(json.flights[i].plane!==""&&json.flights[i].glider!==""){
					var landed=json.flights[i].plane_landing!="" ? '<img src="/node/img/landed.png" style="float:right">' : '';
					html='<tr class="tow">' + 
					  '<td>' + json.flights[i].plane + '</td>' + 
					  '<td>' + json.flights[i].towplane_max_alt + '</td>' + 
					  '<td>' + json.flights[i].takeoff + '</td>' + 
					  '<td>' + json.flights[i].plane_landing + '</td>' + 
					  '<td>' + ptime + landed + '</td>' + 
					  '</tr>';
					  $('#tblLogs tr:last').after(html);

					var landed=json.flights[i].glider_landing!="" ? '<img src="/node/img/landed.png" style="float:right">' : '';
					html='<tr class="glide">' + 
					  '<td colspan="3"><img src="/node/img/arrow.TO.png" width="22" height="12">' + json.flights[i].glider + '</td>' + 
					  '<td>' + json.flights[i].glider_landing + '</td>' + 
					  '<td>' + gtime + landed + '</td>' + 
					  '</tr>';
					  $('#tblLogs tr:last').after(html);
				}
				if(json.flights[i].plane===""&&json.flights[i].glider!==""){
					var landed=json.flights[i].glider_landing!="" ? '<img src="/node/img/landed.png" style="float:right">' : '';
					html='<tr class="glide">' + 
					  '<td colspan="2">' + json.flights[i].glider + '</td>' + 
					  '<td>' + json.flights[i].takeoff + '</td>' + 
					  '<td>' + json.flights[i].glider_landing + '</td>' + 
					  '<td>' + gtime + landed + '</td>' + 
					  '</tr>';
					  $('#tblLogs tr:last').after(html);
				}
				
				//$("#transmitersIcon" + item.waypoint).css('background-image', 'url(/node/img/'+item.aircraftType+'.'+transmitersIcon+'.png)');
						
			}
		}
		
	});	
}

function coverageLoad(station){
	for(i=0;i<signals.length;i++){
		try{signals[i].setMap(null);}catch(e){}	
	}
	signals=[];
	$.ajax({
		url:"/node/data.php?FLAG=COVERAGE&station="+station,
		type:"GET",
		dataType:"json",
		success: function(json){
			var data=json.coverage;
			var maxS=parseInt(json.max);
			console.log(maxS)
			for(i=0;i<data.length;i++){
				var circle = new google.maps.Marker({
					position: new google.maps.LatLng(data[i].lat, data[i].lon),
					icon: {
						path: google.maps.SymbolPath.CIRCLE,
						scale: 6,
						strokeColor: "green",
						strokeOpacity: 1.0,
						strokeWeight: 2,
						fillColor: '#green',
						fillOpacity: parseInt(data[i].signals)/maxS			
					},
					title:data[i].signals + "/" + maxS,
					map: map
				});
  				signals.push(circle);
			}
		}
		
	});	
}
function waypointsLoad(){
	var data="FLAG=WAYPOINTS&ne_lat=" + activeBounds.getNorthEast().lat() + 
	"&ne_lon=" + activeBounds.getNorthEast().lng() + 
	"&sw_lat=" + activeBounds.getSouthWest().lat() + 
	"&sw_lon=" + activeBounds.getSouthWest().lng()
	$.ajax({
				
		url:"/node/data.php",
		data: data,
		type:"GET",
		dataType:"json",
		success: function(json){
			$(".waypoints").empty();
			for(i=0;i<waypoints.length;i++){
				try{waypoints[i].marker.setMap(null);}catch(e){}	
			}
			for(i=0;i<json.waypoints.length;i++){
				var data=json.waypoints[i];
				var myLatLng = {lat: parseFloat(data.waypointLat), lng: parseFloat(data.waypointLon)};
				var marker = new google.maps.Marker({
					icon: {
						url: "/node/img/wp." + data.waypointType + ".png",
						size: new google.maps.Size(24,24)
					},
					position: myLatLng,
					title: data.waypoint,
					map: map
				});
							
				var obj={ 
					waypointlat:parseFloat(data.waypointLat), 
					waypointLon:parseFloat(data.waypointLon), 
					waypoint:data.waypoint, 
					idWaypoint:data.idWaypoint,
					marker:marker
				}
				waypoints.push(obj);
				//var distance=(Math.round(item.distance*10)/10)
				//var transmitersIcon=(item.age>60) ? 0 : 1;
				//var transmitersStatusColor=(item.age>60) ? "#ff0000" : "#6C9F43";
				var html='<div class="waypointsIcon" id="waypoints' + data.idWaypoint + '" style="background-image:url(/node/img/wp.' + data.waypointType + '.png);"></div><strong>' + data.waypoint + ' ' + data.waypointCountry + '</strong><br>Lat: ' + data.waypointLat + ' Lon: ' + data.waypointLon + ' Alt: ' + data.altitude + 'M<br>'
					
				$node='<div class="waypoint" waypoint="' + data.waypoint + '" id="waypoint' + data.idWaypoint + '" lat="' + data.waypointLat + '" lon="' + data.waypointLon + '" alt="' + data.altitude + '">' +
				'<div class="waypointsData"><div class="waypointsStation"  style="overflow:hidden" id="waypointsStation' + data.idWaypoint + '">'+html+'</div></div></div>'
				if($('#waypoint' + data.idWaypoint).length==0){
					$(".waypoints").append($node);
				}else{
					$('#waypointStation' + data.idWaypoint).html(html)
				}
				//$("#transmitersIcon" + item.waypoint).css('background-image', 'url(/node/img/'+item.aircraftType+'.'+transmitersIcon+'.png)');
						
			}
		}
		
	});	
}

function formatAge(age){
	//if(age<60) return age + "s";
	if(age>=60&&age<(60*60)){
		 var minute=parseInt(age/60)
		 var second=age-(minute*60)
		 //return minute + "m " + second + "s";
	}
	if(age>=(60*60)){
		 var hour=parseInt(age/60/60)
		 var minute=age-(hour*60*60)
		 var second=age-(minute*60)
		 //return hour + "h " + minute + "m " + second + "s";
	}
	var date = new Date(null);
	date.setSeconds(age); // specify value for SECONDS here
	return date.toISOString().substr(11, 8);
	
}
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89195032-1', 'auto');
  ga('send', 'pageview');

function ga_heartbeat(){
  _gaq.push(['_trackEvent', 'Heartbeat', 'Heartbeat', '', 0, true]);
  
}
function clearTopLayer(){
	$(".button").removeClass("buttonTrack buttonRadar buttonLock buttonChartsColor");
	for(i=0;i<waypoints.length;i++){
		try{waypoints[i].marker.setMap(null);}catch(e){}	
	}
	for(i=0;i<signals.length;i++){
		try{signals[i].setMap(null);}catch(e){}	
	}	
	for (var i = 0; i < flightPath.length; i++) {
		try{flightPath[i].setMap(null);}catch(e){};
	}
	flightPath=[];	
	$("#header").hide();
	$("#stationDetail").hide();
	infowindow.close();
	$(".receivers").hide();
	$(".transmiters").hide();
	$(".waypoints").hide();
	$(".chartOut").hide();
	$("#btnLock").attr('btnLock','0')
	//$("#map").height($(window).height())
	activeFlarm="";
	activeStation="";
	try{flightTrack.setMap(null);}catch(e){}
	try{stationRangle.setMap(null);}catch(e){}
	
	line.setPath([]);
	flightTrack.setPath([])
	flightPath=[];
	radarOn=0
	trackOn=0
	calcMapSize();
}
setInterval(function(){ga_heartbeat}, 3*60*1000);

function clearAircrafts(){
	$(".chartOut").hide();
	try{line.setMap(null);}catch(e){}

	try{flightTrack.setMap(null);}catch(e){}
	line.setPath([]);
	flightTrack.setPath([])
	flightPath=[];
	radarOn=0
	trackOn=0
	$("#radar").attr("src", "/node/img/radar.0.png")
	$("#track").attr("src", "/node/img/track.0.png")
		
	$.each(tx, function(i, item) {
		
		var color=(item.age>300||item.speed<10) ? offlineColor : onlineColor;	
		var rtMaster=(item.aircraftType=="TOW") ? -45 : 45;								
		item.marker.setIcon({
			path:(item.aircraftType=="GLIDER") ? glider: tow,
			fillColor: color,
			fillOpacity: 1,
			strokeWeight: 1,
			strokeColor: color,
			size: new google.maps.Size(20,20),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(19,15),		
			rotation: item.course+rtMaster
		})				
	});	
}

function getTask(){
	$.ajax({
		url:"/node/data?FLAG=TASK",
		type:"POST",
		dataType:"json",
		success: function(json){
			try{
				var task=[];
				tasksInfoWindow=[]
				for(i=0;i<json.task.turnpoints.length;i++){
					var data=json.task.turnpoints[i];
					task.push({lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)});
					var url="/node/img/task.tp.1.png";
					if(data.type=="Start"){
						url="/node/img/task.start.1.png";
						//var angleDeg = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
						var p1=new google.maps.LatLng(parseFloat(json.task.turnpoints[i].latitude), parseFloat(json.task.turnpoints[i].longitude))
						var p2=new google.maps.LatLng(parseFloat(json.task.turnpoints[i+1].latitude), parseFloat(json.task.turnpoints[i+1].longitude))
						
						var heading = google.maps.geometry.spherical.computeHeading(p1,p2);
						var endPoint1 = google.maps.geometry.spherical.computeOffset(p1, data.rad, heading-90);
						var endPoint2 = google.maps.geometry.spherical.computeOffset(p1, data.rad, heading+90);
						var startLine=[];
						startLine.push(endPoint1);
						startLine.push(endPoint2);
						var flightTask = new google.maps.Polyline({
							path: startLine,
							geodesic: true,
							strokeColor: 'green',
							strokeOpacity: 1.0,
							strokeWeight: 4.5,
							map:map
						});	
						var marker = new google.maps.Marker({
							position: p1,
							icon: {
								url:"/node/img/task.start.end.png",
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(0, 32)
							},
							map: map
						});	
						var content="<strong>Start Line</strong>";
						var infowindow = new google.maps.InfoWindow()
						google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
							return function() {
								infowindow.setContent(content);
								infowindow.open(map,marker);
								//windows.push(infowindow)
								google.maps.event.addListener(map,'click', function(){ 
									infowindow.close();
								}); 
							};
						})(marker,content,infowindow)); 	
										
					}
					if(data.type=="Finish"){
						url="/node/img/task.end.1.png";
						var p1=new google.maps.LatLng(parseFloat(json.task.turnpoints[i-1].latitude), parseFloat(json.task.turnpoints[i-1].longitude))
						var p2=new google.maps.LatLng(parseFloat(json.task.turnpoints[i].latitude), parseFloat(json.task.turnpoints[i].longitude))
						
						var heading = google.maps.geometry.spherical.computeHeading(p1,p2);
						var endPoint1 = google.maps.geometry.spherical.computeOffset(p2, data.rad, heading-90);
						var endPoint2 = google.maps.geometry.spherical.computeOffset(p2, data.rad, heading+90);
						var startLine=[];
						startLine.push(endPoint1);
						startLine.push(endPoint2);
						var flightTask = new google.maps.Polyline({
							path: startLine,
							geodesic: true,
							strokeColor: 'blue',
							strokeOpacity: 1.0,
							strokeWeight: 4.5,
							map:map
						});			
						var marker = new google.maps.Marker({
							position: p2,
							icon: {
								url:"/node/img/task.start.end.png",
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(0, 32)
							},
							map: map
						});
						var content="<strong>Finish Line</strong>";
						var infowindow = new google.maps.InfoWindow()
						google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
							return function() {
								infowindow.setContent(content);
								infowindow.open(map,marker);
								//windows.push(infowindow)
								google.maps.event.addListener(map,'click', function(){ 
									infowindow.close();
								}); 
							};
						})(marker,content,infowindow)); 								
										
					}
					if(data.type=="Turnpoint"){

						var cityCircle = new google.maps.Circle({
							strokeColor: 'cyan',
							strokeOpacity: 0.8,
							strokeWeight: 1,
							fillColor: 'cyan',
							fillOpacity: 0.15,
							map: map,
							center: {lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)},
							radius: data.rad
						});
						
						var marker = new google.maps.Marker({
							position: {lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)},
							icon: {
								url:url,
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(8, 32)
							},
							map: map
						});

						var content="<strong>" + data.name + "</strong><br>Radius: " + Math.round(data.rad/1000) + "Km";
						var infowindow = new google.maps.InfoWindow()
						google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
							return function() {
								infowindow.setContent(content);
								infowindow.open(map,marker);
								//windows.push(infowindow)
								google.maps.event.addListener(map,'click', function(){ 
									infowindow.close();
								}); 
							};
						})(marker,content,infowindow)); 
			
						/*
						var infowindow = new google.maps.InfoWindow({
							content: data.name
						});						
						marker.addListener('click', function() {
							infowindow.open(map, marker);
						});
						*/																	
										
					}
					
			
				}
				var flightTask = new google.maps.Polyline({
					path: task,
					geodesic: true,
					strokeColor: 'yellow',
					strokeOpacity: 1.0,
					strokeWeight: 2.5,
					map:map
				});			
			}catch(e){}
		}
		
	});	
}

function displayData(dataPoint){
	
	var imgClimb="0";
	
	if(dataPoint.climb>0){
		imgClimb="1";
	}else if(dataPoint.climb<0){
		imgClimb="-1";
	}
	//flightPath.push({lat: dataPoint.lat, lng: dataPoint.lon, vario: dataPoint.vario})
	var climb=(Math.round(dataPoint.climb*10)/10)
	tx[dataPoint.flarmId].active=1;
	var registration=dataPoint.registration;
	if(registration==null) registration="N/A";
	var distanceToStation=""
	distanceToStation=" " + Math.round(distance(dataPoint.lat, dataPoint.lon, dataPoint.stationLat, dataPoint.stationLon)*10)/10
	
	if(activeWaypoints.length>0){
		var html=""
		for(i=0;i<activeWaypoints.length;i++){
			altitudeDelta=(activeWaypoints[i].altitudeDelta>0) ? '#6C9F43' : 'red';
			if(activeWaypoints[i].altitudeDelta<0){
				activeWaypoints[i].altitudeDelta=activeWaypoints[i].altitudeDelta*-1
			}
			html+="<div class='breakLine'></div><div style='height:30px; overflow:hidden'>"+
			"<div style='height:30px; width:140px;overflow:hidden; float:left'>"+
			"<div style='width:20px; height:15px; float:left'><img src='/node/img/wp." + activeWaypoints[i].waypointType + ".png' width='16' height='16'/></div>" + 
			"<div style='width:100px; float:left; overflow:hidden'>" + activeWaypoints[i].waypoint + "</div>" + 
			"</div><div style='width:140px;overflow:hidden; float:left;'>"+
			"<div style='width:60px; float:left; overflow:hidden'>" + activeWaypoints[i].distance + "km</div>" + 
			"<div style='width:40px; height:15px; float:left; overflow:hidden'>" + activeWaypoints[i].bearingRose + "</div>" + 
			"<div style='width:60px; height:15px; float:left; overflow:hidden'>" + activeWaypoints[i].altitude + "m</div>" + 
			"<div style='width:65px; height:15px; float:left; overflow:hidden; color:"+ altitudeDelta + "'>" + activeWaypoints[i].altitudeDelta + "m</div>" + 
			"</div></div>";
		}
		$("#nearByWaypoints").html(html);	
	}else{
		$("#nearByWaypoints").html("");
		
	}
	var dist=((parseFloat(dataPoint.distance)*1000 ))
	var altDelta=(parseFloat(dataPoint.altitude)-parseFloat(dataPoint.stationAlt))
	var xForm=altDelta/dist
	var sightAngle=parseInt(Math.atan(xForm)/(Math.PI/180))
	$("#sight").html(sightAngle);
	$("#signal").html(dataPoint.sensitivity);
	if(dataPoint.sensitivity<10) $("#signalIcon").attr("src", "/node/img/sig.0.png")
	else if(dataPoint.sensitivity>=10&&dataPoint.sensitivity<20) $("#signalIcon").attr("src", "/node/img/sig.1.png")
	else if(dataPoint.sensitivity>=20&&dataPoint.sensitivity<30) $("#signalIcon").attr("src", "/node/img/sig.2.png")
	else if(dataPoint.sensitivity>=30&&dataPoint.sensitivity<40) $("#signalIcon").attr("src", "/node/img/sig.3.png")
	else if(dataPoint.sensitivity>=40) $("#signalIcon").attr("src", "/node/img/sig.4.png")
	$("#aircraftType").text(dataPoint.aircraftType);
	$("#compass").css({transform: 'rotate(' + dataPoint.course + 'deg)'})
	$("#header").show();
	$("#reg").html(registration)
	$("#flarm").html(dataPoint.flarmId)
	$("#aircraft").text(dataPoint.aircraft + " (" + formatAge(dataPoint.age) + ")")
	$("#aprs").text(dataPoint.station)
	$("#aprsDistance").text(distanceToStation)
	$("#speed").text(dataPoint.speed)
	$("#altitude").text(dataPoint.altitude)
	$("#agl").text(dataPoint.agl)
	$("#course").text(Math.round(dataPoint.course) + "º")
	$("#verticalSpeedIcon").attr("src", "/node/img/altitude" + imgClimb + ".png");
	$("#verticalspeed").html(climb)
	/*if(flightPath.length==1){
		
		flightTrack = new google.maps.Polyline({
			path: flightPath,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		});	
		flightTrack.setMap(map);
	}
	if(flightPath.length>1){
		flightTrack.setMap(map);
	}*/
	return false;
}



function parsePX(v){
	return v.replace("px", "");
}

$(document).off('click', '.closeChart').on('click', '.closeChart', function(){
	$(".buttonChart").removeClass("buttonChartsColor");
	$(".chartOut").hide();
});
function setUpChart(){
	$(".chartOut").show();
	$(".chartOutW").css({"top": 0, "width": parsePX($("#menu").css("left"))})
	$(".closeChart").css("left",$(".chartOutW").width()-28);
	
}

var chartType=""
var chartData=[];
var chart;
var chartOptions;
var chartDataDraw;
function drawChartAlt() {
	chartType="ALT";
	chartData=[];
	try{
		$.ajax({
			url:"/node/data.php?FLAG=ALT&FLARM=" + activeFlarm,
			data: "",
			type:"POST",
			dataType:"json",
			success: function(data){
			data=data.track
			chartData=[];
			chartData.push(["TIME", "ALT", "GRN"])
			for(i=(data.length-1);i>=0;i--){
				chartData.push([data[i].time, parseFloat(data[i].altitude), parseFloat(data[i].ground)])
			}
			
			chartOptions = {
				legend: {position: 'none'},
				backgroundColor: '#eee',
				title: 'Altitude Track',
				chartArea:{left:70,top:20,width:$(window).width()-70,height:85},
				vAxis: {
					ticks: [0,1000,2000,3000,4000,5000,6000]
				}
			};
			if(chartData.length>1){
				chartDataDraw = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(chartDataDraw, chartOptions);
				}
			}
		
		});	
	}catch(e){}
}
function drawChartVario() {
	chartType="VARIO"
	chartData=[];
	try{
		$.ajax({
			url:"/node/data.php?FLAG=VARIO&FLARM=" + activeFlarm,
			data: "",
			type:"POST",
			dataType:"json",
			success: function(data){
			data=data.vario
			chartData=[];
			chartData.push(["TIME", "VARIO"])
			for(i=data.length-1;i>=0;i--){
				chartData.push([data[i].time, parseFloat(data[i].vario)])
			}
			
			
			chartOptions = {
				legend: {position: 'none'},
				backgroundColor: '#eee',
				title: 'Vario Track',
				chartArea:{left:70,top:20,width:$(window).width()-70,height:85},
				vAxis: {
					ticks: [-10,-5,0,5,10]
				}
			};
			if(chartData.length>1){
				chartDataDraw = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(chartDataDraw, chartOptions);
				}
			}
			
		});
	}catch(e){}	
}

function drawChartSpeed() {
	chartData=[];
	chartType="SPEED"
	try{
		
		$.ajax({
			url:"/node/data.php?FLAG=SPEED&FLARM=" + activeFlarm,
			data: "",
			type:"POST",
			dataType:"json",
			success: function(data){
			data=data.speed
			chartData=[];
			chartData.push(["TIME", "SPEED"])
			for(i=data.length-1;i>=0;i--){
				chartData.push([data[i].time, parseFloat(data[i].speed)])
			}
			
			chartOptions = {
				legend: {position: 'none'},
				backgroundColor: '#eee',
				title: 'Speed Track',
				chartArea:{left:70,top:20,width:$(window).width()-70,height:85},
				vAxis: {
					ticks: [0,75,150,225]
				}
			};
			if(chartData.length>1){
				chartDataDraw = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(chartDataDraw, chartOptions);
				}
			}
		});	
	}catch(e){}
}

var tow="m 15.388371,4.7812376 c 0.06737,0.067371 0.06088,0.1535326 -0.171754,0.656096 -0.02746,0.059318 -0.18034,0.2765235 -0.18034,0.2765235 -10e-7,-1e-6 0.102687,0.1129918 0.130532,0.1408372 0.05383,0.053834 0.07864,0.1746392 0.05668,0.2696526 -0.06814,0.2947833 -0.8899,1.4704243 -1.349979,1.9305048 -0.285512,0.2855112 -0.432705,0.4805551 -0.422513,0.5599149 0.0086,0.06697 0.116774,0.3550941 0.240455,0.6389223 0.218228,0.5008044 0.299971,0.5993204 2.76179,3.3388821 1.949531,2.169479 2.546055,2.86956 2.58145,3.028007 0.09814,0.43933 -0.282015,0.847468 -1.264103,1.35685 l -0.506673,0.262782 c 0,0 -7.3888187,-5.289995 -7.3888187,-5.289995 l -4.429513,3.364643 0.101334,0.18034 c 0.055981,0.09885 0.518862,0.676109 1.028802,1.282996 0.509938,0.606889 0.932924,1.160835 0.939489,1.231471 0.026392,0.283961 -1.110644,1.177107 -1.281278,1.006472 -0.269318,-0.269317 -1.398977,-1.131169 -1.494252,-1.14044 -0.068024,-0.0066 -1.039054,-0.747073 -1.368872,-1.076892 -0.329819,-0.329818 -1.070274,-1.300849 -1.076892,-1.368872 -0.00927,-0.09528 -0.871124,-1.224934 -1.140441,-1.494253 -0.17063503,-0.170635 0.722512,-1.30767 1.006474,-1.281277 0.070635,0.0066 0.624579,0.42955 1.231469,0.939488 0.606887,0.50994 1.184148,0.972821 1.282997,1.028802 l 0.180339,0.101334 3.364644,-4.429513 c 0,0 -5.289996,-7.3888202 -5.289997,-7.3888202 l 0.262784,-0.506672 c 0.509382,-0.9820888 0.917519,-1.3622407 1.356849,-1.2641029 0.158448,0.035395 0.858528,0.6319166 3.028007,2.5814488 2.7395627,2.4618182 2.8380777,2.5435617 3.3388797,2.7617902 0.283829,0.1236801 0.571952,0.2318519 0.638923,0.2404552 0.07936,0.010191 0.274402,-0.1370033 0.559915,-0.4225135 0.460079,-0.4600805 1.635721,-1.2818435 1.930505,-1.3499793 0.09501,-0.021963 0.215817,0.00284 0.269652,0.056678 0.02785,0.027846 0.139121,0.1288154 0.139121,0.1288154 0,0 0.217204,-0.1528832 0.276522,-0.1803404 0.502564,-0.2326341 0.590442,-0.2374085 0.657815,-0.1700356 z"

var glider="M15.222242261163544,17.778045386418853 l0.03751711736144195,0.03751711736144195 l-5.050741924784112,5.048610270388576 c-0.9694764190899875,0.9716080734855234 -3.2439516591274002,2.3222242984974315 -3.2439516591274002,2.3222242984974315 a0.7337154429436532,0.7337154429436532 0 0 1 -0.9456018898599785,-1.1152815797446822 l7.747284735137747,-7.74685840425864 zm9.88490776298172,-11.756926653141848 a0.7337154429436532,0.7337154429436532 0 0 0 -1.0372630288680469,0 l-7.747284735137747,7.747284735137747 l1.4537882977558736,1.4537882977558736 l0.03751711736144195,0.03751711736144195 l5.048610270388576,-5.049036601267684 c0.9694764190899875,-0.9694764190899875 2.3222242984974315,-3.2439516591274002 2.3222242984974315,-3.2439516591274002 a0.7337154429436532,0.7337154429436532 0 0 0 -0.07759221999752759,-0.9456018898599785 zm-2.235679130038649,13.610186984621254 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9912192939244586,0.41013030570121717 l-1.8404704051061884,1.8404704051061884 a1.4022022613838911,1.4022022613838911 0 0 0 0,1.982864918728024 l0.25579852746437626,0.25579852746437626 l3.82376165471332,-3.8233353238342134 l-0.25579852746437626,-0.25579852746437626 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9920719556826738,-0.41013030570121717 zm-1.995228514222136,0.4497790774581954 l-0.7968124130515336,0.7968124130515336 c-1.7424143029115111,-1.732608692692044 -2.7378969056270432,-2.643251450465223 -4.376712804915481,-3.58117938450127 l-1.6742013622543443,-1.676333016649881 c-2.728517626286682,-2.728517626286682 -2.777119346504914,-3.6839251263661286 -2.435201981460864,-4.026268822289285 c0.08142919790949325,-0.08142919790949325 0.20293349845507222,-0.1402628592262999 0.38369779119656483,-0.1402628592262999 c0.5388822311916196,0 1.597461804015031,0.5299292827303667 3.6434236928509343,2.575464840687164 l1.6750540240125584,1.6750540240125584 c0.9357962796405109,1.6400948919257603 1.8489970226883348,2.634724832883078 3.5807530536221632,4.376712804915481 zm-6.688705162314335,-6.941519373624962 c-1.4623149153380188,-1.272171343256165 -2.1252594323498606,-1.4115815407242511 -2.2932337987181346,-1.2436071743559771 c-0.11510933735896944,0.11510933735896944 -0.08142919790949325,0.3572652766919127 0.09933509483199963,0.7204991856913271 c0.20932846164168142,0.4195095850415778 0.5917472602009244,0.9468808824973012 1.1421404251284408,1.574866267422344 z"
</script>
</body>
</html>
