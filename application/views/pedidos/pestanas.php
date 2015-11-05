<?php
	if($pedido){
		$arreglo_modos 			= array();
		$arreglo_tiempos		= array();
		$arreglo_condiciones	= array();
		foreach ($pedido as $row) {
?>	
   
<div class="col-md-12">
	<div class="panel panel-default">
		<div id="imagen-durox" class="col-lg-3 col-lg-offset-2" align="center" style="display: none; margin-top: 20px">
	    	<p style="position: absolute; left: 15px;"><?php echo $this -> lang -> line('pedido') . ' N° ' . $row -> id_pedido; ?></p>
	    	<img alt="DUROX" src="<?php echo base_url().'/img/durox.png'?>">
	      	<hr>
	    </div>
		<div class="panel-heading no-print">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab">
					<i class="fa fa-shopping-cart"></i> <?php echo $this -> lang -> line('pedido') . ' N° ' . $row -> id_pedido; ?>
				</a></li>
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
	    					<!--INFO GRAL DEL PEDIDO-->	
					<div class="row invoice-info">
                    	<div class="col-sm-4 invoice-col">
                        	<b><?php echo $this -> lang -> line('vendedor'); ?></b>
                           	<address>
		                    <?php
								if ($vendedores) {
									foreach ($vendedores as $key) {
										echo '<a class="sinhref" href="' . base_url() . 'index.php/vendedores/pestanas/' . $key -> id_vendedor . '">';
										echo $key -> nombre.' '.$key -> apellido;
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
                       		<div class="col-xs-12 table-responsive" >
                       		<?php
								$total = 0;
								$bandera = 0;
								if ($pedidos) {
									foreach ($pedidos as $row) {
										if ($row -> estado_linea != 3) {
											$total = $row -> subtotal + $total;
										} else {
											$bandera = 1;
										}
									}
								}

								if ($bandera == 1) {
									echo '<table class="table" cellspacing="0" width="100%" id="tablapedido">';
								} else {
									echo '<table class="table table-striped" cellspacing="0" width="100%" id="tablapedido">';
								}
	     						?>
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th style="width: 210px"><?php echo $this -> lang -> line('producto'); ?></th>
								                <th style="width: 200px"><?php echo $this -> lang -> line('cantidad'); ?></th>
								                <th><?php echo $this -> lang -> line('precio'); ?></th>
								                <th><?php echo $this -> lang -> line('subtotal'); ?></th>
								                <th class="no-print"><?php echo $this -> lang -> line('estado'); ?></th>
								            	<th class="no-print"></th>
								            	<th class="no-print" style="width: 43px"></th>
								            </tr>
								        </thead>
								 
								 		<tbody>
								        <?php
								        	$cotizacion = array();
											if ($pedidos) {
												foreach ($pedidos as $row) {
													if ($row -> estado == 'Imposible de Enviar') {
														echo '<tr class="no-print" style="background-color: #f56954 !important; color: #fff;">';
													} else {
														echo '<tr>';
													}
													echo '<td>' . $row -> nombre . '</td>';
													echo '<td>' . $row -> cantidad . '</td>';
													echo '<td>' . $row->abreviatura.$row->simbolo.' '.$row -> precio . '</td>';
													echo '<td class="subtotal1" style="display: none">'.$row->abreviatura.$row->simbolo.' '.round($row -> precio*$row -> cantidad, 2).'</td>';
													if(array_key_exists($row->abreviatura.$row->simbolo, $cotizacion))
														$cotizacion[$row->abreviatura.$row->simbolo] += round($row -> precio*$row -> cantidad, 2);
													else 
														$cotizacion[$row->abreviatura.$row->simbolo] = round($row -> precio*$row -> cantidad, 2);
													echo '<td class="subtotal2">$ ' . $row -> subtotal . '</td>';
													echo '<td class="no-print" style="width: 150px">' . $row -> estado . '</td>';
													if ($row -> estado == 'En Proceso')
														echo '<td class="no-print" style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-danger btn-xs" onclick="sacarProducto(' . $row -> id_linea_producto_pedido . ',' . $id_pedido . ')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></span></td>';
													else if ($row -> estado == 'Nuevo')
														echo '<td class="no-print" style="width: 50px"></td>';
													/*
													else if($row->estado == 'Aprobado')
													 echo 	'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';
													 else if($row->estado == 'Facturado')
													 echo 	'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';
													 else if($row->estado == 'Enviado')
													 echo 	'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';
													 else if($row->estado == 'Eliminado')
													 echo 	'<td style="width: 200px">'.devolverEstadoPedido($row->estado).'</td>';	*/
													else if ($row -> estado == 'Imposible de Enviar')
														echo '<td class="no-print" style="width: 50px"><span class="display-none" style="display:none"><a class="btn btn-success btn-xs" onclick="cargarProducto(' . $row -> id_linea_producto_pedido . ',' . $id_pedido . ')" role="button" data-toggle="tooltip" data-placement="bottom" title="Agregar Producto"><i class="fa fa-plus"></i></a></span></td>';
													else
														echo '<td class="no-print" style="width: 50px"></td>';
													if($row->comentario)
													
													echo 	'<td class="text-center no-print" style="width: 20px"><button type="button" onclick="$(\'#2open-coment'.$row -> id_linea_producto_pedido.'\').show(); $(\'#2text-coment'.$row -> id_linea_producto_pedido.'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>
																<span id="2open-coment'.$row -> id_linea_producto_pedido.'" style="display:none">
																	<div class="talkbubble" >
																		<div class="talkbubble-rectangulo">
																			<textarea rows="4" id="2text-coment'.$row -> id_linea_producto_pedido.'" name="2text-coment'.$row -> id_linea_producto_pedido.'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#2open-coment'.$row -> id_linea_producto_pedido.'\').hide(); guardarComentario2('.$row -> id_linea_producto_pedido.')">'.$row->comentario.'</textarea>
																		</div>
																	</div>
																</span>
															</td>';
													else
														echo '<td class="text-center no-print" style="width: 20px"><button type="button" onclick="$(\'#2open-coment'.$row -> id_linea_producto_pedido.'\').show(); $(\'#2text-coment'.$row -> id_linea_producto_pedido.'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180 nota displaynone"></i></button>
																<span id="2open-coment'.$row -> id_linea_producto_pedido.'" style="display:none">
																	<div class="talkbubble" >
																		<div class="talkbubble-rectangulo">
																			<textarea rows="4" id="2text-coment'.$row -> id_linea_producto_pedido.'" name="2text-coment'.$row -> id_linea_producto_pedido.'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#2open-coment'.$row -> id_linea_producto_pedido.'\').hide(); guardarComentario2('.$row -> id_linea_producto_pedido.')">'.$row->comentario.'</textarea>
																		</div>
																	</div>
																</span>
															</td>';
													echo '</tr>';
												}
											}
										?>
										</tbody>
										<tfoot>
											<tr class="cargarLinea" style="display: none">
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
												<td class="no-print"></td>		
												<td class="no-print"></td>	
											</tr>
										
										</tfoot>
								    </table> 
                        	</div><!-- /.col -->
                    	</form> 
					</div><!-- /.row -->
					<div class="row">
                    <!-- accepted payments column -->
                    	<div class="col-xs-6 box box-default" id="div-cargar-info" style="width: 48%; margin-left: 10px; border-top: none; box-shadow: none; display:none;">
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
			                           		if($sin_modos){
			                           			if($modos_pago){
				                           			foreach($modos_pago as $modos){
				                           				$aux = 0;
				                           				foreach($sin_modos as $row){
				                           					if($modos->id_modo_pago == $row->id_modo_pago)
																$aux = 1;
				                           				}
														if($aux == 0)
				                           					echo '<option value="'.$modos->id_modo_pago.'">'.$modos->modo_pago.'</option>';
														else{
															echo '<option value="'.$modos->id_modo_pago.'" selected>'.$modos->modo_pago.'</option>';
															$arreglo_modos[$modos->id_modo_pago] = $modos->modo_pago;
														}
														
													}
				                           		}
											}
											else{
												if($modos_pago){
				                           			foreach($modos_pago as $modos){
				                           				echo '<option value="'.$modos->id_modo_pago.'">'.$modos->modo_pago.'</option>';
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
			                           		if($pedido){ 
				                           		if($condiciones_pago){
				                           			foreach($condiciones_pago as $condicion){
				                           				$aux = 0;
				                           				foreach($pedido as $row){
				                           					if($condicion->id_condicion_pago == $row->id_condicion_pago)
																$aux = 1;
				                           				}
														if($aux == 0)
				                           					echo '<option value="'.$condicion->id_condicion_pago.'">'.$condicion->condicion_pago.'</option>';
														else{
															echo '<option value="'.$condicion->id_condicion_pago.'" selected>'.$condicion->condicion_pago.'</option>';
															$arreglo_condiciones[$condicion->id_condicion_pago] = $condicion->condicion_pago;
														}
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
			                           		if($pedido){  
				                           		if($tiempos_entrega){
				                            		foreach($tiempos_entrega as $tiempo){
				                            			$aux = 0;
				                           				foreach($pedido as $row){
				                           					if($tiempo->id_tiempo_entrega == $row->id_tiempo_entrega)
																$aux = 1;
				                           				}
														if($aux == 0)
				                            				echo '<option value="'.$tiempo->id_tiempo_entrega.'">'.$tiempo->tiempo_entrega.'</option>';
														else{
															echo '<option value="'.$tiempo->id_tiempo_entrega.'" selected>'.$tiempo->tiempo_entrega.'</option>';
															$arreglo_tiempos[$tiempo->id_tiempo_entrega] = $tiempo->tiempo_entrega;
														}
													}
				                            	}
											}
										?>
			                       </select>
			                    </div>
			                    <div class="col-xs-12 form-group">
			                    	<textarea id="nota-publica" name="nota-publica" placeholder="<?php echo $this -> lang -> line('notas'); ?>" onkeyup="sessionStorage.setItem('nota-publica',$('#nota-publica').val());" style="width: 100%; resize: none" form="formGuardar"><?php if($pedido){	foreach($pedido as $row){ echo $row->nota_publica; } } ?></textarea>
			                    </div>
                           	</div>
                        </div><!-- /.col -->
                    	
                    	<div class="col-xs-6" id="div-info-extra">
                            <p class="lead"><?php echo $this -> lang -> line('informacion'); ?></p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <?php 
                                	echo armarInformacion(
                                			$arreglo_info=array(
                                				$this->lang->line('modos').' de '.$this->lang->line('pago') 		=> $arreglo_modos,
                                				$this->lang->line('condiciones').' de '.$this->lang->line('pago') 	=> $arreglo_condiciones,
                                				$this->lang->line('tiempos').' de '.$this->lang->line('entrega')	=> $arreglo_tiempos
											)
										);
									if($pedido){ foreach($pedido as $row){ echo $row->nota_publica; } }  
								?>
                            </p>
                        </div><!-- /.col -->
                        
                        <div class="col-xs-6" id="sub-pesos">
                            <p class="lead"><?php echo $this->lang->line('totales')?></p>
                            <div class="table-responsive" id="table-totales">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%"><?php echo $this -> lang -> line('subtotal'); ?></th>
                                        <td>$ <?php echo round($total, 2); ?><input type="number" id="total-ped" value="<?php echo $total?>" hidden></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this -> lang -> line('iva'); ?></th>
                                        <td>$ <?php echo round($total * 1.21 - $total, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this -> lang -> line('total'); ?></th>
                                        <td>$ <?php echo round($total * 1.21, 2); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        
                        <div class="col-xs-6" id="sub-otra-moneda" style="display: none;">
                            <p class="lead"><?php echo $this->lang->line('totales')?></p>
                            <div class="table-responsive" id="table-totales">
                            	<table class="table">
                            	<?php if($cotizacion){ foreach ($cotizacion as $key => $value) { ?>
									<tr>
                                        <th style="width:50%"><?php echo $this -> lang -> line('subtotal'); ?></th>
                                        <td><?php echo $key.' '.$value; ?></td>
                                    </tr>
                                <?php } } ?>
                                </table>
                            </div>
                        </div><!-- /.col --> 
					</div><!-- /.row -->
					
					<div class="row no-print">
                        <div class="col-xs-12">
                        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
								<i class="fa fa-info-circle"></i>
							</button>
							<?php
							if($pedido){
								foreach($pedido as $row){
									if($row->id_estado_pedido != 1){
							?>	
							<button type="button" id="btn-print" class="btn btn-default" onclick="imprimirConLogo();window.print();"><i class="fa fa-print"></i> Print</button>
							
							<button type="button" id="btn-cotizacion" class="btn btn-default" onclick="cotizar();"><i class="fa fa-usd"></i> Cotización</button>
							<?php } } } ?>
							<?php if($config_mail){ foreach($config_mail as $mail){?>
							<!-- COMPRUEBO EL ESTADO -->
							<?php
							if($pedido){
								foreach($pedido as $row){
									if($row->id_estado_pedido == 1  && $row->id_origen == 2){
							?>	
							<div class="dropdown pull-right" id="btn-editar">
								<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Acciones
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
									<li><a onclick="editable()"><?php echo $this -> lang -> line('editar'); ?></a></li>
									<li><a data-toggle="modal" data-target="#mail-todos"><?php echo $this->lang-> line('enviar').' '.$this->lang-> line('correo');?></a></li>
									<li><a <?php
											if ($mail -> enviar_auto == 0) {echo 'data-toggle="modal" data-target="#mandar-mail"';
											} else {echo 'onclick="aprobarForm()"';
											} ?> 
										><?php echo $this -> lang -> line('aprobar') . ' ' . $this->lang->line('pedido'); ?>
									</a></li>
								</ul>
							</div>
							<?php
									}
									else if($row->id_estado_pedido == 5 && $row->id_origen == 1){
							?>
							<div class="dropdown pull-right" id="btn-editar">
								<button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Acciones
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
									<li><a onclick="editable()"><?php echo $this -> lang -> line('editar'); ?></a></li>
									<li><a data-toggle="modal" data-target="#mail-todos"><?php echo $this->lang-> line('enviar').' '.$this->lang-> line('correo');?></a></li>
									<li><a <?php
											if ($mail -> enviar_auto == 0) {echo 'data-toggle="modal" data-target="#mandar-mail"';
											} else {echo 'onclick="aprobarForm()"';
											} ?> 
										><?php echo $this->lang-> line('aprobar') . ' ' . $this->lang->line('pedido'); ?>
									</a></li>
								</ul>	
							</div>
							<?php }	} }	?>
							<?php } } ?>
							<?php
							if($pedido){
								foreach($pedido as $row){
									if($row->id_estado_pedido == 1 && $row->id_origen == 2){
							?>
							<form action="<?php echo base_url().'/index.php/Pedidos/guardarPedido2/'.$id_pedido?>" onsubmit="return guardarLineasNuevas(<?php echo $id_pedido?>)" method="post" id="formGuardar" name="formGuardar" novalidate>
							<?php
									}else{
							?>
							<form action="<?php echo base_url().'/index.php/Pedidos/guardarPedido/'.$id_pedido?>" onsubmit="return guardarLineasNuevas(<?php echo $id_pedido?>)" method="post" id="formGuardar" name="formGuardar" novalidate>
							<?php 	}
								}
							}
							?>
								<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelarCambios(<?php echo $id_pedido?>)" style="display: none; margin-left: 5px">
									<?php echo $this -> lang -> line('cancelar'); ?>
								</button>
								<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right" style="display: none;">
									<?php echo $this -> lang -> line('guardar'); ?>
								</button>
							</form>
							<!--
							<form id="aprobarForm" action="<?php echo base_url().'/index.php/Pedidos/aprobarPedido/'.$id_pedido?>" method="post">
							</form>
							-->
                         </div>
                    </div>	
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
		                    	<button type="button" class="pull-right btn btn-primary btn-sm" onclick="saveAlarm(<?php echo $id_pedido?>);"><?php echo $this->lang->line('guardar')?></button>
		                    </div>
						</div>
					</div>
	                </form>		
				</div>
			</div>
		</div>  		
	</div>
</div>
 
		
		
		<!-- Modal INFO-->
<?php if($pedido){ foreach($pedido as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this -> lang -> line('informacion'); ?></h4>
      </div>
      <form action="<?php echo base_url() . "index.php/Pedidos/editarVisto/" . $row -> id_pedido; ?>" class="form-horizontal" method="post">
      <div class="modal-body">
      	<div class="row">
      		<table class="table table-striped">
      			<tr>
      				<td>
		      		<div class="col-lg-8">
		      			<?php echo $this -> lang -> line('fecha'); ?> 
		      			<?php echo $this -> lang -> line('creacion') . ' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row -> date_add)); ?>
					</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this -> lang -> line('fecha'); ?> 
		      			<?php echo $this -> lang -> line('modificacion') . ' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row -> date_upd)); ?>
					</div>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this -> lang -> line('pedido'); ?> 
		      			<?php echo $this -> lang -> line('visto') . ' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<select name="visto" class="form-control chosen-select">	
							<?php
							if ($row -> visto_back == 1) {
								echo '<option value="1" selected>SI</option>';
								echo '<option value="0">NO</option>';
							} else {
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
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this -> lang -> line('cerrar'); ?></button>
      	<button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } } ?>

<!-- Modal Mandar Mail a Todos-->
<div class="modal fade" id="mail-todos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 800px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enviar aviso</h4>
      </div>
      <form id="aprobarForm2" action="<?php echo base_url().'/index.php/Pedidos/enviarMailPedido/'.$id_pedido?>" method="post">
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	      		<div class="form-group">
	      			<select name="mail2[]" class="form-control" id="chosen-mail" multiple  data-placeholder="Enviar a: ">
						<?php
						if ($todosmails) {
							foreach ($todosmails as $row) {
								echo '<option>' . $row -> mail . '</option>';
							}
						}
						?>
	            	</select> 
	            </div>
	            
	            <?php if($config_mail){ foreach($config_mail as $mail){?>
	            <div class="form-group">
	            	<input type="text" class="form-control" name="titulo-Mail" placeholder="Titulo" required value="<?php echo $mail->asunto?>">
	            </div>
	            <div class="form-group">
	            	<textarea id="txt2" class="texteditor" name="cuerpo2" style="resize: none;">
						<?php echo $mail->cuerpo?>
						<table class="table table-striped" cellspacing="0" width="60%" border="1"> 
							<thead class="tabla-datos-importantes">
								<tr>
									<th><?php echo $this -> lang -> line('producto'); ?></th>
								    <th><?php echo $this -> lang -> line('cantidad'); ?></th>
								    <th><?php echo $this -> lang -> line('precio'); ?></th>
								    <th><?php echo $this -> lang -> line('subtotal'); ?></th>
								</tr>
							</thead>
								 
							<tbody>
							<?php
								if ($pedidos) {
									foreach ($pedidos as $row) {
										echo '<tr>';
										echo '<td style="text-align: center;">' .$row->nombre . '</td>';
										echo '<td style="text-align: center;">' .$row->cantidad . '</td>';
										echo '<td style="text-align: center;">$ ' .$row->precio . '</td>';
										echo '<td style="text-align: center;">$ ' .$row->subtotal . '</td>';
										echo '</tr>';
									}
								}
							?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<th><?php echo $this -> lang -> line('total'); ?></th>
									<td style="text-align: center;"><u>$ <?php echo round($total, 2); ?></u></td>
								</tr>
							</tfoot>
						</table> 
					</textarea>
		        </div>
	            <div class="form-group">
	            	<textarea id="editor1" name="cabecera2" rows="10" cols="80" style="display:none;">
	            		<?php echo $mail->cabecera?>
	            	</textarea>
	            </div>
	            <?php } } ?>
	            <?php $tags = traerTags(); ?>
	            <div class="form-group">
	            	<div class="col-md-8">
		            	<select id="etiquetas2" onchange="insertInputTag2()" class="form-control" data-placeholder="Seleccione un tipo...">
		            		<option disabled selected>Etiquetas...</option>
		            		<?php
								foreach ($tags as $key => $value) {
									echo '<option value="' . $value . '">' . $key . '</option>';
								}
							?>
		            	</select>
	            	</div>
	            	<div class="col-md-4">
	            		<input type="button" id="btn-tag2" value="" onclick="pegarEtiqueta2()" class="btn btn-default form-control">
	            	</div>
	            </div>
			</div>
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this -> lang -> line('cerrar'); ?></button>
      	<button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Mandar Mail-->
<div class="modal fade" id="mandar-mail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 800px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enviar aviso</h4>
      </div>
      <form id="aprobarForm" action="<?php echo base_url().'/index.php/Pedidos/aprobarPedido/'.$id_pedido?>" method="post">
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	      		<div class="form-group">
	      			<select name="mail[]" class="form-control chosen-select" multiple  data-placeholder="Enviar a: ">
						<?php
						$i = 0;
						if ($mails) {
							foreach ($mails as $row) {
								if ($i == 0)
									echo '<option selected>' . $row -> mail . '</option>';
								else
									echo '<option>' . $row -> mail . '</option>';
								$i++;
							}
						}
						?>
	            	</select> 
	            </div>
	            <?php if($config_mail){ foreach($config_mail as $mail){?>
	            <div class="form-group">
	            	<input type="text" class="form-control" name="titulo" placeholder="Titulo" required value="<?php echo $mail->asunto?>">
	            </div>
	            <div class="form-group">
	            	<textarea id="txt" class="texteditor" name="cuerpo" style="resize: none;">
						<?php echo $mail->cuerpo?>
						<table class="table table-striped" cellspacing="0" width="60%" border="1"> 
							<thead class="tabla-datos-importantes">
								<tr>
									<th><?php echo $this -> lang -> line('producto'); ?></th>
								    <th><?php echo $this -> lang -> line('cantidad'); ?></th>
								    <th><?php echo $this -> lang -> line('precio'); ?></th>
								    <th><?php echo $this -> lang -> line('subtotal'); ?></th>
								</tr>
							</thead>
								 
							<tbody>
							<?php
								if ($pedidos) {
									foreach ($pedidos as $row) {
										echo '<tr>';
										echo '<td style="text-align: center;">' . $row -> nombre . '</td>';
										echo '<td style="text-align: center;">' . $row -> cantidad . '</td>';
										echo '<td style="text-align: center;">$ ' . $row -> precio . '</td>';
										echo '<td style="text-align: center;">$ ' . $row -> subtotal . '</td>';
										echo '</tr>';
									}
								}
							?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<th><?php echo $this -> lang -> line('total'); ?></th>
									<td style="text-align: center;"><u>$ <?php echo round($total, 2); ?></u></td>
								</tr>
							</tfoot>
						</table> 
					</textarea>
		        </div>
	            <div class="form-group">
	            	<textarea id="editor1" name="cabecera" rows="10" cols="80" style="display:none;">
	            		<?php echo $mail->cabecera?>
	            	</textarea>
	            </div>
	            <?php } } ?>
	            <?php $tags = traerTags(); ?>
	            <div class="form-group">
	            	<div class="col-md-8">
		            	<select id="etiquetas" onchange="insertInputTag()" class="form-control" data-placeholder="Seleccione un tipo...">
		            		<option disabled selected>Etiquetas...</option>
		            		<?php
								foreach ($tags as $key => $value) {
									echo '<option value="' . $value . '">' . $key . '</option>';
								}
							?>
		            	</select>
	            	</div>
	            	<div class="col-md-4">
	            		<input type="button" id="btn-tag" value="" onclick="pegarEtiqueta()" class="btn btn-default form-control">
	            	</div>
	            </div>
			</div>
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this -> lang -> line('cerrar'); ?></button>
      	<button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  
$('#chosen-mail').chosen({ width: '100%' });

$('#chosen-mail').on('chosen:no_results',function(evt, params){
	$(document).keypress(function(e) {
    	if(e.which == 59) {
			var value = params.chosen.search_results.find('span').text();
			$('#chosen-mail').append(new Option(value, value,true).outerHTML);
			$('#chosen-mail').trigger("chosen:updated");
		}
	});
});

function aprobarForm() {
 	$("#aprobarForm").submit();
}

var aux 		= 0;
var aux_coment 	= 0;
var aux_linea	= 0;
$( document ).ready(function() {
	var j = 0;
    getAlarmas(<?php echo $id_pedido?>);
    if(location.hash == "#tab2")
    	$('.nav-pills a:last').tab('show');
   
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
																		'<textarea rows="4" id="text-coment'+j+'" name="text-coment'+j+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+j+'\').hide(); guardarComentario('+j+')">'+
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
		editable();
	}
	
	if(sessionStorage['aux3'] > 0){
    	for(i = 1; i <= sessionStorage['aux3']; i++ ){
    		$('#text-coment'+sessionStorage['linea'+i]).val(sessionStorage['comentario'+i]);
    	}
    }
	armarTotales(<?php echo $id_pedido;?>);
});

function editable(){
	if(cotizar_cng%2 != 0){
		$('.subtotal1').hide();
		$('.subtotal2').show();
		$('#sub-pesos').show("drop");
		$('#sub-otra-moneda').hide();
		cotizar_cng++;
	}
	$('#div-cargar-info').show();
	$('#div-info-extra').hide();
	$("#btn-print").hide();
	$("#btn-editar").hide();
	$("#btn-aprobar").hide();
	$(".cargarLinea").show();
	$('.display-none').show();
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	$('#btn-cotizacion').hide();
	$('.btn-nuevo-hide').show();
	$('#tablapedido').removeClass('table-striped');
	$('.nota').removeClass('displaynone');

	document.getElementById("producto").focus();
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
	aux_linea++;
	var j 	= $linea;
	sessionStorage.setItem('linea'+aux_linea, j);
	sessionStorage.setItem('comentario'+aux_linea, $('#text-coment'+j).val());
	sessionStorage.setItem('aux3', aux_linea); 
}

function guardarComentario2($linea){
	aux_coment++;
	var j 	= $linea;
	sessionStorage.setItem('2comentario'+aux_coment, $('#2text-coment'+j).val());
	sessionStorage.setItem('posicion'+aux_coment, j);
	sessionStorage.setItem('aux2', aux_coment); 
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
	            else{
	            	$('#suggestions').hide();
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
	var producto 		= [];
	var cantidad 		= [];
	var precio 			= [];
	var subtotal 		= [];
	var nombre 			= [];
	var id_moneda 		= [];
	var valor_moneda 	= [];
	var simbolo			= [];
	var comentario		= [];
	
	for(i = 0; i < aux; i++){
		producto[i] 	= $('#id_producto'+i).val();
		cantidad[i] 	= $('#cant'+i).val();
		precio[i] 		= $('#precio'+i).val();
		subtotal[i] 	= $('#subtotal'+i).val();
		nombre[i]		= $('#nomb'+i).val();
		id_moneda[i]	= $('#id_moneda'+i).val();
		valor_moneda[i]	= $('#valor_moneda'+i).val();
		simbolo[i]		= $('#simbolo'+i).val();
		comentario[i]	= $('#text-coment'+i).val();
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
	 			if(precio[i]){
		 			$("#tablapedido > tbody").append('<tr>'+
											 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+producto[i]+'">'+nombre[i]+
											 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+nombre[i]+'">'+
											 				'<input type="text" id="id_moneda'+i+'" autocomplete="off" required hidden value="'+id_moneda[i]+'">'+
															'<input type="text" id="valor_moneda'+i+'" autocomplete="off" required hidden value="'+valor_moneda[i]+'">'+
												 		'</td>'+
											 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+cantidad[i]+'">'+cantidad[i]+'</td>'+
											 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+precio[i]+'">'+simbolo[i]+' '+precio[i]+
												 			'<input type="text" id="simbolo'+i+'" autocomplete="off" required hidden value="'+simbolo[i]+'">'+
												 		'</td>'+
												 		'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+subtotal[i]+'">$ '+subtotal[i]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="deleteRow(this,<?php echo $id_pedido;?>,'+aux+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>'+
												 		'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+i+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+comentario[i]+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
												 	'</tr>');
				}
			}
			if(sessionStorage['aux2'] > 0){
		    	for(i = 1; i <= sessionStorage['aux2']; i++ ){
		    		$('#2text-coment'+sessionStorage['posicion'+i]).val(sessionStorage['2comentario'+i]);
		    	}
		    }	
	 		$(".cargarLinea").show();
	 		armarTotales(pedido);
	 	}
	});
}

function cargarProducto($id_linea, $pedido){
	var producto		= [];
	var cantidad 		= [];
	var precio 			= [];
	var subtotal 		= [];
	var nombre 			= [];
	var id_moneda 		= [];
	var valor_moneda 	= [];
	var simbolo			= [];
	var comentario		= [];
	
	for(i = 0; i < aux; i++){
		producto[i] 	= $('#id_producto'+i).val();
		cantidad[i] 	= $('#cant'+i).val();
		precio[i] 		= $('#precio'+i).val();
		subtotal[i] 	= $('#subtotal'+i).val();
		nombre[i]		= $('#nomb'+i).val();
		id_moneda[i]	= $('#id_moneda'+i).val();
		valor_moneda[i]	= $('#valor_moneda'+i).val();
		simbolo[i]		= $('#simbolo'+i).val();
		comentario[i]	= $('#text-coment'+i).val();		
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
	 			if(precio[i]){
		 			$("#tablapedido > tbody").append('<tr>'+
											 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+producto[i]+'">'+nombre[i]+
											 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+nombre[i]+'">'+
											 				'<input type="text" id="id_moneda'+i+'" autocomplete="off" required hidden value="'+id_moneda[i]+'">'+
															'<input type="text" id="valor_moneda'+i+'" autocomplete="off" required hidden value="'+valor_moneda[i]+'">'+
												 		'</td>'+
											 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+cantidad[i]+'">'+cantidad[i]+'</td>'+
											 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+precio[i]+'">'+simbolo[i]+' '+precio[i]+
												 			'<input type="text" id="simbolo'+i+'" autocomplete="off" required hidden value="'+simbolo[i]+'">'+
												 		'</td>'+
												 		'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+subtotal[i]+'">$ '+subtotal[i]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="deleteRow(this,<?php echo $id_pedido;?>,'+aux+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a></td>'+
												 		'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+i+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+comentario[i]+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
												 	'</tr>');
				}
			}
			if(sessionStorage['aux2'] > 0){
		    	for(i = 1; i <= sessionStorage['aux2']; i++ ){
		    		$('#2text-coment'+sessionStorage['posicion'+i]).val(sessionStorage['2comentario'+i]);
		    	}
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
	 		$('#div-cargar-info').hide();
			$('#div-info-extra').show();
	 		$("#btn-print").show();
			$("#btn-editar").show();
			$("#btn-aprobar").show();
			$(".cargarLinea").hide();
			$('.display-none').hide();
			$('#btn-guardar').hide();
			$('#btn-cancelar').hide();
			$('#btn-cotizacion').show();
			$('.nota').addClass('displaynone');
			aux = 0;
			$('#tablapedido').addClass('table-striped');
			sessionStorage.clear();
	 	}
	});
}
function imprimirConLogo(){
	$('#imagen-durox').show();
	setTimeout(function(){ $('#imagen-durox').hide(); }, 100);
}

function guardarLineasNuevas($pedido){
	var pedido = $pedido;
	var total = $('#total-ped').val();
	if(sessionStorage['aux2'] > 0){
	   	for(i = 1; i <= sessionStorage['aux2']; i++ ){
	   		$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/Pedidos/updateNotaLinea', //Realizaremos la petición al metodo prueba del controlador direcciones
				data: {	'linea'			: sessionStorage['posicion'+i],
						'comentario'	: sessionStorage['2comentario'+i],
				},
				success: function(resp) { 
						
				},
				async: false
			});
	   	}
	}
	
	if($('#tiempo_entrega').val() && $('#condicion_pago').val() && $('#modos_pago').val()){
		if(aux > 0){
			for(i = 0; i < aux; i++){
				if($('#id_producto'+i).val()){
					var producto 	= $('#id_producto'+i).val();
					var cantidad 	= $('#cant'+i).val();
					var precio 		= $('#precio'+i).val();
					var subtotal 	= $('#subtotal'+i).val();
					var id_moneda	= $('#id_moneda'+i).val();
					var valor_moneda= $('#valor_moneda'+i).val();
					var comentario	= $('#text-coment'+i).val();
					$.ajax({
					 	type: 'POST',
					 	url: '<?php echo base_url(); ?>index.php/Pedidos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
					 	data: {	'producto'		: producto,
					 		   	'cantidad'		: cantidad,
					 		   	'precio'		: precio,
					 		   	'subtotal'		: subtotal,
					 		   	'pedido'		: pedido,
					 		   	'id_moneda'		: id_moneda,
						 		'valor_moneda'	: valor_moneda,
						 		'comentario'	: comentario,
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
			if(total > 0){
				return true;
			}
			else{
				alert("ERROR! - No hay lineas en el pedido!");
				$('#producto').focus();
				return false;
			}
		}
	}
	else{
		alert("ERROR! - Falta agregar Información al pedido!");
		return false;
	}
}
function pegarEtiqueta(){
	//var caretPos 		= document.getElementById("txt").selectionEnd;
    var textAreaTxt 	= $('#txt').val();
    var txtToAdd 		=  $( "#btn-tag" ).val();
	$("#txt").val(textAreaTxt + txtToAdd);
}
function pegarEtiqueta2(){
	//var caretPos 		= document.getElementById("txt").selectionEnd;
    var textAreaTxt 	= $('#txt2').val();
    var txtToAdd 		=  $( "#btn-tag2" ).val();
	$("#txt2").val(textAreaTxt + txtToAdd);
}
function insertInputTag(){
	$("#btn-tag" ).val($( "#etiquetas" ).val());
}

function insertInputTag2(){
	$("#btn-tag2" ).val($( "#etiquetas2" ).val());
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
			 		'cruce'		: 'pedidos'
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
		url: '<?php echo base_url(); ?>index.php/Pedidos/getAlarmas', 
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

var cotizar_cng = 0;

function cotizar(){
	if(cotizar_cng%2 == 0){
		$('.subtotal1').show();
		$('.subtotal2').hide();
		$('#sub-pesos').hide();
		$('#sub-otra-moneda').show("drop");
		cotizar_cng ++;
	}
	else{
		$('.subtotal1').hide();
		$('.subtotal2').show();
		$('#sub-pesos').show("drop");
		$('#sub-otra-moneda').hide();
		cotizar_cng ++;
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