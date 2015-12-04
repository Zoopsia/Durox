<?php

if($this->input->post('id_vendedor')){
	$listado = array(
		'inicio'		=> $this->input->post('inicio'),
		'final'			=> $this->input->post('final'),
		'id_vendedor'	=> $this->input->post('id_vendedor'),
	);
}else{
	$listado = array(
		'inicio'		=> date("01/m/Y" , strtotime("-1 MONTH")),
		'final'			=> date("d/m/Y"),
		'id_vendedor'	=> '',
	);
	
}

if($registros){
	$graficos = new Graficos();
	$opcion_clientes = array(
		'id' 	=> 'id_torta',
		'title' => '',
		'type'	=> 'column',
		
	);
	$opcion_valoracion = array(
		'id' 	=> 'id_valoracion', 
		'title' => '',
		'type'	=> 'chart'		
	);

	foreach ($registros as $visita) {
		if(isset($cant_clientes['total'][$visita->razon_social] )){
			$cant_clientes['total'][$visita->razon_social] = $cant_clientes['total'][$visita->razon_social] + 1;	
		}else{
			$cant_clientes['total'][$visita->razon_social] = 1;
		}
		
		$valoracion = valoracion($visita->valoracion, 1);
		
		if(isset($cant_valoraciones[$valoracion] )){
			$cant_valoraciones[$valoracion] = $cant_valoraciones[$valoracion] + 1;	
		}else{
			$cant_valoraciones[$valoracion] = 1;
		}
		
	}
	
	$grafico_clientes  = $graficos->barra($opcion_clientes, $cant_clientes);
	$grafico_valoracion  = $graficos->torta($opcion_valoracion, $cant_valoraciones);
	echo $grafico_clientes;
	echo $grafico_valoracion;
}

?>
<script>
$(document).ready(function() {
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		defaultDate: '2015-12-12',
		editable: true,
		eventLimit: true, 
		events: [
		<?php 
		$events = "";
		foreach ($registros as $visita) {
			$events .= '{ ';	
			$events .= "title: '".$visita->razon_social."', ";
			$events .= "start: '".$visita->fecha."' ";
			$events .= '},';	
		}
		$events = trim($events, ',');
		echo $events;
		?>
			]
		});
		
	});

</script>
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-sm-3">
    					<div class="input-group">
      						<div class="input-group-addon" onclick='document.getElementById("inicio").focus()'><i class="fa fa-calendar"></i></div>
      						<input type="text" class="form-control" id="inicio" name="inicio" placeholder="<?php echo $this->lang->line('inicio')?>" value="<?php echo $listado['inicio']?>" required>
      					</div>
      				</div>
  			
					<div class="col-sm-3">
    					<div class="input-group">
      						<div class="input-group-addon" onclick='document.getElementById("final").focus()'><i class="fa fa-calendar"></i></div>
      						<input type="text" class="form-control" id="final" name="final" placeholder="<?php echo $this->lang->line('final')?>" value="<?php echo $listado['final']?>"  required>
      					</div>
      				</div>
      				
      				<div class="col-sm-3">
    					<select class="form-control" id="id_vendedor" name="id_vendedor">
    						<?php
    						foreach ($vendedores as $vendedor) {
    							if($vendedor->id_vendedor == $listado['id_vendedor']){
    								echo "<option value='".$vendedor->id_vendedor."' selected>".$vendedor->apellido." ".$vendedor->nombre."</option>";
    							}else{
    								echo "<option value='".$vendedor->id_vendedor."'>".$vendedor->apellido." ".$vendedor->nombre."</option>";	
    							}
							} 
    						?>
    					</select>
      				</div>
      				
      				<div class="col-sm-3">
    					<button class="btn btn-default" id="enviar" name="enviar">
    						<?php echo $this->lang->line('enviar');?>
    					</button>
      				</div>
  				</div>
			</form>
		</div>
	</div>	
			<?php 
			if($registros){
			?>
				
			
	<div class="row">
		<div class="col-md-6">	
			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-calendar"></i>
					<div class="box-title">Calendario</div>
					<div class="pull-right box-tools">
						<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
                                
				<div class="box-body no-padding">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-header">
					<i class="fa fa-star"></i>
					<div class="box-title">Cantidad de valoraciones</div>
					<div class="pull-right box-tools">
						<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
	                                
				<div class="box-body no-padding">
					<div id="id_valoracion"></div>
				</div>
			</div>
		</div>
	</div>	
	
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-table"></i>
					<div class="box-title">Tabla</div>
					<div class="pull-right box-tools">
						<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
                                
				<div class="box-body no-padding " id="box-tabla">	
			
				<table class="table table-hover prueba">
				<thead>
					<tr>
						<td><?php echo $this->lang->line('visita')?></td>
						<td><?php echo $this->lang->line('cliente')?></td>
						<td><?php echo $this->lang->line('fecha')?></td>
						<td><?php echo $this->lang->line('valoracion')?></td>
						<td><?php echo $this->lang->line('comentarios')?></td>
						<td><?php echo $this->lang->line('origen')?></td>
					</tr>
				</thead>
				
				<tbody>
					<?php
					foreach ($registros as $visita) {
						echo '<tr>';
						echo '<td>'.$visita->id_visita.'</td>';
						echo '<td>'.$visita->razon_social.'</td>';
						echo '<td>'.$visita->fecha.'</td>';
						echo '<td>'.valoracion($visita->valoracion).'</td>';
						echo '<td>'.$visita->descripcion.'</td>';
						echo '<td>'.$visita->origen.'</td>';
						echo '</tr>';
					}
					?>
				</tbody>
				</table>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-header">
					<i class="fa fa-calendar"></i>
					<div class="box-title">Cantidad de visitas por cliente</div>
					<div class="pull-right box-tools">
						<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
	                                
				<div class="box-body no-padding" id="box-barra">
					<div id="id_torta" ></div>
				</div>
			</div>
		</div>
		
		
	</div>	
				
			<?php	
			}
			?>
		</div>
	
	
</div>	
	
<script>
$(function() {
    $( "#inicio" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#final" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#final" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
});
</script>

<script>
$(function() {
	$( "#box-tabla" ).hide();
	$( "#box-barra" ).hide();
	$(window).scroll(function(){
		if ($(this).scrollTop() > 150) {
			 $( "#box-tabla" ).show("drop", 1000);
		} 
		
		
		if ($(this).scrollTop() > 350) {
			 $( "#box-barra" ).show("drop", 1000);
		} 
	});
	
});
</script>


<link href="<?php echo base_url()?>libraries/plantilla/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />  		
<script src='<?php echo base_url()?>libraries/plantilla/js/plugins/fullcalendar/lang.js'></script>
<script src="<?php echo base_url()?>libraries/plantilla/js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>