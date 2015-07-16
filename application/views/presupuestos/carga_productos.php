<script>
function cargaProducto($presupuesto){
	
 	var producto 	= $('select#producto').val(); 
 	var cantidad 	= $('input#cantidad1').val();
 	var presupuesto	= $presupuesto;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'producto'	: producto,
	 		   'cantidad'	: cantidad,
	 		   'presupuesto': presupuesto,
	 		   },
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#table').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$('#btn-guardar').show();
	 		$('#btn-cancelar').show();
	 		document.getElementById("formProducto").reset();
	 	}
	});
}

function sacarProducto($id_linea, $presupuesto){
	var presupuesto = $presupuesto;
 	var id_linea	= $id_linea;
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/sacarProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {'id_linea'	: id_linea,
	 		   'presupuesto': presupuesto,
	 		   },
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#table').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
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
		  				<?php echo $this->lang->line('presupuesto').' '.$presupuesto; ?>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<div class="row">
		  						<div class="col-sm-6">
			  						<h3><div style="padding: 0 0 20px 60px">
										<a href="#">
											<?php echo $this->lang->line('carga').' '.$this->lang->line('productos'); ?>
										</a>
									</div></h3>
								</div>
								
								<div class="col-sm-2 col-sm-offset-3">
									
									
								</div>
							</div>	
	    						<form action="<?php echo base_url().'index.php/Presupuestos/nuevoPresupuesto/'; ?>" id="formProducto" class="form-inline" method="post">
	    							<div class="row">
		    							<div class="col-sm-10 col-sm-offset-2" style="padding: 0 50px">
											 <!-- NUEVA CARGA DE PRESUPUESTO -->
											 <div class="form-group">
											 	<div class="col-sm-6 col-sm-offset-1">
													 <select id="producto" name="producto" class="form-control" required>	
														<option value='' disabled selected style='display:none;'>Seleccione una opcion...</option>
														<?php
															foreach($productos as $row){
																echo '<option value="'.$row->id_producto.'">'.$row->nombre.'</option>';
															}
														?>
													</select>
											     </div>
										     </div>
										     <div class="form-group">
										     	<div class="col-sm-4 col-sm-offset-1">
										     		<input type="text" id="cantidad1" name="cantidad1" class="numeric form-control" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>" required>
										     	</div>
										     </div>
										     <div class="form-group">
										     	<div class="col-sm-4 col-sm-offset-1">
										     		<a role="button" class="btn btn-success btn-sm" onclick="cargaProducto(<?php echo $presupuesto ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('producto');?>">
											 			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
												</div>
											 </div>
										</div>
									</div>
									<br /><br />
									<div class="row">
										<div id="table" class="col-sm-10 col-sm-offset-1">
											
										</div>
									</div>
									<div class="row">
										<div>
											<div class="col-sm-4 col-sm-offset-4">
												<button class="btn btn-primary" id="btn-guardar" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('guardar');?>" style="display: none">
													<?php echo $this->lang->line('guardar'); ?>
												</button>
												<input type="button" id="btn-cancelar" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="" style="display: none">
											</div>
										</div>
									</div>
	    						</form>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
