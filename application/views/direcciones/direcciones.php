<script>
$(function() { //Mientras no selecciona un pais desabilito las provincias
	$('select#provincias').attr('disabled',true);
	$('select#departamentos').attr('disabled',true);
});

function paises_activos(){
 	var id_pais = $('select#paises').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/direcciones/getProvincias', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_pais='+id_pais, //Pasaremos por parámetro POST el id del pais
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
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
	 		//Activar y Rellenar el select de departamentos
	 		$('select#departamentos').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

</script>


<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				<?php echo $this->lang->line('nueva').' '.$this->lang->line('direccion'); ?>
		  			</div>
		  			<div class="panel-body"> 
		  					<?php 
		  						if($save){
		  							$arreglo_mensaje = array(			
										'save' 			=> $save,
										'tabla'			=> 'direcciones',
										'id_tabla'		=> $id_direccion,
										'id_usuario'	=> $id,
										'tipo'			=> $tipo	
									);
		  							$mensaje = get_mensaje($arreglo_mensaje);
									echo $mensaje;	
								}
							?>
							
						<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('nueva').' '.$this->lang->line('direccion'); ?>
							</a>
						</div></h3>	
						<div class="form-content form-div">	
							<form action="<?php echo base_url()."index.php/direcciones/nuevaDireccion/$id/$tipo"?>" class="form-horizontal" method="post" id="crudForm">	 	  					
		  						
		  						<div style="padding: 0 50px">
			  						<div class="form-group odd">
										<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('direccion'); ?></label>
											<div class="col-sm-3">	
												<div class="input-group">		
													<div class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>
													<input type="text" name="direccion" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('direccion'); ?>" required> 	    	 	
												</div>
											</div> 
									</div>
									
									<div class="form-group even">
										<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('cod_postal'); ?></label>
											<div class="col-sm-3">
												<input type="text" name="cod_postal" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cod_postal'); ?>" required> 	    	
											</div> 
									</div>
								
		  
									<div class="form-group odd">
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
									
									<div class="form-group even">
										<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('pais'); ?></label>
										  	<div class="col-md-3">
												<select id="paises" name="id_pais" class="form-control" onchange="paises_activos()">	
													<option value='' disabled selected style='display:none;'>Seleccione una opcion...</option>
													<?php
												  		foreach ($paises as $row) {
												  			echo '<option value="'.$row->id_pais.'">'.$row->nombre_pais.'</option>';
												  		}
													?>
												</select>
											</div>
									</div>
									
									
									<div class="form-group odd">
										<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('provincia'); ?></label>
										  	<div class="col-md-3">
												<select id="provincias" name="id_provincia" class="form-control" onchange="provincias_activas()">	
												</select>
											</div>
									</div>
									
									<div class="form-group even">
										<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('departamento'); ?></label>
										  	<div class="col-md-3">
												<select id="departamentos" name="id_departamento" class="form-control">		
												</select>
											</div>
									</div>
									 
									<hr />
									
									<div class="form-group">
									  	<label class="col-sm-1 control-label"></label>
								      		<div class="col-md-6">
										  		<button type="submit" class="btn btn-primary" name="btn-save" value="1"><?php echo $this->lang->line('guardar'); ?></button>	 
										  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
									  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmar(<?php echo $id.",".$tipo; ?>)">	
									  		</div>
									</div>
								 </div>
						</form>	
						</div>					
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>