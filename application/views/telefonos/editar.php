<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Editar Teléfono
		  			</div>
		  			<div class="panel-body"> 
		  				<?php
		  				foreach ($telefonos as $row){ ?>	  
						 			
			  				<form action="<?php echo base_url()."index.php/telefonos/editarTelefonos/$row->id_telefono"?>" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1 control-label">Teléfono</label>
										<div class="col-sm-2">
											<input type="text" name="cod_area" class="numeric form-control" pattern="[0-9]*" value="<?php echo $row->cod_area ?>" required>	 
										</div>
										<div class="col-sm-4">
											<div class="input-group">
												<div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
												<input type="text" name="telefono" class="numeric form-control" pattern="[0-9]*" value="<?php echo $row->telefono ?>" required> 	    	
										   	</div>
										</div> 
								</div>
									 
									  
									  <div class="form-group">
									  	<label class="col-sm-1 control-label">Fax</label>
									  		<div class="col-sm-2">
									  			<?php
									  				if($row->fax == 1)
									    				echo '<input type="checkbox" class="form-control" name="fax" value="1" checked>';
													else 
														echo '<input type="checkbox" class="form-control" name="fax" value="1">';
									 			?>
									 		</div>
									  </div>
									  
									  <div class="form-group">
									  	<label class="col-sm-1 control-label">Tipo</label>
									  		<div class="col-md-3">
											  <select name="id_tipo" class="form-control">
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
								 
								 <div class="form-group">
								  	<label class="col-sm-1 control-label"></label>
							      		<div class="col-md-3">
									  		<button type="submit" class="btn btn-primary">Guardar</button>	  	
								  	  		<input type="button" value="Cancelar" class="btn btn-danger" id="btn-cancelar">
								  		</div>
								  </div>
							</form>
						<?php	}	?>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>