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
	 		$('.prueba').DataTable({
			 		"language": {
						"sProcessing":     "Procesando...",
						"sLengthMenu":     "Mostrar _MENU_ registros",
						"sZeroRecords":    "No se encontraron resultados",
						"sEmptyTable":     "Ningún dato disponible en esta tabla",
						"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":    "",
						"sSearch":         "Buscar:",
						"sUrl":            "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "Primero",
							"sLast":     "Último",
							"sNext":     "Siguiente",
							"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					}
	 		});
	 	}
	});
}
</script>
<?php $array_n = pestañaActivaGrupo($this->uri->segment(3));?>

	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">			
		  				<ul class="nav nav-tabs">
							<li class="<?php echo $array_n['main']; ?>"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('grupos_clientes'); ?></a></li>
							<li id="volver" class="pull-right desactive"><a href="#tab1" data-toggle="tab"  onclick="volverHide()"><?php echo $this->lang->line('volver'); ?></a></li>
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
												<li class="<?php echo $array_n['nuevogrupo']; ?> desactive"><a href="#tab2" data-toggle="tab" onclick="volverShow()"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('grupo'); ?></a></li>
												<li class="<?php echo $array_n['agregarcliente']; ?> desactive"><a href="#tab3" data-toggle="tab" onclick="volverShow()"><?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente'); ?></a></li>
												<li class="<?php echo $array_n['editargrupo']; ?> desactive"><a href="#tab4" data-toggle="tab" onclick="volverShow(), editarGrupo()"><?php echo $this->lang->line('editar').' '.$this->lang->line('grupo'); ?></a></li>
											</ul>
									</div>
	    							<!--
		    						<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupos_clientes'); ?></label>
									-->
										<div class="col-md-4">
											<select id="grupos" name="id_grupo_cliente" class="form-control chosen-select" data-placeholder="Seleccione un Grupo..." onchange="reglasActivas(),clientesActivos()">
		    									<option></option>
		    									<?php
			    									if($grupos){
			    										foreach ($grupos as $row) {
			    											if($row->id_grupo_cliente==1){
			    												echo '<option value="'.$row->id_grupo_cliente.'">'.$row->grupo_nombre.'</option>';
			    											}
															else if($id_grupo==$row->id_grupo_cliente){
																echo '<option value="'.$row->id_grupo_cliente.'" selected>'.$row->grupo_nombre.'</option>';
																//----LLAMO FUNCION DE LLENAR LAS REGLAS---//
																?><script>reglasActivas(), clientesActivos();</script><?php
															}
															else
			    												echo '<option value="'.$row->id_grupo_cliente.'">'.$row->grupo_nombre.'</option>';
														}
													}
		    									?>
		    								</select>
										</div>
								<!--ACÁ ESTABA DIV DE ROW PRUEBA-->
								
								<div class="col-md-7"><!--DIV DE COL PRUEBA-->
									
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
								
								</div><!--DIV DE COL PRUEBA-->
								</div><!--DIV DE ROW PRUEBA-->
	    					</div> <!--TAB 1 GRUPOS CLIENTES -->
	     					<div class="tab-pane fade <?php echo $array_n['nuevogrupo']; ?>" id="tab2">
	     					<!--TAB 2 CARGA DE GRUPOS-->
	     						<div id="divregistro">
	     						<!-----CARGA DE REGISTRO---->	
	     						</div>
	     						<div class="col-sm-2">
							        <nav class="nav-tab nav-justified nav-sidebar">
							        	<ul class="nav nav-sidebar">
							            	<li><a href="#grupo1" data-toggle="tab"><?php echo $this->lang->line('grupo'); ?></a></li>
							                <li><a href="#grupo2" data-toggle="tab"><?php echo $this->lang->line('regla'); ?></a></li>
							            </ul>
							    	</nav>
							    </div>
	     						<form action="<?php echo base_url()."index.php/grupos/nuevoGrupo"?>" id="form-grupo" class="form-horizontal" onsubmit="return comprobarGrupo()" method="post">
											
		     						<div class="tab-content">
			     						<div class="tab-pane fade" id="grupo1">
			     							<div class="col-md-9" >
				     							<div class="form-group odd">
													<label class="col-sm-2 control-label"><?php echo $this->lang->line('grupo').'*: '; ?></label>
														<div class="col-sm-8">
															<div class="input-group">
																<div class="input-group-addon"><span class="fa fa-users" aria-hidden="true"></span></div>
																<input type="text" id="grupo_nombre" name="grupo_nombre" class="form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('nombre'); ?>" required> 	    	
														   	</div>
														</div> 
												</div>
											</div>
										</div>
									
										<div class="tab-pane fade" id="grupo2">
		     								<div class="col-md-9">
		     									<div class="form-group odd">
													<label class="col-sm-2 control-label"><?php echo $this->lang->line('regla').'*: '; ?></label>
														<div class="col-sm-8">
															<input type="text" id="regla" name="regla" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('nombre'); ?>" required> 	    	
														</div> 
												</div>
												
												<div class="form-group even">
													<label class="col-sm-2 control-label"><?php echo $this->lang->line('valor').'*: %'; ?></label>
														<div class="col-sm-8">
															<input type="text" id="valor" name="valor" class="numeric form-control" pattern="[0-9]*" placeholder="%" required> 	    	
														</div> 
												</div>
												
												<div class="form-group odd">
													<label class="col-sm-2 control-label"><?php echo $this->lang->line('tipo').'*: '; ?></label>
														<div class="col-sm-8">
															<select name="tipo" id="tipo" class="form-control">
																<option value="0" selected><?php echo $this->lang->line('aumento'); ?></option>
																<option value="1"><?php echo $this->lang->line('descuento'); ?></option>
															</select>
														</div> 
												</div>
												
												<div class="form-group">
										  			<label class="col-sm-2 control-label"></label>
											      		<div class="col-md-8">
												  	  		<input type="button" value="<?php echo $this->lang->line('guardar'); ?>" class="btn btn-primary" id="btn-guardar" onclick="nuevoGrupo()">
												  	  		<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardaryvolver'); ?></button> 	
												  	  		<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmarGrupo()">
														</div>
												</div>
											</div>
			     						</div>
									</div>	
	     						</form>
	    					</div><!--TAB 2 CARGA DE GRUPOS -->
	    				
	    					<div class="tab-pane fade <?php echo $array_n['agregarcliente']; ?>" id="tab3">
	     						<!--TAB 3 CARGA DE CLIENTE -->
	     						
		     					<div class="col-sm-2">
							        <nav class="nav-tab nav-justified nav-sidebar">
							        	<ul class="nav nav-sidebar">
							            	<li class="desactive"><a href="#cliente1" data-toggle="tab" onclick="nuevoCliente()"><?php echo $this->lang->line('clientes'); ?></a></li>
							                <li class="desactive"><a href="#cliente2" data-toggle="tab" onclick="nuevoCliente2()"><?php echo $this->lang->line('clientes').' '.$this->lang->line('grupo'); ?></a></li>
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
	    					
	    					<div class="tab-pane fade <?php echo $array_n['editargrupo']; ?>" id="tab4">
	     						<!--TAB 4 EDITAR GRUPO -->
	     						<form action="<?php echo base_url()."index.php/grupos/editarGrupo"?>" class="form-horizontal" method="post">
		     						<div style="padding: 0 50px" >
			     						<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('grupo') ?></label>
												<div class="col-sm-8">
													<div class="input-group" id="editargrupo">
													<!-- Esta tabla se llena con AJAX -->	
														   	
													</div>
												</div>
										</div>
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('regla'); ?></label>
												<div class="col-sm-8">
													<div id="nombre_regla">
													<!-- Esta tabla se llena con AJAX -->
														
													</div>	    	
												</div> 
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('valor').' %'; ?></label>
												<div class="col-sm-8">
													<div id="valor_regla">
													<!-- Esta tabla se llena con AJAX -->
																    	
													</div>
												</div> 
										</div>
												
										<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('tipo'); ?></label>
												<div class="col-sm-8">
													<div id="tipo_regla">
													<!-- Esta tabla se llena con AJAX -->	
													
													</div>
												</div> 
										</div>
										
		     							<hr />
		     						
			     						<div class="form-group">
											<label class="col-sm-2 control-label"></label>
												<div class="col-md-8">	
													<button type="submit" class="btn btn-primary" name="btn-save" value="2"><?php echo $this->lang->line('guardar'); ?></button> 	
													<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" id="btn-cancelar" onclick="confirmarGrupo()">
												</div>
										</div>
									</div>
		     					</form>    						
	    					</div>
	    					
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    

