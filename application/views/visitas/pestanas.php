<script>
function modal($id_presupuesto){
	var id_presupuesto  = $id_presupuesto;
	var url				= '<?php echo base_url(); ?>index.php/Presupuestos/pestanas/'+id_presupuesto;
	$("#ModalBuscar").modal("show");
	
	var input = document.getElementById('id_div_contenedor');
	input.innerHTML = 	'<a role="button" class="btn btn-info" href="'+url+'">Ver</a><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>';					
}

function tablaPresupuesto($id_presupuesto){
	var id_presupuesto = $id_presupuesto;
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Visitas/vistaPresupuesto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_presupuesto='+id_presupuesto, //Pasaremos por parámetro POST el id del pai
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#tablaPresupuesto').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}	
</script>
<!-- Modal -->
<div class="modal fade" id="ModalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  	<div class="modal-content">
	  		<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      		<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('presupuesto'); ?></h4>
	   		</div>
			<div class="modal-body" id="tablaVisitas">
				<div id="tablaPresupuesto">
					
				</div>			        		
			</div>
			<div class="modal-footer" id="id_div_contenedor">	
				
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('cancelar'); ?></button>
			</div>
		</div>
	</div>
</div>



	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-body">
						<?php
							if($visita)
							{
								if($tipo!=0)
								{?>
									<div class="row">
										<div class="col-md-10 col-md-offset-1">
											<div class="alert alert-success alert-dismissable">
                                        		<i class="fa fa-check"></i>
                                        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        			<?php echo $this->lang->line('el_registro'); ?>
													<a href="<?php echo base_url().'index.php/Visitas/editar/'.$visita; ?>"><?php echo $visita; ?></a>
													<?php echo $this->lang->line('insert_ok'); ?>
                                    		</div> 
										</div>
									</div>
						<?php 	} 
							}
						?>
						
						<div class="tab-content">
							<div class="tab-pane fade in active" id="visita">
								<?php
									if($visita){
										foreach ($visitas as $row) {
								?>	
												<div class="panel-body">
						  							<div class="row">
						  							<div class="col-md-4">
						  							<div class="box box-primary">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('visita'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('visita'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                                <div class="box-body">
						                                   <?php
															echo '<div class="odd">';
															echo $this->lang->line('id').': ';
															echo '<a role="button" href="'.base_url().'index.php/Visitas/editar/'.$row->id_visita.'">'.$row->id_visita.'</a>';
															echo "</div>";
															echo '<div class="even">';
															$date	= date_create($row->fecha);
															echo $this->lang->line('fecha').': '.date_format($date, 'd/m/Y');
															echo "</div>";
															foreach($epocas as $key){
																if($key->id_epoca_visita == $row->id_epoca_visita){
																	echo '<div class="odd">';	
																	echo $this->lang->line('epoca').': '.$key->epoca;
																	echo "</div>";
																}
															}
															if($row->id_epoca_visita==0){
																echo '<div class="odd">';	
																echo $this->lang->line('epoca').': Sin '.$this->lang->line('epoca');
																echo "</div>";
															}
															echo '<div class="even">';
															echo $this->lang->line('valoracion').': '.valoracion($row->valoracion);
															echo "</div>";
															
															if($row->eliminado !=1)
															{
																echo '<div class="even">';
																echo $this->lang->line('comentarios').': ';
																echo $row->descripcion; 
																echo '</div>';
															}
															else {
																echo '<div class="col-md-4" style="color: red; text-align: center">';
																echo $this->lang->line('visita').' '.$this->lang->line('eliminada'); 
																echo '</div>';
															}
															?>
														</div><!-- /.box-footer-->
						                            </div>
						                            </div>
						                            
						                            
						                            <div class="col-md-4">
						  							<div class="box box-success">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('vendedor'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('vendedor'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-success btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-success btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                                <div class="box-body">
						                                  	<div class="img_div">
															<?php
																foreach ($vendedores as $key) {
																	if($row->id_vendedor == $key->id_vendedor){
																		if($key->imagen != '')
																		{
																			echo '<img alt="User Pic" src="'.$key->imagen.'" class="img-perfil-sm img-circle img-responsive">';
																		}
																		
															?>
															</div>
															<div class="datos_img">
															<?php
																		echo '<a href="'.base_url().'index.php/vendedores/pestanas/'.$key->id_vendedor.'">';
																		echo $key->nombre.', '.$key->apellido;
																		echo '</a>';
																		echo "<br>";
																		echo $this->lang->line('id').': '.$key->id_vendedor;
																		echo "<br>";
																	}
																}
															?>
															</div>
						                                </div><!-- /.box-body -->
						                            </div>
						                            </div>
						                            
						                            
						                            
						                            <div class="col-md-4">
						  							<div class="box box-info">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('cliente'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('cliente'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-info btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-info btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                                <div class="box-body">
						                                  	<div class="img_div">
															<?php
																foreach ($clientes as $key) {
																	if($row->id_cliente == $key->id_cliente){
																		if($key->imagen != '')
																		{
																			echo '<img alt="User Pic" src="'.$key->imagen.'" class="img-perfil-sm img-circle img-responsive" style=" width: 100px; height: 100px;">';
																		}
															?>
															</div>
															<div class="datos_img">
															<?php
																		echo '<a href="'.base_url().'index.php/clientes/pestanas/'.$key->id_cliente.'">';
																		echo $key->nombre.', '.$key->apellido;
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
																		echo $this->lang->line('id').': '.$key->id_cliente;
																		echo "<br>";
																	}
																}
															?>
															</div>
						                                </div><!-- /.box-body -->
						                            </div>
						                            </div>
						  							</div>
												</div>
										</div>	
									</div>	
							<?php
								} //foreach ($visitas as $row)
							} //if($visita){
							?>
							<?php
	    						if($presupuesto){
	    					?>		
										<div class="row">
									        <div class="col-md-6">
									        	<div class="box box-default">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('presupuestos'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('presupuestos').' de la '.$this->lang->line('visita'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-default btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                        <div class="box-body">
										            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
												        <thead>
												            <tr>
												            	<th><?php echo $this->lang->line('id'); ?></th>
												            	<th><?php echo $this->lang->line('date'); ?></th>
												            	<th><?php echo $this->lang->line('estado'); ?></th>
												            	<th><?php echo $this->lang->line('total'); ?></th>
												            	<th></th>
												            </tr>
												        </thead>
												 
												        <tfoot>
												            <tr>
												            	<th><?php echo $this->lang->line('id'); ?></th>
												            	<th><?php echo $this->lang->line('date'); ?></th>
												            	<th><?php echo $this->lang->line('estado'); ?></th>
												            	<th><?php echo $this->lang->line('total'); ?></th>
												            	<th></th>
												            </tr>
												        </tfoot>
												 
												        <tbody>
												        	<?php						                
																foreach ($presupuesto as $row) 
															    {
																	echo '<tr>';
																	echo '<td>'.$row->id_presupuesto.'</td>';
																	$date	= date_create($row->fecha);
																	echo '<td>'.date_format($date, 'd/m/Y').'</td>';
																	foreach($estados as $key){
																		if($key->id_estado_presupuesto == $row->id_estado_presupuesto)	
																			echo '<td>'.$key->estado.'</td>';
																	}
																	echo '<td>$ '.$row->total.'</td>';
																	echo '<td style="text-align: center"><button type="button" class="btn btn-primary btn-xs" onclick="modal('.$row->id_presupuesto.'); tablaPresupuesto('.$row->id_presupuesto.')" id="btn-ver" name="btn-ver" value="">'.$this->lang->line('ver').'</button></td>';
																	echo "</tr>";
																}
														 	?>
												        </tbody>
												    </table>
									       		 </div>
											</div>
										</div>
								<?php	
	    							}
									else {
								?>
										
									        <div class="col-sm-6 col-md-6">
									        	<div class="box box-default">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('presupuestos'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('presupuestos').' de la '.$this->lang->line('visita'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-default btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                        <div class="box-body">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PRESUPUESTO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    <a class="btn btn-default" href="<?php echo base_url().'index.php/Presupuestos/carga/'.$visita; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('presupuesto'); ?></a>
													</p>
									            </div>
									            </div>
									        	</div>
									        </div>
										
								<?php
									}	
								?>
	    					







	    						<?php
	    							if($pedido){
	    						?>		
										    <div class="col-sm-6 col-md-6">
									        	<div class="box box-default">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('pedidos'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('pedidos').' de la '.$this->lang->line('visita'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-default btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                        <div class="box-body">
						                        	
									            <div class="alert-message alert-message-success">
									                <h4>PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                 	<a href="#"><?php echo $this->lang->line('ver').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									            
									            </div>
									            
									        </div>
										</div>
								<?php	
	    							}
									else 
									{
								?>
											<div class="col-sm-6 col-md-6">
									        	<div class="box box-default">
						                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('datos').' '.$this->lang->line('pedidos'); ?>">
						                                    <h3 class="box-title"><?php echo $this->lang->line('pedidos').' de la '.$this->lang->line('visita'); ?></h3>
						                                    <div class="box-tools pull-right">
						                                        <button class="btn btn-default btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
						                                        <button class="btn btn-default btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
						                                    </div>
						                                </div>
						                        <div class="box-body">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                   	<a class="btn btn-default" href="<?php echo base_url().'index.php/Pedidos/carga/'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									            </div>
									        </div>
									     </div>
								<?php
									}	
								?>
								
								<div class="row">
									<div class="col-lg-10"></div>
									<div class="col-lg-2">
										<?php
											echo '<a role="button" class="btn btn-primary btn-sm" href="'.base_url().'index.php/Visitas/editar/'.$row->id_visita.'" style="margin-right: 3px">'.$this->lang->line('editar').'</a>';
											echo '<a role="button" class="btn btn-danger btn-sm" href="'.base_url().'index.php/Visitas/editar/'.$row->id_visita.'">'.$this->lang->line('eliminar').'</a> ';
										?>
									</div>
								</div>
	    					</div>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
