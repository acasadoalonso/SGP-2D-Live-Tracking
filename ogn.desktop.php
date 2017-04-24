<!DOCTYPE html>
<html>
<head>
    <title>Glider Tracking SGP 2D</title>
    <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8">
  <script src="jquery.2.2.4.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,visualization&key=AIzaSyCKOPCAqnZW-OZvw3hzOjcKTldrZZN9wLo"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="jquery.cookie.js"></script>
  <script src="jquery.screen.full.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
    <link href='/node/js/kendo/styles/kendo.common.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.rtl.min.css' rel='stylesheet'>
    <link href='/node/js/kendo/styles/kendo.bootstrap.min.css' rel='stylesheet'>
    <script src="/node/js/socket.io.js"></script>
    <script src='/node/js/kendo/js/kendo.all.min.js'></script>
    <script src='/node/js/kendo/js/cultures/kendo.culture.es-CL.min.js'></script>
    <script src='/node/config.js'></script>


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

.stations{
	position:fixed;
	top:40px!important;
	right:0px;
	width:80px!important;
	background-color:green;
	overflow:auto;
	border-radius: 10px 0 0 10px ;
}
.station{
	margin:5px;
	background-color:green;
	color:white;
}

.c2{
	width:90px!important;
	padding:3px;
	height:17px;
	overflow:hidden;
	float:left;
	color:#09F;
	border:1px solid #09F;
	background-color:white;
	
}
.break{
	clear:both;
}
    </style>
  </head>
<body>
<style>
#header{
	left:0px!important;
	bottom:0px!important;
	background-color:white;
	width:100%;
	float:left;
	position:fixed;
	overflow:hidden;
	padding:3px;
	border:1px solid #CCC;
	display:none;
}


#stationDetail{
	left:0px!important;
	bottom:0px!important;
	background-color:white;
	width:100%;
	float:left;
	
	position:fixed;
	overflow:hidden;
	padding:3px;
	border:1px solid #CCC;
	display:none;
}

.click{
	cursor:pointer;	
}
.menu{
	position:fixed;
	top:55px;
	right:10px;
	width:120px;
	height:106px;
	border:1px solid #ccc;
	background-color:white;
	overflow:hidden;
	display:none;
}
.subMenu{
	position:fixed;
	top:5px;
	height:22px;
	width:40px;
	padding:4px 3px 3px 3px;
	font-size:11px;
	text-align:center;
	border-bottom:1px solid #D6D4D1;
	border-top:1px solid #D6D4D1;
	cursor:pointer;
	background-color:white;
}
.leftRound{
    -webkit-border-radius: 18px;
    -moz-border-radius: 18px;
    border-radius: 18px;
}
</style>


<!--<div class="receivers">
<div class="receiversTitle">Receivers: </div>
</div>-->
<div style="clear:both;"></div>
<div id="map"></div>
<div class="subMenu" type="clients" style="right:10px; border-right:1px solid #D6D4D1;" id="clientsCount">CLI</div>
<div class="subMenu" type="transmiters" style="right:50px; border-left:1px solid #D6D4D1;" id="transmitersCount">TX</div>
<div class="subMenu" type="receivers" style="right:90px; border-left:1px solid #D6D4D1;" id="receiversCount">RX</div>
<div class="subMenu" type="waypoints" style="right:130px; width:40px!important;" id="waypointsCount">WPS</div>
<div class="subMenu" type="fullscreen" style="right:170px; width:30px!important; solid #D6D4D1;" id="fullScreen"><img src="/node/img/fullScreen.png" width="20" height="20"></div>
<div class="subMenu" type="pallete" style="right:200px; width:30px!important;border-left:1px solid #D6D4D1;" id="pallete"><img src="/node/img/config.png" width="20" height="20"></div>
<style>

.receivers{
	width:180px; top:10px; left:10px;
	position:fixed;
	border:1px solid black;
	background-color:white;
	display:none;
	max-height:90%;
	overflow:auto;
	opacity:0.6;
}
.receiver{
	padding:5px;
	height:30px;
	border-bottom:1px solid #999;
	cursor:pointer;
}

.receiversIcon{
	width:20px;
	height:20px;
	background-image:url(/node/img/antenna0.png);
	background-size:contain;
	float:left;
	
}
.receiversData{
	padding-left:10px;
	height:32px;
	float:left;
}
.receiversStation{
	
}

.transmiters{
	width:300px; top:10px; left:10px;
	position:fixed;
	border:1px solid black;
	background-color:white;
	display:none;
	max-height:90%;
	overflow:auto;
	opacity:0.6;
}
.transmiter{
	width:290px;
	padding:5px;
	height:45px;
	border-bottom:1px solid #999;
	cursor:pointer;
}

.transmitersIcon{
	width:20px;
	height:20px;
	background-image:url(/node/img/glider.0.png);
	background-size:contain;
	float:left;
	
}
.transmitersData{
	width:252px;
	padding-left:10px;
	height:45px;
	float:left;
	overflow:hidden;
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
	padding:0 3px;
	cursor:pointer;
}
.waypoints{
	width:220px; top:10px; left:10px;
	position:fixed;
	border:1px solid black;
	background-color:white;
	display:none;
	max-height:90%;
	overflow:auto;
	opacity:0.6;
}
.waypoint{
	padding:3px;
	height:30px;
	border-bottom:1px solid #999;
	cursor:pointer;
}

.waypointsIcon{
	width:20px;
	height:20px;
	background-image:url(/node/img/glider.0.png);
	background-size:contain;
	float:left;
	
}
.waypointsData{
	padding-left:10px;
	height:45px;
	float:left;
	overflow:hidden;
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

.pallete{
	width:300px; top:10px; left:10px;
	position:fixed;
	border:1px solid black;
	background-color:white;
	display:none;
	max-height:90%;
	overflow:auto;
	opacity:0.8;
	padding:2px;
}
.colorSelector{
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
	width:12px;
	height:12px;
	border:3px solid #CCC;
	float:left;
	margin-left:2px;
	
}
.subMenuPalleteTitle{
	float:left;
	width:70px;	
}
.colorSelectorSelected{
	border:3px solid black;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
}

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('/node/img/loading.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}
</style>


<div class="receivers">

</div>

<div class="transmiters">

</div>
<div class="waypoints">

</div>


<div class="pallete">
<strong>Configuration</strong><br>
<label>Map Type:</label>
<label><input type="radio" id="mapSatellite" value="satellite" name="mapType" class="mapType">Sat</label>
<label><input type="radio" id="mapHybrid" value="hybrid" name="mapType" class="mapType">Hyb</label>
<label><input type="radio" id="mapRoadmap" value="roadmap" name="mapType" class="mapType">Road</label>
<label><input type="radio" id="mapTerrain" value="terrain" name="mapType" class="mapType">Terr</label>
<div style="clear:both"></div>
<label>Visibility:</label>
<label><input type="radio" id="visibleActive" value="online" name="visible" class="visible">Only Active</label>
<label><input type="radio" id="visibleAll" value="all" name="visible" class="visible">All Aircrafts</label>

<div style="clear:both"></div>
<label>Heatmap:</label>
<label><input type="radio" id="visibleHeatmap1" value="1" name="heatmap" class="heatmap">Show</label>
<label><input type="radio" id="visibleHeatmap2" value="0" name="heatmap" class="heatmap">Hide</label>
<div style="clear:both"></div>
<label>Heatmap Age:</label>
<label><input type="radio" id="heatmapDate1" value="0" name="heatmapDate" class="heatmapDate">Today</label>
<label><input type="radio" id="heatmapDate2" value="-1" name="heatmapDate" class="heatmapDate">Yesterday</label>


<div style="clear:both"></div>
<strong>Pallete Options</strong><br><br>

<em>&nbsp;&nbsp;Gliders</em><br>
<div class="subMenuPalleteTitle">Active:&nbsp;</div>
<?php 
$top=11;
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorGliderActive<?php echo $i ?> color<?php echo $i ?> colorGliderActive" type="colorGliderActive"></div>
<?php 
}
?>
<div class="break"></div>
<div class="subMenuPalleteTitle">Online:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorGliderOnline<?php echo $i ?> color<?php echo $i ?> colorGliderOnline" type="colorGliderOnline"></div>
<?php 
}
?>