<script>



function editarGrupo(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/editarGrupo', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente,
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		$('#editargrupo').attr('disabled',false).html(resp); 
		}
	});
	
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/getRegla', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente,
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		$('#nombre_regla').attr('disabled',false).html(resp); 
		}
	});
	
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/getValorRegla', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente,
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		$('#valor_regla').attr('disabled',false).html(resp); 
		}
	});	
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/grupos/getTipoRegla', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente,
		success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		$('#tipo_regla').attr('disabled',false).html(resp); 
	 		$(".chosen-select").chosen({ width: '100%' });
		}
	});	
}

function nuevoGrupo(){
 	var grupo_nombre	= $('input#grupo_nombre').val(); 
 	var regla			= $('input#regla').val();
 	var valor			= $('input#valor').val();
 	var tipo			= $('select#tipo').val();
 	if(comprobarGrupo()){
	 	$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/grupos/nuevoGrupo', 
		 	data: {'grupo_nombre' 	: grupo_nombre,
		 			'btn-save'		: 1, 
		 			'regla'			: regla,
		 			'valor'			: valor,
		 			'tipo'			: tipo,
		 	}, //Pasaremos por parámetro POST
		 	success: function(resp) { 
		 		$('#divregistro').attr('disabled',false).html(resp); 
		 	}
		});
	}
}



function comprobarGrupo(){
	var grupo_nombre	= $('input#grupo_nombre').val();
	var i = 0;
	<?php 
	if($grupos){
		foreach ($grupos as $row) {
			echo "if(grupo_nombre == '".$row->grupo_nombre."'){ i++;}";
		}
	}
	?>
	if(i > 0){
		alert("ERROR - Ya existe un grupo '"+grupo_nombre+"'");
		return false;
	}
	else
		return true;
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

$(document).ready(function(){
	document.getElementById('volver').style.display = 'none';
});

function volverShow(){
	document.getElementById('volver').style.display = 'block';
	$('#volver').removeClass('active');
}
function volverHide(){
	document.getElementById('volver').style.display = 'none';
	$('.desactive').removeClass('active');
	$('#clientes').html('');
	$('#clientegrupo').html('');
}
</script>