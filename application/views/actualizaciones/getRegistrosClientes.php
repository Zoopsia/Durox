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

if($registros5){
	foreach($registros5 as $row){
		$json[$array5][]=$row;
	}
}

if($registros6){
	foreach($registros6 as $row){
		$json[$array6][]=$row;
	}
}

if($registros7){
	foreach($registros7 as $row){
		$json[$array7][]=$row;
	}
}

if($registros8){
	foreach($registros8 as $row){
		$json[$array8][]=$row;
	}
}

if($registros9){
	foreach($registros9 as $row){
		$json[$array9][]=$row;
	}
}

if($registros10){
	foreach($registros10 as $row){
		$json[$array10][]=$row;
	}
}

if($registros11){
	foreach($registros11 as $row){
		$json[$array11][]=$row;
	}
}

if($registros12){
	foreach($registros12 as $row){
		$json[$array12][]=$row;
	}
}

$encode = json_encode($json);
$encode = str_replace("'", " ", $encode);

echo $encode;
?>