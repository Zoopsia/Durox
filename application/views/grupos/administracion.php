<script>

function reglasActivas(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/getReglasGrupos', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente, //Pasaremos por parámetro POST el id del grupo
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar la tabla
	 		$('#tablareglas').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
	 	}
	});
}
	
function clientesActivos(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/getClientesGrupos', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente, //Pasaremos por parámetro POST el id del grupo
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar la tabla
	 		$('#tablaclientes').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
	 	}
	});
}

function nuevoGrupo(){
 	var grupo_nombre = $('input#grupo_nombre').val(); //Obtenemos el id del grupo seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/nuevoGrupo', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: {'grupo_nombre' : grupo_nombre,'btn-save': 1 }, //Pasaremos por parámetro POST el id del grupo
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar la tabla
	 		$('#divregistro').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
	 	}
	});
}	
</script>
<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('grupos_clientes'); ?></a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">		  				
		  				
		  				<div class="tab-content">
	    					<div class="tab-pane fade in active" id="tab1">
	    					<!--Grupos de Clientes-->
	    						
	    						<?php 
			  						if($save){
			  							$arreglo_mensaje = array(			
											'save' 			=> $save,
											'tabla'			=> 'grupos',
											'id_tabla'		=> $id_grupo,
											'id_usuario'	=> null
										);
			  							$mensaje = get_mensaje($arreglo_mensaje);
										echo $mensaje;
									}
								?> 	
	     							    						
	    						<div class="row">
	    							
	    							<div class="col-md-1 dropdown">
											<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
												<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('grupo'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('agregar').' '.$this->lang->line('regla'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('administrar').' '.$this->lang->line('reglas'); ?></a></li>
											</ul>
									</div>
	    							
		    						<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupos_clientes'); ?></label>
										<div class="col-md-3">
											<select id="grupos" name="id_grupo_cliente" class="form-control chosen-select" data-placeholder="Selecciones un Grupo..." onchange="reglasActivas(),clientesActivos()">
		    									<option></option>
		    									<?php
		    										foreach ($grupos as $row) {
		    											if($id_grupo==$row->id_grupo_cliente){
															echo '<option value="'.$row->id_grupo_cliente.'" selected>'.$row->grupo_nombre.'</option>';
															//----LLAMO FUNCION DE LLENAR LAS REGLAS---//
															?><script>reglasActivas(), clientesActivos();</script><?php
														}
														else
		    												echo '<option value="'.$row->id_grupo_cliente.'">'.$row->grupo_nombre.'</option>';
													}
		    									?>
		    								</select>
										</div>
								</div>
								
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="padding-top: 20px">
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								         	<?php echo $this->lang->line('clientes'); ?>
								        </a>
								      </h4>
								    </div>
								    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								        <div class="row">
											<div class="col-md-9 col-sm-offset-1">
												<div id="tablaclientes">
												<!-- Esta tabla se llena con AJAX -->		
												</div>
											</div>
										</div>
								      </div>
								    </div>
								  </div>
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingTwo">
								      <h4 class="panel-title">
								        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								        	<?php echo $this->lang->line('reglas'); ?>
								        </a>
								      </h4>
								    </div>
								    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								      <div class="panel-body">
								      	<div class="row">
											<div class="col-md-9 col-sm-offset-1">
												<div id="tablareglas">
												<!-- Esta tabla se llena con AJAX -->		
												</div>
											</div>
										</div>
								      </div>
								    </div>
								  </div>
								</div>
				
	    					</div> <!--TAB 1 GRUPOS CLIENTES -->
	     					<div class="tab-pane fade" id="tab2">
	     					<!--TAB 2 CARGA DE GRUPOS-->
	     						<div id="divregistro">
	     							
	     							
	     						</div>
	     						<form action="<?php echo base_url()."index.php/grupos/nuevoGrupo"?>" class="form-horizontal" method="post">
									<div class="form-group">
										<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupo'); ?></label>
											
											<div class="col-sm-3">
												<div class="input-group">
													<div class="input-group-addon"><span class="fa fa-users" aria-hidden="true"></span></div>
													<input type="text" id="grupo_nombre" name="grupo_nombre" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('nombre'); ?>" required> 	    	
											   	</div>
											</div> 
									</div>

									<div class="form-group">
										  	<label class="col-sm-1 control-label"></label>
									      		<div class="col-md-6">	
										  	  		<!--<button type="submit" class="btn btn-primary" name="btn-save" value="1" onclick="nuevoGrupo()"><?php echo $this->lang->line('guardar'); ?></button> 
										  	  		-->
										  	  		<input type="button" value="<?php echo $this->lang->line('guardar'); ?>" class="btn btn-primary" id="btn-guardar" onclick="nuevoGrupo()">
										  	  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
										  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="">
												</div>
									</div>
								</form>	
	     						
	    					</div><!--TAB 2 CARGA DE GRUPOS -->
	    				
	    					<div class="tab-pane fade" id="tab3">
	     						<!--TAB 3 TELEFONOS CLIENTE -->
	     						PRUEBA
	    					</div>
	    					<div class="tab-pane fade" id="tab4">
	     						<!--TAB 4 DIRECCIONES CLIENTE -->
	     						
	    					</div>
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 E-MAILS CLIENTE -->					
	     						
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab6">
	     						<!--TAB 6 PANEL DE PEDIDOS -->
	     						
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab7">
	     						<!--TAB 7 PANEL DE PRESUPUESTOS -->
	     						
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
