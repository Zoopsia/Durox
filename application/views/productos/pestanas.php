<script>

$( document ).ready(function() {
    getAlarmas(<?php echo $id?>);
    if(location.hash == "#tab2")
    	$('.nav-pills a:last').tab('show');
});

$(function() {		
	$( '#bb-bookblock' ).bookblock();
});

<?php
if($productos){
	foreach($productos as $row){
		echo "var precio =".$row->precio.";";
		echo "var descripcion ='".trim(strip_tags($row->descripcion))."';";
	}
}
?>

function editable(){
	$(".cambio").removeAttr("disabled");
	$(".cambio").removeClass("editable");
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	$('#divcargaimg').show();
	$('#btn-editar').hide();
	$('#btn-eliminar').hide();
	$('#btn-print').hide();
	$('#precio').val(precio);
	$('#ficha_tecnica1').show();
	$('#ficha_tecnica').attr('type', 'file');
	$("#ficha_tecnica").removeClass("web");
	$("#ficha_tecnica").addClass("editable2");
	$("#td_confirmar").html('Tipo de Moneda: ');
	$("#td_confirmar").removeClass("transparente");
	$("#td_moneda").removeClass("transparente");
	$('#moneda').show();
	$('#textarea').html('<textarea class="texteditor" name="editor1" rows="10" cols="88" style="resize: none;">'+descripcion+'</textarea>');
}

function eliminar($id){
	var r = confirm("¿Esta seguro que quiere eliminar el registro?");
    if (r == true) {
		window.location.assign("/durox/index.php/Productos/delete_user/"+$id);
	}
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true) {
		$(".cambio").attr("disabled", true);
		$(".cambio").addClass("editable");
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#divcargaimg').hide();
		$('#btn-eliminar').show();
		$('#btn-editar').show();
		$('#btn-print').show();
		$('#ficha_tecnica1').hide();
		$('#ficha_tecnica').attr('type', 'text');
		$("#ficha_tecnica").addClass("web");
		$("#ficha_tecnica").removeClass("editable2");
		$("#td_confirmar").html('');
		$("#td_confirmar").addClass("transparente");
		$("#td_moneda").addClass("transparente");
		$('#moneda').hide();
		<?php
			if($productos){
				foreach($productos as $row){
					echo "$('#nombre').val('".$row->nombre."');";
					echo "$('#precio').val('".$row->abreviatura.$row->simbolo.' '.$row->precio."');";	
					echo "$('#textarea').html('<blockquote><em>".trim(strip_tags($row->descripcion))."</em></blockquote>');";
					if($row->ficha_tecnica)
						echo "$('#ficha_tecnica').val('".$row->ficha_tecnica."');";	
					if($row->codigo)
						echo "$('#codigo').val('".$row->codigo."');";									
				}	
			}
		?>
	}
}

function cambiarImagen(){
	if(!document.getElementById("em-text").innerHTML){
		$("#textarea").addClass("no-print");
	}
	if($('.img-cambiar').val());
		$('.img-cambiar').attr('style','height: 270px !important');
	setTimeout(function(){ $('.img-cambiar').attr('style','height: 300px !important'); }, 100);
	
}

function saveAlarm($id){
	<?php
	$cantidad_paginas = 0;
	if($alarmas){
		$cantidad_paginas = ceil(count($alarmas)/5);
	}
	echo 'var cant_pag = '.$cantidad_paginas.';';
	?>

	if($('#mensaje').val()){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Alarmas/insertAlarma', 
			data: { 'tipo' 		: $('#tipo').val(),
			 		'mensaje'	: $('#mensaje').val(),
			 		'id'		: $id, 
			 		'cruce'		: 'productos'
			}, 
			success: function(resp) { 
				$('#box-alarmas'+cant_pag).append(resp);
				$('#formAlarma').trigger("reset");
				getAlarmas($id);
				$('#mensaje').removeClass();
			}
		});
	}
}

