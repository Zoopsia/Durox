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
								        <?php
								        	if($detalle) {
												foreach ($detalle as $row) {
													if ($row -> estado_linea != 3) {
														
														echo '<tr>';
														
														echo '<td>' . $row -> nombre . '</td>';
														echo '<td>' . $row -> cantidad . '</td>';
														echo '<td>' . $row->abreviatura.$row->simbolo.' '.$row -> precio . '</td>';
														echo '<td>$ ' . $row -> subtotal . '<input type="text" class="subtotal_anteriores" name="anterior_subtotal'.$row -> id_linea_producto_presupuesto.'" id="anterior_subtotal'.$row -> id_linea_producto_presupuesto.'" value="' . $row -> subtotal . '" hidden></td>';
														echo '<td class="no-print">' . $row -> estado . '<input type="text" name="linea'.$row -> id_linea_producto_presupuesto.'" id="linea'.$row -> id_linea_producto_presupuesto.'" value="1" hidden></td>';
														echo '<td><a class="btn btn-danger btn-xs" onclick="eliminarProducto(this,'.$row -> id_linea_producto_presupuesto.')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>';
														if($row->comentario){
																echo '<td class="text-center no-print" style="width: 20px"><button type="button" onclick="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').show(); $(\'#2text-coment'.$row -> id_linea_producto_presupuesto.'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>
																	<span id="2open-coment'.$row -> id_linea_producto_presupuesto.'" style="display:none">
																		<div class="talkbubble" >
																			<div class="talkbubble-rectangulo">
																				<textarea rows="4" id="2text-coment'.$row -> id_linea_producto_presupuesto.'" name="2text-coment'.$row -> id_linea_producto_presupuesto.'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').hide(); guardarComentario2('.$row -> id_linea_producto_presupuesto.')">'.$row->comentario.'</textarea>
																			</div>
																		</div>
																	</span>
																</td>';
														}
														else{
															echo '<td class="text-center no-print" style="width: 20px"><button type="button" onclick="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').show(); $(\'#2text-coment'.$row -> id_linea_producto_presupuesto.'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>
																	<span id="2open-coment'.$row -> id_linea_producto_presupuesto.'" style="display:none">
																		<div class="talkbubble" >
																			<div class="talkbubble-rectangulo">
																				<textarea rows="4" id="2text-coment'.$row -> id_linea_producto_presupuesto.'" name="2text-coment'.$row -> id_linea_producto_presupuesto.'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').hide(); guardarComentario2('.$row -> id_linea_producto_presupuesto.')"></textarea>
																			</div>
																		</div>
																	</span>
																</td>';
														}
													}
												}
											}
										?>
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
			                           			if($modos){
			                           				foreach($modos_pago as $value){
				                           				$aux = 0;
				                           				foreach($modos as $row){
				                           					if($value->id_modo_pago == $row->id_modo_pago)
																$aux = 1;
				                           				}
														if($aux == 0)
				                           					echo '<option value="'.$value->id_modo_pago.'">'.$value->modo_pago.'</option>';
														else{
															echo '<option value="'.$value->id_modo_pago.'" selected>'.$value->modo_pago.'</option>';
														}
													}
												}
												else{
													foreach($modos_pago as $value){	
				                           				if($value->id_modo_pago == 1)
															echo '<option value="'.$value->id_modo_pago.'" selected>'.$value->modo_pago.'</option>';
														else
					                           				echo '<option value="'.$value->id_modo_pago.'">'.$value->modo_pago.'</option>';
													}
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
			                           			foreach($condiciones_pago as $row){
			                           				if($condicion){
			                           					if($row->id_condicion_pago == $condicion)
															echo '<option value="'.$row->id_condicion_pago.'" selected>'.$row->condicion_pago.'</option>';
														else
				                           					echo '<option value="'.$row->id_condicion_pago.'">'.$row->condicion_pago.'</option>';
													}
													else{
				                           				if($row->id_condicion_pago == 1)
															echo '<option value="'.$row->id_condicion_pago.'" selected>'.$row->condicion_pago.'</option>';
														else
				                           					echo '<option value="'.$row->id_condicion_pago.'">'.$row->condicion_pago.'</option>';
													}
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
			                            		foreach($tiempos_entrega as $row){
			                            			if($tiempo){
			                            				if($row->id_tiempo_entrega == $tiempo)
															echo '<option value="'.$row->id_tiempo_entrega.'" selected>'.$row->tiempo_entrega.'</option>';
														else
				                            				echo '<option value="'.$row->id_tiempo_entrega.'">'.$row->tiempo_entrega.'</option>';
				                            		}
													else {
														if($row->id_tiempo_entrega == 1)
															echo '<option value="'.$row->id_tiempo_entrega.'" selected>'.$row->tiempo_entrega.'</option>';
														else
				                            				echo '<option value="'.$row->id_tiempo_entrega.'">'.$row->tiempo_entrega.'</option>';
			                            			}
			                            		}
			                            	}
										?>
			                       </select>
			                    </div>
			                    <div class="col-xs-12 form-group">
			                    	<textarea id="nota-publica" name="nota-publica" placeholder="<?php echo $this -> lang -> line('notas'); ?>" onkeyup="sessionStorage.setItem('nota-publica',$('#nota-publica').val());" style="width: 100%; resize: none" form="formGuardar"><?php if($nota){ echo $nota;}?></textarea>
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
                        	<form action="<?php echo base_url().'/index.php/Presupuestos/guardarNuevoPresupuesto/'?>" onsubmit="return guardarLineasNuevas(<?php echo $presupuesto?>)" method="post" id="formGuardar" name="formGuardar" novalidate>
	                        	<input type="text" name="cliente" value="<?php echo $id_cliente; ?>" hidden required/>
	                        	<input type="text" name="vendedor" value="<?php echo $id_vendedor; ?>" hidden required/>
	                        	<input type="text" name="visita" value="<?php echo $visita; ?>" hidden required/>
	                        	<input type="text" name="fecha" value="<?php echo $fecha; ?>" hidden required/>
	                        	<input type="number" name="estado_presupuesto" id="estado_presupuesto" value="1" hidden required/>
	                        	<?php if($anterior_presup){ ?>
	                        	<input type="text" name="anterior_presupuesto" value="<?php echo $anterior_presup; ?>" hidden required/>
	                        	<?php } else { ?>
	                        	<input type="text" name="anterior_presupuesto" value="0" hidden required/>	
	                        	<?php } ?>
	                        	<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelarCambios(<?php echo $presupuesto?>)" style="margin-left: 5px">
									<?php echo $this -> lang -> line('cancelar'); ?>
								</button>
								<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right">
									<?php echo $this -> lang -> line('guardar'); ?>
								</button>
							</form>
                         </div>
                    </div>	
	    				
				</div>
			</div><!--tab content-->
		</div><!--panel body-->
	</div><!--panel-->
</div><!--contenedor-->
   

<script>
var aux = 0;
var aux_coment = 0;
$(document ).ready(function() {
	$('#producto').focus();
	
	if(sessionStorage['aux2'] > 0){
    	for(i = 1; i <= sessionStorage['aux2']; i++ ){
    		$('#2text-coment'+sessionStorage['posicion'+i]).val(sessionStorage['2comentario'+i]);
    	}
    }
    
	if(sessionStorage['nota-publica'] != 'undefined'){
    	$('#nota-publica').val(sessionStorage['nota-publica']);
    }
	if(sessionStorage['aux']){
		for(i = 0; i <= sessionStorage['aux']; i++ ){
			if(sessionStorage['estado'+i] == 1){
				$("#tablapedido > tbody").append('<tr>'+
											 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+i]+'">'+sessionStorage['nomb'+i]+
											 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+i]+'">'+
											 				'<input type="text" id="id_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+i]+'">'+
															'<input type="text" id="valor_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+i]+'">'+
															'<input type="text" id="estado'+i+'" autocomplete="off" required hidden value="'+sessionStorage['estado'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+i]+'">'+sessionStorage['cant'+i]+'</td>'+
											 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+i]+'">'+sessionStorage['simbolo'+i]+' '+sessionStorage['precio'+i]+
											 				'<input type="text" id="simbolo'+i+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+i]+'">$ '+sessionStorage['subtotal'+i]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="sacarProducto(this,'+i+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+i+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
											 		'</tr>');
			}
			else{
				$("#tablapedido > tbody").append('<tr style="background-color: #f56954 !important; color: #fff;">'+
											 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+i]+'">'+sessionStorage['nomb'+i]+
											 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+i]+'">'+
											 				'<input type="text" id="id_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+i]+'">'+
															'<input type="text" id="valor_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+i]+'">'+
															'<input type="text" id="estado'+i+'" autocomplete="off" required hidden value="'+sessionStorage['estado'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+i]+'">'+sessionStorage['cant'+i]+'</td>'+
											 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+i]+'">'+sessionStorage['simbolo'+i]+' '+sessionStorage['precio'+i]+
											 				'<input type="text" id="simbolo'+i+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+i]+'">$ '+sessionStorage['subtotal'+i]+'</td>'+
											 			'<td>Imposible de Enviar</td>'+
											 			'<td><a class="btn btn-success btn-xs" onclick="cargarProducto2(this,'+i+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+i+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
											 		'</tr>');
			}
			if(sessionStorage['comentario'+i]){
				$('#text-coment'+i).val(sessionStorage['comentario'+i]);
			}
			aux++;
		}
	}
	armarTotales(<?php echo $presupuesto;?>); 
});

