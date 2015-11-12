<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading no-print">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab">
					<i class="fa fa-shopping-cart"></i> <?php echo $this -> lang -> line('pedido') . ' N° ' . $id_pedido; ?>
				</a></li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1"> 				
	    					<!--INFO GRAL DEL PEDIDO-->	
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
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('presupuesto') . ': ' . '<a class="sinhref">' . $id_presupuesto . '</a>';
								echo "</div>";
								echo '<div class="even">';
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('visita') . ': ' . '<a class="sinhref" >' . $id_visita . '</a>';
								echo "</div>";
								echo '<div class="odd">';
								$date = date_create($fecha);
								echo $this -> lang -> line('fecha') . ': ' . date_format($date, 'd/m/Y');
								echo "</div>";
								foreach ($estados as $key) {
									if ($key -> id_estado_pedido == 1) {
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
						<form id="formProducto" name="formProducto" class="form-inline" method="post">
                       		<div class="col-xs-12 table-responsive">
                       			<table class="table" cellspacing="0" width="100%" id="tablapedido">
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th style="width: 210px"><?php echo $this -> lang -> line('producto'); ?></th>
								                <th style="width: 200px"><?php echo $this -> lang -> line('cantidad'); ?></th>
								                <th><?php echo $this -> lang -> line('precio'); ?></th>
								                <th><?php echo $this -> lang -> line('subtotal'); ?></th>
								                <th class="no-print"><?php echo $this -> lang -> line('estado'); ?></th>
								            	<th style="width: 84px"></th>
								            	<th class="text-center" style="width: 20px"></th>
								            </tr>
								        </thead>
								 
								 		<tbody>
								        
										</tbody>
										<tfoot>
											<tr class="cargarLinea">
												<td style="width: 210px">
													<input type="text" id="producto" name="producto" class="numeric form-control editable" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="<?php echo $this -> lang -> line('producto'); ?>" required style="height: 20px">
													<div id="suggestions">
											            <div id="autoSuggestionsList">  
											            </div>
											        </div>
											        <input type="text" id="id_producto" name="id_producto" autocomplete="off" pattern="[0-9]*" required hidden>
												</td>
												<td style="width: 200px">
													<input type="text" id="cantidad" name="cantidad1" class="numeric form-control editable" onkeypress="if (event.keyCode==13){cargaProducto(<?php echo $id_cliente?>); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this -> lang -> line('cantidad'); ?>" style="height: 20px" required>
												</td>
												<td></td>
												<td></td>
												<td class="no-print"></td>		
												<td></td>
												<td class="text-center" style="width: 20px">
												</td>	
											</tr>
										</tfoot>
								    </table> 
                        	</div><!-- /.col -->
                    	</form> 
					</div><!-- /.row -->
					<div class="row">
                    <!-- accepted payments column -->
                    	<div class="col-xs-6 box box-default" style="width: 48%; margin-left: 10px; border-top: none; box-shadow: none">
                        	<div class="box-header" style="margin-bottom: 0px">
                        		<div class="pull-right box-tools">                                        
                                	<button class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Datos"><i class="fa fa-minus"></i></button>
                                </div>
                                <p class="lead"><?php echo $this->lang->line('informacion')?></p>
                        	</div>
                        	<div class="box-body">
                        		<div class="col-xs-5 form-group">
		                        	<label><?php echo $this->lang->line('modos').' de '.$this->lang->line('pago').':';?></label>
		                        </div>
		                        <div class="col-xs-7 form-group">
			                           <select name="modos_pago[]" id="modos_pago" class="form-control chosen-select" multiple="" data-placeholder="<?php echo $this->lang->line('modos').' de '.$this->lang->line('pago');?>" required form="formGuardar">
			                           	<option></option>
			                           	<?php 
			                           		if($modos_pago){
			                           			foreach($modos_pago as $modos){
			                           				if($modos->id_modo_pago == 1)
														echo '<option value="'.$modos->id_modo_pago.'" selected>'.$modos->modo_pago.'</option>';
													else
			                           					echo '<option value="'.$modos->id_modo_pago.'">'.$modos->modo_pago.'</option>';
			                           			}
			                           		}
										?>
			                           </select>
			                    </div>
		                        <div class="col-xs-5 form-group">
		                        	<label><?php echo $this->lang->line('condiciones').' de '.$this->lang->line('pago').':';?></label>
		                        </div>
		                        <div class="col-xs-7 form-group">
		                            <select name="condicion_pago" id="condicion_pago" class="form-control chosen-select" data-placeholder="<?php echo $this->lang->line('condicion').' de '.$this->lang->line('pago');?>" required form="formGuardar">
			                           	<option></option>
			                           	<?php 
			                           		if($condiciones_pago){
			                           			foreach($condiciones_pago as $condicion){
			                           				if($condicion->id_condicion_pago == 1)
														echo '<option value="'.$condicion->id_condicion_pago.'" selected>'.$condicion->condicion_pago.'</option>';
													else
			                           					echo '<option value="'.$condicion->id_condicion_pago.'">'.$condicion->condicion_pago.'</option>';
			                           			}
			                           		}
										?>
			                        </select>
			                    </div>
		                        <div class="col-xs-5 form-group">
									<label><?php echo $this->lang->line('tiempos').' de '.$this->lang->line('entrega').':';?></label>
		                        </div>
		                        <div class="col-xs-7 form-group">
			                    	<select name="tiempo_entrega" id="tiempo_entrega" class="form-control chosen-select" data-placeholder="<?php echo $this->lang->line('tiempo').' de '.$this->lang->line('entrega');?>" required form="formGuardar">
			                        	<option></option>
			                           	<?php 
			                           		if($tiempos_entrega){
			                            		foreach($tiempos_entrega as $tiempo){
			                            			if($tiempo->id_tiempo_entrega == 1)
														echo '<option value="'.$tiempo->id_tiempo_entrega.'" selected>'.$tiempo->tiempo_entrega.'</option>';
													else
			                            				echo '<option value="'.$tiempo->id_tiempo_entrega.'">'.$tiempo->tiempo_entrega.'</option>';
			                            		}
			                            	}
										?>
			                       </select>
			                    </div>
                           </div>
                        </div><!-- /.col -->
                        
                        <div class="col-xs-6">
                            <p class="lead"><?php echo $this->lang->line('totales')?></p>
                            <div class="table-responsive" id="table-totales">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%"><?php echo $this -> lang -> line('subtotal'); ?></th>
                                        <td>$ </td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this -> lang -> line('iva'); ?></th>
                                        <td>$ </td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this -> lang -> line('total'); ?></th>
                                        <td>$ </td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
					<div class="row no-print">
                        <div class="col-xs-12">
                        	<form action="<?php echo base_url().'/index.php/Pedidos/guardarNuevoPedido/'?>" onsubmit="return guardarLineasNuevas(<?php echo $id_pedido?>)" method="post" id="formGuardar" name="formGuardar" novalidate>
	                        	<input type="text" name="cliente" value="<?php echo $id_cliente; ?>" hidden />
	                        	<input type="text" name="vendedor" value="<?php echo $id_vendedor; ?>" hidden/>
	                        	<input type="text" name="fecha" value="<?php echo $fecha; ?>" hidden/>
	                        	<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelarCambios(<?php echo $id_pedido?>)" style="margin-left: 5px">
									<?php echo $this -> lang -> line('cancelar'); ?>
								</button>
								<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right">
									<?php echo $this -> lang -> line('guardar'); ?>
								</button>
							</form>
                         </div>
                    </div>	
				</div>
			</div>
		</div>  		
	</div>
</div>

<script>
var aux = 0;

$( document ).ready(function() {
	//sessionStorage.clear();
	var j = 0;
	$('#producto').focus();
	if(sessionStorage['aux']){
		for(i = 0; i <= sessionStorage['aux']; i++ ){
			if(sessionStorage['nomb'+i]){
				$("#tablapedido > tbody").append('<tr>'+
											 			'<td><input type="text" id="id_producto'+j+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+i]+'">'+sessionStorage['nomb'+i]+
											 				'<input type="text" id="nomb'+j+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+i]+'">'+
											 				'<input type="text" id="id_moneda'+j+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+i]+'">'+
															'<input type="text" id="valor_moneda'+j+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+j+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+i]+'">'+sessionStorage['cant'+i]+'</td>'+
											 			'<td><input type="text" id="precio'+j+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+i]+'">'+sessionStorage['simbolo'+i]+' '+sessionStorage['precio'+i]+
											 				'<input type="text" id="simbolo'+j+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+j+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+i]+'">$ '+sessionStorage['subtotal'+i]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="deleteRow(this,<?php echo $id_pedido;?>,'+aux+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+j+'\').show(); $(\'#text-coment'+j+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+j+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+j+'" name="text-coment'+j+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+j+'\').hide(); guardarComentario('+j+')">'+sessionStorage['comentario'+i]+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
											 		'</tr>');
				j++;
			}
			aux++;
		}
	}
	armarTotales(<?php echo $id_pedido;?>);
});