function getAlarmas($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Productos/getAlarmas', 
		data: { 'id'		: $id,
				}, 
		success: function(resp) {
			$('#llenarAlarmas').html(resp);
		}
	});
}

function cambiarSelect(){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Alarmas/tipoAlarma', 
		data: { 'tipo' 		: $('#tipo').val(),
				}, 
		success: function(resp) { 
			$('#mensaje').removeClass();
			//$('#tipo').addClass('form-control alert-'+resp);
			$('#mensaje').addClass('alert-'+resp);
		}
	});
}


<?php 
$producto_nombre = '';

if($productos){
	foreach ($productos as $producto) {
		$producto_nombre = $producto->nombre;
	}
}
?>

$('.content-header > h1 > small').append('. Producto: <b><?php  echo $producto_nombre.'.';?></b>');


</script>
<?php
$bandera = 0;
?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading no-print">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab">
					<i class="fa fa-archive"></i> <?php echo $this->lang->line('producto'); ?>
				</a></li>
				<?php if($datosDB) { ?>
				<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('db').' '.$this->lang->line('externa'); ?></a></li>
				<?php } ?>
				<li style="position: absolute; right: 30px">
					<a href="#tab2" data-toggle="tab"><?php echo $this -> lang -> line('alarmas'); ?>
						<span class="badge">
							<div id="llenarAlarmas">
							 					
							</div>
						</span>
					</a>
				</li>
			</ul>
        </div>
		
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1"> 		
					<?php if($productos) { ?>
					<form id="formulario" action="<?php echo base_url()."index.php/Productos/editarProducto/$row->id_producto"?>" class="form-horizontal" method="post" enctype="multipart/form-data"> 
					<?php } ?>
					<div class="row">
						<div class="col-md-5 col-lg-5 " align="center">
							
							<?php
								if($imagenes)
								{
							?>
							<div id="bb-bookblock" class="bb-bookblock">
								<?php	
										foreach ($imagenes as $row)
										{
											if($row->url != '')
											{
												echo '<div class="bb-item">';
												echo '<img alt="User Pic" src="'.base_url().'img/productos/imagenes/'.$row->url.'" class="img-rounded img-responsive img-bookblock img-cambiar">';
												echo '</div>';
											}
										}
										
								?>
							</div>
							
							<nav class="no-print">
								<a id="bb-nav-first" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-double-left fa-2x"></i></button></a>
								<a id="bb-nav-prev" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-left fa-2x"></i></button></a>
								<a id="bb-nav-next" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-right fa-2x"></i></button></a>
								<a id="bb-nav-last" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-double-right fa-2x"></i></button></a>
							</nav>
							
							<div id="divcargaimg" style="margin-top: 20px; display: none">
								<a class="no-print" href="<?php echo base_url().'index.php/productos/producto_imagen/'.$id ?>">
								<button type="button" class="btn btn-primary"><?php echo $this->lang->line('imagen')?></button>
								</a>
							</div>
							<?php
								}
								else{
									echo '<a class="no-print" href="'.base_url().'index.php/productos/producto_imagen/'.$id.'">'.$this->lang->line('cargar').' '.$this->lang->line('imagen').' <i class="fa fa-upload"></i></a>';
								}
							?>
						</div>
						
						<div class=" col-md-7 col-lg-7 "><!--carga info cliente-->
							<div class="row">
								<div class=" col-md-12 col-lg-12 ">
									<table class="table table-striped table-user-information"> 
									<?php
									if($productos){
										foreach ($productos as $row) 
										{
											if($row->eliminado != 1)
											{
												echo "<tbody>";
												echo  "<tr>";
												echo  '<td class="padtop">'.$this->lang->line('nombre').':</td>';
												echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="nombre" name="nombre" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre.'" maxlength="128" disabled placeholder="'.$this->lang->line('nombre').'" autocomplete="off" required></td>';
												echo  "</tr>";
												echo  "<tr class='no-print'>";
												echo  '<td class="padtop">'.$this->lang->line('id').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="text" name="id" class="form-control editable"  value="'.$row->id_producto.'" autocomplete="off" disabled style="width: 275px !important;"></td>';
												echo  "</tr>";
												echo  "<tr>";
												echo  '<td class="padtop">'.$this->lang->line('precio').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="text" name="precio" id="precio" class="form-control editable cambio" pattern="[0-9]*.{1,}" value="'.$row->abreviatura.$row->simbolo.' '.round($row->precio,2).'" placeholder="'.$this->lang->line('precio').'" autocomplete="off" disabled required></td>';
												echo  "</tr>";
												echo  "<tr>";
												echo  '<td class="padtop">'.$this->lang->line('codigo').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="text" name="codigo" id="codigo" class="form-control editable cambio" value="'.$row->codigo.'" placeholder="'.$this->lang->line('codigo').'" autocomplete="off" disabled></td>';
												echo  "</tr>";
												echo  "<tr class='no-print'>";
												echo  '<td class="padtop">'.$this->lang->line('id').' '.$this->lang->line('bejerman').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="text" name="id_db" class="form-control editable"  value="'.$row->id_db.'" autocomplete="off" disabled style="width: 275px !important;"></td>';
												echo  "</tr>";
												$date	= date_create($row->date_upd);
												echo  "<tr>";
												echo  '<td class="padtop" style="width: 209px">'.$this->lang->line('date').' '.$this->lang->line('sincronizacion').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="text" name="fecha" class="form-control editable"  value="'.date_format($date, 'd/m/Y').'" autocomplete="off" disabled></td>';
												echo  "</tr>";
												if($row->ficha_tecnica){
													echo  "<tr class='no-print'>";
													echo  '<td class="padtop">'.$this->lang->line('ficha').':</td>';
													echo  '<td class="tabla-datos-importantes">';
													echo  '<a href="'.base_url().'img/productos/documentos/'.$row->ficha_tecnica.'" download style="display:"inherit>';
													echo  "<input type='text' name='ficha_tecnica' id='ficha_tecnica' class='form-control editable cambio web' value='".$row->ficha_tecnica."' autocomplete='off' disabled>";
									                echo  '</a>';
									                echo  '</td>';
													//echo  '<td class="tabla-datos-importantes"><a href="'.base_url().'img/productos/documentos/'.$row->ficha_tecnica.'" download>'.$this->lang->line('descarga').' <i class="fa fa-download"></i></a></td>';
													echo  "</tr>";
												}
												else{
													echo  "<tr class='no-print'>";
													echo  '<td class="padtop">'.$this->lang->line('ficha').':</td>';
													echo  '<td class="tabla-datos-importantes"><input type="file" name="ficha_tecnica" class="form-control editable2" id="ficha_tecnica1" style="display: none"></td>';
													echo  "</tr>";
												}
												
												echo  "<tr class='no-print'>";
												echo  '<td  class="padtop" colspan="2" style="text-align: center">';
												echo '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#popPrecios">';
												echo $this->lang->line('ver').' '.$this->lang->line('precios');
												echo '</button>';
												echo '</td>';
												echo  "</tr>";
												echo "<tr>";
												if($monedas){
													echo '<td class="padtop transparente" id="td_confirmar"></td>';
													echo '<td class="transparente" id="td_moneda">';
													echo '<div id="moneda" style="display: none">';
													echo '<select name="id_moneda" id="id_moneda" class="form-control cambio">';
													foreach ($monedas as $key) {
														if($key->abreviatura == $row->abreviatura && $key->simbolo == $row->simbolo)
															echo '<option value="'.$key->id_moneda.'" selected>'.$key->moneda.' '.$key->abreviatura.'</option>';
														else
															echo '<option value="'.$key->id_moneda.'">'.$key->moneda.' '.$key->abreviatura.'</option>';
													}
													echo '</select>';	
													echo  '</div>';
													echo '</td>';
												}	
												echo "</tr>";
												echo  "</tbody>";
											}
											else
											{
												echo '<div class="row">
														<div class="col-md-offset-3 col-sm-6 col-md-6">
															<div class="alert-message alert-message-danger">
																<h4>'.$this->lang->line('producto').' '.$this->lang->line('eliminado').'</h4>
																<p>
																				                    
																</p>
															</div>
														</div>
													  </div>';
												$bandera = 1;
											}
										}
									}
									?>
									</table>
								</div>
							</div>
							<div class="row">
								<div class=" col-md-12 col-lg-12 ">
									<?php
										if($productos)
										{
											foreach ($productos as $row) 
											{
												if($row->eliminado != 1)
												{
													echo '<div id="textarea">';
													echo "<blockquote><em id='em-text'>";
													echo $row->descripcion;
													echo "</em></blockquote>";
													echo "</div>";
												}
											
												$precio_base = $row->precio;
												$simbolo	 = $row->simbolo;
												$abreviatura = $row->abreviatura;
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
					if($bandera != 1){
					?>
					<div class="row no-print" style="padding-top: 10px">
						<div class="col-xs-12">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
								<i class="fa fa-info-circle"></i>
							</button>
					                            
					        <button type="button" class="btn btn-default" id="btn-print" onclick="cambiarImagen(); window.print()"><i class="fa fa-print"></i> Print</button>
		                    			
							<button type="button" id="btn-eliminar" class="btn btn-danger btn-sm pull-right" onclick="eliminar(<?php echo $id?>)" style="margin-left: 5px">
								<?php echo $this->lang->line('eliminar');?>
							</button>
							<button type="button" id="btn-editar" class="btn btn-primary btn-sm pull-right" onclick="editable()">
								<?php echo $this->lang->line('editar');?>
							</button>
										
							<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelar()" style="display: none; margin-left: 5px">
								<?php echo $this->lang->line('cancelar');?>
							</button>
							<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right" style="display: none; ">
								<?php echo $this->lang->line('guardar');?>
							</button>
						</div>
					</div>
					<?php
					}
					?>
					</form>
				</div>
				<div class="tab-pane fade" id="tab2">
	     			<!--TAB 2 ALARMAS -->
	     			<div class="col-md-6">
	     				<div class="box box-primary">
		            	    <div class="box-header">
		                	    <h3 class="box-title"><?php echo $this->lang->line('alarmas')?></h3>
		                    </div><!-- /.box-header -->
		                    <?php
		                    	$cantidad_paginas = 0;
					     		if($alarmas){
					     			$cantidad_paginas = ceil(count($alarmas)/5);
									foreach($alarmas as $row){
										$arreglo[]	= array(
											'id_tipo'	=> $row->id_tipo_alarma,
											'tipo'		=> $row->tipo_alarma,
											'mensaje'	=> $row->mensaje,
											'nombre'	=> $row->nombre,
											'color'		=> $row->color
										);
									}
								}
							?>     
		                    <div class="tab-content">
		                    	<?php
		                    	$k=0;
		                    	for($i=0; $i<$cantidad_paginas; $i++){
		                    		if($i == 0)
										echo	'<div class="tab-pane fade in active" id="body'.($i+1).'">';  
									else 
										echo	'<div class="tab-pane fade in" id="body'.($i+1).'">';
			                    	echo			'<div class="box-body" id="box-alarmas'.($i+1).'">';
									for($j=$k; $j<count($alarmas); $j++){
			                   			echo 		armarAlarma($arreglo[$j]);
										$k++;
										if($k%5==0)
											break;
									}
			                   		echo 			'</div>';
		                    		echo 		'</div>';
									
								}
								
								if($cantidad_paginas == 0){
									echo	'<div class="tab-pane fade in active" id="body'.$cantidad_paginas.'">';
									echo		'<div class="box-body" id="box-alarmas'.$cantidad_paginas.'">';
									echo 		'</div>';
		                    		echo 	'</div>';
								}
		                    	?>
		                    </div>
		                    
		                    <div class="box-footer" align="center">
		                    	<nav>
								  <ul class="pagination">
								  	<?php 
								    	for($i=0 ; $i< $cantidad_paginas; $i++){
								    		if($i == 0)
								    			echo '<li class="active"><a href="#body'.($i+1).'" data-toggle="tab">'.($i+1).'</a></li>';
											else
												echo '<li><a href="#body'.($i+1).'" data-toggle="tab">'.($i+1).'</a></li>';
										}
										if($cantidad_paginas == 0){
											/*--- No mostrar nada por ahora ----*/
										}
									?>
								  </ul>
								</nav>
		                    </div>
						</div>
					</div>
					<form id="formAlarma">
					<div class="col-md-6">
						<div class="box box-info">
		                	<div class="box-header ui-sortable-handle" style="cursor: move;">
		                    	<i class="fa fa-envelope"></i>
		                        <h3 class="box-title"><?php echo $this->lang->line('nueva')?></h3>
		                    </div>
		                    <div class="box-body">
			                	<div class="form-group">
			                    	<select class="form-control" id="tipo" name="tipo_alarma" style="font-family: 'FontAwesome', Helvetica;" onchange="cambiarSelect()">
				                    	<option disabled selected>Seleccione un Icono...</option>
				                        <?php
								     		if($tipos_alarmas){
												foreach($tipos_alarmas as $row){
													echo '<option value="'.$row->id_tipo_alarma.'">'.unicodeIcono($row->tipo_alarma).' '.$row->nombre.'</option>';
												}
											}
										?>
									</select>
								</div>
			                    <div class="form-group">
			                    	<textarea id="mensaje" name="mensaje" style="resize: none; width: 100%; height: 150px"></textarea>
			                    </div>
							</div>
		                    <div class="box-footer clearfix">
		                    	<button type="button" class="pull-right btn btn-danger btn-sm" onclick="location.reload();" style="margin-left: 5px"><?php echo $this->lang->line('cancelar');?></button>
		                    	<button type="button" class="pull-right btn btn-primary btn-sm" onclick="saveAlarm(<?php echo $id?>);"><?php echo $this->lang->line('guardar')?></button>
		                    </div>
						</div>
					</div>
	                </form>		
				</div>
				<div class="tab-pane fade" id="tab3">
	    			<div class="row" style="padding: 0px 10px 0px 10px;">
		    			<div class=" col-md-6 col-lg-6 "><!--carga info cliente-->
							<table class="table table-striped table-user-information"> 
							    <tbody>
							    <?php
							    	if($datosDB){
							   			$cant_datos = count($datosDB);
										$i = 0;
							    		foreach ($datosDB as $key => $value) {
							    			if($i > $cant_datos/2)
												break;
											else
												$i++;										    								
										    echo "<tr>";
											echo '<td class="padtop border-right"><b>'.$key.':</b></td>';
											echo '<td class="padtop text-center">'.$value.'</td>';
											echo "</tr>";												
										}
							    	}
							    ?>
								</tbody>
							</table>
						</div>
						<div class=" col-md-6 col-lg-6 "><!--carga info cliente-->
							<table class="table table-striped table-user-information"> 
					    		<tbody>
							    <?php
								    if($datosDB){
									    $j = 0;
									    foreach ($datosDB as $key => $value) {
									    	if($j>=$i){
												echo "<tr>";
												echo '<td class="padtop border-right"><b>'.$key.':</b></td>';
												echo '<td class="padtop text-center">'.$value.'</td>';
												echo "</tr>";
											}
											$j++;
										}
								    }
							    ?>
								</tbody>
							</table>
						</div>
					</div>
	    		</div>
			</div>
		</div>
	</div>
</div>
		
		
<!-- Modal Precios -->
<div class="modal fade" id="popPrecios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <div class="modal-body">
      	<div class="row">	
      		<div class="col-lg-12">
      			<table table class="table table-striped" cellspacing="0" width="100%">
      				<thead>
						<tr>
							<th class="th1"><?php echo $this->lang->line("grupo")?></th>
							<th class="th1"><?php echo $this->lang->line("precio")?></th>
						</tr>
					</thead>
					<tbody>
      				<?php
      				if($precios)
      				{
      					foreach ($precios as $row){
							if($row->id_grupo_cliente == 1)
							{
								echo '<tr>
									      <td>'.$this->lang->line('precio').' '.$this->lang->line('base').'</td>
										  <td>'.$abreviatura.$simbolo.' '.$precio_base.'</td>
									 </tr>';		
							}
							else
							{
								echo '<tr>';
								echo '<td>'.$row->grupo_nombre.'</td>';
								if($row->aumento_descuento == 1)
								{
									$descuento 		= ($precio_base * $row->valor)/100;
									$preciofinal	= round($precio_base - $descuento, 2);
								}
								else 
								{
									$descuento 		= ($precio_base * $row->valor)/100;
									$preciofinal	= round($precio_base + $descuento, 2);
								}		  
										  
								echo '<td>'.$abreviatura.$simbolo.' '.$preciofinal.'</td>';
								echo '</tr>';	
							}
						}
      				}
      				?>
      				</tbody>
      			</table>
			</div>
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal INFO -->
<?php if($productos){ foreach($productos as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Productos/editarVisto/".$row->id_producto; ?>" class="form-horizontal" method="post">
      <div class="modal-body">
      	<div class="row">
      		<table class="table table-striped">
      			<tr>
      				<td>
		      		<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('creacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_add)); ?>
					</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('modificacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_upd)); ?>
					</div>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('producto'); ?> 
		      			<?php echo $this->lang->line('visto').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<select name="visto" class="form-control chosen-select">	
							<?php
							if($row->visto == 1){
								echo '<option value="1" selected>SI</option>';
								echo '<option value="0">NO</option>';
							}
							else{
								echo '<option value="1">SI</option>';
								echo '<option value="0" selected>NO</option>';
							}
							?>
						</select>	
					</div>
					</td>
				</tr>
			</table>
			<input type="hidden" name="url" value="<?php echo current_url(); ?>">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      	<button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } } ?>
<script>
	var Page = (function() {
	var config = {
		$bookBlock : $( '#bb-bookblock' ),
		$navNext : $( '#bb-nav-next' ),
		$navPrev : $( '#bb-nav-prev' ),
		$navFirst : $( '#bb-nav-first' ),
		$navLast : $( '#bb-nav-last' )
	},
	init = function() {
		config.$bookBlock.bookblock( {
		speed : 800,
		shadowSides : 0.8,
		shadowFlip : 0.7
		} );
		initEvents();
	},
	initEvents = function() {
	var $slides = config.$bookBlock.children();

	// add navigation events
	config.$navNext.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'next' );
		return false;
	} );

	config.$navPrev.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'prev' );
		return false;
	} );

	config.$navFirst.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'first' );
		return false;
	} );

	config.$navLast.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'last' );
		return false;
	} );
						
	// add swipe events
	$slides.on( {
		'swipeleft' : function( event ) {
			config.$bookBlock.bookblock( 'next' );
			return false;
		},
		'swiperight' : function( event ) {
			config.$bookBlock.bookblock( 'prev' );
			return false;
		}
	} );

	// add keyboard events
	$( document ).keydown( function(e) {
	var keyCode = e.keyCode || e.which,
	arrow = {
		left : 37,
		up : 38,
		right : 39,
		down : 40
	};

	switch (keyCode) {
		case arrow.left:
			config.$bookBlock.bookblock( 'prev' );
			break;
		case arrow.right:
			config.$bookBlock.bookblock( 'next' );
			break;
	}
	} );
};

	return { init : init };

})();
</script>
<script>
	Page.init();
</script>
