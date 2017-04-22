
<?php 
require_once 'config.php';
$today=date("ymd");
// Create connection
$connAPRSLOG = new mysqli($servername, $username, $password, $dbname);

$measPerDeg = 1201; # Set to 3601 for 1 second data for the U.S. 
$datafiles = glob('hgt/S33W067.hgt'); 

foreach ($datafiles as $hgtfile) { 
    $fh = fopen($hgtfile, 'rb') or die("Error opening $hgtfile. Aborting!"); 
    $hgtfile = basename($hgtfile); 
    $starty = +substr ($hgtfile, 1, 2); 
    if (substr ($hgtfile, 0, 1) == "S") { 
      $starty = -$starty; 
    } 
    $startx = +substr ($hgtfile, 4, 3); 
    if (substr ($hgtfile, 3, 1) == "W") { 
      $startx = -$startx; 
    } 
    if ($data = fread($fh, 2 * $measPerDeg * $measPerDeg)) { 
      $point = 0; 
      $offset = 0; 
      $hgtfile = basename($hgtfile,'.hgt'); 
      echo $hgtfile."\n"; 
      echo("lat;lon;ele\n"); 
      for ($i = 0; $i < $measPerDeg; $i++) { 
     	for ($j = 0; $j< $measPerDeg; $j++) { 
 	       $short = substr ($data, $offset, 2); 
    	    $shorts = reset(unpack("n*", $short));
			$lat=($starty + 1 - $i / ($measPerDeg - 1));
			$lon=($startx + $j / ($measPerDeg - 1));
			$sqlString="insert into GEOMETRY values (".number_format($shorts,0).", ".$lat.", ".$lon.");";
        	try{
				$connAPRSLOG->query($sqlString);
			}catch(Exception $e){
			}
			//printf("%10.8f;%10.8f;%d\n", ($starty + 1 - $i / ($measPerDeg - 1)), ($startx + $j / ($measPerDeg - 1)), $shorts); 
    	    $offset += 2; 
        	$point++; 
			//$j=10000000;
      	} 
      } 
    } else echo "Could not read file!\n"; 
    fclose($fh); 
} 
