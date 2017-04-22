<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlString="select distinct(station) from OLAP_RECEIVERS_DISTANCE order by station asc";
$sqlStringTemp="select date";
$stations = array( );
$rSet = $conn->query($sqlString);
if ($rSet->num_rows > 0) {
	//echo $sqlString;
	while($r2 = $rSet->fetch_assoc()) {
		$station=$r2["station"];
		array_push($stations,$r2); 
		$stationsData[$station]="";
		$sqlStringTemp=$sqlStringTemp.", ROUND(max(case when station = '".$station."' then distance else 0 end),2) ".$station;
	}
	$sqlStringTemp=$sqlStringTemp." from OLAP_RECEIVERS_DISTANCE group by date order by date desc";
}
//$stationsData = array(count($stations)+1);
$rSet = $conn->query($sqlStringTemp);
$stationsData['date']="";

if ($rSet->num_rows > 0) {
	//echo $sqlString;
	
	while($r3 = $rSet->fetch_assoc()) {
		//$stationsData[$i]=$stationsData[$i].$r3["date"].",";
		$stationsData['date']=$stationsData['date'].$r3["date"].","; 
		for($i = 0; $i < count($stations); $i++) {
		//foreach($stationsData as $x => $x_value) {
			//print $stations[$i]["station"];
			$stationsData[$stations[$i]["station"]]=$stationsData[$stations[$i]["station"]].$r3[$stations[$i]["station"]].",";
		}
		//$stationsData["ROBLE1"]=substr($stationsData["ROBLE1"], 0, strlen($stationsData["ROBLE1"])-1);
	}
}

for($i = 0; $i < count($stations); $i++) {
	$stationsData[$stations[$i]["station"]]=substr($stationsData[$stations[$i]["station"]], 0, strlen($stationsData[$stations[$i]["station"]])-1);
}

?>

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


<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <style>
  html, body { 
	height: 100%;
	margin: 0;
	padding: 0;
  }

body,td,th {
font-family: Verdana, Geneva, sans-serif;
font-size: 12px;
	
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
    </style>
  </head>
<body>
<style>


</style>
<div id="example">
    <div class="demo-section k-content wide">
        <div id="chart" style="background: center no-repeat url('../content/shared/styles/world-map.png');"></div>
    </div>
    <script>
        function createChart() {
            $("#chart").kendoChart({
                title: {
                    text: "Gross domestic product growth \n /GDP annual %/"
                },
                legend: {
                    position: "bottom"
                },
                chartArea: {
                    background: ""
                },
                seriesDefaults: {
                    type: "line",
                    style: "smooth"
                },
                series: [<?php 
for($i = 0; $i < count($stations); $i++) {			
				?>{
                    name: "<?php echo($stations[$i]["station"]); ?>",
                    data: [<?php echo $stationsData[$stations[$i]["station"]]; ?>]
                }<?php 
	if($i<count($stations)-1) echo ",";
}
				?>],
                valueAxis: {
                    labels: {
                        format: "{0}KM"
                    },
                    line: {
                        visible: false
                    },
                    axisCrossingValue: -10
                },
                categoryAxis: {
                    categories: [<?php echo $stationsData["date"]; ?>],
                    majorGridLines: {
                        visible: false
                    },
                    labels: {
                        rotation: "auto"
                    }
                },
                tooltip: {
                    visible: true,
                    format: "{0}KM",
                    template: "#= series.name #: #= value #"
                }
            });
        }

        $(document).ready(createChart);
        $(document).bind("kendo:skinChange", createChart);
    </script>
</div>
</body>
</html>