function aprobarForm() {
 	$("#aprobarForm").submit();
}

function cargaProducto($id_cliente){
	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var cliente		= $id_cliente;
 	var pedido		= <?php echo $id_pedido;?>;
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/traerProducto2', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'producto'	: producto,
	 		   'cantidad'	: cantidad,
	 		   'cliente'	: cliente,
	 		   'aux'		: aux,
	 		   'pedido'		: pedido
	 		   },
	 	success: function(resp) { 
	 		$("#tablapedido > tbody").append(resp);
	 		
	 		sessionStorage.setItem('aux', aux);
	 		
	 		sessionStorage.setItem('id_producto'+aux, $('#id_producto'+aux).val());
	 		sessionStorage.setItem('nomb'+aux, $('#nomb'+aux).val());
	 		sessionStorage.setItem('id_moneda'+aux, $('#id_moneda'+aux).val());
	 		sessionStorage.setItem('valor_moneda'+aux, $('#valor_moneda'+aux).val());
	 		
	 		sessionStorage.setItem('cant'+aux, $('#cant'+aux).val());
	 		
	 		sessionStorage.setItem('precio'+aux, $('#precio'+aux).val());
	 		sessionStorage.setItem('simbolo'+aux, $('#simbolo'+aux).val());
	 		
	 		sessionStorage.setItem('subtotal'+aux, $('#subtotal'+aux).val());
	 		
	 		aux = aux+1;
	 		armarTotales(pedido);
	 		document.formProducto.reset(); 
			document.getElementById("producto").focus();
	 	}
	});
}

