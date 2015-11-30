<?php
if($registros){
	foreach($registros as $tabla => $datos){
		if(is_array($datos)){
			
			foreach($datos as $row){
					$json[$tabla][] =  $row;
			}
		}
	}
}

$encode = json_encode($json);
$encode = str_replace("'", " ", $encode);

echo $encode;
?>