<?php
if($registros){
	foreach($registros as $tabla => $datos){
		foreach($datos as $row){
				$json[$tabla][]=$row;
		}
		
	}
}

echo json_encode($json);
?>