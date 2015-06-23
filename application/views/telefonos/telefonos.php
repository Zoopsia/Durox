<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Nuevo Teléfono
		  			</div>
		  			<div class="panel-body"> 				
		  				<form action="<?php echo base_url()."index.php/telefonos/nuevoTelefono/$id/$tipo"?>" class="form-horizontal" method="post">
							<div class="form-group">
								<label class="col-sm-1 col-sm-offset-1 control-label">Teléfono</label>
									<div class="col-sm-2">
										<input type="text" name="cod_postal" class="numeric form-control" pattern="[0-9]*" placeholder="Cod Postal" required>	 
									</div>
									<div class="col-sm-4">
										<div class="input-group">
											<div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
											<input type="text" name="telefono" class="numeric form-control" pattern="[0-9]*" placeholder="Teléfono" required> 	    	
									   	</div>
									</div> 
							</div>
								 
								  
								  <div class="form-group">
								  	<label class="col-sm-1 col-sm-offset-1 control-label">Fax</label>
								  		<div class="col-sm-1">
								    		<input type="checkbox" class="form-control" name="fax" value="1">
								 		</div>
								  </div>
								  
								  <div class="form-group">
								  	<label class="col-sm-1 col-sm-offset-1 control-label">Tipo</label>
								  		<div class="col-md-3">
										  <select name="id_tipo" class="form-control">
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
						      		<div class="col-md-3">
								  		<button type="submit" class="btn btn-primary">Guardar</button>	  	
							  	  		<input type="button" value="Cancelar" class="btn btn-danger" id="btn-cancelar">
							  		</div>
							  </div>
						</form>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>