<div class="break"></div>
<div class="subMenuPalleteTitle">Offline:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorGliderOffline<?php echo $i ?> color<?php echo $i ?> colorGliderOffline" type="colorGliderOffline"></div>
<?php 
}
?>
<div class="break"></div>
<div class="subMenuPalleteTitle">Track:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorGliderTrack<?php echo $i ?> color<?php echo $i ?> colorGliderTrack" type="colorGliderTrack"></div>
<?php 
}
?>

<div class="break"></div>

<em>&nbsp;&nbsp;Task</em><br>
<div class="subMenuPalleteTitle">Track:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorTaskTrack<?php echo $i ?> color<?php echo $i ?> colorTaskTrack" type="colorTaskTrack"></div>
<?php 
}
?>
<div class="break"></div>

<div class="subMenuPalleteTitle">Start:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorTaskStart<?php echo $i ?> color<?php echo $i ?> colorTaskStart" type="colorTaskStart"></div>
<?php 
}
?>
<div class="break"></div>

<div class="subMenuPalleteTitle">Finish:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorTaskFinish<?php echo $i ?> color<?php echo $i ?> colorTaskFinish" type="colorTaskFinish"></div>
<?php 
}
?>
<div class="break"></div>

<div class="subMenuPalleteTitle">Turnpoint:&nbsp;</div>
<?php 
for($i=0;$i<$top;$i++){
?>
<div id="" index="<?php echo $i ?>" class="colorSelector colorTaskTurnPoint<?php echo $i ?> color<?php echo $i ?> colorTaskTurnPoint" type="colorTaskTurnPoint"></div>
<?php 
}
?>
<div class="break"></div>

</div>
<div id="stationDetail" class="stationDetail">
		<img src="/node/img/close.png" style="float:right; margin:3px 3px;" width="24" height="24" class="close">
		<div style="width:170px; float:left; height:40px;">
		    <div style="font-size:18px; font-weight:bold;width:155px; float:left; height:20px;" id="station"></div>
            
        	<div style="font-size:18px; font-weight:bold;width:155px; float:left; height:20px; color:#999" id="version"></div>
	    </div>
    	<div style="width:1px; background-color:#E6E6E9; height:30px; margin:5px 0 5px; float:left;"></div>
    	<div style="width:115px; height:40px; float:left; padding-left:3px;">
        	<div style="width:40px; height:40px; float:left;">
            <img src="/node/img/altimeter.png" width="40" height="40">
            </div>
            <div style="width:75px; height:30px; overflow:hidden; float:left; font-size:16px; font-weight:bold; color:#963; padding-top:10px;" id="stationAltitude"></div>
       	</div>
        
        
        
		<div style="float:left; height:40px; overflow:hidden;">
        	<div style="float:left; height:20px; overflow:hidden;" class="nearbyStations"></div>
       	    <div style="height:20px; float:left; margin-left:10px;"><img src="/node/img/heat.map.png" width="20" height="20" id="heatMap"></div>
        	<div style="height:20px; font-size:16px; float:left;" id="pkgs"></div>
            <div class="break"></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowL.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;"><span id="maxDistance"></span><sup>KM</sup></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowR.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;" id="stationAge"></div>
        </div>
        <div class="break"></div>
        <div style="width:300px; float:left; height:120px; overflow:hidden;" id="gauges">
        	<div style="height:15px; width:95px; float:left; text-align:center;">CPU</div>
        	<div style="height:15px; width:95px; float:left;text-align:center;">TEMP</div>
            <div class="break"></div>
        	<div style="height:95px; width:95px; float:left;" id="cpu"></div>
        	<div style="height:95px; width:95px; float:left;" id="temp"></div>
        	<div style="height:95px; width:95px; float:left; background-image:url(/node/img/tracking.aircrafts.png); background-size:contain;" id="">
            	<div id="trackingAircrafts">12</div>
            </div>
        </div>
        <!--
        <div style="width:300px; float:left; height:50px; overflow:hidden; font-size:10px;">
        	<div style="height:12px; color:#999; width:300px; overflow:hidden;" id="rf"></div>
        	<div style="height:24px; color:#999; width:300px; overflow:hidden;" id="status"></div>
        </div>
        -->        
</div>

