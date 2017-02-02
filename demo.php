<?php 
 
/****************************************************************
 Returns a single elevation for a given point location
 (uses POSTed params to avoid values being cached by some browsers )
****************************************************************/
require_once 'SRTMGeoTIFFReader.php';

$lat = $_GET['lat'];
$lon = $_GET['lon'];
$interpolate = $_geT['interpolate'];  

$dataReader = new SRTMGeoTIFFReader("hgt"); // directory containing SRTM data files
echo $dataReader->getElevation($lat, $lon, $interpolate=false);
?> 
 