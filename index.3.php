<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>OGN TRACKING SA</title>
    <!-- Favicon-->
      <link rel="icon" type="image/png" href="/sys/api/images/favicon.png" />

    <!-- Google Fonts -->
    <?php echo("<link href='//fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>");?>
    <?php echo("<link href='//fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet' type='text/css'>");?>
	<?php echo("<script src='//maps.googleapis.com/maps/api/js?libraries=geometry,visualization&key=AIzaSyCKOPCAqnZW-OZvw3hzOjcKTldrZZN9wLo'></script>");?>
	<?php echo("<script src='/node/js/socket.io.js'></script>");?>
    <!-- Bootstrap Core Css -->
    <?php echo("<link href='/node/bootstrap/plugins/bootstrap/css/bootstrap.css' rel='stylesheet'>");?> 

    <!-- Waves Effect Css -->
    <?php echo("<link href='/node/bootstrap/plugins/node-waves/waves.css' rel='stylesheet' />");?>

    <!-- Animation Css -->
    <?php echo("<link href='/node/bootstrap/plugins/animate-css/animate.css' rel='stylesheet' />");?>


    <!-- Custom Css -->
    <?php echo("<link href='/node/bootstrap/css/style.css' rel='stylesheet'>");?>

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <?php echo("<link href='/node/bootstrap/css/themes/all-themes.css' rel='stylesheet' />");?>
    
    
<style>
.bold{font-weight:bold;}
.hand{cursor:pointer;}
.pointer{cursor:default;}


</style>
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper loading">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p id="loadingTitle">Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">OGN - SCLC
                <span id="mapCenter"></span>
                 <img src="/node/img/rose.2.png" class="hide" width="16" height="16" id="bearingRose2"></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="javascript:void(0);"><i class="material-icons" id="conn">favorite_border</i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">settings_input_antenna</i>
                            <span class="label-count" id="stationsCount"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">STATIONS</li>
                            <li class="body">
                                <ul class="menu" id="stationsMenu">

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">Close</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <div class="menu">
                <ul class="list" id="aircraftsMenu">
                    <li class="header">AIRCRAFTS</li>
                    <li class="active removeAtFirst">
                        <a href="index.html">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
            	
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">CPV - OGN</a>.
                    
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                <li role="presentation"><a href="#activeAircraftColor" data-toggle="tab">ACTIVE</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class=" fade in active in active" id="settings">
                    <div class="demo-settings">
                        <p>Map Type</p>
                        <ul class="setting-list">
                            <li>
                                <input name="group5" type="radio" id="radio_30" value="hybrid" class="with-gap radio-col-blue-grey mapType hybrid" />
                                <label for="radio_30">Hybrid</label>
                            </li>
                            <li>
                                <input name="group5" type="radio" id="radio_31" value="roadmap" class="with-gap radio-col-blue-grey mapType roadmap" />
                                <label for="radio_31">Roadmap</label>
                            </li>
                            <li>
                                <input name="group5" type="radio" id="radio_32" value="satellite" class="with-gap radio-col-blue-grey mapType satellite" />
                                <label for="radio_32">Satellite</label>
                            </li>
                            <li>
                                <input name="group5" type="radio" id="radio_33" value="terrain" class="with-gap radio-col-blue-grey mapType terrain" />
                                <label for="radio_33">Terrain</label>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>On Top</span>
                                <div class="switch">
                                    <label>Stations<input type="checkbox" id="onTop" value="1"><span class="lever"></span>Aircrafts</label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="activeAircraftColor">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span> 
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
  	<div id="real_time_chart" class="flot-chart hide"></div>
    <div id="map" style="width:100%; height:100px"></div>


    <!-- Jquery Core Js -->
    <?php echo("<script src='/node/bootstrap/plugins/jquery/jquery.min.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/moment.js'></script>");?>

    <!-- Bootstrap Core Js -->
    <?php 
	//echo("<script src='jquery.cookie.js'></script>");
    ?>
    <?php echo("<script src='/node/bootstrap/plugins/bootstrap/js/bootstrap.js'></script>");?>

    <!-- Select Plugin Js -->
    <?php echo("<script src='/node/bootstrap/plugins/bootstrap-select/js/bootstrap-select.js'></script>");?>

    <!-- Slimscroll Plugin Js -->
    <?php echo("<script src='/node/bootstrap/plugins/jquery-slimscroll/jquery.slimscroll.js'></script>");?>

    <!-- Waves Effect Plugin Js -->
    <?php echo("<script src='/node/bootstrap/plugins/node-waves/waves.js'></script>");?>

    <!-- Jquery CountTo Plugin Js -->
    <?php echo("<script src='/node/bootstrap/plugins/jquery-countto/jquery.countTo.js'></script>");?>


    <!-- Flot Charts Plugin Js -->
    <?php echo("<script src='/node/bootstrap/plugins/flot-charts/jquery.flot.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/plugins/flot-charts/jquery.flot.resize.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/plugins/flot-charts/jquery.flot.categories.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/plugins/flot-charts/jquery.flot.time.js'></script>");?>


    <!-- Custom Js -->
    <?php echo("<script src='/node/bootstrap/js/admin.js'></script>");?>

    <!-- Demo Js -->
    <?php echo("<script src='/node/bootstrap/js/demo.js'></script>");?>


    <?php echo("<script src='/node/bootstrap/plugins/cookies/cookies.js'></script>");?>
    
    <?php echo("<script src='/node/bootstrap/plugins/momentjs/moment.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/plugins/momentjs/es.js'></script>");?>
    <?php echo("<script src='/node/bootstrap/plugins/momentjs/en.js'></script>");?>
