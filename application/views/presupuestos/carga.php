<script>

function modal(){
	$("#ModalBuscar").modal("show");
}

function prueba(){
	var id_vendedor = $('#id_vendedor').val();
	var id_cliente 	= $('#id_cliente').val();
	
	if(id_vendedor != null && id_cliente != null) 
		document.getElementById('button-submit').setAttribute('type', 'submit');
}

function busqueda(){

 	var id_visita = $('select#id_visita').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/getVendedor', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_visita='+id_visita, //Pasaremos por parámetro POST el id del pai
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#id_vendedor').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#id_vendedor").trigger("chosen:updated");
			if($('#id_vendedor').val() == null)
	 			document.getElementById('button-submit').setAttribute('type', 'button');
	 	}
	});
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/getCliente', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_visita='+id_visita, //Pasaremos por parámetro POST el id del pais
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#id_cliente').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#id_cliente").trigger("chosen:updated");
	 		if($('#id_cliente').val() == null)
	 			document.getElementById('button-submit').setAttribute('type', 'button');
	 	}
	});
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/getFecha', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_visita='+id_visita, //Pasaremos por parámetro POST el id del pais
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#date_add').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

function busqueda2(){
	
 	var id_vendedor = $('select#id_vendedor').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/getClientes', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_vendedor='+id_vendedor, 
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#id_cliente').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#id_cliente").trigger("chosen:updated");
	 	}
	});
}

function resetear(){
	document.location.reload();
}


$('#formPresupuesto').submit(function(event){
    event.preventDefault();
	alert("Submit prevented");
});
</script>

<!-- Modal -->
<div class="modal fade" id="ModalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  	<div class="modal-content">
	  		<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      		<h4 class="modal-title" id="myModalLabel">Ayuda</h4>
	   		</div>
			<div class="modal-body" id="tablaVisitas">
				<p>. Si no conoce el número de visita puede buscarlo presionando el botón "BUSCAR".</p>
				<p>. Puede crear una nueva visita presionando el botón "CREAR".</p>
				<p>. Presione "CANCELAR" si conoce el número de la visita.</p>					        		
			</div>
			<div class="modal-footer">
				<a role="button" class="btn btn-primary" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>" data-placement="bottom" title="<?php echo $this->lang->line('crear').' '.$this->lang->line('visita');?>">
					<?php echo $this->lang->line('crear'); ?>
				</a>
				<a role="button" class="btn btn-info" href="<?php echo base_url().'index.php/Visitas/buscar'?>" data-placement="bottom" title="<?php echo $this->lang->line('buscar').' '.$this->lang->line('visita');?>">
					<?php echo $this->lang->line('buscar'); ?>
				</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('cancelar'); ?></button>
			</div>
		</div>
	</div>
