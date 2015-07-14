<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<?php echo $this->lang->line('nuevo').' '.$this->lang->line('presupuesto'); ?>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  						<h3><div style="padding: 0 0 20px 60px">
									<a href="#">
										<?php echo $this->lang->line('nuevo').' '.$this->lang->line('presupuesto'); ?>
									</a>
								</div></h3>	
								
	    						<form action="" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    								<?php
	    									if($visita!=''){
	    										foreach ($visita as $row) {
										?>		
										<!-- CARGA DE PRESUPUESTO CON ID DE VISITA -->	
	    								<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('visita'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_visita" class="form-control chosen-select" required>	
														<option value="<?php echo $row->id_visita; ?>" selected><?php echo $row->id_visita; ?></option>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									    
	    								<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('vendedor'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<?php
														foreach ($vendedores as $key) {
															if($key->id_vendedor == $row->id_vendedor){
													?>	
													<select name="id_cliente" class="form-control chosen-select" required>	
														<option value="<?php echo $key->id_vendedor; ?>" selected><?php echo $key->nombre.', '.$key->apellido; ?></option>
													</select>	
													
													<?php
															}/*--FOREACH---*/
														}/*--IF---*/
												    ?> 												      	 
									      		</div>
									      		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
	    								
	    								<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('cliente'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<?php
														foreach ($clientes as $key) {
															if($key->id_cliente == $row->id_cliente){
													?>	
													<select name="id_cliente" class="form-control chosen-select" required>	
														<option value="<?php echo $key->id_cliente; ?>" selected><?php echo $key->nombre.', '.$key->apellido; ?></option>
													</select>	
													
													<?php
															}/*--FOREACH---*/
														}/*--IF---*/
												    ?> 	 
									     		</div>
									     		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									        								
		    							<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('fecha'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<input type="text" name="date_add" class="form-control" value="<?php echo $row->date_upd;?>" required>	 
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('estado'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_estado_presupuesto" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('estado'); ?>" required>	
														<option></option>
														<?php
															foreach($estados as $row){
																echo '<option value="'.$row->id_estado_presupuesto.'">'.$row->estado.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									    </div>
									    
										<hr />
										
										<div class="form-group even">
											<div class="col-sm-4 col-sm-offset-3">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarVisita()">
											</div>
									   	</div>
									   	
									   	<?php 
												} /*---FOREACH---*/
											}/*---IF---*/
											else{
										 ?>
										 
										 <!-- NUEVA CARGA DE PRESUPUESTO -->
										 <div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('visita'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_visita" class="form-control chosen-select" data-placeholder="Seleccione una <?php echo $this->lang->line('visita'); ?>" required>	
														<option></option>
														<?php
															foreach($visitas as $row){
																echo '<option value="'.$row->id_visita.'">'.$row->id_visita.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1 col-sm-offset-3">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									    
	    								<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('vendedor'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_vendedor" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('vendedor'); ?>" required>	
														<option></option>
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
	    								
	    								<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('cliente'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_cliente" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('cliente'); ?>" required>	
														<option></option>
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
									        								
		    							<div class="form-group even">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('fecha'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<input type="date" name="date_add" class="form-control" value="" required>	 
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('estado'); ?></label>
												<div class="col-sm-4 col-sm-offset-1">
													<select name="id_estado_presupuesto" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('estado'); ?>" required>	
														<option></option>
														<?php
															foreach($estados as $row){
																echo '<option value="'.$row->id_estado_presupuesto.'">'.$row->estado.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									    </div>
									    
										<hr />
										
										<div class="form-group even">
											<div class="col-sm-4 col-sm-offset-3">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarVisita()">
											</div>
									   	</div>
									   	
									   	<?php } ?>
									</div>
	    						</form>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
