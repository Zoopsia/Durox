<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('nuevo').' '.$this->lang->line('correo'); ?>
		  			</div>
		  			<div class="panel-body">
		  				<?php 
		  					if($save){
		  						$arreglo_mensaje = array(			
									'save' 			=> $save,
									'tabla'			=> 'mails',
									'id_tabla'		=> $id_mail,
									'id_usuario'	=> $id,
									'tipo'			=> $tipo	
								);
		  						$mensaje = get_mensaje($arreglo_mensaje);
								echo $mensaje;	
							}
						?> 				
		  				<form action="<?php echo base_url()."index.php/mails/nuevoMail/$id/$tipo"?>" class="form-horizontal" method="post">
							<div class="form-group">
								<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('correo'); ?></label>
									
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
											<input type="email" name="mail" class="numeric form-control" pattern="^[A-Za-z0-9 ._@]+$" placeholder="<?php echo $this->lang->line('correo'); ?>" required> 	    	
									   	</div>
									</div> 
							</div>
							
							<div class="form-group">
							  	<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('tipo'); ?></label>
									<div class="col-md-3">
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
							
							<div class="form-group">
								  	<label class="col-sm-1 control-label"></label>
							      		<div class="col-md-6">
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="1"><?php echo $this->lang->line('guardar'); ?></button>	 
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
								  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmar(<?php echo $id.",".$tipo; ?>)">		  	  	
										</div>
							</div>
						</form>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>