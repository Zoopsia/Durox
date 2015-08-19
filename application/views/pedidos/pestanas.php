<script>
function editable(){
	$("#btn-print").hide();
	$("#btn-editar").hide();
	$(".cargarLinea").show();
	$('.display-none').show();
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	document.getElementById("producto").focus();
	
}

function cargaProducto($id_pedido){
	
 	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var pedido	= $id_pedido;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'producto'	: producto,
	 		   'cantidad'	: cantidad,
	 		   'pedido'		: pedido
	 		   },
	 	success: function(resp) { 
	 		$('#tablapedido').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias 	
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});

	
}

function armarTotales($id_pedido){
	var pedido	= $id_pedido;	
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/armarTotales', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'pedido'		: pedido},
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

function funcion1($id_producto){
	
	var nombre 		= $('#id_valor'+$id_producto).val();
	var id_producto	= $id_producto;
	$('#producto').val(nombre);
	$('#id_producto').val(id_producto);
	$('#suggestions').hide();
	document.getElementById("cantidad").focus();
}

function sacarProducto($id_linea, $pedido){
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
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});
}

function cargarProducto($id_linea, $pedido){
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
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});
}

</script>
<?php
	if($pedido){
		foreach ($pedido as $row) {
?>	
<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<div class="row">
		  					<div class="col-lg-2">
				  				<i class="fa fa-shopping-cart"></i> <?php echo $this->lang->line('pedido').' N° '.$row->id_pedido; ?>
		                  	</div>
		                   	<div id="imagen-durox" class="col-lg-3 col-lg-offset-2" align="center" style="display: none">
		                   		<img alt="DUROX" src="<?php echo base_url().'/img/durox.png'?>">
                   			</div>
                   		</div>
                   	</div>
		  			<div class="panel-body">
		  				  				
	    					<!--INFO GRAL DEL PEDIDO-->	
	    						
								 <div class="row invoice-info">
                        			<div class="col-sm-4 invoice-col">
                        				<b><?php echo $this->lang->line('vendedor');?></b>
                           			<address>
		                                <?php
		                                if($vendedores){
											foreach ($vendedores as $key) 
											{
												echo '<a class="sinhref" href="'.base_url().'index.php/vendedores/pestanas/'.$key->id_vendedor.'">';
												echo $key->apellido.', '.$key->nombre;
												echo '</a>';
												echo "<br>";
												echo "<div class='no-print'>";
												echo $this->lang->line('id').': '.$key->id_vendedor;
												echo "</div>";
												echo "<br>";
												if($key->eliminado == 0)
													$aux2 = 1;
											}
										}
										?>
									</address>
			                        </div><!-- /.col -->
			                        <div class="col-sm-4 invoice-col">
		                            	<b><?php echo $this->lang->line('cliente');?></b>
		                            <address>
		                                <?php
		                                if($clientes){
											foreach ($clientes as $key) 
											{
												echo '<a class="sinhref" href="'.base_url().'index.php/clientes/pestanas/'.$key->id_cliente.'">';
												echo $key->razon_social;
												echo '</a>';
												echo "<br>";
												echo $this->lang->line('cuit').': '.cuit($key->cuit);
												echo "<br>";
												foreach ($iva as $value) {
													if($value->id_iva == $key->id_iva){	
														echo $value->iva;
														echo "<br>";
													}
												}
												echo "<div class='no-print'>";
												echo $this->lang->line('id').': '.$key->id_cliente;
												echo "</div>";
												echo "<br>";
												if($key->eliminado == 0)
													$aux = 1;
											}
										}
										?>
		                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        	<b><?php echo $this->lang->line('presupuesto');?></b>
                            <?php
												echo '<div class="odd">';
												echo $this->lang->line('id').' '.$this->lang->line('presupuesto').': '.'<a class="sinhref" href="'.base_url().'index.php/Presupuestos/pestanas/'.$row->id_presupuesto.'">'.$row->id_presupuesto.'</a>';
												echo "</div>";
												echo '<div class="even">';
												echo $this->lang->line('id').' '.$this->lang->line('visita').': '.'<a class="sinhref" href="'.base_url().'index.php/Visitas/carga/'.$row->id_visita.'/0">'.$row->id_visita.'</a>';
												echo "</div>";
												echo '<div class="odd">';
												$date	= date_create($row->fecha);
												echo $this->lang->line('fecha').': '.date_format($date, 'd/m/Y');
												echo "</div>";
												foreach($estados as $key){
													if($key->id_estado_pedido == $row->id_estado_pedido){
														echo '<div class="even no-print">';	
														echo $this->lang->line('estado').': '.$key->estado;
														echo "</div>";
													}
												}
												echo '<div class="odd">';
												echo $this->lang->line('total').' '.$this->lang->line('presupuesto').': $ '.$row->total;
												echo "</div>";
												echo "<br>";							
								}
							}
							?>
						</div>
						</div>
						
						
						<div class="row">
							<div class="col-md-1 col-lg-1">
								<?php echo $this->lang->line('detalle'); ?>
							</div>
						</div>
						<div class="row">
                        <div class="col-xs-12 table-responsive" id="tablapedido">
                        	<form id="formProducto" class="form-inline" method="post">
                        		<?php
                                		
									$total = 0;
									$bandera = 0;
									if($pedidos)
									{
										foreach ($pedidos as $row) 
										{
											if($row->estado_linea != 3){
												$total = $row->subtotal + $total;
											}
											else{
												$bandera = 1;
											}	
										}
									}
									
									if($bandera == 1)
	     							{
	     								echo '<table class="table" cellspacing="0" width="100%">';
	     							}
									else {
										echo '<table class="table table-striped" cellspacing="0" width="100%">';
									}	
	     						?>
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th><?php echo $this->lang->line('producto'); ?></th>
								                <th><?php echo $this->lang->line('cantidad'); ?></th>
								                <th><?php echo $this->lang->line('precio'); ?></th>
								                <th><?php echo $this->lang->line('subtotal'); ?></th>
								                <th class="no-print"><?php echo $this->lang->line('estado'); ?></th>
								            	<th></th>
								            </tr>
								        </thead>
								 
								 		<tbody>
								        <?php	
								        if($pedidos)
										{
									        foreach ($pedidos as $row) 
									        {
												if($row->estado == 'Imposible de Enviar'){
													echo '<tr class="no-print" style="background-color: #f56954 !important; color: #fff;">';
												}
												else{
						     						echo '<tr>';	
												}
												echo '<td>'.$row->nombre.'</td>';
												echo '<td>'.$row->cantidad.'</td>';
												echo '<td>$ '.$row->precio.'</td>';
												echo '<td>$ '.$row->subtotal.'</td>';
												echo '<td class="no-print" style="width: 269px">'.$row->estado.'</th>';	
												if($row->estado != 'Imposible de Enviar')
													echo '<td style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-danger btn-xs" onclick="sacarProducto('.$row->id_linea_producto_pedido.','.$id_pedido.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></span></td>';			
												else {
													echo '<td style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-success btn-xs" onclick="cargarProducto('.$row->id_linea_producto_pedido.','.$id_pedido.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Agregar Producto"><i class="fa fa-plus"></i></a></span></td>';	
												}
												echo '</tr>';
											}	
										}		
										?>
										<tr class="cargarLinea" style="display: none">
											<td style="width: 200px">
												<input type="text" id="producto" name="producto" class="numeric form-control editable" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="<?php echo $this->lang->line('producto'); ?>" required style="height: 20px">
												<div id="suggestions">
										            <div id="autoSuggestionsList">  
										            </div>
										        </div>
										        <input type="text" id="id_producto" name="id_producto" autocomplete="off" pattern="[0-9]*" required hidden>
											</td>
											<td style="width: 189px">
												<input type="text" id="cantidad" name="cantidad1" class="numeric form-control editable" onkeypress="if (event.keyCode==13){cargaProducto(<?php echo $id_pedido?>); return false;}" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>" style="height: 20px" required>
											</td>
											<td></td>
											<td></td>
											<td class="no-print"></td>		
											<td></td>		
										</tr>
										
										</tbody>
								    </table>  
							</form>            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
						<div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead no-print"><?php echo $this->lang->line('notas');?></p>
                            <p class="text-muted well well-sm no-shadow no-print" style="margin-top: 10px;">
                                
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead"><?php echo $this->lang->line('totales');?></p>
                            <div class="table-responsive" id="table-totales">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%"><?php echo $this->lang->line('subtotal');?></th>
                                        <td>$ <?php echo round($total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('iva');?></th>
                                        <td>$ <?php echo round($total*1.21-$total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('total');?></th>
                                        <td>$ <?php echo round($total*1.21,2);?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
					<div class="row no-print">
                        <div class="col-xs-12">
                        	<form action="<?php echo base_url().'/index.php/Pedidos/guardarPedido/'.$id_pedido?>" method="post">
	                        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
									<i class="fa fa-info-circle"></i>
								</button>
								
								<button id ="btn-print" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
								
								<button type="button" id="btn-editar" class="btn btn-primary btn-sm pull-right" onclick="editable()">
									<?php echo $this->lang->line('editar');?>
								</button>	
								
								<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="" style="display: none; margin-left: 5px">
									<?php echo $this->lang->line('cancelar');?>
								</button>
								<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right" style="display: none;">
									<?php echo $this->lang->line('guardar');?>
								</button>
							</form>
                         </div>
                    </div>	
                   	
			  		</div>
			  		
	</div>
</div>
 
		
		
		<!-- Modal -->
<?php if($pedido){ foreach($pedido as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Pedidos/editarVisto/".$row->id_presupuesto; ?>" class="form-horizontal" method="post">
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
		      			<?php echo $this->lang->line('pedido'); ?> 
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