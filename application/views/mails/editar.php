
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('editar').' '.$this->lang->line('correo'); ?>
		  			</div>
		  			<div class="panel-body"> 
		  				
		  				<?php
		  				foreach ($mails as $row){ ?>
		  					<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('editar').' '.$this->lang->line('correo'); ?>
							</a>
							</div></h3>		   			
				  			<div class="form-content form-div">
				  				<form action="<?php echo base_url()."index.php/mails/editarMails/$row->id_mail/$id_usuario/$tipo"?>" class="form-horizontal" method="post">
									<div style="padding: 0 50px">
										<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('telefono'); ?></label>
												
												<div class="col-sm-8">
													<div class="input-group">
														<div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
														<input type="text" name="mail" class="numeric form-control" pattern="^[A-Za-z0-9 ._@]+$" value="<?php echo $row->mail ?>" required> 	    	
												   	</div>
												</div> 
										</div>
											 		  
										<div class="form-group even">
										  	<label class="col-sm-2 control-label"><?php echo $this->lang->line('tipo'); ?></label>
										  		<div class="col-md-8">
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
										
										<hr />
										 
										<div class="form-group">
										  	<label class="col-sm-2 control-label"></label>
									      		<div class="col-md-8">
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
