<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'mobile.detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if($deviceType=="phone") redirect("http://ogn.planeadores.cl/node/ogn.phone.php");
if($deviceType!="phone") redirect("http://ogn.planeadores.cl/node/ogn.desktop.php");

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}

?>