<div id="header" class="header">
		<img src="/node/img/close.png" style="position:absolute;top:3px;right:6px;" width="24" height="24" class="close">
		<div style="float:left; height:20px;">
		    <div style="font-size:18px; font-weight:bold;float:left; height:20px; margin-left:5px;" id="reg"></div>
        	<div style="font-size:18px; font-weight:bold;max-width:200px; float:left; height:20px; color:#999; margin-left:5px;" id="flarm"></div>
	    </div>
        
        <div style="clear:both"></div>
        
        <div style="float:left; height:20px; overflow:hidden; font-size:16px; font-weight:bold; color:#069; margin-left:5px;" id="aircraft"></div>
    
        <div style="float:left; height:20px; overflow:hidden; margin-left:5px;">
        	<div style="height:20px; font-size:16px; float:left;"><span id="aprs" class="aprs">ROBLE1</span></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowL.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;"><span id="aprsDistance">25.5KM</span><sup>KM</sup></div>
        	<div style="height:20px; float:left;"><img src="/node/img/arrowR.png" width="30" height="20"></div>
        	<div style="height:20px; font-size:16px; float:left;" id="aircraftType">GLIDER</div>
        </div>  
        
        <div style="clear:both"></div>
        <div style="float:left; overflow:hidden; font-size:10px; margin-left:5px;" id="nearByWaypoints"></div>  
         
        <div style="clear:both"></div>
        <div style="float:left;overflow:hidden; margin-left:5px;"> 
        	<div style="min-width:40px; float:left; margin-right:10px;">
        		<div style="height:22px; float:left;"><img src="/node/img/rumbo.png" width="20" height="20" id="compass"></div>
        		<div style="height:22px; font-size:16px; float:left;overflow:hidden;" id="course"></div>
            </div>
                        
        	<div style="min-width:40px; float:left; margin-right:10px;">
        		<div style="height:22px; float:left;"><img src="/node/img/speed.png" width="20" height="20" class="click speed"></div>
        		<div style="height:22px; font-size:16px; float:left;overflow:hidden;" class="click speed"><span id="speed">128</span><sup>KM/H</sup></div>
            </div>
        	<div style="min-width:40px; float:left; margin-right:10px;">            
        		<div style="height:22px; float:left;"><img src="/node/img/altimeter.png" width="20" height="20" class="click altitude"></div>
	        	<div style="height:22px; font-size:16px; float:left; overflow:hidden;" class="click altitude"><span id="altitude">1546</span><sup>M</sup></div>
            </div>
        	<div style="min-width:40px; float:left; margin-right:10px;">
				<div style="height:22px; float:left;"><img src="/node/img/agl.png" width="20" height="20" class="click agl"></div>
				<div style="height:22px; font-size:16px; float:left; overflow:hidden;" class="click agl"><span id="agl"></span><sup>M</sup></div>
            </div>
        	<div style="min-width:40px; float:left; margin-right:10px;"> 
	        	<div style="height:22px; float:left;"><img src="/node/img/altitude0.png" width="20" height="20" id="verticalSpeedIcon" class="click verticalspeed"></div>
    	    	<div style="height:22px; font-size:16px; float:left;overflow:hidden;" class="click verticalspeed"><span id="verticalspeed">+3.5</span><sup>m/s</sup></div>
            </div>
        	<div style="min-width:40px; float:left; margin-right:10px;"> 
            	<div style="height:22px; float:left;"><img src="/node/img/sight.angle.png" width="20" height="20" class="click"></div>
	        	<div style="height:22px; font-size:16px; float:left; overflow:hidden;" class="click"><span id="sight"></span><sup>º</sup></div>
            </div>
        	<div style="min-width:40px; float:left; margin-right:10px;">
            	<div style="height:22px; float:left;"><img src="/node/img/sig.0.png" width="20" height="20" class="click" id="signalIcon"></div>
	        	<div style="height:22px; font-size:16px; float:left; overflow:hidden;" class="click"><span id="signal"></span><sup>dB</sup></div>
    		</div>        
        </div>
        
        <div style="clear:both; height:3px;"></div>
        
        <div style="width:300px; float:left; overflow:hidden; margin-left:5px;">
        	<div class="button buttonChart" type="SPEED">SPEED</div>
        	<div class="button buttonChart" type="ALTIM">ALTIM</div>
        	<div class="button buttonChart" type="VARIO">VARIO</div>
        	<div class="button" type="LOCK" lock="0" id="lock">LOCK</div>
        	<div class="button" type="RADAR">RADAR</div>
        	<div class="button" type="TRACK">TRACK</div>
            
        	<!--<div style="height:48px; float:left; padding-left:10px"><img src="/node/img/unlock.png" width="48" height="48" style="float:left" id="lock" lock="0"/></div>
        	<div style="height:48px; float:left; padding-left:10px"><img id="radar" src="/node/img/radar.0.png" width="48" height="48"></div>
        	<div style="height:48px; float:left; padding-left:10px"><img id="track" src="/node/img/track.0.png" width="48" height="48"></div>
        	-->
        </div>    
        
</div>


<div id="stations" class="stations">

</div>


<div class="chartOut" id="chartOut" style="width: 100%; height: 90px; top:40px; left:0px; position:fixed; display:none;">
	<img src="/node/img/close.png" style="position:fixed;top:3px;right:6px; z-index:15000" width="24" height="24" class="closeChart chartOut">
	<div class="chartOut" id="chartAltitude" style="width: 100%; height: 90px; top:40px; left:0px; position:fixed;">
	</div>
</div>
<div id="comm" style="position:fixed; top:0; left:0; width:10px; height:10px; background-color:red; display:none;"></div>
<div id="stationPhoto" style="width:350px; height:350px; border:1px solid black; display:none; z-index:999999; position:fixed; left:0; top:0;"></div>

<div class="modal"><!-- Place at bottom of page --></div>

<script type="text/javascript">
var tow="m 15.388371,4.7812376 c 0.06737,0.067371 0.06088,0.1535326 -0.171754,0.656096 -0.02746,0.059318 -0.18034,0.2765235 -0.18034,0.2765235 -10e-7,-1e-6 0.102687,0.1129918 0.130532,0.1408372 0.05383,0.053834 0.07864,0.1746392 0.05668,0.2696526 -0.06814,0.2947833 -0.8899,1.4704243 -1.349979,1.9305048 -0.285512,0.2855112 -0.432705,0.4805551 -0.422513,0.5599149 0.0086,0.06697 0.116774,0.3550941 0.240455,0.6389223 0.218228,0.5008044 0.299971,0.5993204 2.76179,3.3388821 1.949531,2.169479 2.546055,2.86956 2.58145,3.028007 0.09814,0.43933 -0.282015,0.847468 -1.264103,1.35685 l -0.506673,0.262782 c 0,0 -7.3888187,-5.289995 -7.3888187,-5.289995 l -4.429513,3.364643 0.101334,0.18034 c 0.055981,0.09885 0.518862,0.676109 1.028802,1.282996 0.509938,0.606889 0.932924,1.160835 0.939489,1.231471 0.026392,0.283961 -1.110644,1.177107 -1.281278,1.006472 -0.269318,-0.269317 -1.398977,-1.131169 -1.494252,-1.14044 -0.068024,-0.0066 -1.039054,-0.747073 -1.368872,-1.076892 -0.329819,-0.329818 -1.070274,-1.300849 -1.076892,-1.368872 -0.00927,-0.09528 -0.871124,-1.224934 -1.140441,-1.494253 -0.17063503,-0.170635 0.722512,-1.30767 1.006474,-1.281277 0.070635,0.0066 0.624579,0.42955 1.231469,0.939488 0.606887,0.50994 1.184148,0.972821 1.282997,1.028802 l 0.180339,0.101334 3.364644,-4.429513 c 0,0 -5.289996,-7.3888202 -5.289997,-7.3888202 l 0.262784,-0.506672 c 0.509382,-0.9820888 0.917519,-1.3622407 1.356849,-1.2641029 0.158448,0.035395 0.858528,0.6319166 3.028007,2.5814488 2.7395627,2.4618182 2.8380777,2.5435617 3.3388797,2.7617902 0.283829,0.1236801 0.571952,0.2318519 0.638923,0.2404552 0.07936,0.010191 0.274402,-0.1370033 0.559915,-0.4225135 0.460079,-0.4600805 1.635721,-1.2818435 1.930505,-1.3499793 0.09501,-0.021963 0.215817,0.00284 0.269652,0.056678 0.02785,0.027846 0.139121,0.1288154 0.139121,0.1288154 0,0 0.217204,-0.1528832 0.276522,-0.1803404 0.502564,-0.2326341 0.590442,-0.2374085 0.657815,-0.1700356 z"

