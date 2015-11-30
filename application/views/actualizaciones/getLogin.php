<?php
if($registros){
	foreach($registros as $row){
		$id_vendedor = $row->id_vendedor;
	}

	$resultado[] = array("logstatus" => $id_vendedor);
	
}else{
	$resultado[] = array("logstatus" => "0");
}

$encode = json_encode($resultado);
$encode = str_replace("'", " ", $encode);

echo $encode;


?>