function guardarComentario($linea){
	var j 	= $linea;
	sessionStorage.setItem('comentario'+j, $('#text-coment'+j).val());
}

function armarTotales($id_pedido){
	var pedido	= $id_pedido;
	var x = 0;
	for(i = 0; i < aux; i++){
		if($('#subtotal'+i).val())
			x += parseFloat($('#subtotal'+i).val());
	}		
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/armarTotales', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {	'pedido'		: pedido,
	 			'subtotal'		: x
	 			},
	 	success: function(resp) { 
	 		$('#table-totales').html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias 	
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
//-----FUNCION PARA SELECCIONAR UN PRODUCTO Y ESCONDER EL AUTOCOMPLETAR---//
function funcion1($id_producto){
	var nombre 		= $('#id_valor'+$id_producto).val();
	var id_producto	= $id_producto;
	$('#producto').val(nombre);
	$('#id_producto').val(id_producto);
	$('#suggestions').hide();
	document.getElementById("cantidad").focus();
}


function cancelarCambios($pedido){
	var r = confirm("Desea Cancelar el pedido?\nAdventencia! - No podrá volver atrás");
	if (r == true) {
		sessionStorage.clear();
		window.location.assign("/durox/index.php/Pedidos/pedidos_abm/tab1");
	}
}

function guardarLineasNuevas($pedido){
	var pedido 			= $pedido;
	if($('#tiempo_entrega').val() && $('#condicion_pago').val() && $('#modos_pago').val()){
		if(aux > 0){
			for(i = 0; i < aux; i++){
				var producto 	= $('#id_producto'+i).val();
				var cantidad 	= $('#cant'+i).val();
				var precio 		= $('#precio'+i).val();
				var subtotal 	= $('#subtotal'+i).val();
				var id_moneda	= $('#id_moneda'+i).val();
				var valor_moneda= $('#valor_moneda'+i).val();
				var comentario	= $('#text-coment'+i).val();
				if(producto){
					$.ajax({
					 	type: 'POST',
					 	url: '<?php echo base_url(); ?>index.php/Pedidos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
					 	data: {'producto'		: producto,
					 		   'cantidad'		: cantidad,
					 		   'precio'			: precio,
					 		   'subtotal'		: subtotal,
					 		   'pedido'			: pedido,
					 		   'id_moneda'		: id_moneda,
					 		   'valor_moneda'	: valor_moneda,
					 		   'comentario'		: comentario,
					 		   },
					 	success: function(resp) { 
					 		sessionStorage.clear();
					 	},
					 	async: false
					});
				}
			}
			return true;
		}
		else{
			alert("ERROR! - No hay lineas en el pedido!");
			$('#producto').focus();
			return false;
		}
	}
	else{
		alert("ERROR! - Falta agregar Información al pedido!");
		return false;
	}
}

function deleteRow(r, $pedi, $row) {
    var j 		= r.parentNode.parentNode.rowIndex;
    var fila 	= $row;
    var pedido	= <?php echo $id_pedido;?>;
    document.getElementById("tablapedido").deleteRow(j);
    
	sessionStorage.removeItem('id_producto'+fila);
	sessionStorage.removeItem('nomb'+fila);
	sessionStorage.removeItem('id_moneda'+fila);
	sessionStorage.removeItem('valor_moneda'+fila);
		 	
	sessionStorage.removeItem('cant'+fila);
		 	
	sessionStorage.removeItem('precio'+fila);
	sessionStorage.removeItem('simbolo'+fila);
	 	
	sessionStorage.removeItem('subtotal'+fila);
    
    sessionStorage.removeItem('comentario'+fila);
    
    armarTotales(pedido);
}

</script>