var glider="M15.222242261163544,17.778045386418853 l0.03751711736144195,0.03751711736144195 l-5.050741924784112,5.048610270388576 c-0.9694764190899875,0.9716080734855234 -3.2439516591274002,2.3222242984974315 -3.2439516591274002,2.3222242984974315 a0.7337154429436532,0.7337154429436532 0 0 1 -0.9456018898599785,-1.1152815797446822 l7.747284735137747,-7.74685840425864 zm9.88490776298172,-11.756926653141848 a0.7337154429436532,0.7337154429436532 0 0 0 -1.0372630288680469,0 l-7.747284735137747,7.747284735137747 l1.4537882977558736,1.4537882977558736 l0.03751711736144195,0.03751711736144195 l5.048610270388576,-5.049036601267684 c0.9694764190899875,-0.9694764190899875 2.3222242984974315,-3.2439516591274002 2.3222242984974315,-3.2439516591274002 a0.7337154429436532,0.7337154429436532 0 0 0 -0.07759221999752759,-0.9456018898599785 zm-2.235679130038649,13.610186984621254 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9912192939244586,0.41013030570121717 l-1.8404704051061884,1.8404704051061884 a1.4022022613838911,1.4022022613838911 0 0 0 0,1.982864918728024 l0.25579852746437626,0.25579852746437626 l3.82376165471332,-3.8233353238342134 l-0.25579852746437626,-0.25579852746437626 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9920719556826738,-0.41013030570121717 zm-1.995228514222136,0.4497790774581954 l-0.7968124130515336,0.7968124130515336 c-1.7424143029115111,-1.732608692692044 -2.7378969056270432,-2.643251450465223 -4.376712804915481,-3.58117938450127 l-1.6742013622543443,-1.676333016649881 c-2.728517626286682,-2.728517626286682 -2.777119346504914,-3.6839251263661286 -2.435201981460864,-4.026268822289285 c0.08142919790949325,-0.08142919790949325 0.20293349845507222,-0.1402628592262999 0.38369779119656483,-0.1402628592262999 c0.5388822311916196,0 1.597461804015031,0.5299292827303667 3.6434236928509343,2.575464840687164 l1.6750540240125584,1.6750540240125584 c0.9357962796405109,1.6400948919257603 1.8489970226883348,2.634724832883078 3.5807530536221632,4.376712804915481 zm-6.688705162314335,-6.941519373624962 c-1.4623149153380188,-1.272171343256165 -2.1252594323498606,-1.4115815407242511 -2.2932337987181346,-1.2436071743559771 c-0.11510933735896944,0.11510933735896944 -0.08142919790949325,0.3572652766919127 0.09933509483199963,0.7204991856913271 c0.20932846164168142,0.4195095850415778 0.5917472602009244,0.9468808824973012 1.1421404251284408,1.574866267422344 z"



var colors=[
	'#FFFF01',
	'#FE9901',
	'#FD0002',
	'#9A01CD',
	'#0102FC',
	'#32CACB',
	'#98FD00',
	'#CC6600',
	'black',
	'gray',
	'white',
];
var map;
var aircrafts={};
var airIcons=[];
var timerMove, activeBounds, mapLoaded=false;
var headerHeight=0;
var activeStation="";
var activeFlarm=""
var flightTrack;
var flightPath = [];
var gotFlightTrack=0
var tx={}, rx={}, wp={};
var busy=false;
var appurl =getappurl();
var appport=getappport();
socketurl=appurl+':'+appport;
var socket = io.connect(socketurl, { query: "platform=desktop"});
$(document).off('click', '.colorSelector').on('click', '.colorSelector', function(){
	$.cookie($(this).attr("type"), $(this).attr("index"))
	$("." + $(this).attr("type")).removeClass("colorSelectorSelected")
	$(this).addClass("colorSelectorSelected")
	for(i=0;i<taskElements.length;i++){
		try{taskElements[i].setMap(null)}catch(e){}	
	}
	if($("." + $(this).attr("type")=="colorGliderTrack")){
		line.setMap(null)
		line = new google.maps.Polyline({
			path: [],
			strokeColor: getColor("colorGliderTrack"),
			strokeOpacity: 1.0,
			strokeWeight: 3,
			map: map
		});	
	}else if($("." + $(this).attr("type")=="colorGliderTrack")){
		getTask();
	}
	
});
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
	console.log($(this).val())
	console.log($.cookie("visible"))
	busy=false
});
$('#stationPhoto').off('click').on('click', function(){
	$(this).hide();
});
function getColor(element){
	return(colors[$.cookie(element)])
}


function requestFullscreen(element) {
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    }
}
var isFullScreen=false;
$('#fullScreen').off('click').on('click', function(){
	if(isFullScreen==false){
        screenfull.request();
		isFullScreen=true;
	}else{
		screenfull.exit();
		isFullScreen=false;	
	}
});
$(function(){
	//document.fullscreenEnabled = document.fullscreenEnabled || document.mozFullScreenEnabled || document.documentElement.webkitRequestFullScreen;

	screenfull.enabled ? $("#fullScreen").show() : $("#fullScreen").hide();
	for(i=0;i<colors.length;i++){
		$(".color" + i).css('background-color', colors[i]);	
	}
	//document.body.requestFullscreen();
	detectLandscape()
	headerHeight=$("#header").height()
	$("#header").css("bottom", 0)
	$("#header").hide();
	setTimeout(function(){$("#header").css("visibility","visible")},500)
	if(!$.cookie("lat")||isNaN($.cookie("lat"))) $.cookie("lat",    getcenterlat())
	if(!$.cookie("lon")||isNaN($.cookie("lon"))) $.cookie("lon",    getcenterlon())
	if(!$.cookie("zoom")||isNaN($.cookie("zoom"))) $.cookie("zoom", getcenterzoom())
	if(!$.cookie("visible")) $.cookie("visible", "all") 
	if(!$.cookie("mapType")) $.cookie("mapType", "roadmap")
	
	if(!$.cookie("heatmap")) $.cookie("heatmap", "1")
	if(!$.cookie("heatmapDate")) $.cookie("heatmapDate", "-1")
	
	if(!$.cookie("colorGliderActive")) $.cookie("colorGliderActive", 1)
	if(!$.cookie("colorGliderOnline")) $.cookie("colorGliderOnline", 5)
	if(!$.cookie("colorGliderOffline")) $.cookie("colorGliderOffline", 4)
	if(!$.cookie("colorGliderTrack")) $.cookie("colorGliderTrack", 2)
	if(!$.cookie("colorTaskTrack")) $.cookie("colorTaskTrack", 0)
	if(!$.cookie("colorTaskStart")) $.cookie("colorTaskStart", 6)
	if(!$.cookie("colorTaskFinish")) $.cookie("colorTaskFinish", 4)
	if(!$.cookie("colorTaskTurnPoint")) $.cookie("colorTaskTurnPoint", 0)
	
	$(".colorGliderActive" + $.cookie("colorGliderActive")).addClass("colorSelectorSelected");
	$(".colorGliderOnline" + $.cookie("colorGliderOnline")).addClass("colorSelectorSelected");
	$(".colorGliderOffline" + $.cookie("colorGliderOffline")).addClass("colorSelectorSelected");
	$(".colorGliderTrack" + $.cookie("colorGliderTrack")).addClass("colorSelectorSelected");
	$(".colorTaskTrack" + $.cookie("colorTaskTrack")).addClass("colorSelectorSelected");
	$(".colorTaskStart" + $.cookie("colorTaskStart")).addClass("colorSelectorSelected");
	$(".colorTaskFinish" + $.cookie("colorTaskFinish")).addClass("colorSelectorSelected");
	$(".colorTaskTurnPoint" + $.cookie("colorTaskTurnPoint")).addClass("colorSelectorSelected");
	
	

	$(".heatmap:radio[value="+$.cookie("heatmap")+"]").prop("checked", true)
	$(".heatmapDate:radio[value="+$.cookie("heatmapDate")+"]").prop("checked", true)
	

	$(".mapType:radio[value="+$.cookie("mapType")+"]").prop("checked", true)
	$(".visible:radio[value="+$.cookie("visible")+"]").prop("checked", true)
	
	window.scrollTo(0,1);
	initMap();	
	

	$("#cpu").kendoRadialGauge({
		pointer: {value: 0},
		scale: {
			minorUnit: 5,majorUnit: 20, startAngle: -90, endAngle: 180, max: 100, 
			minorTicks:{size:4},
			majorTicks:{size:7,visible: true},
			labels: {position: "inside", font:"11px Arial"},
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
			labels: {position: "inside", font:"11px Arial"},
			ranges: [
				{from: 0, to: 35, color: "#009933"
				}, {from: 35, to: 55, color: "#ffc700"
				}, {from: 55, to: 75, color: "#ff7a00"
				}, {from: 75, to: 100, color: "#c20000"}
			]
		}
	});
	
	
})
$('#heatMap').off('click').on('click', function(){
	coverageLoad(activeStation);
});
var onlineColor="#66FFFF", offlineColor="#996600", activeColor="#FF9900"; //onlineColor="black", offlineColor="#777", activeColor="magenta";

