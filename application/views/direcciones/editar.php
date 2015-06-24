<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Editar Dirección
		  			</div>
		  			<div class="panel-body"> 
		  				<?php
		  				foreach ($direcciones as $row){ ?>	  
						 			
			  				<form action="<?php echo base_url()."index.php/direcciones/editarDireccion/$row->id_direccion"?>" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Dirección</label>
										<div class="col-sm-3">	
											<div class="input-group">		
												<div class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>
												<input type="text" name="direccion" class="form-control" pattern="^[A-Za-z0-9 ]+$" value="<?php echo $row->direccion ?>" required> 	    	 	
											</div>
										</div> 
								</div>
								
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Código Postal</label>
										<div class="col-sm-3">
											<input type="text" name="cod_postal" class="form-control" pattern="[0-9]*" value="<?php echo $row->cod_postal ?>" required> 	    	
										</div> 
								</div>
							
	  
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Tipo</label>
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