</body>
<script>
var chtTimer
var firstTime=true
$(document).off('click', '.cht').on('click', '.cht', function(){
	console.log("CHT")
	$("#real_time_chart").removeClass("hide")
	resizeMap();
	startCht($(this).attr("cht"))
});
$('#real_time_chart').off('click').on('click', function(){
	$("#real_time_chart").addClass("hide")
	resizeMap();
	
});
function startCht(type){
	$.ajax({
		url:"/node/data.php?FLAG="+type+"&FLARM=" + activeFlarm,
		data: "",
		type:"POST",
		dataType:"json",
		success: function(data){
			data=data[type.toLowerCase()]
			chartData=[];
			var chartData2=[];
			var jsonConfig={},jsonConfig2={}
			for(i=0;i<data.length;i++){
				var dataArray=[data.length-i, parseFloat(data[i][type.toLowerCase()])]
				var dataArray2=[]
				if(type=="ALTITUDE"){
					dataArray2=[data.length-i, parseFloat(data[i].ground)]
					chartData2.push(dataArray2)
				}
				
				chartData.push(dataArray)
			}
			var dataFinal=[]
			if(type=="ALTITUDE"){
				jsonConfig.color="#FFB56A";
				jsonConfig.data=chartData
				
				jsonConfig2.color="#B3FFFF";
				jsonConfig2.data=chartData2
				dataFinal=[jsonConfig2, jsonConfig]
			}else{
				jsonConfig.color="#FFB56A";
				jsonConfig.data=chartData
				dataFinal=[jsonConfig]
			}
			console.log(dataFinal)
			if(chartData.length>1){
	
				var plot = $.plot('#real_time_chart', dataFinal, {
					series: {
						shadowSize: 0,
						colors: ['#B3FFFF', '#FFB56A']
					},
					grid: {
						borderColor: '#f3f3f3',
						borderWidth: 1,
						tickColor: '#f3f3f3',
						margin:0
					},
					lines: {
						fill: true
					},
					xaxis: {
						show:false
					}
				});
			}
		}
	});
}
$(function() {

	
	if (typeof(Storage) !== "undefined") {
		console.log("STORAGE")
	} else {
		console.log("!STORAGE")
	}	
    var $elie = $("#bearingRose2"), degree = 0, timer;
    rotate();
    function rotate() {

        $elie.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});  
        $elie.css({ '-moz-transform': 'rotate(' + degree + 'deg)'});
        $elie.css('transform','rotate('+degree+'deg)');                      
        timer = setTimeout(function() {
            ++degree; rotate();
			//console.log(degree)
        },5);
    }
}); 

function getRotationDegrees(obj) {
	var matrix = obj.css("-webkit-transform") ||
	obj.css("-moz-transform")    ||
	obj.css("-ms-transform")     ||
	obj.css("-o-transform")      ||
	obj.css("transform");
	if(matrix !== 'none') {
		var values = matrix.split('(')[1].split(')')[0].split(',');
		var a = values[0];
		var b = values[1];
		var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
	} else { var angle = 0; }
	return (angle < 0) ? angle +=360 : angle;
}

var activeBounds;

function loading(state, txt){
	if(!txt) txt="Please wait...";
	if(state){
		$("#loadingTitle").text(txt);
		$(".loading").show();
		
	}else
		$(".loading").hide();	
}

