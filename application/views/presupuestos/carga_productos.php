<script>
var evento 	= 0;
function funcion2(){
	evento = 1;
}
window.onbeforeunload = function(){
	if(evento == 0){
		return 'Los datos van a ser eliminados...'
	}
}
window.onunload = function () {
	if(evento == 0){
		var presupuesto = $('#presupuesto').val();
		$.ajax({
			 	type: 'POST',
			 	url: '<?php echo base_url(); ?>index.php/Presupuestos/deletePresupuesto', //Realizaremos la petición al metodo prueba del controlador direcciones
			 	data: {'presupuesto': presupuesto},
			 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
			 		
			 	}
		});
	}
};

$( document ).ready(function() {
    document.getElementById("producto").focus();
    <?php
    	if($tipo==1){
    		echo "$('#btn-guardar').show();";
    	}
    ?>
});

function nuevaLinea(){
	$("#nuevalinea").click();
}

function cargaProducto($presupuesto){
	
 	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var presupuesto	= $presupuesto;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'producto'	: producto,
	 		   'cantidad'	: cantidad,
	 		   'presupuesto': presupuesto,
	 		   },
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#table').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$('#btn-guardar').show();
	 		document.getElementById("formProducto").reset();
	 		$("#producto").focus();
	 	}
	});
}

function sacarProducto($id_linea, $presupuesto){
	var presupuesto = $presupuesto;
 	var id_linea	= $id_linea;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/sacarProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'id_linea'	: id_linea,
	 		   'presupuesto': presupuesto,
	 		   },
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#table').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

function ajaxSearch() {
	var producto = $('#producto').val();
    if (producto.length === 0) {
       	$('#suggestions').hide();
    } 
    else {
       	$.ajax({
        	type: "POST",
            url: '<?php echo base_url(); ?>index.php/Presupuestos/buscarProducto',
            data: {'producto': producto,},
            success: function(data) {
	            // return success
	            if (data.length > 0) {
	            	$('#suggestions').show();
	                $('#autoSuggestionsList').addClass('auto_list');
	                $('#autoSuggestionsList').html(data);
	            }
            }
		});
	}
}

function ingresarProducto($id_linea, $presupuesto){
	var presupuesto = $presupuesto;
 	var id_linea	= $id_linea;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/ingresarProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'id_linea'	: id_linea,
	 		   'presupuesto': presupuesto,
	 		   },
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#table').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

function deletePresupuesto($presupuesto){
	var c = confirm("Los datos no han sido guardados.\n¿Está seguro que quiere salir?");
	if (c==true){
		var presupuesto = $presupuesto;
	 	$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/Presupuestos/deletePresupuesto', //Realizaremos la petición al metodo prueba del controlador direcciones
		 	data: {'presupuesto': presupuesto},
		 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
		 		
		 	}
		});
		window.location.assign("/Durox/index.php/Presupuestos/presupuestos_abm/tab1");
		
	}
}

function funcion1($id_producto){
	
	var nombre 		= $('#id_valor'+$id_producto).val();
	var id_producto	= $id_producto;
	$('#producto').val(nombre);
	$('#id_producto').val(id_producto);
	$('#suggestions').hide();
	document.getElementById("cantidad").focus();
}

