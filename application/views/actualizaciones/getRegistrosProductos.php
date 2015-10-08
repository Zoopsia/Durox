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

echo json_encode($json); 
?>