<?php
if($registros){
	foreach($registros as $row){
		$json[$array][]=$row;
	}
}

if($registros2){
	foreach($registros2 as $row){
		$json[$array2][]=$row;
	}
}

$encode = json_encode($json);
$encode = str_replace("'", " ", $encode);

echo $encode;
?>