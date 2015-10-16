<script>

$( document ).ready(function() {
	$('#producto').focus();
});

function aprobarForm() {
 	$("#aprobarForm").submit();
}

var aux = 0;

function cargaProducto($id_pedido){
	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var pedido		= $id_pedido;
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/traerProducto2', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'producto'	: producto,
	 		   'cantidad'	: cantidad,
	 		   'pedido'		: pedido,
	 		   'aux'		: aux
	 		   },
	 	success: function(resp) { 
	 		$("#tablapedido > tbody").append(resp);
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
function sacarProducto($id_linea, $pedido){
	var producto = [];
	var cantidad = [];
	var precio = [];
	var subtotal = [];
	var nombre = [];
	for(i = 0; i < aux; i++){
		producto[i] 	= $('#id_producto'+i).val();
		cantidad[i] 	= $('#cant'+i).val();
		precio[i] 		= $('#precio'+i).val();
		subtotal[i] 	= $('#subtotal'+i).val();
		nombre[i]		= $('#nomb'+i).val();
		
	}	
	var pedido = $pedido;
 	var id_linea	= $id_linea;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/sacarProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'id_linea'	: id_linea,
	 		   'pedido': pedido,
	 		   },
	 	success: function(resp) {
	 		$('#tablapedido').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		for(i = 0; i < aux; i++){
	 			$("#tablapedido > tbody").append('<tr>'+
										 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+producto[i]+'">'+nombre[i]+
										 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+nombre[i]+'">'+
										 			'</td>'+
										 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+cantidad[i]+'">'+cantidad[i]+'</td>'+
										 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+precio[i]+'">$ '+precio[i]+'</td>'+
										 			'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+subtotal[i]+'">$ '+subtotal[i]+'</td>'+
										 			'<td>Nuevo</td>'+
										 			'<td></td>'+
										 		'</tr>');
			}	
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});
}
function cargarProducto($id_linea, $pedido){
	var producto = [];
	var cantidad = [];
	var precio = [];
	var subtotal = [];
	var nombre = [];
	for(i = 0; i < aux; i++){
		producto[i] 	= $('#id_producto'+i).val();
		cantidad[i] 	= $('#cant'+i).val();
		precio[i] 		= $('#precio'+i).val();
		subtotal[i] 	= $('#subtotal'+i).val();
		nombre[i]		= $('#nomb'+i).val();
		
	}	
	var pedido = $pedido;
 	var id_linea	= $id_linea;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/cargarProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'id_linea'	: id_linea,
	 		   'pedido': pedido,
	 		   },
	 	success: function(resp) {
	 		$('#tablapedido').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		for(i = 0; i < aux; i++){
	 			$("#tablapedido > tbody").append('<tr>'+
										 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+producto[i]+'">'+nombre[i]+
										 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+nombre[i]+'">'+
										 			'</td>'+
										 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+cantidad[i]+'">'+cantidad[i]+'</td>'+
										 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+precio[i]+'">$ '+precio[i]+'</td>'+
										 			'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+subtotal[i]+'">$ '+subtotal[i]+'</td>'+
										 			'<td>Nuevo</td>'+
										 			'<td></td>'+
										 		'</tr>');
			}	
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});
}
function cancelarCambios($pedido){
	var pedido = $pedido;
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/cancelarCambios', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'pedido': pedido,},
	 	success: function(resp) {
	 		$('#tablapedido').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		armarTotales(pedido);
	 		$(".cargarLinea").show();
			aux = 0;
	 	}
	});
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
				 		
				 	},
				 	async: false
				});
			}
		}
		return true;
	}
	else{
		alert("ERROR! - No hay lineas en el pedido!");
		return false;
	}
}

function deleteRow(r, $pedi) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("tablapedido").deleteRow(i);
    armarTotales($pedi);
}
</script>

<?php
	if($pedido){
		foreach ($pedido as $row) {
?>	

       
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading no-print">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab">
					<i class="fa fa-shopping-cart"></i> <?php echo $this -> lang -> line('pedido') . ' N° ' . $row -> id_pedido; ?>
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
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('presupuesto') . ': ' . '<a class="sinhref" href="' . base_url() . 'index.php/Presupuestos/pestanas/' . $row -> id_presupuesto . '">' . $row -> id_presupuesto . '</a>';
								echo "</div>";
								echo '<div class="even">';
								echo $this -> lang -> line('id') . ' ' . $this -> lang -> line('visita') . ': ' . '<a class="sinhref" href="' . base_url() . 'index.php/Visitas/carga/' . $row -> id_visita . '/0">' . $row -> id_visita . '</a>';
								echo "</div>";
								echo '<div class="odd">';
								$date = date_create($row -> fecha);
								echo $this -> lang -> line('fecha') . ': ' . date_format($date, 'd/m/Y');
								echo "</div>";
								foreach ($estados as $key) {
									if ($key -> id_estado_pedido == $row -> id_estado_pedido) {
										echo '<div class="even no-print">';
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
													<input type="text" id="cantidad" name="cantidad1" class="numeric form-control editable" onkeypress="if (event.keyCode==13){cargaProducto(<?php echo $id_pedido?>); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this -> lang -> line('cantidad'); ?>" style="height: 20px" required>
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
                        	<form action="<?php echo base_url().'/index.php/Pedidos/guardarPedido/'.$id_pedido.'/1'?>" onsubmit="return guardarLineasNuevas(<?php echo $id_pedido?>)" method="post">
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

		