
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('nuevo').' '.$this->lang->line('telefono'); ?>
		  			</div>
		  			<div class="panel-body">
		  				<?php 
		  						if($save){
		  							$arreglo_mensaje = array(			
										'save' 			=> $save,
										'tabla'			=> 'telefonos',
										'id_tabla'		=> $id_telefono,
										'id_usuario'	=> $id,
										'tipo'			=> $tipo	
									);
		  							$mensaje = get_mensaje($arreglo_mensaje);
									echo $mensaje;	
								}
						?>
						<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('nuevo').' '.$this->lang->line('telefono'); ?>
							</a>
						</div></h3>	
						<div class="form-content form-div">	 				
			  				<form action="<?php echo base_url()."index.php/telefonos/nuevoTelefono/$id/$tipo"?>" class="form-horizontal" method="post">
								<div style="padding: 0 50px">
									<div class="form-group odd">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('telefono'); ?></label>
											
											<div class="col-md-8">
												<div class="input-group">
													<div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
													<input type="text" name="telefono" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('telefono'); ?>" required> 	    	
											   	</div>
											</div> 
									</div>
									
									<div class="form-group even">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('cod_area'); ?></label>	 
											<div class="col-md-8">
												<input type="text" name="cod_area" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cod_area'); ?>" required>	 
										</div>
									</div>
			  
									<div class="form-group odd">
									  	<label class="col-sm-2 control-label"><?php echo $this->lang->line('tipo'); ?></label>
											<div class="col-md-8">
												<select name="id_tipo" class="form-control chosen-select" data-placeholder="Seleccione un tipo..." required>
													<option></option>
													<?php
												  		foreach ($tipos as $row) {
															  echo '<option value="'.$row->id_tipo.'">'.$row->tipo.'</option>';
														}
													?>
												</select>
											</div>
									</div>
									
									<div class="form-group even">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('fax'); ?></label>
											<div class="col-sm-1">
										   		<input type="checkbox" name="fax" value="1">
											</div>
								    </div> 
								    
								    <hr />
								    
									<div class="form-group">
										  	<label class="col-sm-2 control-label"></label>
									      		<div class="col-md-8">
											  		<button type="submit" class="btn btn-primary" name="btn-save" value="1"><?php echo $this->lang->line('guardar'); ?></button>	 
											  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
										  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmar(<?php echo $id.",".$tipo; ?>)">
												</div>
									</div>
								</div>
							</form>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
