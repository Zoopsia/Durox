	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading no-print">
				<ul class="nav nav-pills">
					<li class="active"><a href="#tab1" data-toggle="tab">
						<i class="fa fa-shopping-cart"></i> <?php echo $this -> lang -> line('presupuesto') . ' N° ' . $presupuesto; ?>
					</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade in active" id="tab1">
				  		<div class="row invoice-info">
                    	<div class="col-sm-4 invoice-col">
                        	<b><?php echo $this -> lang -> line('vendedor'); ?></b>
                           	<address>
		                    <?php
								if ($vendedores) {
									foreach ($vendedores as $key) {
										echo '<a class="sinhref" href="' . base_url() . 'index.php/vendedores/pestanas/' . $key -> id_vendedor . '">';
										echo $key -> apellido . ', ' . $key -> nombre;
										echo '</a>';
										echo "<br>";
										echo "<div class='no-print'>";
										echo $this -> lang -> line('id') . ': ' . $key -> id_vendedor;
										echo "</div>";
										echo "<br>";
										if ($key -> eliminado == 0)
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
								if ($clientes) {
									foreach ($clientes as $key) {
										echo '<a class="sinhref" href="' . base_url() . 'index.php/clientes/pestanas/' . $key -> id_cliente . '">';
										echo $key -> razon_social;
										echo '</a>';
										echo "<br>";
										echo $this -> lang -> line('cuit') . ': ' . cuit($key -> cuit);
										echo "<br>";
										foreach ($iva as $value) {
											if ($value -> id_iva == $key -> id_iva) {
												echo $value -> iva;
												echo "<br>";
											}
										}
										echo "<div class='no-print'>";
										echo $this -> lang -> line('id') . ': ' . $key -> id_cliente;
										echo "</div>";
										echo "<br>";
										if ($key -> eliminado == 0)
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
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('presupuesto') . ': ' . '<a class="sinhref">' . $presupuesto . '</a>';
								echo "</div>";
								echo '<div class="even">';
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('visita') . ': ' . '<a class="sinhref" >' . $visita . '</a>';
								echo "</div>";
								echo '<div class="odd">';
								$date = date_create($fecha);
								echo $this -> lang -> line('fecha') . ': ' . date_format($date, 'd/m/Y');
								echo "</div>";
								foreach ($estados as $key) {
									if ($key -> id_estado_presupuesto == 1) {
										echo '<div class="even no-print">';
										echo $this -> lang -> line('estado') . ': ' . $key -> estado;
										echo "</div>";
									}
								}
								echo "<br>";
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-lg-1">
							<?php echo $this -> lang -> line('detalle'); ?>
						</div>
					</div>
					
				  		
			    			<div class="row">
				    			<div id="table" class="col-sm-12" >
				    				<form action="" id="formProducto" class="form-inline" method="post">
										<table class="table" cellspacing="0" width="100%">
											<thead class="tabla-datos-importantes">
								            <tr>
								            	<th style="width: 210px"><?php echo $this -> lang -> line('producto'); ?></th>
								                <th style="width: 200px"><?php echo $this -> lang -> line('cantidad'); ?></th>
								                <th><?php echo $this->lang->line("precio").' '.$this->lang->line("base"); ?></th>
								                <th><?php echo $this->lang->line("precio"); ?></th>
								                <th class="no-print"><?php echo $this->lang->line("subtotal"); ?></th>
								            	<th style="width: 84px"></th>
								            	<th class="text-center" style="width: 20px"></th>
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
									</form>
								</div>
							</div>
							<br /><br />
							<?php
			    			if($tipo ==1 ){
			    				echo '<form action="'.base_url().'index.php/Presupuestos/totalPresupuesto/'.$presupuesto.'" id="formGuardar" class="form-inline" method="post">			
									  <input type="hidden" id="total" name="total" pattern="[0-9 ]*" placeholder="'.$total.'" value="'.$total.'" required>
									  </form>';					  
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
	    				
  					</div>
  				</div><!--tab content-->
  			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
   

<script>

  
$( document ).ready(function() {
    document.getElementById("producto").focus();
    console.log(<?php echo $id_cliente.', '.$fecha.', '.$id_vendedor.', '.$visita.', '.$presupuesto;?>);
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
 	if(producto && cantidad){
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
		window.location.assign("/durox/index.php/Presupuestos/presupuestos_abm/tab1");
		
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

