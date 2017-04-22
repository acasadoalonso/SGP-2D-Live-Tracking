<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);


for($i=1;$i<5;$i++){

	$url="http://glidern$i.glidernet.org:14501/status.json";
	$html=file_get_contents($url);
	$json=(json_decode($html));
	
	foreach($json->clients as $client){
		$sqlString="select * from RECEIVERS where station='$client->username'";
		$aprs = $conn->query($sqlString);
		if ($aprs->num_rows > 0){
			$sqlString="update RECEIVERS set since_connect='$client->since_connect', since_last_read='$client->since_last_read' where station='$client->username';";
			$conn->query($sqlString);
			//echo $sqlString;
		}else{
			$sqlString="insert into RECEIVERS (station, since_connect, since_last_read, app_name, app_version) values ('$client->username', '$client->since_connect', '$client->since_last_read', '$client->app_name', '$client->app_version')";
			$conn->query($sqlString);
		}
		//echo $sqlString;
	}
}
?>