</script>


	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-body">
		  				<?php
						if($presupuestos){
							foreach ($presupuestos as $row) {
						?>	
								<div class="row invoice-info">
                        			<div class="col-sm-4 invoice-col">
                        				<b><?php echo $this -> lang -> line('vendedor'); ?></b>
                           			<address>
		                                <?php
										foreach ($vendedores as $key) {
											if ($row -> id_vendedor == $key -> id_vendedor) {
												echo '<a href="' . base_url() . 'index.php/vendedores/pestanas/' . $key -> id_vendedor . '">';
												echo $key -> nombre . ', ' . $key -> apellido;
												echo '</a>';
												echo "<br>";
												echo $this -> lang -> line('id') . ': ' . $key -> id_vendedor;
												echo "<br>";
												$aux2 = 1;
											}
										}
										?>
									</address>
			                        </div><!-- /.col -->
			                        <div class="col-sm-4 invoice-col">
		                            	<b><?php echo $this -> lang -> line('cliente'); ?></b>
		                            <address>
		                                <?php
										foreach ($clientes as $key) {
											if ($row -> id_cliente == $key -> id_cliente) {
												echo '<a href="' . base_url() . 'index.php/clientes/pestanas/' . $key -> id_cliente . '">';
												echo $key -> nombre . ', ' . $key -> apellido;
												echo '</a>';
												echo "<br>";
												echo $this -> lang -> line('cuit') . ': ' . $key -> cuit;
												echo "<br>";
												foreach ($iva as $value) {
													if ($value -> id_iva == $key -> id_iva) {
														echo $value -> iva;
														echo "<br>";
													}
												}
												echo $this -> lang -> line('id') . ': ' . $key -> id_cliente;
												echo "<br>";
												$aux = 1;
											}
										}
															?>
		                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        	<b><?php echo $this -> lang -> line('presupuesto'); ?></b>
                            <?php
							echo '<div class="odd">';
							echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('presupuesto') . ': ' . '<a href="#">' . $row -> id_presupuesto . '</a>';
							echo "</div>";
							echo '<div class="even">';
							echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('visita') . ': ' . '<a href="' . base_url() . 'index.php/Visitas/carga/' . $row -> id_visita . '/0">' . $row -> id_visita . '</a>';
							echo "</div>";
							echo '<div class="odd">';
							$date = date_create($row -> fecha);
							echo $this -> lang -> line('fecha') . ': ' . date_format($date, 'd/m/Y');
							echo "</div>";
							foreach ($estados as $key) {
								if ($key -> id_estado_presupuesto == $row -> id_estado_presupuesto) {
									echo '<div class="even">';
									echo $this -> lang -> line('estado') . ': ' . $key -> estado;
									echo "</div>";
								}
							}
							echo '<div class="odd">';
							echo $this -> lang -> line('total') . ' ' . $this -> lang -> line('presupuesto') . ': $ ' . $row -> total;
							echo "</div>";
							echo "<br>";

							}
							}
												?>
						</div>
						</div>
		  				
		  				
		  				
		  				<div class="tab-content">
		  					<form action="" id="formProducto" class="form-inline" method="post">
	    						<div class="row">
		    						<div id="table" class="col-sm-12" >
										<table class="table" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th class="th"><?php echo $this->lang->line("producto"); ?></th>
													<th class="th"><?php echo $this->lang->line("cantidad"); ?></th>
													<th class="th"><?php echo $this->lang->line("precio").' '.$this->lang->line("base"); ?></th>
													<th class="th"><?php echo $this->lang->line("precio"); ?></th>
													<th class="th"><?php echo $this->lang->line("subtotal"); ?></th>
													<th></th>
													<th style="width: 107px"></th>
													</tr>
											</thead>
											<tbody>
												<tr>
														<th>
															<input type="text" id="producto" name="producto" class="numeric form-control" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="<?php echo $this->lang->line('producto'); ?>" required>
															<div id="suggestions">
													            <div id="autoSuggestionsList">  
													            </div>
													        </div>
													        <input type="text" id="id_producto" name="id_producto" autocomplete="off" pattern="[0-9]*" required hidden>
														</th>
														<th><input type="text" id="cantidad" name="cantidad1" class="numeric form-control" onkeypress="if (event.keyCode==13){nuevaLinea(); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>" required></th>
														<th></th>
														<th></th>
														<th></th>
														<th>
															<a role="button" id="nuevalinea" class="btn btn-success btn-sm" onclick="cargaProducto(<?php echo $presupuesto ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('producto');?>">
													 			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
															</a>
														</th>
														<th></th>
													</tr>
											 		
													
													
													<?php
													if($tipo==1){
														$total = 0;
														if($detalle)
														{
															foreach ($detalle as $row) 
															{
																if($row->estado_linea != 3){
																	echo '<tr>				
																			<th>'.$row->nombre.'</th>
																			<th>'.$row->cantidad.'</th>
																			<th>'.'$'.$row->preciobase.'</th>
																			<th>'.'$'.$row->precio.'</th>
																			<th>'.'$'.$row->subtotal.'</th>
																			<th>
																				<a href="#" class="btn btn-danger btn-xs" onclick="sacarProducto('.$row->id_linea_producto_presupuesto.','.$presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('anular').' '.$this->lang->line('producto').'">
																				<i class="fa fa-minus"></i>
																				</a>
																			</th>
																			<th></th>
																		 </tr>';
																	$total = $total + $row->subtotal;
																}
															}
														}
														
														echo '</tbody>';
														echo '<tfoot>
																<tr>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th class="th1">'.$this->lang->line("total").'</th>
																	<th>'.'$'.$total.'</th>
																	<th></th>
																	<th></th>
																</tr>
															</tfoot>';
															
													}else{
														echo 	'</tbody>';
														echo 	'<tfoot>
																	<tr>
																		<th></th>
																		<th></th>
																		<th></th>
																		<th class="th1">'.$this->lang->line("total").'</th>
																		<th></th>
																		<th></th>
																		<th></th>
																	</tr>
																</tfoot>';
													}
													?>
											 </table>
										</div>
									</div>
									<br /><br />
									</form>
									<?php
	    						if($tipo ==1 ){
	    							echo '<form action="'.base_url().'index.php/Presupuestos/totalPresupuesto/'.$presupuesto.'" id="formGuardar" class="form-inline" method="post">			
										  <input type="hidden" id="total" name="total" pattern="[0-9 ]*" placeholder="'.$total.'" value="'.$total.'" required>';
	    						}
								?>
									<div class="row">
										<div>
											<div class="col-sm-4 col-sm-offset-5">
												<button type="submit" form="formGuardar" onclick="funcion2();" class="btn btn-primary" id="btn-guardar" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('guardar') ;?>" style="display: none">
													<?php echo $this->lang->line('guardar'); ?>
												</button>
												<input type="button" id="btn-cancelar" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="funcion2(); deletePresupuesto(<?php echo $presupuesto ?>)">
												<input type="number" id="presupuesto" name="presupuesto" pattern="[0-9 ]*" placeholder="<?php echo $presupuesto ?>" value="<?php echo $presupuesto ?>" required hidden> 
											</div>
										</div>
									</div>
	    						</form>
	    						
	    						
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
