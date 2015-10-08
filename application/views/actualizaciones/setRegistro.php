<?php
if($mensaje)
{
	$json['mensaje']['insert'] = "ok";
}else{
	$json['mensaje']['insert'] = "ERROR";
}

echo json_encode($json); 
?>