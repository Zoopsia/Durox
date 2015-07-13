<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('editar').' '.$this->lang->line('telefono'); ?>
		  			</div>
		  			<div class="panel-body"> 
		  				
		  				<?php
		  				foreach ($telefonos as $row){ ?>
		  					<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('editar').' '.$this->lang->line('telefono'); ?>
							</a>
							</div></h3>	
							<div class="form-content form-div">	   			
				  				<form action="<?php echo base_url()."index.php/telefonos/editarTelefonos/$row->id_telefono/$id_usuario/$tipo"?>" class="form-horizontal" method="post">
									<div style="padding: 0 50px">
										<div class="form-group odd">
											<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('telefono'); ?></label>
												
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
														<input type="text" name="telefono" class="numeric form-control" pattern="[0-9]*" value="<?php echo $row->telefono ?>" required> 	    	
												   	</div>
												</div> 
										</div>
											 
										<div class="form-group even">
										  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('cod_area'); ?></label>
												<div class="col-sm-3">
													<input type="text" name="cod_area" class="numeric form-control" pattern="[0-9]*" value="<?php echo $row->cod_area ?>" required>	 
												</div>
										</div>
											  									  
										<div class="form-group odd">
										  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('tipo'); ?></label>
										  		<div class="col-md-3">
										    		<select name="id_tipo" class="form-control chosen-select">
														<?php
													  		foreach ($tipos as $key) {
													  			if($row->id_tipo == $key->id_tipo)
																	echo '<option value="'.$key->id_tipo.'" selected>'.$key->tipo.'</option>';
																else 
																	echo '<option value="'.$key->id_tipo.'">'.$key->tipo.'</option>';		
															}
														?>
													</select>
												</div>
										</div>
										
										<div class="form-group even">
										  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('fax'); ?></label>
										  		<div class="col-sm-1">
										  			<?php
														if($row->fax == 1)
											   				echo '<input type="checkbox" name="fax" value="1" checked>';
														else 
															echo '<input type="checkbox" name="fax" value="1">';
										 			?>
										 		</div>
									  	</div>
										
										<hr />
										 
										<div class="form-group">
										  	<label class="col-sm-1 control-label"></label>
									      		<div class="col-md-6">
											  		<button type="submit" class="btn btn-primary" name="btn-save" value="1"><?php echo $this->lang->line('guardar'); ?></button> 	
										  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmar(<?php echo $id_usuario.",".$tipo; ?>)">
										  	  	</div>
										</div>
									</div>
								</form>
							</div>
						<?php	}	?>	
											
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>