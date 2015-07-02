<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Nuevo Teléfono
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
		  				<form action="<?php echo base_url()."index.php/telefonos/nuevoTelefono/$id/$tipo"?>" class="form-horizontal" method="post">
							<div class="form-group">
								<label class="col-sm-1 col-sm-offset-1 control-label">Teléfono</label>
									
									<div class="col-sm-3">
										<div class="input-group">
											<div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
											<input type="text" name="telefono" class="numeric form-control" pattern="[0-9]*" placeholder="Teléfono" required> 	    	
									   	</div>
									</div> 
							</div>
							
							<div class="form-group">
								<label class="col-sm-1 col-sm-offset-1 control-label">Código Área</label>	 
									<div class="col-sm-3">
										<input type="text" name="cod_area" class="numeric form-control" pattern="[0-9]*" placeholder="Cod Área" required>	 
								</div>
							</div>
	  
							<div class="form-group">
							  	<label class="col-sm-1 col-sm-offset-1 control-label">Tipo</label>
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
								<label class="col-sm-1 col-sm-offset-1 control-label">Fax</label>
									<div class="col-sm-1">
								   		<input type="checkbox" name="fax" value="1">
									</div>
						    </div> 
						    
							<div class="form-group">
								  	<label class="col-sm-1 control-label"></label>
							      		<div class="col-md-6">
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="1">Guardar</button>	 
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="2">Guardar y volver</button> 	
								  	  		<input type="button" value="Cancelar" class="btn btn-danger" id="btn-cancelar" onclick="confirmar(<?php echo $id.",".$tipo; ?>)">
										</div>
							</div>
						</form>						
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>