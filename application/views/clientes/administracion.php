<script>

function reglasActivas(){
 	var id_grupo_cliente = $('select#grupos').val(); //Obtenemos el id del grupo seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/clientes/getReglasGrupos', //Realizaremos la petición al metodo prueba del controlador cliente
	 	data: 'id_grupo_cliente='+id_grupo_cliente, //Pasaremos por parámetro POST el id del grupo
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar la tabla
	 		$('#tablareglas').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
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
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('grupos_clientes'); ?></a></li>
					    	<li><a href="#tab2" data-toggle="tab"></a></li>
					    	<li role="presentation" class="dropdown">
							    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							       <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu" role="menu">
							     	<li><a href="#tab3" data-toggle="tab"></a></li>
							     	<li><a href="#tab4" data-toggle="tab"></a></li>
							     	<li><a href="#tab5" data-toggle="tab"></a></li>
							    </ul>
							</li>
					    		
					    	<li><a href="#tab6" data-toggle="tab"></a></li>
					    	<li><a href="#tab7" data-toggle="tab"></a></li>
					    	<li><a href="#tab8" data-toggle="tab"></a></li>
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
												<li><a href="#"><?php echo $this->lang->line('agregar').' '.$this->lang->line('grupo'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('administrar').' '.$this->lang->line('reglas'); ?></a></li>
												<li><a href="#"><?php echo $this->lang->line('agregar').' '.$this->lang->line('regla'); ?></a></li>
											</ul>
									</div>
	    							
		    						<label class="col-sm-2 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupos_clientes'); ?></label>
										<div class="col-md-3">
											<select id="grupos" name="id_grupo_cliente" class="form-control chosen-select" data-placeholder="Selecciones un Grupo..." onchange="reglasActivas()">
		    									<option></option>
		    									<?php
		    										foreach ($grupos as $row) {
		    											if($id_grupo==$row->id_grupo_cliente){
															echo '<option value="'.$row->id_grupo_cliente.'" selected>'.$row->grupo_nombre.'</option>';
															//----LLAMO FUNCION DE LLENAR LAS REGLAS---//
															?><script>reglasActivas();</script><?php
														}
														else
		    												echo '<option value="'.$row->id_grupo_cliente.'">'.$row->grupo_nombre.'</option>';
													}
		    									?>
		    								</select>
										</div>
										
								</div>
								<div class="row">
									<div class="col-md-9">
										<div id="tablareglas" style="padding-top: 20px">
												
										</div>
									</div>
								</div>
	    					</div> <!--TAB 1 GRUPOS CLIENTES -->
	     					<div class="tab-pane fade" id="tab2">
	     					<!--TABLA DE VENDEDORES CON RESPECTO AL CLIENTE-->	
	     						
							    
	    					</div><!--TAB 2 VENDEDORES CLIENTE -->
	    				
	    					<div class="tab-pane fade" id="tab3">
	     						<!--TAB 3 TELEFONOS CLIENTE -->
	     						
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
