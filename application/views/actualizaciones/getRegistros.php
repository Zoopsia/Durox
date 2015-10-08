<?php
if($registros){
	foreach($registros as $row){
		$json[$array][]=$row;
	}
	
	echo json_encode($json); 
}
?>