function initMap() {
		
		//google.charts.load('current', {'packages':['corechart']});
		console.log("INITMAP")
		loading(true, "Initializing MAP")
		map = new google.maps.Map(document.getElementById('map'), {
			center: { lat: parseFloat(localStorage.getItem("lat")), lng: parseFloat(localStorage.getItem("lon"))},
			zoom: parseInt(localStorage.getItem("zoom")),
			panControl:false,
			zoomControl:false,
			mapTypeId:localStorage.getItem("mapType"), //$.cookie("mapType"),
			mapTypeControl: false,
			scaleControl: true,
			navigationControl: false,
			streetViewControl: false,
		});
		$(".removeAtFirst").remove()
		console.log("INITMAP2")
		loading(true, "Startup Trigger")
		startUp()		
		google.maps.event.addListenerOnce(map, 'tilesloaded', function () {
			setTitleMapCoordinates();
			infowindow = new google.maps.InfoWindow();
			google.maps.event.addListener(map, 'zoom_changed', function () {
				localStorage.setItem("zoom", map.getZoom())
				setTitleMapCoordinates();
			});
			
			activeBounds=map.getBounds();
			google.maps.event.addListener(map, 'center_changed', function () {
				//$(".menu").hide();
				//$(".options").hide();
				setTitleMapCoordinates()
				localStorage.setItem("lat", map.getCenter().lat())
				localStorage.setItem("lon", map.getCenter().lng())
				
				activeBounds=map.getBounds();
				
			});
			google.maps.event.addListener(map, 'click', function () {
				activeFlarm="";
				activeStation="";
				infowindow.close();
				removeHeatmap();
				activeFlarmExtra=false;
				openCloseRightNav();
				clearTrackPath();
				clearRadarPath();
				radar=false;track=false;lock=false
				
			});

			google.maps.event.addListener( map, 'maptypeid_changed', function() { 
			});
			
			google.maps.event.addListener(infowindow,'closeclick',function(){
				activeFlarm="";
				activeStation="";
				infowindow.close();
				removeHeatmap();
				activeFlarmExtra=false;
				openCloseRightNav();
				clearTrackPath();
				clearRadarPath();
				radar=false;track=false;lock=false
			});		
			var lineSymbol = {
				path: 'M 0,-0.5 0,0.5',
				strokeOpacity: 1,
				scale: 4
			};
		
			flightRadar = new google.maps.Polyline({
				path: [],
				strokeColor: "#FF5722",
				strokeOpacity: 0,
				icons: [{
					icon: lineSymbol,
					offset: '0',
					repeat: '15px'
				}],
				//strokeWeight: 3,
				map: map
			});			
			flightTrack = new google.maps.Polyline({
				path: [],
				strokeColor: "#00ccff",
				strokeOpacity: 1.0,
				strokeWeight: 3,
				map: map
			});				
		});
}
function setTitleMapCoordinates(){
	var lat=(Math.round(map.getCenter().lat()*10000)/10000);
	var lng=(Math.round(map.getCenter().lng()*10000)/10000);
	
	$("#mapCenter").html("LL:" +  lat + "/" + lng)
}
var stations=[], aircrafts=[], aircraftsLines=[]
var stationsMarkers=[], aircraftsMarkers=[];
var showInfoWindowsAircrafts=false;
$(function(){
	resizeMap()
	setTimeout(function(){initMap()},1000)
})
$('#onTop').off('click').on('click', function(){
	if($(this).is(":checked")){
		localStorage.setItem("onTop", "1")
		MAX_ZS=0;
		MAX_ZA=1000000;
	}else{
		localStorage.setItem("onTop", "0");
		MAX_ZA=0;
		MAX_ZS=1000000;
	}
});
$(document).off('click', '.mapType').on('click', '.mapType', function(){
	localStorage.setItem("mapType", $(this).val())
	map.setMapTypeId($(this).val())
});

function startUp(){
	if(!localStorage.getItem("lat")) localStorage.setItem("lat", -33.380167)
	if(!localStorage.getItem("lon")) localStorage.setItem("lon", -70.5825)
	if(isNaN(localStorage.getItem("lat"))) localStorage.setItem("lat", -33.380167)
	if(isNaN(localStorage.getItem("lon"))) localStorage.setItem("lon", -70.5825)
	if(!localStorage.getItem("zoom")||isNaN(localStorage.getItem("zoom"))) localStorage.setItem("zoom", 12)
	if(!localStorage.getItem("zoom")=="0") localStorage.setItem("zoom", 12)
	if(!localStorage.getItem("visible")) localStorage.setItem("visible", "all") 
	if(!localStorage.getItem("mapType")) localStorage.setItem("mapType", "roadmap")
	if(!localStorage.getItem("onTop")) localStorage.setItem("onTop", "0");
	if(!localStorage.getItem("heatmapDate")) localStorage.setItem("heatmapDate", "-1");
	
	
	if(localStorage.getItem("onTop")=="0"){
		$("#onTop").prop("checked", false)	
		MAX_ZA=0;
		MAX_ZS=1000000;
	}else{
		$("#onTop").prop("checked", true)
		MAX_ZS=0;
		MAX_ZA=1000000;
		
	}
	$("." + localStorage.getItem("mapType")).prop("checked", true)
	//initMap();
	loading(true, "Loading Config")
	$.ajax({
		url:"config.json",
		complete: function(){loading(false)},
		success: function(json){
	console.log(json.socket.server)
			socket=io.connect('' + json.socket.server + ':' + json.socket.port, {
				secure:true,
				verify:false,
				reconnect:true,
				query: "platform=desktop" + 
				"&ne_lat=" + json.bounds.ne_lat +
				"&ne_lon=" + json.bounds.ne_lat +
				"&sw_lat=" + json.bounds.ne_lat +
				"&sw_lon=" + json.bounds.ne_lat
			});
			
			socket.on('data', function (data) {
				$("#conn").html("favorite").addClass("col-red")
				setTimeout(function(){
					$("#conn").html("favorite_border").removeClass("col-red")
				},500)
				var json=jQuery.parseJSON(JSON.stringify(data));
				//console.log(json)
				stations={}; aircrafts={}
				for(i=0;i<json.stations.length;i++){
					stations[json.stations[i].station]=json.stations[i];
				}
				for(i=0;i<json.aircrafts.length;i++){
					aircrafts[json.aircrafts[i].flarmId]=json.aircrafts[i];
				}
				//aircrafts=json.aircrafts
				//stations=json.stations
				stations.length==0 ? $("#stationsCount").text("") : $("#stationsCount").text("" + getObjLength(stations) + "");
				aircrafts.length==0 ? $("#aircraftsCount").text("") : $("#aircraftsCount").text("" + getObjLength(aircrafts) + "");
				if(firstTime==true) loading(true, "Creating stations...")
				createStations();
				if(firstTime==true) loading(true, "Creating aircrafts...")
				createAircrafts();
				if(firstTime==true) loading(false);
				firstTime=false;
			});
		}
	});
}

