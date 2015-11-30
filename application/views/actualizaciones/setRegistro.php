<?php
if($mensaje)
{
	$json['mensaje']['insert'] = "ok";
}else{
	$json['mensaje']['insert'] = "ERROR";
}

$encode = json_encode($json);
$encode = str_replace("'", " ", $encode);

echo $encode;
?>