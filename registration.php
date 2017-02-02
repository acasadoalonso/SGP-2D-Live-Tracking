<?php
$servername = "localhost";
$username = "ogn";
$password = "ogn";
$dbname = "APRSLOG";
$today=date("ymd");
$connSWIFACE = new mysqli($servername, $username, $password, $dbname);
$sqlString="select * from GLIDERS_INFO where registration='".$_GET["reg"]."'";
$result2 = $connSWIFACE->query($sqlString);
if ($result2->num_rows == 0) {
	$url="http://produccion.dgac.cl:8082/ConsultaAeronaves2/ConsultaAeronave?pMatricula=".str_replace("CC-", "", $_GET["reg"]);
	$html=file_get_contents($url);
	$owner=""; $maker=""; $model="";
	if(strpos($html, "SOAPFaultException")==0){
		$lines = explode(PHP_EOL, $html);
		foreach ($lines as $value) {
			if(strpos($value, "Marca")>0){
				$maker=str_replace("Marca", "", $value);
				$maker=strip_tags($maker);
			}
			if(strpos($value, "Modelo")>0){
				$model=str_replace("Modelo", "", $value);
				$model=strip_tags($model);
			}
			if(strpos($value, "Propietario")>0){
				$owner=str_replace("Propietario", "", $value);
				$owner=strip_tags($owner);
			}
		}
	
		$sqlString="INSERT INTO GLIDERS_INFO (registration, maker, model, owner) values ('".$_GET["reg"]."','".$maker."','".$model."','".$owner."');";
		echo $sqlString;
		$resultBase2 = $connSWIFACE->query($sqlString);	
	}

	die();
}
?>