var activeFlarmExtra=false
function setInfoWindowAircraft(flarmId){
	var obj=aircrafts[flarmId];
	var climb=(Math.round(parseFloat(obj.climb)*10)/10)
	var sensitivity=(Math.round(parseFloat(obj.sensitivity)*10)/10)
	var html='<div style="background-color:#008080; color:white; margin-bottom:3px; text-align:center; padding:3px;">'+obj.registration
	if(obj.aircraft!='') html+='<br>' + obj.aircraft
	
	html+='</div>' + 
	'<table width="100%" border="0" cellspacing="1" cellpadding="2">' +
  '<tr>' +
    '<td><strong>GSP:</strong></td>' +
    '<td><a class="cht" cht="SPEED" flarmId="'+ obj.flarmId +'">'+ parseInt(obj.speed) +'km/h</a></td>' +
    '<td nowrap><strong>&nbsp;COU:</strong></td>' +
    '<td>'+ parseInt(obj.course) +'º</td>' +
  '</tr>' +
  '<tr>' +
    '<td><strong>ALT:</strong></td>' +
    '<td><a class="cht" cht="ALTITUDE" flarmId="'+ obj.flarmId +'">'+ parseInt(obj.altitude) +'m</a></td>' +
    '<td nowrap><strong>&nbsp;VAR:</strong></td>' +
    '<td><a class="cht" cht="VARIO" flarmId="'+ obj.flarmId +'">'+ climb +'m/s</a></td>' +
  '</tr>' +
  '<tr>' +
    '<td><strong>GRN:</strong></td>' +
    '<td>'+ parseInt(obj.ground) +'m</td>' +
    '<td nowrap><strong>&nbsp;RX:</strong></td>' +
    '<td>'+ sensitivity +'db</td>' +
  '</tr>' +
  '<tr>' +
    '<td><strong>STA:</strong></td>' +
    '<td colspan="3"><a onclick="$(\'#stationListClick' + obj.station + '\').click();">'+ (obj.station) + '@' + parseInt(obj.distance) + 'km</a>;</td>' +
  '</tr>' +
  '<tr>' +
    '<td colspan="4" align="center">'+
		getAge(obj.age) + '</td>' +
  '</tr>' +
  '<tr>' +
    '<td colspan="4" align="center"><hr style="border-top:1px solid #777; margin:2px 0 2px">'+
	'<a class="cmd ' + (lock ? 'font-bold' : '') + '" cmd="lock">Lock</a> | <a class="cmd ' + (track ? 'font-bold' : '') + '" cmd="track">Track</a> | <a class="cmd ' + (radar ? 'font-bold' : '') + '" cmd="radar">Radar</a></td>' +
  '</tr>' +
'</table>'
	infowindow.setContent(html);
	try{
		infowindow.open(map, aircraftsMarkers[flarmId]);
		
		//map.panTo(new google.maps.LatLng(parseFloat(obj.lat), parseFloat(obj.lon)))
	}catch(e){console.log(e)}

/*	$('#stationPhotoThumb').off('click').on('click', function(){
		$("#stationPhoto").html('<img width=350 height=350 src="' + $(this).attr('src') + '">').show().css({"left":($(window).width()-350)/2, "top":($(window).height()-350)/2 });
	});	*/	
}
var lock=false, track=false, radar=false;
$(document).off('click', '.cmd').on('click', '.cmd', function(){
	$(this).toggleClass("font-bold");
	if($(this).attr("cmd")=="lock"){
		lock=!lock	
	}
	if($(this).attr("cmd")=="track"){
		track=!track

		clearTrackPath()
		if(track){
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
				
		
	}
	if($(this).attr("cmd")=="radar"){
		radar=!radar;
		if(!radar) clearRadarPath()

	}
	
});
function clearRadarPath(){flightRadar.setPath([]);}
function clearTrackPath(){flightTrack.setPath([]);}

function AnimateRotate(angle) {
    // caching the object for performance reasons
    var $elem = $('#bearingRose');

    // we use a pseudo object for the animation
    // (starts from `0` to `angle`), you can name it as you want
    $({deg: 0}).animate({deg: angle}, {
        duration: 1000,
        step: function(now) {
            // in the step-callback (that is fired each step of the animation),
            // you can use the `now` paramter which contains the current
            // animation-position (`0` up to `angle`)
            $elem.css({
                transform: 'rotate(' + now + 'deg)'
            });
        }
    });
}
var MAX_ZINDEX=1,MAX_ZS=0,MAX_ZA=0

var flightTrack, flightRadar;
var flightPath = [];

function createAircrafts(){
	
	for (var item2 in aircrafts){
		

					
		var item=aircrafts[item2];
		var color="green"
		if(item.age>60) color="cyan" 
		if(item.age>60||item.speed<10) color="gray"
		if(item.age>300) color="black"
		if(item.flarmId==activeFlarm){
			color="yellow"
		}
		var rotation=Math.round( (parseInt(item.course))/10) *10;
		var aircraftName=item.registration
		if(item.competitionName!="") aircraftName=item.competitionName
		var urlIcon="/node/icon.generator.php?a=" + rotation + "&c=" + color + "&cn=" + aircraftName 

		var pinIcon = new google.maps.MarkerImage(
			urlIcon,
			null, /* size is determined at runtime */
			null, /* origin is 0,0 */
			new google.maps.Point(21,21),
			new google.maps.Size(42,42)
		);  
					
		if(!aircraftsMarkers[item.flarmId]){
			//No existe el marker	
			console.log(item)
			var myLatLng = {lat: parseFloat(item.lat), lng: parseFloat(item.lon)};
			var marker = new google.maps.Marker({
				position: myLatLng,
				title: item.flarmId,
				flarmId: item.flarmId,
				icon: pinIcon,
				map: map
			});
			
			google.maps.event.addDomListener(marker, 'click', function() {
				activeFlarm=this.flarmId
				activeStation=""; 
				activeFlarmExtra=true
				activeStation="";
				infowindow.close();
				removeHeatmap();
				clearTrackPath();
				clearRadarPath();
				radar=false;track=false;lock=false
			});			
			marker.setZIndex(MAX_ZINDEX);
			MAX_ZINDEX++;
			
			aircraftsMarkers[item.flarmId]=marker; 
			$("#aircraftsMenu").append('<li class="aircraftsMenuLi aircraftList" id="aircraftsMenuLi'+item.flarmId+'" flarmId="'+item.flarmId+'">'+
				'<a href="#">'+
				'<i class="material-icons" flarmId="' + item.flarmId + '" id="aircraftMenuIcon' + item.flarmId + '">flash_on</i>'+
				'<span class="aircraftMenuSpan" id="aircraftMenu' + item.flarmId + '">'+item.registration+' @ ' + item.altitude +'m</span>'+
				'</a>'+
				'</li>')
			
			//item.marker=marker;
			//item.hasMarker=1;			
		}else{
			var marker=aircraftsMarkers[item.flarmId]
			if(activeFlarm==item.flarmId){
				if(lock) try{map.panTo(new google.maps.LatLng(item.lat, item.lon))}catch(e){}
				if(activeFlarmExtra==true) setInfoWindowAircraft(item.flarmId)
				//map.panTo(new google.maps.LatLng(item.lat, item.lon))
				
				if(radar){
					var pathLine=[
					new google.maps.LatLng( Math.round(parseFloat(item.lat)*10000)*0.0001, Math.round(parseFloat(item.lon)*10000)*0.0001 ),
					new google.maps.LatLng( Math.round(parseFloat(item.stationLat)*10000)*0.0001, Math.round(parseFloat(item.stationLon)*10000)*0.0001 ) 
					]
					flightRadar.setPath(pathLine)
					flightRadar.setMap(map)
				}
				if(track){
					flightPath.push({lat:parseFloat(item.lat),lng:parseFloat(item.lon)})	
					flightTrack.setPath(flightPath)
					flightTrack.setMap(map)
				}

			}
			

							
			$("#aircraftMenu" + item.flarmId).text(item.registration+' @ ' + item.altitude + 'm ' + getAge(item.age));
			
			marker.setPosition(new google.maps.LatLng(parseFloat(item.lat), parseFloat(item.lon)));
			
			if(item.age>60||item.speed<10){
				$("#aircraftMenuIcon" + item.flarmId).removeClass("col-grey col-green").addClass("col-grey").text("flash_off")
			}else{
				$("#aircraftMenuIcon" + item.flarmId).removeClass("col-grey col-green").addClass("col-green").text("flash_on")
			}


						
			marker.setIcon(pinIcon)
			
			if(activeFlarm==item.flarmId){
				MAX_ZINDEX++; marker.setZIndex(MAX_ZINDEX);
				$(".aircraftMenuSpan").removeClass("col-blue")
				$("#aircraftMenu" + activeFlarm).addClass("col-blue")
			} 
		}
	}
	if(activeFlarm==""){
		$(".aircraftMenuSpan").removeClass("col-blue")
	}
	$(".aircraftsMenuLi").each(function(index, element) {
		var found=false;
		for (var item2 in aircrafts){
			var item=aircrafts[item2];
			if(item.flarmId==$(this).attr('flarmId')){
				found=true;
			}
		}
		if(found==false) removeAircraft($(this).attr('flarmId'));
	});
}
function getObjLength(obj){
	var t=0;
	for (var item2 in obj){
		t++
	}
	return t;
}
function removeAircraft(flarmId){
	$("#aircraftsMenuLi" + flarmId).remove()
	var marker=aircraftsMarkers[flarmId];
	marker.setMap(null)
	delete(aircraftsMarkers[flarmId]);
	
}
var activeFlarm="", activeStation=""
$(document).off('click', '.aircraftList').on('click', '.aircraftList', function(){
	activeFlarm=$(this).attr('flarmId');
	activeStation="";
	infowindow.close();
	var obj=aircrafts[activeFlarm];
	map.panTo(new google.maps.LatLng(parseFloat(obj.lat), parseFloat(obj.lon)))
	openCloseRightNav();
	clearTrackPath();
	clearRadarPath();
	removeHeatmap();
	radar=false;track=false;lock=false

});
function getAge(age){
	var now=(moment().subtract(parseInt(age), 'seconds'));
	return (moment(now).fromNow())
}
function errorGeo(msg){
	alert("No pudimos obtener su posición:" + msg);
}
function successGeo(position){
}
function centerOnMyPosition(){
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(successGeo, errorGeo);
	} else {
		alert("No pudimos obtener su posición2");
	}	
}
var infowindow;
function setInfoStation(station){
	var obj=stations[station];
	
	var lat=Math.round(parseFloat(obj.lat)*1000)/1000
	var lon=Math.round(parseFloat(obj.lon)*1000)/1000
	var rf=Math.round(parseFloat(obj.rf)*10)/10
	var maxDistance=Math.round(parseFloat(obj.maxDistance)*10)/10
	var html='<div style="background-color:#008080; color:white; margin-bottom:3px; text-align:center; padding:3px;">' + obj.station + '</div><img id="stationPhotoThumb" style="float:left; padding-right:4px;" width=40 height=40 src="/node/img/stations/' + obj.station + '.jpg"><div style="float:left">' + 
'<table width="100%" border="0" cellspacing="1" cellpadding="2">' +
  '<tr>' +
    '<td><strong>LAT:</strong></td>' +
    '<td>'+ lat +'</td>' +
    '<td nowrap><strong>&nbsp;LNG:</strong></td>' +
    '<td>'+ obj.lon +'</td>' +
  '</tr>' +
  '<tr>' +
    '<td><strong>CPU:</strong></td>' +
    '<td>'+ parseInt(obj.cpu) +'%</td>' +
    '<td nowrap><strong>&nbsp;TMP:</strong></td>' +
    '<td>'+ parseInt(obj.temp) +'ºC</td>' +
  '</tr>' +
  '<tr>' +
    '<td><strong>SNR:</strong></td>' +
    '<td>'+ rf +'dB</td>' +
    '<td nowrap><strong>&nbsp;MXD:</strong></td>' +
    '<td>'+ maxDistance +'km</td>' +
  '</tr>' +
    '<td><strong>TRA:</strong></td>' +
    '<td>'+ parseInt(obj.trackingAircrafts) +'</td>' +
    '<td nowrap><strong>&nbsp;PKG:</strong></td>' +
    '<td>'+ parseInt(obj.pkgs) +'</td>' +
  '</tr>' +
  '<tr>' +
    '<td colspan="4" align="center">'+
		getAge(obj.age) + '</td>' +
  '</tr>'
  
	var html2=""
	for (var item2 in aircrafts){
		var item=aircrafts[item2];	
  		if(item.station==obj.station) html2+='<a onclick="$(\'#aircraftsMenuLi' + item2 + '\').click();">' + item.registration + '</a>; '
	}
	if(html2!="") html+='<tr>' +
    '<td colspan="4" align="left"><strong>Follow: </strong>' + html2 + 
	'</tr></tr>';
	
	
  
	var html2=""
	for (i=0;i<obj.nearby.length;i++){
		html2+='<a onclick="$(\'#stationListClick' + obj.nearby[i].station + '\').click();">' + obj.nearby[i].station + '</a>; '
	}
	if(html2!="") html+='<tr>' +
    '<td colspan="4" align="left"><strong>Nearby: </strong>' + html2 + 
	'</tr></tr>';
	
  html+='<tr>' +
    '<td colspan="4" align="center">'+
	'</strong><hr style="border-top:1px solid #777; margin:2px 0 2px"><a href="#" class="moraInfoStation" station="'+obj.station+'">More Info</a> | <a href="#" onclick="setHeatMap(\'' + obj.station + '\')" station="'+obj.station+'">Heatmap</a></td>' +
  '</tr>' +
'</table>'	
	
	infowindow.setContent(html);
	try{
		infowindow.open(map, stationsMarkers[station]);
		//map.panTo(new google.maps.LatLng(parseFloat(obj.lat), parseFloat(obj.lon)))
	}catch(e){console.log(e)}
	$('#stationPhotoThumb').off('click').on('click', function(){
		$("#stationPhoto").html('<img width=350 height=350 src="' + $(this).attr('src') + '">').show().css({"left":($(window).width()-350)/2, "top":($(window).height()-350)/2 });
	});	
	//setupNearby(item.station);	
}

