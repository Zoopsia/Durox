<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Nueva Dirección
		  			</div>
		  			<div class="panel-body"> 
		  					<form action="<?php echo base_url()."index.php/direcciones/nuevaDireccion/$id/$tipo"?>" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Dirección</label>
										<div class="col-sm-3">	
											<div class="input-group">		
												<div class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>
												<input type="text" name="direccion" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="Dirección" required> 	    	 	
											</div>
										</div> 
								</div>
								
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Código Postal</label>
										<div class="col-sm-3">
											<input type="text" name="cod_postal" class="numeric form-control" pattern="[0-9]*" placeholder="Cód Postal" required> 	    	
										</div> 
								</div>
							
	  
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Tipo</label>
									  	<div class="col-md-3">
											<select name="id_tipo" class="form-control chosen-select">
												<?php
											  		foreach ($tipos as $row) {
															echo '<option value="'.$row->id_tipo.'">'.$row->tipo.'</option>';
													}
												?>
											</select>
										</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1 col-sm-offset-1 control-label">Tipo</label>
									  	<div class="col-md-3">
											<select id="id_pais" name="id_pais" class="form-control" data-placeholder="Selecciona una opción...">
												
												<?php
											  		foreach ($paises as $row) {
											  			echo '<option value="'.$row->id_pais.'">'.$row->nombre_pais.'</option>';
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
								 
								 <div id="resultados">
								 </div>
						</form>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>