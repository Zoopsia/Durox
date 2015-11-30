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

if($registros3){
	foreach($registros3 as $row){
		$json[$array3][]=$row;
	}
}

if($registros4){
	foreach($registros4 as $row){
		$json[$array4][]=$row;
	}
}

$encode = json_encode($json);
$encode = str_replace("'", " ", $encode);

echo $encode;
?>