var heatmap;
function removeHeatmap(){
	try{heatmap.setMap(null)}catch(e){};
}
function setHeatMap(station){
	try{heatmap.setMap(null)}catch(e){};
	var url="/node/data.php?FLAG=GETHEATMAP&station=" + station + "&offset=-1" //+ localStorage.getItem("heatmapDate");
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

function createStations(){
	for (var item2 in stations){
		var item=stations[item2];
	//for(i=0;i<stations.length;i++){
		var stationIcon=(item.age>300) ? '<div class="icon-circle bg-grey"> <i class="material-icons">flash_off</i> </div>' : '<div class="icon-circle bg-light-green"> <i class="material-icons">flash_on</i> </div>';

		getAge(item.age)		
		if(!stationsMarkers[item.station]){
			//No existe el marker	
			
			var myLatLng = {lat: parseFloat(item.lat), lng: parseFloat(item.lon)};
			var pinIcon = new google.maps.MarkerImage(
				parseInt(item.age>60*5) ? "/node/img/rx.0.png" : "/node/img/rx.1.png",
				null, /* size is determined at runtime */
				null, /* origin is 0,0 */
				new google.maps.Point(8,8),
				new google.maps.Size(16,16)
			);  
			
			var marker = new google.maps.Marker({ 
				position: myLatLng,
				title: item.station,
				station:item.station,
				icon: pinIcon,
/*				{
					url: parseInt(item.age>60*5) ? "/node/img/rx.0.png" : "/node/img/rx.1.png",
					size: new google.maps.Size(16,16),
                    origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(0, 16)
				},*/
				map: map
			});
			marker.addListener('click', function() {
				activeFlarm=""
				activeFlarmExtra=false
				infowindow.close();
				removeHeatmap();
				activeStation=this.station;
				setInfoStation(this.station)
				var obj=stations[activeStation]
				map.panTo(new google.maps.LatLng(parseFloat(obj.lat), parseFloat(obj.lon)))
				
				
			});	
			marker.setZIndex(MAX_ZINDEX);
			MAX_ZINDEX++;
			stationsMarkers[item.station]=marker;
			$("#stationsMenu").append('<li class="nav">'+
				'<a href="javascript:void(0);" class=" waves-effect waves-block stationListClick" id="stationListClick'+item.station+'" station="'+item.station+'">'+
				stationIcon+
				'<div class="menu-info">'+
				'<h4>'+item.station+'</h4>'+
				'<p>'+
				'<i class="material-icons">access_time</i><span id="stationAge'+item.station+'">'+ getAge(item.age) + '</span>', 
				'</p>'+
				'</div>'+
				'</a>'+
				'</li>')
				$(document).off('click', '.stationListClick').on('click', '.stationListClick', function(){
					activeFlarm=""
					activeFlarmExtra=false
					infowindow.close();
					removeHeatmap();
					activeStation=$(this).attr("station");
					setInfoStation($(this).attr("station"));
				});					
		}else{
			$("#stationAge" + item.station).text(getAge(item.age) + ' | ' + (Math.round(item.cpu*100)) + '% | ' + item.temp + 'º')
			//El marker existe
			if(item.station==activeStation){
				setInfoStation(item.station)	
			}
		}
	}
}

window.addEventListener("resize", function() {
    // Announce the new orientation number
	resizeMap()
	setTimeout(function(){resizeMap()},300)
	

}, false);
function resizeMap(){
	try{
		var currCenter = map.getCenter();
	}catch(e){
		
	}
	var marginLeft=parseInt($("#leftsidebar").css("margin-left").replace("px",""))
	var topPadding=parseInt($(".container-fluid").height())
	var topPadding2=parseInt($(".container-fluid").height())
	
	$("#real_time_chart").css({
		left:(300+parseInt(marginLeft)), 
		width:$(window).width() - (300+parseInt(marginLeft)),
		height:parseInt($(window).height()/7),
		top:topPadding2
	})
	
	
	if($("#real_time_chart").is(":visible")) topPadding2+=parseInt($("#real_time_chart").css("height").replace("px",""))
	
	//var bottomCardHeight= $(".bottomCard").is(":visible") ? $(".bottomCard").height() : 0; 
	$("#map").css({
		height:$(window).height()- topPadding2, 
		top:topPadding ,
		left:(300+parseInt(marginLeft)), 
		width:$(window).width() - (300+parseInt(marginLeft))
	});
	
	
	if(currCenter){
		google.maps.event.trigger(map, 'resize');
		map.setCenter(currCenter);	
	}
}
function getAircraftType(type){
	var aircraftType="GLIDER";
	if(type.toLowerCase().indexOf("pa-18")>=0) aircraftType="TOW"	
	return aircraftType;
}
function openCloseRightNav(){
	if($(".bars").is(":visible")) $(".bars").click()

/*	var $body = $('body');
	var $overlay = $('.overlay');

	//Open left sidebar panel
	$('.bars').on('click', function () {
		$body.toggleClass('overlay-open');
		if ($body.hasClass('overlay-open')) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
	});

	//Close collapse bar on click event
	$('.nav [data-close="true"]').on('click', function () {
		var isVisible = $('.navbar-toggle').is(':visible');
		var $navbarCollapse = $('.navbar-collapse');

		if (isVisible) {
			$navbarCollapse.slideUp(function () {
				$navbarCollapse.removeClass('in').removeAttr('style');
			});
		}
	});*/
}
function getColor(element){
	return(colors[localStorage.getItem(element)])
}
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
var tow="m 15.388371,4.7812376 c 0.06737,0.067371 0.06088,0.1535326 -0.171754,0.656096 -0.02746,0.059318 -0.18034,0.2765235 -0.18034,0.2765235 -10e-7,-1e-6 0.102687,0.1129918 0.130532,0.1408372 0.05383,0.053834 0.07864,0.1746392 0.05668,0.2696526 -0.06814,0.2947833 -0.8899,1.4704243 -1.349979,1.9305048 -0.285512,0.2855112 -0.432705,0.4805551 -0.422513,0.5599149 0.0086,0.06697 0.116774,0.3550941 0.240455,0.6389223 0.218228,0.5008044 0.299971,0.5993204 2.76179,3.3388821 1.949531,2.169479 2.546055,2.86956 2.58145,3.028007 0.09814,0.43933 -0.282015,0.847468 -1.264103,1.35685 l -0.506673,0.262782 c 0,0 -7.3888187,-5.289995 -7.3888187,-5.289995 l -4.429513,3.364643 0.101334,0.18034 c 0.055981,0.09885 0.518862,0.676109 1.028802,1.282996 0.509938,0.606889 0.932924,1.160835 0.939489,1.231471 0.026392,0.283961 -1.110644,1.177107 -1.281278,1.006472 -0.269318,-0.269317 -1.398977,-1.131169 -1.494252,-1.14044 -0.068024,-0.0066 -1.039054,-0.747073 -1.368872,-1.076892 -0.329819,-0.329818 -1.070274,-1.300849 -1.076892,-1.368872 -0.00927,-0.09528 -0.871124,-1.224934 -1.140441,-1.494253 -0.17063503,-0.170635 0.722512,-1.30767 1.006474,-1.281277 0.070635,0.0066 0.624579,0.42955 1.231469,0.939488 0.606887,0.50994 1.184148,0.972821 1.282997,1.028802 l 0.180339,0.101334 3.364644,-4.429513 c 0,0 -5.289996,-7.3888202 -5.289997,-7.3888202 l 0.262784,-0.506672 c 0.509382,-0.9820888 0.917519,-1.3622407 1.356849,-1.2641029 0.158448,0.035395 0.858528,0.6319166 3.028007,2.5814488 2.7395627,2.4618182 2.8380777,2.5435617 3.3388797,2.7617902 0.283829,0.1236801 0.571952,0.2318519 0.638923,0.2404552 0.07936,0.010191 0.274402,-0.1370033 0.559915,-0.4225135 0.460079,-0.4600805 1.635721,-1.2818435 1.930505,-1.3499793 0.09501,-0.021963 0.215817,0.00284 0.269652,0.056678 0.02785,0.027846 0.139121,0.1288154 0.139121,0.1288154 0,0 0.217204,-0.1528832 0.276522,-0.1803404 0.502564,-0.2326341 0.590442,-0.2374085 0.657815,-0.1700356 z"

var glider="M15.222242261163544,17.778045386418853 l0.03751711736144195,0.03751711736144195 l-5.050741924784112,5.048610270388576 c-0.9694764190899875,0.9716080734855234 -3.2439516591274002,2.3222242984974315 -3.2439516591274002,2.3222242984974315 a0.7337154429436532,0.7337154429436532 0 0 1 -0.9456018898599785,-1.1152815797446822 l7.747284735137747,-7.74685840425864 zm9.88490776298172,-11.756926653141848 a0.7337154429436532,0.7337154429436532 0 0 0 -1.0372630288680469,0 l-7.747284735137747,7.747284735137747 l1.4537882977558736,1.4537882977558736 l0.03751711736144195,0.03751711736144195 l5.048610270388576,-5.049036601267684 c0.9694764190899875,-0.9694764190899875 2.3222242984974315,-3.2439516591274002 2.3222242984974315,-3.2439516591274002 a0.7337154429436532,0.7337154429436532 0 0 0 -0.07759221999752759,-0.9456018898599785 zm-2.235679130038649,13.610186984621254 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9912192939244586,0.41013030570121717 l-1.8404704051061884,1.8404704051061884 a1.4022022613838911,1.4022022613838911 0 0 0 0,1.982864918728024 l0.25579852746437626,0.25579852746437626 l3.82376165471332,-3.8233353238342134 l-0.25579852746437626,-0.25579852746437626 a1.3975126217137106,1.3975126217137106 0 0 0 -0.9920719556826738,-0.41013030570121717 zm-1.995228514222136,0.4497790774581954 l-0.7968124130515336,0.7968124130515336 c-1.7424143029115111,-1.732608692692044 -2.7378969056270432,-2.643251450465223 -4.376712804915481,-3.58117938450127 l-1.6742013622543443,-1.676333016649881 c-2.728517626286682,-2.728517626286682 -2.777119346504914,-3.6839251263661286 -2.435201981460864,-4.026268822289285 c0.08142919790949325,-0.08142919790949325 0.20293349845507222,-0.1402628592262999 0.38369779119656483,-0.1402628592262999 c0.5388822311916196,0 1.597461804015031,0.5299292827303667 3.6434236928509343,2.575464840687164 l1.6750540240125584,1.6750540240125584 c0.9357962796405109,1.6400948919257603 1.8489970226883348,2.634724832883078 3.5807530536221632,4.376712804915481 zm-6.688705162314335,-6.941519373624962 c-1.4623149153380188,-1.272171343256165 -2.1252594323498606,-1.4115815407242511 -2.2932337987181346,-1.2436071743559771 c-0.11510933735896944,0.11510933735896944 -0.08142919790949325,0.3572652766919127 0.09933509483199963,0.7204991856913271 c0.20932846164168142,0.4195095850415778 0.5917472602009244,0.9468808824973012 1.1421404251284408,1.574866267422344 z"

</script>
</html>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-content">

            </div>
            <button type="button" class="btn hide" id="btnCloseModal" data-dismiss="modal"></button>
        </div>
    </div>