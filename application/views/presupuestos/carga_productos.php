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
								                <th style="width: 200px"><?php echo $this -> lang -> line('precio'); ?></th>
								                <th style="width: 200px"><?php echo $this -> lang -> line('subtotal'); ?></th>
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
														
														echo '<td>' . $row -> nombre . '<input type="text" name="linea'.$row -> id_linea_producto_presupuesto.'" id="linea'.$row -> id_linea_producto_presupuesto.'" value="1" hidden></td>';
														echo '<td>' . $row -> cantidad . '</td>';
														echo '<td>' . $row->abreviatura.$row->simbolo.' '.$row -> precio . '</td>';
														echo '<td>$ ' . $row -> subtotal . '<input type="text" class="subtotal_anteriores" name="anterior_subtotal'.$row -> id_linea_producto_presupuesto.'" id="anterior_subtotal'.$row -> id_linea_producto_presupuesto.'" value="' . round( $row -> subtotal,2) . '" hidden></td>';
														echo '<td class="no-print">' . $row -> estado . '</td>';
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
													<div class="form-group">
														<div class="input-group" >
															<input type="text" id="producto" name="producto" class="numeric form-control editable" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" onkeyup="ajaxSearch();" placeholder="<?php echo $this -> lang -> line('producto'); ?>" required style="height: 20px">
														</div>	
													</div>
													
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
                        	<form action="<?php echo base_url().'/index.php/Presupuestos/guardarNuevoPresupuesto/'?>" onsubmit="return <?php if($detalle){ echo "guardarLineasViejas(".$presupuesto.") &&";}?> guardarLineasNuevas(<?php echo $presupuesto?>)" method="post" id="formGuardar" name="formGuardar" novalidate>
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