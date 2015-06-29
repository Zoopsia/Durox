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


<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading"><!---PESTAÑAS DEL PANEL DE NAVEGACION--->
		  				Nueva Dirección
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
							<form action="<?php echo base_url()."index.php/direcciones/nuevaDireccion/$id/$tipo"?>" class="form-horizontal" method="post">	 	  					
		  						<div class="form-group">
									<label class="col-sm-2 col-sm-offset-1 control-label">Dirección</label>
										<div class="col-sm-3">	
											<div class="input-group">		
												<div class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></div>
												<input type="text" name="direccion" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="Dirección" required> 	    	 	
											</div>
										</div> 
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 col-sm-offset-1 control-label">Código Postal</label>
										<div class="col-sm-3">
											<input type="text" name="cod_postal" class="numeric form-control" pattern="[0-9]*" placeholder="Cód Postal" required> 	    	
										</div> 
								</div>
							
	  
								<div class="form-group">
									<label class="col-sm-2 col-sm-offset-1 control-label">Tipo</label>
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
									<label class="col-sm-2 col-sm-offset-1 control-label">Pais</label>
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
								
								
								<div class="form-group">
									<label class="col-sm-2 col-sm-offset-1 control-label">Provincia</label>
									  	<div class="col-md-3">
											<select id="provincias" name="id_provincia" class="form-control" onchange="provincias_activas()">	
											</select>
										</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 col-sm-offset-1 control-label">Departamento</label>
									  	<div class="col-md-3">
											<select id="departamentos" name="id_departamento" class="form-control">		
											</select>
										</div>
								</div>
								 
								 <div class="form-group">
								  	<label class="col-sm-1 control-label"></label>
							      		<div class="col-md-6">
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="1">Guardar</button>	 
									  		<button type="submit" class="btn btn-primary" name="btn-save" value="2">Guardar y volver</button> 	
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