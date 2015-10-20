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
	 		
	 		for(i = 0; i <= sessionStorage['aux']; i++ ){
				console.log(sessionStorage['nomb'+i]);	
	 		}
	 		aux = aux+1;
	 		armarTotales(pedido);
	 		document.formProducto.reset(); 
			document.getElementById("producto").focus();
	 	}
	});
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
		window.location.assign("/Durox/index.php/Pedidos/pedidos_abm/tab1");
	}
}

function guardarLineasNuevas($pedido){
	var pedido = $pedido;
	if(aux > 0){
		for(i = 0; i < aux; i++){
			var producto 	= $('#id_producto'+i).val();
			var cantidad 	= $('#cant'+i).val();
			var precio 		= $('#precio'+i).val();
			var subtotal 	= $('#subtotal'+i).val();
			var id_moneda	= $('#id_moneda'+i).val();
			var valor_moneda= $('#valor_moneda'+i).val();
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

function deleteRow(r, $pedi, $row) {
    var j 		= r.parentNode.parentNode.rowIndex;
    var fila 	= $row;
    document.getElementById("tablapedido").deleteRow(j);
    
    console.log('id_producto'+fila);
    
	sessionStorage.removeItem('id_producto'+fila);
	sessionStorage.removeItem('nomb'+fila);
	sessionStorage.removeItem('id_moneda'+fila);
	sessionStorage.removeItem('valor_moneda'+fila);
		 	
	sessionStorage.removeItem('cant'+fila);
		 	
	sessionStorage.removeItem('precio'+fila);
	sessionStorage.removeItem('simbolo'+fila);
	 	
	sessionStorage.removeItem('subtotal'+fila);
    
}
</script>

   
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
								            	<th></th>
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
											</tr>
										
										</tfoot>
								    </table> 
                        	</div><!-- /.col -->
                    	</form> 
					</div><!-- /.row -->
					<div class="row">
                    <!-- accepted payments column -->
                        <div class="col-xs-6">
                            
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
                        	<form action="<?php echo base_url().'/index.php/Pedidos/guardarNuevoPedido/'?>" onsubmit="return guardarLineasNuevas(<?php echo $id_pedido?>)" method="post">
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

		