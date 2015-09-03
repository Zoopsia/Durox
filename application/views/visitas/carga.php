<script>
function busqueda(){
	
 	var id_vendedor = $('select#id_vendedor').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Visitas/getClientes', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_vendedor='+id_vendedor, 
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#id_cliente').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#id_cliente").trigger("chosen:updated");
	 	}
	});
}
</script>

	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<!--TABLA CARGA VISITA-->
		  						<h3>
									<div class="floatL form-title-left" style="padding: 0 0 20px 60px">
										<a href="#"><?php echo $this->lang->line('añadir').' '.$this->lang->line('visitas')?></a>
									</div>
									<div class="clear"></div>
								</h3>
	    						<form action="<?php echo base_url()."index.php/Visitas/nuevaVisita/"?>" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    								
	    								<div class="form-group odd">
											<label class="col-sm-2	 control-label"><?php echo $this->lang->line('vendedor').'*:'; ?></label>
												<div class="col-sm-8">
													<select id="id_vendedor" name="id_vendedor" class="form-control chosen-select" onchange=" busqueda()" data-placeholder="Seleccione un <?php echo $this->lang->line('vendedor'); ?>" required>	
														<option></option>
														<?php
															foreach($vendedores as $row){
																echo '<option value="'.$row->id_vendedor.'">'.$row->nombre.', '.$row->apellido.'</option>';
															}
														?>
													</select>												      	 
									      		</div>
									      		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
	    								
	    								<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('cliente').'*:'; ?></label>
												<div class="col-sm-8">
													<select id="id_cliente" name="id_cliente" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('cliente'); ?>" required>	
														<!-- SE LLENA CON AJAX -->
													</select>												      	 
									     		</div>
									     		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									      	  
									    <div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('epoca').' '.$this->lang->line('visita').'*:'; ?></label>
												<div class="col-sm-8">
													<select name="id_epoca_visita" class="form-control chosen-select" data-placeholder="Seleccione una <?php echo $this->lang->line('epoca'); ?>">	
														<option></option>
														<?php
															foreach($epocas as $row){
																echo '<option value="'.$row->id_epoca_visita.'">'.$row->epoca.'</option>';
															}
														?>
													</select>												      	 
									     		</div>
									    </div>
	    								
		    							<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('fecha').'*:'; ?></label>
												<div class="col-sm-8">
													<input type="text" name="date_add" class="form-control datepicker" value="" required autocomplete="off">	 
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('comentarios').':'; ?></label>
												<div class="col-sm-8">
													<textarea name="comentarios" style="width: 100%; height: 100px;" ></textarea>	 
												</div>
										</div>
										
										<div class="form-group even" style="padding-bottom: 1%">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('valoracion').':'; ?></label>
												<div class="col-sm-8" style="margin-top: 1%">
													<input name="star1" type="radio" value="1" class="star"/>
													<input name="star1" type="radio" value="2" class="star"/>
													<input name="star1" type="radio" value="3" class="star" checked/>
													<input name="star1" type="radio" value="4" class="star"/>
													<input name="star1" type="radio" value="5" class="star"/>
												</div>
										</div>
										
										<hr />
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"></label>
											<div class="col-sm-8">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarVisita()">
											</div>
									   	</div>
									</div>
	    						</form>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    