function armarTotales($presupuesto){
	var presupuesto	= $presupuesto - 1;
	var x = 0;
	/*
	for(i = 0; i < $(".subtotal_anteriores").length; i++){
		var name = $("input.subtotal_anteriores").attr('name');
		console.log(name.slice(17));
	}*/
	for(i = 0; i < aux; i++){
		if($('#estado'+i).val() == 1){
			if($('#subtotal'+i).val())
				x += parseFloat($('#subtotal'+i).val());
		}
	}		
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/armarTotales', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {	'presupuesto'	: presupuesto,
	 			'subtotal'		: x
	 			},
	 	success: function(resp) { 
	 		$('#table-totales').html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias 	
	 	}
	});	
}

function cargaProducto($id_cliente){
 	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var cliente		= $id_cliente;
 	var presupuesto	= <?php echo $presupuesto; ?>;
 	if(producto && cantidad){
	 	$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/Presupuestos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
		 	data: {	'producto'		: producto,
		 		   	'cantidad'		: cantidad,
		 		   	'presupuesto'	: presupuesto,
		 		   	'cliente'		: cliente,
	 		  		'aux'			: aux,
		 		   },
		 	success: function(resp) { 
		 		$("#tablapedido > tbody").append(resp);
		 		
		 		sessionStorage.setItem('aux', aux);
	 		
		 		sessionStorage.setItem('id_producto'+aux, $('#id_producto'+aux).val());
		 		sessionStorage.setItem('nomb'+aux, $('#nomb'+aux).val());
		 		sessionStorage.setItem('id_moneda'+aux, $('#id_moneda'+aux).val());
		 		sessionStorage.setItem('valor_moneda'+aux, $('#valor_moneda'+aux).val());
		 		sessionStorage.setItem('estado'+aux, $('#estado'+aux).val());
		 		
		 		sessionStorage.setItem('cant'+aux, $('#cant'+aux).val());
		 		
		 		sessionStorage.setItem('precio'+aux, $('#precio'+aux).val());
		 		sessionStorage.setItem('simbolo'+aux, $('#simbolo'+aux).val());
		 		
		 		sessionStorage.setItem('subtotal'+aux, $('#subtotal'+aux).val());
		 		
		 		aux = aux+1;
		 		armarTotales(presupuesto);
		 		document.formProducto.reset(); 
				document.getElementById("producto").focus();
		 	}
		});
	}
}

function sacarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#f56954 !important", "color": "#fff"});
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").html('<td><input type="text" id="id_producto'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+fila]+'">'+sessionStorage['nomb'+fila]+
											 				'<input type="text" id="nomb'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+fila]+'">'+
											 				'<input type="text" id="id_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+fila]+'">'+
															'<input type="text" id="valor_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+fila]+'">'+
															'<input type="text" id="estado'+fila+'" autocomplete="off" required hidden value="3">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+fila]+'">'+sessionStorage['cant'+fila]+'</td>'+
											 			'<td><input type="text" id="precio'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+fila]+'">'+sessionStorage['simbolo'+fila]+' '+sessionStorage['precio'+fila]+
											 				'<input type="text" id="simbolo'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+fila]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+fila]+'">$ '+sessionStorage['subtotal'+fila]+'</td>'+
											 			'<td>Imposible de Enviar</td>'+
											 			'<td><a class="btn btn-success btn-xs" onclick="cargarProducto2(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+fila+'\').show(); $(\'#text-coment'+fila+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+fila+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+fila+'" name="text-coment'+fila+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+fila+'\').hide(); guardarComentario('+j+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>');
	if(sessionStorage['comentario'+fila]){
		$('#text-coment'+fila).val(sessionStorage['comentario'+fila]);
	}
	sessionStorage.setItem('estado'+fila, $('#estado'+fila).val());
	armarTotales(<?php echo $presupuesto;?>);
}

function eliminarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#f56954 !important", "color": "#fff"});
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(6)").html('<a class="btn btn-success btn-xs" onclick="agregarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a>');
	$('#linea'+fila).val(3);
	armarTotales(<?php echo $presupuesto;?>);
}

function agregarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#FFFFFF !important", "color": "#333333"});
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(6)").html('<a class="btn btn-danger btn-xs" onclick="eliminarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a>');
	$('#linea'+fila).val(1);
	armarTotales(<?php echo $presupuesto;?>);
}

function cargarProducto2(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#FFFFFF", "color": "#333333"});
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").html('<td><input type="text" id="id_producto'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+fila]+'">'+sessionStorage['nomb'+fila]+
											 				'<input type="text" id="nomb'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+fila]+'">'+
											 				'<input type="text" id="id_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+fila]+'">'+
															'<input type="text" id="valor_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+fila]+'">'+
															'<input type="text" id="estado'+fila+'" autocomplete="off" required hidden value="1">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+fila]+'">'+sessionStorage['cant'+fila]+'</td>'+
											 			'<td><input type="text" id="precio'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+fila]+'">'+sessionStorage['simbolo'+fila]+' '+sessionStorage['precio'+fila]+
											 				'<input type="text" id="simbolo'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+fila]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+fila]+'">$ '+sessionStorage['subtotal'+fila]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="sacarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-minus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+fila+'\').show(); $(\'#text-coment'+fila+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+fila+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+fila+'" name="text-coment'+fila+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+fila+'\').hide(); guardarComentario('+j+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>');
	if(sessionStorage['comentario'+fila]){
		$('#text-coment'+fila).val(sessionStorage['comentario'+fila]);
	}
	sessionStorage.setItem('estado'+fila, $('#estado'+fila).val());
	armarTotales(<?php echo $presupuesto;?>);
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

function guardarComentario($linea){
	var j 	= $linea;
	sessionStorage.setItem('comentario'+j, $('#text-coment'+j).val());
}

function guardarComentario2($linea){
	aux_coment++;
	var j 	= $linea;
	sessionStorage.setItem('2comentario'+aux_coment, $('#2text-coment'+j).val());
	sessionStorage.setItem('posicion'+aux_coment, j);
	sessionStorage.setItem('aux2', aux_coment);
}

function funcion1($id_producto){
	
	var nombre 		= $('#id_valor'+$id_producto).val();
	var id_producto	= $id_producto;
	$('#producto').val(nombre);
	$('#id_producto').val(id_producto);
	$('#suggestions').hide();
	document.getElementById("cantidad").focus();
}

function cancelarCambios($presupuesto){
	var r = confirm("Desea Cancelar el presupuesto?\nAdventencia! - No podrá volver atrás");
	if (r == true) {
		sessionStorage.clear();
		window.location.assign("/durox/index.php/Presupuestos/presupuestos_abm/tab1");
	}
}

function guardarLineasNuevas($presupuesto){
	var presupuesto		= $presupuesto;
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
				var estado		= $('#estado'+i).val();
				if(producto){
					$.ajax({
					 	type: 'POST',
					 	url: '<?php echo base_url(); ?>index.php/Presupuestos/guardarLineasPresupuesto', //Realizaremos la petición al metodo prueba del controlador direcciones
					 	data: {'producto'		: producto,
					 		   'cantidad'		: cantidad,
					 		   'precio'			: precio,
					 		   'subtotal'		: subtotal,
					 		   'presupuesto'	: presupuesto,
					 		   'id_moneda'		: id_moneda,
					 		   'valor_moneda'	: valor_moneda,
					 		   'comentario'		: comentario,
					 		   'estado'			: estado
					 		   },
					 	success: function(resp) { 
					 		sessionStorage.clear();
					 	},
					 	async: false
					});
				}
				if(estado == 3){
					$('#estado_presupuesto').val(3);
				}
			}
			return true;
		}
		else{
			alert("ERROR! - No hay lineas en el presupuesto!");
			$('#producto').focus();
			return false;
		}
	}
	else{
		alert("ERROR! - Falta agregar Información al presupuesto!");
		return false;
	}
}
</script>

