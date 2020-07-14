<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("UTC");
include ("node/imageSmoothArc.php");

require_once  'node/config.php';
$station='LECD';

if (isset($_GET['station']))
        $station = $_GET['station'];
        
$query="select idrec, otime from RECEIVERS_STATUS where idrec = '".$station."' order by `otime` desc ;"; 
$db = new mysqli($servername, $DBuserread, $DBpasswdread, $dbname);

$results = $db->query($query);
$txt="NOT FOUND";
$txt2="in the DB";
$cColor=array(45,45,45,0);

if ($results->num_rows > 0) 
   {
   $row      =$results->fetch_array() ;
   $sta      =$row[0];
   $otime    =$row[1];
   $tsta     =strtotime($otime);
   $tnow     =time() ;
   $diff     =$tnow-$tsta;
   $msg      ='Last fix at: '.date("r", $tsta);
   $txt2=date("Y-d-m H:i\Z", strtotime($otime));
   if ($diff  > 720)
        {
                        $txt="Down since";
                        $cColor=array(255,0,0,0);
                        $txt2=date("Y-m-d H:i\Z", strtotime($otime));
        }
   else
        {
                        $txt="Last heartbeat";
                        $txt2=date("Y-m-d H:i\Z", strtotime($otime));
                        $cColor=array(0,128,0,0);
        }
   }


$image = imageCreateTrueColor( 230, 30 );
imagealphablending($image,true);
$color = imageColorAllocate( $image, 255,255,255);
$tcolor = imageColorAllocate( $image, 40,40,40);
imagefill( $image, 0, 0, $color );
imageSmoothArc ( $image, 15, 14, 28,28, array(192,192,192,0),0, M_PI*2);
imageSmoothArc ( $image, 15, 14, 24,24, $cColor,0, M_PI*2);
imagettftext($image, 9, 0, 32, 13, $tcolor, "/var/www/html/node/arialbd.ttf", $txt);
imagettftext($image, 8, 0, 32, 27, $tcolor, "/var/www/html/node/arial.ttf", $txt2);

imagealphablending($image, false);
imagesavealpha($image, true);
header( 'Content-Type: image/png' );
imagePNG( $image );

$db->close(); 
?>