$('#options').off('click').on('click', function(){
	($(".menu").css('display')=='none') ? $(".menu").show() : $(".menu").hide();
});

function showWaypoints(state){
	$.each(wp, function(i, item) {
		item.marker.setVisible(state);
		if(state){
			(map.getBounds().contains(item.marker.getPosition())) ? $("#waypoint" + item.idWaypoint).show() : $("#waypoint" + item.idWaypoint).hide();
		}
	});
	
}
$(document).off('click', '.subMenu').on('click', '.subMenu', function(){
	$(".menu").hide();
	if($(this).attr('type')=='options'){
		$(".options").show();
	}
	if($(this).attr('type')=='receivers'){
		clearTopLayer();
		$(".receivers").show();
	}
	if($(this).attr('type')=='transmiters'){
		clearTopLayer();
		$(".transmiters").show();
	}
	if($(this).attr('type')=='waypoints'){
		clearTopLayer();
		$(".waypoints").show();
		showWaypoints(true);
		
	}
	if($(this).attr('type')=='pallete'){
		clearTopLayer();
		$(".pallete").show();
	}
	
});

$(document).off('click', '.mapType').on('click', '.mapType', function(){
	$.cookie("mapType", $(this).val());
	map.setMapTypeId($(this).val())
});

$(document).off('click', '.heatmapDate').on('click', '.heatmapDate', function(){
	$.cookie("heatmapDate", $(this).val());
});

$(document).off('click', '.heatmap').on('click', '.heatmap', function(){
	$.cookie("heatmap", $(this).val());
});

var waypoints=[]
var signals=[]
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
function setInfoWaypoint(marker, data){
	var content=('<div style="background-color:#FF8000; color:white; margin-bottom:3px; text-align:center; padding:3px;">Waypoint File</div>' + data.waypoint);
	marker.addListener('click', function() {
		//activeFlarm=dataPoint.flarmId
		infowindow.setContent(content);
		infowindow.open(map, marker);
		map.panTo(new google.maps.LatLng(data.waypointLat, data.waypointLon))					
		
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
					map: map,
					visible: false
				});
				setInfoWaypoint(marker, data)


				
				var obj={ 
					waypointlat:parseFloat(data.waypointLat), 
					waypointLon:parseFloat(data.waypointLon), 
					waypoint:data.waypoint, 
					idWaypoint:data.idWaypoint,
					marker:marker
				}
				wp[data.idWaypoint]=(obj);
				var html='<img src="/node/img/wp.' + data.waypointType + '.png" width="24" height="24" style="float:left;"><div style="flat:left;"><strong>' + data.waypoint + ' ' + data.waypointCountry + '</strong></div>'; //<br>Lat: ' + data.waypointLat + ' Lon: ' + data.waypointLon + '<br>'
					
				$node='<div class="waypoint" idWaypoint="' + data.idWaypoint + '" waypoint="' + data.waypoint + '" id="waypoint' + data.idWaypoint + '" lat="' + data.waypointLat + '" lon="' + data.waypointLon + '">' +
				html + '</div>'
				$(".waypoints").append($node);
						
			}
		}
		
	});	
}
var infowindow;
$(document).off('click', '.waypoint').on('click', '.waypoint', function(){
	infowindow.setContent('<div style="background-color:#FF8000; color:white; margin-bottom:3px; text-align:center; padding:3px;">Waypoint File</div>' + $(this).attr("waypoint"));
	infowindow.open(map, wp[$(this).attr("idWaypoint")].marker);
	map.panTo(new google.maps.LatLng($(this).attr("lat"), $(this).attr("lon")))
});
$(document).off('click', '.close').on('click', '.close', function(){
	clearTopLayer();
});

$(document).off('click', '.closeChart').on('click', '.closeChart', function(){
	$(".buttonChart").removeClass("buttonChartsColor");
	$(".chartOut").hide();
});


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
					flightPath=[];
					for(i=0;i<data.track.length;i++){
						flightPath.push({lat:parseFloat(data.track[i].lat),lng:parseFloat(data.track[i].lon)})
					}
					flightTrack.setPath(flightPath);
				}
				
			});
		}
	}else if($(this).attr('type')=="ALTIM"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		drawChartAlt();
	}else if($(this).attr('type')=="SPEED"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		drawChartSpeed();
	}else if($(this).attr('type')=="VARIO"){
		$(".buttonChart").removeClass("buttonChartsColor");
		$(this).addClass("buttonChartsColor");
		drawChartVario();
	}else if($(this).attr('type')=="LOCK"){
		($(this).attr('lock')=="1") ? $("#lock").attr('lock','0')	:  $(this).attr('lock','1');
		($(this).attr('lock')=="1") ? $(this).addClass("buttonLock") : $(this).removeClass("buttonLock");
	}
});


var trackOn=0
$('#track').off('click').on('click', function(){
	trackOn = (trackOn==0) ? 1 : 0;
	$("#track").attr("src", "/node/img/track." + trackOn + ".png")
	flightTrack.setPath([]);
	if(trackOn==1){
		$.ajax({
			url:"/node/data.php?FLAG=TRACK&FLARM=" + activeFlarm,
			data: "",
			type:"POST",
			dataType:"json",
			success: function(data){
				flightPath=[];
				for(i=0;i<data.track.length;i++){
					flightPath.push({lat:parseFloat(data.track[i].lat),lng:parseFloat(data.track[i].lon)})
				}
				flightTrack.setPath(flightPath);
			}
			
		});
	}
});

var radarOn=0;
var chartType=""
var chartData=[];
var chart;
var chartOptions
function drawChartAlt() {
	chartType="ALT"
	$(".chartOut").show();
	$(".chartOut").css("top", $("#stations").height())
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
				var data = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(data, chartOptions);
				}
			}
		
		});	
	}catch(e){}
}
function drawChartVario() {
	chartType="VARIO"
	$(".chartOut").show();
	$(".chartOut").css("top", $("#stations").height())
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
				var data = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(data, chartOptions);
				}
			}
			
		});
	}catch(e){}	
}

var taskElements=[]