</div>



	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<?php echo $this->lang->line('nuevo').' '.$this->lang->line('presupuesto'); ?>
		  				<li id="volver" class="pull-right desactive" style="display: block"><a href="#" data-toggle="tab"  onclick="resetear()">Resetear Formulario</a></li>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<div class="row">
		  						<div class="col-sm-6">
			  						<h3><div style="padding: 0 0 20px 60px">
										<a href="#">
											<?php echo $this->lang->line('nuevo').' '.$this->lang->line('presupuesto'); ?>
										</a>
										<a role="button" class="btn btn-info btn-sm" href="#" onclick="modal()" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('ayuda');?>" style="border-radius: 200px">
											<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
										</a>
									</div></h3>
								</div>
								<?php
	    									if($visita==''){
								?>		
								<div class="col-sm-2 col-sm-offset-3">
									<a role="button" class="btn btn-info" href="<?php echo base_url().'index.php/Visitas/buscar'?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('buscar').' '.$this->lang->line('visita');?>" style="margin-top: 15% ; width: 85px">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
										<?php echo $this->lang->line('buscar'); ?>
									</a>
									
								</div>
								<?php
											}
								?>	
							</div>	
	    						<form action="<?php echo base_url().'index.php/Presupuestos/nuevoPresupuesto/'; ?>" id="formPresupuesto" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    								<?php
	    									if($visita!=''){
	    										foreach ($visita as $row) {
										?>		
										<!-- CARGA DE PRESUPUESTO CON ID DE VISITA -->	
	    								<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('visita').'*:'; ?></label>
												<div class="col-sm-8">
													<select name="id_visita" class="form-control chosen-select" required>	
														<option value="<?php echo $row->id_visita; ?>" selected><?php echo $row->id_visita; ?></option>
													</select>												      	 
									      		</div>
									    </div>
									    
	    								<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('vendedor').'*:'; ?></label>
												<div class="col-sm-8">
													<?php
														foreach ($vendedores as $key) {
															if($key->id_vendedor == $row->id_vendedor){
													?>	
													<select name="id_vendedor" class="form-control chosen-select" required>	
														<option value="<?php echo $key->id_vendedor; ?>" selected><?php echo $key->nombre.', '.$key->apellido; ?></option>
													</select>	
													
													<?php
															}/*--FOREACH---*/
														}/*--IF---*/
												    ?> 												      	 
									      		</div>
									    </div>
	    								
	    								<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('cliente').'*:'; ?></label>
												<div class="col-sm-8">
													<?php
														foreach ($clientes as $key) {
															if($key->id_cliente == $row->id_cliente){
													?>	
													<select name="id_cliente" class="form-control chosen-select" required>	
														<option value="<?php echo $key->id_cliente; ?>" selected><?php echo $key->razon_social; ?></option>
													</select>	
													
													<?php
															}/*--FOREACH---*/
														}/*--IF---*/
												    ?> 	 
									     		</div>
									    </div>
									        								
		    							<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('fecha').'*:'; ?></label>
												<div class="col-sm-8">
													<input type="text" name="fecha" class="form-control datepicker" value="<?php echo date('d/m/Y', strtotime($row->fecha));?>" required autocomplete="off">	 
												</div>
										</div>
										
										<hr />
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"></label>
											<div class="col-sm-8">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarPresupuesto()">
											</div>
									   	</div>
									   	
									   	<?php 
												} /*---FOREACH---*/
											}/*---IF---*/
											else{
										 ?>
										 
										 <!-- NUEVA CARGA DE PRESUPUESTO -->
										 <div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('visita').'*:'; ?></label>
												<div class="col-sm-8">
													<select id="id_visita" name="id_visita" class="form-control chosen-select" onchange=" busqueda()">	
														<option value='' disabled selected style='display:none;'>Seleccione una opcion...</option>
														<?php
															foreach($visitas as $row){
																echo '<option value="'.$row->id_visita.'">'.$row->id_visita.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('visita');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									    
	    								<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('vendedor').'*:'; ?></label>
												<div class="col-sm-8">
													<select id="id_vendedor" name="id_vendedor" class="form-control chosen-select" onchange=" busqueda2()" data-placeholder="Seleccione un <?php echo $this->lang->line('vendedor'); ?>" required>	
														<option></option>
														<?php
															foreach($vendedores as $row){
																echo '<option value="'.$row->id_vendedor.'">'.$row->nombre.', '.$row->apellido.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
	    								
	    								<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('cliente').'*:'; ?></label>
												<div class="col-sm-8">
													<select id="id_cliente" name="id_cliente" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('cliente'); ?>" required>	
														<!-- SE LLENA CON AJAX -->
													</select> 
									     		</div>
									     		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									        								
		    							<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('fecha').'*:'; ?></label>
												<div class="col-sm-8" id="date_add">
													<input type="text" name="fecha" class="form-control datepicker" value="" required autocomplete="off">	 
												</div>
										</div>
																		    
										<hr />
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"></label>
											<div class="col-sm-8">
												<button type="submit" class="btn btn-primary" id="button-submit" onclick="prueba()"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarPresupuesto()">
											</div>
									   	</div>
									   	
									   	<?php } ?>
									</div>
	    						</form>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    

