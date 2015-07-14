<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<?php echo $this->lang->line('nueva').' '.$this->lang->line('visita'); ?>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<!--TABLA PRINCIPAL CON PEDIDOS-->
		  					
	    					<!--BUSQUEDA AVANZADA DE PEDIDOS-->
	    					
								<h3><div style="padding: 0 0 20px 60px">
									<a href="#">
										<?php echo $this->lang->line('nueva').' '.$this->lang->line('visita'); ?>
									</a>
								</div></h3>	
								
	    						<form action="<?php echo base_url()."index.php/Visitas/nuevaVisita/"?>" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    								
	    								<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('vendedor'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_vendedor" class="form-control chosen-select">	
														<?php
															foreach($vendedores as $row){
																echo '<option value="'.$row->id_vendedor.'">'.$row->nombre.', '.$row->apellido.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
	    								
	    								<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('cliente'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_cliente" class="form-control chosen-select">	
													<?php
														foreach($clientes as $row){
															echo '<option value="'.$row->id_cliente.'">'.$row->nombre.', '.$row->apellido.'</option>';
														}
													?>
													</select>												      	 
									     		</div>
									     		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									      	  
									    <div class="form-group odd">
											<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('epoca').' '.$this->lang->line('visita'); ?></label>
												<div class="col-sm-4">
													<select name="id_epoca_visita" class="form-control chosen-select">	
													<?php
														foreach($epocas as $row){
															echo '<option value="'.$row->id_epoca_visita.'">'.$row->epoca.'</option>';
														}
													?>
													</select>												      	 
									     		</div>
									    </div>
	    								
		    							<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('fecha'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<input type="date" name="date_add" class="form-control" value="">	 
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('comentarios'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<textarea name="comentarios" style="width: 100%; height: 100px;" ></textarea>	 
												</div>
										</div>
										
										<div class="form-group even" style="padding-bottom: 1%">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('valoracion'); ?></label>
												<div class="col-sm-4 col-sm-offset-1" style="margin-top: 1%">
													<input name="star1" type="radio" value="1" class="star"/>
													<input name="star1" type="radio" value="2" class="star"/>
													<input name="star1" type="radio" value="3" class="star" checked/>
													<input name="star1" type="radio" value="4" class="star"/>
													<input name="star1" type="radio" value="5" class="star"/>
												</div>
										</div>
										
										<hr />
										
										<div class="form-group even">
											<div class="col-sm-4 col-sm-offset-3">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarVisita()">
											</div>
									   	</div>
									</div>
	    						</form>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