function setStartTask(marker){
	marker.addListener('click', function() {
		
		infowindow.setContent('<div style="background-color:#FF8000; color:white; margin-bottom:3px; text-align:center; padding:3px;">Task WP</div><strong>Start Line</strong>');
		infowindow.open(map, marker);
			
		
	});
}
function setEndTask(marker){
	marker.addListener('click', function() {
		
		infowindow.setContent('<div style="background-color:#FF8000; color:white; margin-bottom:3px; text-align:center; padding:3px;">Task WP</div><strong>End Line</strong>');
		infowindow.open(map, marker);
			
		
	});
}
function setTurnPointTask(marker,data){
	marker.addListener('click', function() {
		
		infowindow.setContent("<div style='background-color:#FF8000; color:white; margin-bottom:3px; text-align:center; padding:3px;'>Task WP</div><strong>#" + data.turnPointNumber + " " + data.name + "</strong><br>Radius: " + Math.round(data.rad/1000) + "Km");
		infowindow.open(map, marker);
			
		
	});
}

var taskElements=[]
function getTask(){
	$.ajax({
		url:"/node/data.php?FLAG=TASK",
		type:"POST",
		dataType:"json",
		success: function(json){
			taskElements=[]
			try{
				var task=[];
				tasksInfoWindow=[]
				var turnPointNumber=1;
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
							strokeColor: getColor("colorTaskStart"),
							strokeOpacity: 1.0,
							strokeWeight: 4.5,
							map:map
						});	
						taskElements.push(flightTask)
						var marker = new google.maps.Marker({
							position: p1,
							icon: {
								url:"/node/img/task.start.end.png",
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(0, 32)
							},
							map: map
						});	
						taskElements.push(marker)
						setStartTask(marker)


										
										
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
							strokeColor: getColor("colorTaskFinish"),
							strokeOpacity: 1.0,
							strokeWeight: 4.5,
							map:map
						});			
						taskElements.push(flightTask)
						var marker = new google.maps.Marker({
							position: p2,
							icon: {
								url:"/node/img/task.start.end.png",
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(0, 32)
							},
							map: map
						});
						taskElements.push(marker)
						
						setEndTask(marker)
													
										
					}
					if(data.type=="Turnpoint"){

						var cityCircle = new google.maps.Circle({
							strokeColor: getColor("colorTaskTurnPoint"),
							strokeOpacity: 0.8,
							strokeWeight: 1,
							fillColor: getColor("colorTaskTurnPoint"),
							fillOpacity: 0.15,
							map: map,
							center: {lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)},
							radius: data.rad
						});
						taskElements.push(cityCircle)
						
						var marker = new google.maps.Marker({
							position: {lat: parseFloat(data.latitude), lng: parseFloat(data.longitude)},
							icon: {
								url:url,
								size: new google.maps.Size(32, 32),
								anchor: new google.maps.Point(8, 32)
							},
							map: map
						});
						taskElements.push(marker)
						data.turnPointNumber=turnPointNumber;
						setTurnPointTask(marker, data)
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
					strokeColor: getColor("colorTaskTrack"),
					strokeOpacity: 1.0,
					strokeWeight: 2.5,
					map:map
				});
				taskElements.push(flightTask)
			}catch(e){}
		}
		
	});	
}

function drawChartSpeed() {
	
	chartType="SPEED"
	$(".chartOut").show();
	$(".chartOut").css("top", $("#stations").height())
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
				var data = google.visualization.arrayToDataTable(chartData);
				chart = new google.visualization.AreaChart(document.getElementById('chartAltitude'));
					chart.draw(data, chartOptions);
				}
			}
		});	
	}catch(e){}
}




function distance(lat1, lon1, lat2, lon2) {
  var p = 0.017453292519943295;    // Math.PI / 180
  var c = Math.cos;
  var a = 0.5 - c((lat2 - lat1) * p)/2 + 
          c(lat1 * p) * c(lat2 * p) * 
          (1 - c((lon2 - lon1) * p))/2;

  return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
}

