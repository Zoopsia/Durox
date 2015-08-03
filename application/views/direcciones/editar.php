<script>

function paises_activos(){
	
	var id = <?php echo $id ?>;
 	var id_pais = $('select#paises').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/direcciones/getProvincias/', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {id_pais: id_pais}, //Pasaremos por parámetro POST el id del pais	 		  	
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de partidos
	 		$('select#provincias').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

function provincias_activas(){
	var id_provincia = $('select#provincias').val(); //Obtenemos el id de la provincia seleccionada en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/direcciones/getDepartamentos', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_provincia='+id_provincia, //Pasaremos por parámetro POST el id de la provincia
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de partidos
	 		$('select#departamentos').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}	
</script>

	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('editar').' '.$this->lang->line('direccion'); ?>
		  			</div>
		  			<div class="panel-body"> 
		  				<?php
		  				foreach ($direcciones as $row){ ?>
						 	<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('editar').' '.$this->lang->line('direccion'); ?>
							</a>
							</div></h3>
							<div class="form-content form-div">				
				  				<form action="<?php echo base_url()."index.php/direcciones/editarDireccion/$row->id_direccion/$id_usuario/$tipo"?>" class="form-horizontal" method="post">
									<div style="padding: 0 50px">
										<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('direccion'); ?></label>
												<div class="col-sm-8">	
													<div class="input-group">		
														<div class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>
														<input type="text" name="direccion" class="form-control" pattern="^[A-Za-z0-9 ]+$" value="<?php echo $row->direccion ?>" required> 	    	 	
													</div>
												</div> 
										</div>
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('cod_postal'); ?></label>
												<div class="col-sm-8">
													<input type="text" name="cod_postal" class="form-control" pattern="[0-9]*" value="<?php echo $row->cod_postal ?>" required> 	    	
												</div> 
										</div>
									
			  
										<div class="form-group odd">
											<label class="col-sm-2  control-label"><?php echo $this->lang->line('tipo'); ?></label>
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
										
										<div class="form-group even">
											<label class="col-sm-2  control-label"><?php echo $this->lang->line('pais'); ?></label>
											  	<div class="col-md-8">
													<select id="paises" name="id_pais" class="form-control" onchange="paises_activos(), provincias_activas()" >	
														<?php
													  		foreach ($paises as $key) {
													  			if($row->id_pais == $key->id_pais)
																	echo '<option value="'.$key->id_pais.'" selected>'.$key->nombre_pais.'</option>';
																else
													  				echo '<option value="'.$key->id_pais.'">'.$key->nombre_pais.'</option>';
													  		}
														?>
													</select>
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-2  control-label"><?php echo $this->lang->line('provincia'); ?></label>
											  	<div class="col-md-8">
													<select id="provincias" name="id_provincia" class="form-control" onchange="provincias_activas()">	
														<?php
													  		foreach ($provincias as $key) {
													  			if($row->id_provincia == $key->id_provincia)
																	echo '<option value="'.$key->id_provincia.'" selected>'.$key->nombre_provincia.'</option>';
																else
													  				echo '<option value="'.$key->id_provincia.'">'.$key->nombre_provincia.'</option>';
													  		}
														?>
													</select>
												</div>
										</div>
										
										<div class="form-group even">
											<label class="col-sm-2  control-label"><?php echo $this->lang->line('departamento'); ?></label>
											  	<div class="col-md-8">
													<select id="departamentos" name="id_departamento" class="form-control">		
														<?php
													  		foreach ($departamentos as $key) {
													  			if($row->id_departamento == $key->id_departamento)
																	echo '<option value="'.$key->id_departamento.'" selected>'.$key->nombre_departamento.'</option>';
																else
													  				echo '<option value="'.$key->id_departamento.'">'.$key->nombre_departamento.'</option>';
													  		}
														?>
													</select>
												</div>
										</div>
										 
										<hr />
										
										<div class="form-group">
										  	<label class="col-sm-2 control-label"></label>
									      		<div class="col-md-8">
											  		<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>	  	
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
