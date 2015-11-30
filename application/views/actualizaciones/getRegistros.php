<?php
if($registros){
	foreach($registros as $row){
		$json[$array][]=$row;
	}
	
	$encode = json_encode($json);
	$encode = str_replace("'", " ", $encode);

	echo $encode; 
}
?>