var line;
function initMap() {
	setTimeout(function(){

		google.charts.load('current', {'packages':['corechart']});
		map = new google.maps.Map(document.getElementById('map'), {
			center: { lat: parseFloat($.cookie("lat")), lng: parseFloat($.cookie("lon"))},
			zoom: parseInt($.cookie("zoom")),
			panControl:false,
			zoomControl:false,
			mapTypeId:$.cookie("mapType"), //$.cookie("mapType"),
			mapTypeControl: false,
			scaleControl: true,
			navigationControl: false,
			streetViewControl: false,
		});
		google.maps.event.addListenerOnce(map, 'tilesloaded', function () {
			
			infowindow = new google.maps.InfoWindow();
			getTask();
			google.maps.event.addListener(map, 'zoom_changed', function () {
				$(".menu").hide();
				$(".options").hide();
				$.cookie("zoom", map.getZoom())
			});
			
			activeBounds=map.getBounds();
			mapLoaded=true;
			google.maps.event.addListener(map, 'center_changed', function () {
				$(".menu").hide();
				$(".options").hide();
				$.cookie("lat", map.getCenter().lat())
				$.cookie("lon", map.getCenter().lng())
				activeBounds=map.getBounds(); 
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
			waypointsLoad()
			/*
			if($(this).val()=="hybrid"||$(this).val()=="satellite"){
				onlineColor="#00CCFF", offlineColor="#996600", activeColor="#FF9900";	
			}else{
				onlineColor="#00CCFF", offlineColor="#996600", activeColor="#FF9900";
			}
			*/		

								
		}); 
	},1000);
}

function clearTopLayer(){
	$(".button").removeClass("buttonTrack buttonRadar buttonLock buttonChartsColor");
	showWaypoints(false);
	for(i=0;i<signals.length;i++){
		try{signals[i].setMap(null);}catch(e){}	
	}	
	$('#stationPhoto').hide();
	try{heatmap.setMap(null)}catch(e){};
	$("#header").hide();
	$(".pallete").hide();
	$("#stationDetail").hide();
	infowindow.close();
	$(".receivers").hide();
	$(".transmiters").hide();
	$(".waypoints").hide();
	$(".chartOut").hide();
	$("#lock").attr('lock','0')
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

var stations=[];
var stationsIcons=[];
var activeWaypoints=[];

$('#aprs').off('click').on('click', function(){
	clearTopLayer()
	activeStation=$(this).text();
	$("#stationDetail").show();
	$(".receivers").hide();
	setInfoStation(rx[$(this).text()])
});
var heatmap;
function setHeatMap(station){
	try{heatmap.setMap(null)}catch(e){};
	var url="/node/data.php?FLAG=GETHEATMAP&station=" + station + "&offset=" + $.cookie("heatmapDate");
	$.ajax({
		url:url,
		dataType: "json",
		type:"POST",
		success: function(json){

			var heatmapData=[];
			
			for(i=0;i<json.heatmap.length;i++){
				var data=json.heatmap[i];
				var position=new google.maps.LatLng(data.lat, data.lon)
				//bounds.extend(position);
				heatmapData.push(position);
			}
			heatmap = new google.maps.visualization.HeatmapLayer({
				data: heatmapData
			});
			heatmap.setMap(map);
			//map.fitBounds(bounds);
			heatmap.set('opacity', 1)
			heatmap.set('radius', 20);
			
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
			var gradient = ['rgba(0, 255, 255, 0)','#E5E100', '#E6CE01', '#E8BC02', '#EAAA04', '#EC9705', '#EE8507', '#EF7308', '#F1610A', '#F34E0B', '#F53C0D', '#F72A0E', '#F91810']
			heatmap.set('gradient', heatmap.get('gradient') ? null : gradient)
	
		}
		
	});		
}

function gradient(currentColor, desiredColor, N) {

    var colors = [],
    cR = currentColor[0],
    cG = currentColor[1],
    cB = currentColor[2]
    var dR = desiredColor[0] - cR;
    var dG = desiredColor[1] - cG;
    var dB = desiredColor[2] - cB;

    for(var i = 1; i <= N; i++) {
        colors.push(new Color(cR + i * dR / N, cG + i * dG / N, cB + i * dB / N));
    }

    return colors;
}

$('#stationPhoto').off('click').on('click', function(){
	$(this).hide();
});
$(document).off('click', '.moraInfoStation').on('click', '.moraInfoStation', function(){
	$.ajax({
		url:"data.php?FLAG=MOREINFOSTATION&station=" + $(this).attr('station'),
		type:"POST",
		success: function(data){
			console.log(data);
			infowindow.setContent(data);
		}
		
	});	
});



function setInfoStation(item){
	infowindow.setContent('<div style="background-color:#008080; color:white; margin-bottom:3px; text-align:center; padding:3px;">OGN Station</div><img id="stationPhotoThumb" style="float:left; padding-right:4px;" width=40 height=40 src="/node/img/stations/' + item.station + '.jpg"><div style="float:left"><strong>' + item.station + 
	'</strong><br>'+ + item.alt +'m<br><a href="#" class="moraInfoStation" station="'+item.station+'">More Info</a></div>');
	try{
		infowindow.open(map, item.marker);
		map.panTo(new google.maps.LatLng(item.lat, item.lon))
	}catch(e){console.log(e)}
	$('#stationPhotoThumb').off('click').on('click', function(){
		$("#stationPhoto").html('<img width=350 height=350 src="' + $(this).attr('src') + '">').show().css({"left":($(window).width()-350)/2, "top":($(window).height()-350)/2 });
	});	
	setupNearby(item.station);	
}
$(document).off('click', '.receiver').on('click', '.receiver', function(){
	clearTopLayer()
	activeStation=$(this).attr('station');
	$("#stationDetail").show();
	$(".receivers").hide();
	setInfoStation(rx[$(this).attr('station')]);
});
var zIndex=1
var stationRangle
	
function setupNearby(station){
	setHeatMap(activeStation)
	rx[station].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
	zIndex++;
	
	$.ajax({
		url:"/node/data.php?FLAG=NEARBY&station="+activeStation,
		data: "",
		type:"POST",
		dataType:"json",
		success: function(json){
			var html=""
			for(i=0;i<json.nearbyStations.length;i++){
				var color=(json.nearbyStations[i].age<360) ? "#09C" : "red";
				html+='<span class="nearbyStation" style="color:'+color+'" station="'+json.nearbyStations[i].station+'">' + json.nearbyStations[i].station + '</span>';
			}
			html=="" ? $(".nearbyStations").hide() : $(".nearbyStations").show().html("Nearby: " + html);
			calcMapSize();
		}
		
	});	
	/*
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
	*/		
}
$(document).off('click', '.nearbyStation').on('click', '.nearbyStation', function(){	clearTopLayer()
	activeStation=$(this).attr('station');
	$("#stationDetail").show();
	$(".receivers").hide();
	
	setInfoStation(rx[$(this).attr('station')])
	
});
$(document).off('click', '.transmiter').on('click', '.transmiter', function(){
	clearTopLayer()
	activeFlarm=$(this).attr('flarmId');
	displayData(tx[$(this).attr('flarmId')]);
	tx[$(this).attr('flarmId')].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
	map.panTo(new google.maps.LatLng(tx[$(this).attr('flarmId')].lat, tx[$(this).attr('flarmId')].lon))
	zIndex++;	
});

var landscape=false;
function detectLandscape(){
	landscape=($(window).width()>$(window).height()) ? true : false;
	if($(window).height()>800) landscape=false;
}
window.addEventListener("resize", function() {
    // Announce the new orientation number
	detectLandscape()
    calcMapSize()
}, false);

function calcMapSize(){
	var currCenter = map.getCenter();
	var wnd=$(window).height();
	var w=0, t=0;
	if($("#header").css("display")=="block") w=w+$("#header").height();
	if($("#stationDetail").css("display")=="block") w=w+$("#stationDetail").height();
	if($("#chartOut").css("display")=="block"){
		w=w+$("#chartAltitude").height();
		t=$("#chartAltitude").height();
	}
	$("#map").css({top:t,height:wnd-w});
	
	google.maps.event.trigger(map, 'resize');
	map.setCenter(currCenter);
}


function createStations(){
	var found=false;
	var html=''
	var jsonString=JSON.stringify(stations)
	var stationList="#blank "
	$.each(rx, function(i, item) {
		var stationIcon=(item.age>60*5) ? 0 : 1;
		var distance=(Math.round(item.maxDistance*10)/10)
		$node='<div class="receiver" station="' + item.station + '" id="station' + item.station + '" lat="' + item.lat + '" lon="' + item.lon + '"><div class="receiversIcon" id="stationIcon' + item.station + '"></div><div class="receiversData"><div class="receiversStation"><strong>' + 
			item.station + '</strong><br>Max Dist: ' + distance + ' km</div></div></div>'
		if($('#station' + item.station).length==0){
			$(".receivers").append($node);
		}else{
			
		}
		$("#stationIcon" + item.station).css('background-image', 'url(/node/img/antenna'+stationIcon+'.png)');
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
				//activeFlarm=dataPoint.flarmId
				clearTopLayer()
				activeStation=item.station;
				$("#stationDetail").show();
				$(".receivers").hide();
				(landscape) ? $("#gauges").css("display", "none") : $("#gauges").css("display", "block");
				setInfoStation(item)
				
			});				
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
			$("#station").text(item.station)
			$("#version").text(item.version)
			$("#rf").text(item.rf)
			$("#status").text(item.status)
			if(!landscape){
				$("#gauges").css("display", "block")	
				$("#cpu").data("kendoRadialGauge").value(item.cpu);
				$("#temp").data("kendoRadialGauge").value(item.temp);
				$("#trackingAircrafts").text(item.trackingAircrafts);
			}else{
				$("#gauges").css("display", "none")	
			}
			$("#stationAltitude").html(item.alt + "m");
			$("#pkgs").html(formatpkgs(item.pkgs))
			var distance=(Math.round(item.maxDistance*10)/10)
			$("#maxDistance").text(distance)
			$("#stationAge").text(formatAge(item.age))
			
		
			
			
		}
		
	});
	for(i=0;i<stations.length;i++){
		stationList+=", #station" + stations[i].station;
	}
	$(".receiver:not("+stationList+")").remove()
	if ($(".receiver").length==0) $(".receivers").hide()
	//transmiters
	var transmitersList="#blank "
	//onlineColor="white", offlineColor="#ddd", activeColor="magenta";	
	$.each(tx, function(i, item) {
		var distance=(Math.round(item.distance*10)/10)
		var transmitersIcon=(item.age>60) ? 0 : 1;
		var transmitersStatusColor=(item.age>60) ? "#ff0000" : "#6C9F43";
		var html='<img src="/node/img/antenna'+transmitersIcon+'.png" width="20" height="20" style="float:right;"><strong>' + item.registration + ' ' + item.aircraft + '</strong><br>Alt: ' + item.altitude + 'm Speed: ' + item.speed + 'km/h<br>Station: ' + item.station + '<sup>'+ distance +'km</sup>'
			
		$node='<div class="transmiter" flarmId="' + item.flarmId + '" id="transmiter' + item.flarmId + '" lat="' + item.lat + '" lon="' + item.lon + '">' +
		'<div class="transmitersIcon" id="transmitersIcon' + item.flarmId + '"></div>'+
		'<div class="transmitersData"><div class="transmitersStation" id="transmitersStation' + item.flarmId + '">'+html+'</div></div></div>'
		if($('#transmiter' + item.flarmId).length==0){
			$(".transmiters").append($node);
		}else{
			$('#transmitersStation' + item.flarmId).html(html)
		}
		$("#transmitersIcon" + item.flarmId).css('background-image', 'url(/node/img/'+item.aircraftType+'.'+transmitersIcon+'.png)');
		
		var rtMaster=(item.aircraftType=="TOW") ? -45 : 45;	
		var color=(item.age>300||item.speed<10) ? getColor("colorGliderOffline") : getColor("colorGliderOnline");
		if(item.hasMarker==0){

			var myLatLng = {lat: item.lat, lng: item.lon};
			
			
			if(item.flarmId==activeFlarm) color=getColor("colorGliderActive");
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
				clearAircrafts();
				clearTopLayer();
				activeFlarm=tx[item.flarmId].flarmId
				displayData(tx[item.flarmId]);

				tx[item.flarmId].marker.setZIndex(google.maps.Marker.MAX_ZINDEX + zIndex);
				zIndex++;
				calcMapSize();				
			});				
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
				if($("#lock").attr('lock')=="1") try{map.panTo(new google.maps.LatLng(item.lat, item.lon))}catch(e){}
				if($("#header").is(":visible")){
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
					flightPath.push({lat:item.lat,lng:item.lon})	
					flightTrack.setPath(flightPath)
					flightTrack.setMap(map)
				}
			}
			var color=(item.age>60||item.speed<10) ? getColor("colorGliderOffline") : getColor("colorGliderOnline");
			if(item.flarmId==activeFlarm) color=getColor("colorGliderActive");
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
	$(".transmiter:not("+transmitersList+")").remove()
	calcMapSize()
}
function formatpkgs(p){
	if(p<10000){
		return p		
	}else{
		return Math.round(p/100)/10 + "k";
	}
}
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
		
		var color=(item.age>300||item.speed<10) ? getColor("colorGliderOffline") : getColor("colorGliderOnline");	
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

