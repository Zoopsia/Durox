<?php
/* 
	Creacion de objeto de la clase Graficos, es una libreria, debe estar cargada en el controlador.
*/

$graficos = new Graficos();


/* 
	GRAFICO DE TORTA
*/

$opcion_torta = array(
	'id' 	=> 'id_torta', // id del div donde se va a cargar el grafico
	'title' => 'Torta',			// titulo del grafico
	//'type'	=> 'donut'		// posibles tipos de grafico
	//'type'	=> 'chart'
	//'type'	=> 'legend'
	//'type'	=> '3d'
);
$datos_torta = array(
	'Carga uno' => 20,
	'Carga dos' => 25,
	'Carga tres' => 40,
);
$grafico_torta  = $graficos->torta($opcion_torta, $datos_torta);



/*
 GRAFICO DE BARRA
*/

$opcion_barra = array(
	'id' 	=> 'id_barra',
	'title' => 'Barras',
	//'type'	=> 'line',
	'type'	=> 'column',
	//'type'	=> 'area',
	//'type'	=> '3d'
);
$datos_barra = array(
	'Carga uno' => array(
		'categoria 1' => 10,
		'categoria 2' => 20,
	),
	'Carga dos' => array(
		'categoria 1' => 30,
		'categoria 3' => 25,
	),
);
$grafico_barra = $graficos->barra($opcion_barra, $datos_barra);


// Las dos funciones me devuelven el javascript necesario para armar el grafico.
echo $grafico_torta;
echo $grafico_barra;

// el ultimo paso es armar la vista con los id de los div donde iran los graficos
?>


<div class="row">
	<div class="col-md-6">
		<div id="id_torta" ></div>
	</div>
	<div class="col-md-6">
		<div id="id_barra"></div>
	</div>
</div>
