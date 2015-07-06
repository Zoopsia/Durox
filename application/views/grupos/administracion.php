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
 	var grupo_nombre	= $('input#grupo_nombre').val(); //Obtenemos el nombre del grupo seleccionado en la lista
 	var regla			= $('input#regla').val();
 	var cant_min		= $('input#cant_min').val();
 	var precio_min		= $('input#precio_min').val();
 	var desde			= $('input#desde').val();
 	var hasta			= $('input#hasta').val();
 	var tipovalor		= $('select#tipovalor').val();
 	var valor			= $('input#valor').val();
 	var tipo			= $('select#tipo').val();
 	
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/nuevoGrupo', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: {'grupo_nombre' 	: grupo_nombre,
	 			'btn-save'		: 1, 
	 			'regla'			: regla,
	 			'cant_min'		: cant_min,
	 			'precio_min'	: precio_min,
	 			'desde'			: desde,
	 			'hasta'			: hasta,
	 			'tipovalor'		: tipovalor,
	 			'valor'			: valor,
	 			'tipo'			: tipo,
	 	}, //Pasaremos por parámetro POST
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar la tabla
	 		$('#divregistro').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
	 	}
	});
}

function nuevoCliente(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	if(id_grupo_cliente){
	
		$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/grupos/nuevoCliente', //Realizaremos la petición al metodo prueba del controlador cliente
		 	data: {'id_grupo_cliente' : id_grupo_cliente}, //Pasaremos por parámetro POST el id del grupo
		 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
		 		//Activar y Rellenar la tabla
		 		$('#clientes').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
		 		$('.prueba').DataTable();
		 	}
		});
	}
}		
function nuevoCliente2(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	if(id_grupo_cliente){
			
		$.ajax({
			 type: 'POST',
			 url: '<?php echo base_url(); ?>index.php/grupos/grupoCliente', //Realizaremos la petición al metodo prueba del controlador cliente
			 data: {'id_grupo_cliente' : id_grupo_cliente}, //Pasaremos por parámetro POST el id del grupo
			 success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
			 	//Activar y Rellenar la tabla	
			 	$('#clientegrupo').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
			 	$('.prueba').DataTable();
			 }
		});
	}
}


function cargarCliente($id_cliente){
 	var id_cliente 			= $id_cliente; //Obtenemos el id del grupo seleccionado en la lista
	var id_grupo_cliente 	= $('select#grupos').val();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/grupos/cargarCliente', //Realizaremos la petición al metodo prueba del controlador cliente
		data: {'id_cliente' : id_cliente, 'id_grupo_cliente' : id_grupo_cliente}, //Pasaremos por parámetro POST el id del grupo
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
		 	//Activar y Rellenar la tabla
		 	nuevoCliente();
		}
	});	
}