function displayData(dataPoint){
	
	var imgClimb="0";
	
	if(dataPoint.climb>0){
		imgClimb="1";
	}else if(dataPoint.climb<0){
		imgClimb="-1";
	}
	flightPath.push({lat: dataPoint.lat, lng: dataPoint.lon})
	var climb=(Math.round(dataPoint.climb*10)/10)
	tx[dataPoint.flarmId].active=1;
	var registration=dataPoint.registration;
	if(dataPoint.pilot!="") registration=registration + ":" + dataPoint.pilot
	if(registration==null) registration="N/A";
	var distanceToStation=""
	distanceToStation=" " + Math.round(distance(dataPoint.lat, dataPoint.lon, dataPoint.stationLat, dataPoint.stationLon)*10)/10
	
	if(activeWaypoints.length>0){
		var html=""
		for(i=0;i<activeWaypoints.length;i++){
			html+="<img src='/node/img/wp." + activeWaypoints[i].waypointType + ".png' width='10' height='10'/>" + activeWaypoints[i].waypoint + " (" + activeWaypoints[i].distance + "km " + activeWaypoints[i].bearingRose+ "); "
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
	if(flightPath.length==1){
		flightTrack = new google.maps.Polyline({
			path: flightPath,
			geodesic: true,
			strokeColor: getColor("colorGliderTrack"),
			strokeOpacity: 1.0,
			strokeWeight: 2
		});	
		flightTrack.setMap(map);
	}
	if(flightPath.length>1){
		flightTrack.setMap(map);
	}
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
var commShowTimer=0;
socket.on('data', function (data) {
	$("#comm").show();
	clearTimeout(commShowTimer);
	commShowTimer=setTimeout(function(){
		$("#comm").hide();
	},300);
	console.log("DATA");
	try{

		var json=jQuery.parseJSON(JSON.stringify(data));
		var json=data
		//socket.emit('my other event', { my: 'data' });
		if(mapLoaded==true&&busy==false){
			
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
					competitionName:(json.aircrafts[i].competitionName),
					pilot:(json.aircrafts[i].pilot),
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
					if($("#chartOut").css("display")==="block"){
						if(chartType=="SPEED") chartData.push([json.aircrafts[i].time, parseFloat(json.aircrafts[i].speed)])
						if(chartType=="VARIO") chartData.push([json.aircrafts[i].time, obj.climb])
						if(chartType=="ALT") chartData.push([json.aircrafts[i].time, parseFloat(json.aircrafts[i].altitude), parseFloat(json.aircrafts[i].altitude)-200])
						var data = google.visualization.arrayToDataTable(chartData);
						try{chart.draw(data, chartOptions);}catch(e){} 
									
					}
				}
				
			}

			
			parseInt(json.clients==0) ? $("#clientsCount").html("CLI<br>0") : $("#clientsCount").html("CLI<br>"+ json.clients +"");
			var txc=0;
			$.each(tx, function(i, item) {
				if(item.hasMarker==1)
					if(map.getBounds().contains(item.marker.getPosition())) txc++;
			});
			(txc==0) ? $("#transmitersCount").html("TX<br>0") : $("#transmitersCount").html("TX<br>"+ txc +"");	
			
			var rxc=0;
			$.each(rx, function(i, item) {
				if(item.hasMarker==1)
					if(map.getBounds().contains(item.marker.getPosition())) rxc++;
			});
			(rxc==0) ? $("#receiversCount").html("RX<br>0") : $("#receiversCount").html("RX<br>"+ rxc +"");	
			var rxc=0;
			$.each(rx, function(i, item) {
				if(item.hasMarker==1)
					if(map.getBounds().contains(item.marker.getPosition())) rxc++;
			});
			(rxc==0) ? $("#receiversCount").html("RX<br>0") : $("#receiversCount").html("RX<br>"+ rxc +"");	
			var wpc=0;
			$.each(wp, function(i, item) {
				if(map.getBounds().contains(item.marker.getPosition())) wpc++;
			});
			(wpc==0) ? $("#waypointsCount").html("WPS<br>0") : $("#waypointsCount").html("WPS<br>"+ wpc +"");	
			
			
			createStations();	
		}
	}catch(e){console.log(e)}
});


$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89195032-1', 'auto');
  ga('send', 'pageview');

function ga_heartbeat(){
  _gaq.push(['_trackEvent', 'Heartbeat', 'Heartbeat', '', 0, true]);
  
}
setInterval(function(){ga_heartbeat}, 3*60*1000);
</script>
</body>
</html>