function sacarCliente($id_cliente){
 	var id_cliente 			= $id_cliente; //Obtenemos el id del grupo seleccionado en la lista
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/grupos/sacarCliente', //Realizaremos la petición al metodo prueba del controlador cliente
		data: {'id_cliente' : id_cliente}, //Pasaremos por parámetro POST el id del grupo
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
		 	//Activar y Rellenar la tabla
		 	nuevoCliente2();
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
	    							    						
	    						<div class="row">
	    							
	    							<div class="col-md-1 dropdown">
											<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
											</button>
											<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
												<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('grupo'); ?></a></li>
												<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('agregar').' '.$this->lang->line('regla'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('administrar').' '.$this->lang->line('reglas'); ?></a></li>
											</ul>
									</div>
	    							
		    						<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupos_clientes'); ?></label>
										<div class="col-md-3">
											<select id="grupos" name="id_grupo_cliente" class="form-control chosen-select" data-placeholder="Seleccione un Grupo..." onchange="reglasActivas(),clientesActivos()">
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
								    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
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
	     						
	     						<div class="col-sm-2">
							        <nav class="nav-tab nav-justified nav-sidebar">
							        	<ul class="nav nav-sidebar">
							            	<li><a href="#grupo1" data-toggle="tab"><?php echo $this->lang->line('grupo'); ?></a></li>
							                <li><a href="#grupo2" data-toggle="tab"><?php echo $this->lang->line('regla'); ?></a></li>
							            </ul>
							    	</nav>
							    </div>
	     						
	     						<div class="tab-content">
		     						<div class="tab-pane fade" id="grupo1">
		     							<div class="col-md-9" >
				     						<form action="<?php echo base_url()."index.php/grupos/nuevoGrupo"?>" class="form-horizontal" method="post">
												
												<div class="form-group">
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupo'); ?></label>
														
														<div class="col-sm-5">
															<div class="input-group">
																<div class="input-group-addon"><span class="fa fa-users" aria-hidden="true"></span></div>
																<input type="text" id="grupo_nombre" name="grupo_nombre" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('nombre'); ?>" required> 	    	
														   	</div>
														</div> 
												</div>
		
												<div class="form-group">
										  			<label class="col-sm-1 col-sm-offset-1 control-label"></label>
											      		<div class="col-md-6">	
												  	  		<!--<button type="submit" class="btn btn-primary" name="btn-save" value="1" onclick="nuevoGrupo()"><?php echo $this->lang->line('guardar'); ?></button> 
												  	  		-->
												  	  		<input type="button" value="<?php echo $this->lang->line('guardar'); ?>" class="btn btn-primary" id="btn-guardar" onclick="nuevoGrupo()">
												  	  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
												  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmarGrupo()">
														</div>
												</div>
											</form>
										</div>
									</div>
									
									<div class="tab-pane fade" id="grupo2">
		     							<div class="col-md-9">
		     								<form action="<?php echo base_url()."index.php/grupos/nuevoGrupo"?>" class="form-horizontal" method="post">
											
		     									<div class="form-group">
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('regla'); ?></label>
														<div class="col-sm-5">
															<input type="text" id="regla" name="regla" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('nombre'); ?>" required> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('precio').' '.$this->lang->line('minimo'); ?></label>
														<div class="col-sm-4">
															<input type="text" id="cant_min" name="cant_min" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>"> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('cantidad').' '.$this->lang->line('minima'); ?></label>
														<div class="col-sm-4">
															<input type="text" id="precio_min" name="precio_min" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>"> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('date').' '.$this->lang->line('inicio'); ?></label>
														<div class="col-sm-4">
															<input type="date" id="desde" name="desde" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('date'); ?>"> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('date').' '.$this->lang->line('hasta'); ?></label>
														<div class="col-sm-4">
															<input type="date" id="hasta" name="hasta" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('date'); ?>"> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('cantidad'); ?></label>
														<div class="col-sm-4">
															<select name="tipovalor" id="tipovalor" class="form-control">
																<option value="0" selected><?php echo $this->lang->line('fija').' $'; ?></option>
																<option value="1"><?php echo $this->lang->line('porcentual').' %'; ?></option>
															</select>
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('valor'); ?></label>
														<div class="col-sm-4">
															<input type="text" id="valor" name="valor" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('valor'); ?>" required> 	    	
														</div> 
												</div>
												
												<div class="form-group">
													<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('tipo'); ?></label>
														<div class="col-sm-4">
															<select name="tipo" id="tipo" class="form-control">
																<option value="0" selected><?php echo $this->lang->line('aumento'); ?></option>
																<option value="1"><?php echo $this->lang->line('descuento'); ?></option>
															</select>
														</div> 
												</div>
												
												<div class="form-group">
										  			<label class="col-sm-1 col-sm-offset-1 control-label"></label>
											      		<div class="col-md-6">	
												  	  		<!--<button type="submit" class="btn btn-primary" name="btn-save" value="1" onclick="nuevoGrupo()"><?php echo $this->lang->line('guardar'); ?></button> 
												  	  		-->
												  	  		<input type="button" value="<?php echo $this->lang->line('guardar'); ?>" class="btn btn-primary" id="btn-guardar" onclick="nuevoGrupo()">
												  	  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
												  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmarGrupo()">
														</div>
												</div>
												
											</form>
										</div>
		     						</div>
								</div>	
	     						
	    					</div><!--TAB 2 CARGA DE GRUPOS -->
	    				
	    					<div class="tab-pane fade" id="tab3">
	     						<!--TAB 3 CARGA DE CLIENTE -->
	     						
		     					<div class="col-sm-2">
							        <nav class="nav-tab nav-justified nav-sidebar">
							        	<ul class="nav nav-sidebar">
							            	<li><a href="#cliente1" data-toggle="tab" onclick="nuevoCliente()"><?php echo $this->lang->line('clientes'); ?></a></li>
							                <li><a href="#cliente2" data-toggle="tab" onclick="nuevoCliente2()"><?php echo $this->lang->line('clientes').' '.$this->lang->line('grupo'); ?></a></li>
							            </ul>
							    	</nav>
							    </div>
	     						
	     							
	     						<div class="tab-content">
		     						<div class="tab-pane fade" id="cliente1">
		     							<div class="col-md-9" >
											<div id="clientes">
												<!-- Esta tabla se llena con AJAX -->		
											</div>
										</div>
		     						</div>
	     							
	     							<div class="tab-pane fade" id="cliente2">
		     							<div class="col-md-9">
											<div id="clientegrupo">
												<!-- Esta tabla se llena con AJAX -->		
											</div>
										</div>
		     						</div>
	     						</div>
								
							</div>
	    					
	    					<div class="tab-pane fade" id="tab4">
	     						<!--TAB 4 DIRECCIONES CLIENTE -->
	     						
	    					</div>
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 E-MAILS CLIENTE -->					
	     						
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab">
	     						<!--TAB 6 PANEL DE PEDIDOS -->
	     						
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab">
	     						<!--TAB 7 PANEL DE PRESUPUESTOS -->
	     						
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
