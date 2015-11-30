<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-sm-2">
					<nav class="nav-tab nav-justified">
						<ul class="nav nav-sidebar">
							<li class="active in"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('pais'); ?></a></li>
						    <li class=""><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('provincia'); ?></a></li>
					    	<li class=""><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('departamento'); ?></a></li>
					    	<li class=""><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('nuevo'); ?></a></li>
					    </ul>
					</nav>
				</div>
				<div class="tab-content">
		     		<div class="tab-pane fade active in" id="tab1">
		     			<form name="paises_edit" action="<?php echo base_url()."index.php/Localidades/editarPais"?>" class="form-horizontal" method="POST">
			     			<div class="col-lg-9 col-md-9 col-md-offset-1">
			     				<div class="row" style="margin-top: 10px;">
				     				<div class="col-lg-10 col-md-10">	
				     					<div class="form-group">
					     					<select name="paises" id="paises" class="form-control chosen-select" onchange="pais_input()" data-placeholder="Seleccione un <?php echo $this->lang->line('pais'); ?>" required>
												<option selected></option>
												<?php
							     				if($paises){
							     					foreach($paises as $paises){
							     						echo '<option value="'.$paises->id_pais.'">'.$paises->nombre_pais.'</option>';
							     					}
							     				}
												?>
											</select>
											<div style="margin-top: 20px;">
												<input type="text" name="input_pais" id="input_pais" class="form-control" required placeholder="<?php echo $this->lang->line('pais'); ?>" />
											</div>
										</div>
									</div>
									
			     				</div>
			     				<br>
			     				<div class="row">
								    <div class="pull-right">
								    	<button type="submit" id="btn-guardar" class="btn btn-primary">
											<?php echo $this->lang->line('guardar');?>
										</button>
										<button type="button" id="btn-cancelar" class="btn btn-danger" onclick="location.reload();" style="margin-right: 120px">
											<?php echo $this->lang->line('cancelar');?>
										</button>
									</div>            
								</div>
			     			</div>
			     			
			     		</form>
		     		</div>
		     		<div class="tab-pane fade" id="tab2">
						<form name="provincias_edit" action="<?php echo base_url()."index.php/Localidades/editarDepartamento"?>" class="form-horizontal" method="POST">
			     			<div class="col-lg-9 col-md-9 col-md-offset-1">
			     				<div class="row" style="margin-top: 10px;">
				     				<div class="col-lg-10 col-md-10">
				     					<div class="form-group">
						     				<select name="provincias" id="provincias" class="form-control chosen-select" onchange="provincia_input()" data-placeholder="Seleccione un <?php echo $this->lang->line('provincia'); ?>" required>
												<option selected></option>
												<?php
								     			if($provincias){
								     				foreach($provincias as $provincias){
								     					echo '<option value="'.$provincias->id_provincia.'">'.$provincias->nombre_provincia.'</option>';
								     				}
								     			}
												?>
											</select>
										</div>
										<div class="form-group">
											<select name="paises_provincias" id="paises_provincias" class="form-control chosen-select" disabled data-placeholder="Seleccione un <?php echo $this->lang->line('pais'); ?>" required>
												<option selected></option>
												<?php
								     			if($paises2){
								     				foreach($paises2 as $paises){
								     					echo '<option value="'.$paises->id_pais.'">'.$paises->nombre_pais.'</option>';
								     				}
								     			}
												?>
											</select>
											<div style="margin-top: 20px;">
												<input type="text" name="input_provincia" id="input_provincia" class="form-control" required placeholder="<?php echo $this->lang->line('provincia'); ?>" />
											</div>
										</div>
									</div>
			     				</div>
			     				<br>
			     				<div class="row">
								    <div class="pull-right">
								    	<button type="submit" id="btn-guardar" class="btn btn-primary">
											<?php echo $this->lang->line('guardar');?>
										</button>
										<button type="button" id="btn-cancelar" class="btn btn-danger" onclick="location.reload();" style="margin-right: 120px">
											<?php echo $this->lang->line('cancelar');?>
										</button>
									</div>            
								</div>
			     			</div>
			     		</form>
					</div>
					<div class="tab-pane fade" id="tab3">
						<form name="departamentos_edit" action="<?php echo base_url()."index.php/Localidades/editarDepartamento"?>" class="form-horizontal" method="POST">
							<div class="col-lg-9 col-md-9 col-md-offset-1">
								<div class="row" style="margin-top: 10px;">
					     			<div class="col-lg-10 col-md-10">
					     				<div class="form-group">
						     				<select name="departamentos" id="departamentos" class="form-control chosen-select" onchange="departamento_input()" data-placeholder="Seleccione un <?php echo $this->lang->line('departamento'); ?>" required>
												<option selected></option>
												<?php
								    				if($departamentos){
								    					foreach($departamentos as $departamentos){
								    						echo '<option value="'.$departamentos->id_departamento.'">'.$departamentos->nombre_departamento.'</option>';
								    					}
								    				}
												?>
											</select>
										</div>
					     				<div class="form-group">
						     				<select name="provincias_departamentos" id="provincias_departamentos" class="form-control chosen-select" disabled data-placeholder="Seleccione un <?php echo $this->lang->line('provincia'); ?>" required>
												<option selected></option>
												<?php
								     			if($provincias2){
								     				foreach($provincias2 as $provincias){
								     					echo '<option value="'.$provincias->id_provincia.'">'.$provincias->nombre_provincia.'</option>';
								     				}
								     			}
												?>
											</select>
										</div>
										<div class="form-group">
											<select name="paises_departamentos" id="paises_departamentos" class="form-control chosen-select" disabled onchange="paises_activos()" data-placeholder="Seleccione un <?php echo $this->lang->line('pais'); ?>" required>
												<option selected></option>
												<?php
								     			if($paises3){
								     				foreach($paises3 as $paises){
								     					echo '<option value="'.$paises->id_pais.'">'.$paises->nombre_pais.'</option>';
								     				}
								     			}
												?>
											</select>
											<div style="margin-top: 20px;">
												<input type="text" name="input_departamento" id="input_departamento" class="form-control" required placeholder="<?php echo $this->lang->line('departamento'); ?>" />
											</div>
										</div>
									</div>
									
				     			</div>
				     			<br>
				     			<div class="row">
								    <div class="pull-right">
								    	<button type="submit" id="btn-guardar" class="btn btn-primary">
											<?php echo $this->lang->line('guardar');?>
									</button>
										<button type="button" id="btn-cancelar" class="btn btn-danger" onclick="location.reload();" style="margin-right: 120px">
											<?php echo $this->lang->line('cancelar');?>
										</button>
									</div>            
								</div>
				     		</div>
						</form>
					</div>
		     		<div class="tab-pane fade" id="tab4">
		     			<div class="col-lg-10 col-md-10">
			     			<div class="row">
			     				<form name="departamentos_nuevos" action="<?php echo base_url()."index.php/Localidades/nuevoDepartamento"?>" class="form-horizontal" method="POST">
			     					<div class="col-xs-6 box box-success" style="width: 48%; margin-right: 20px;">
			                        	<div class="box-header" style="margin-bottom: 0px">
			                        		<div class="pull-right box-tools">                                        
			                                	<button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Datos"><i class="fa fa-minus"></i></button>
			                                </div>
			                                <p class="lead"><?php echo $this->lang->line('departamento')?></p>
			                        		<hr style="margin-bottom: 0px;"/>
			                        	</div>
			                        	<div class="box-body">
			     							<input type="text" name="nuevo_departamento" class="form-control" required placeholder="<?php echo $this->lang->line('departamento'); ?>" />
				     						<div style="margin-top: 20px;">
				     							<select name="nuevo_departamento_provincia" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('provincia'); ?>" required>
													<option selected></option>
													<?php
									     			if($provincias3){
									     				foreach($provincias3 as $provincias){
									     					echo '<option value="'.$provincias->id_provincia.'">'.$provincias->nombre_provincia.'</option>';
									     				}
									     			}
													?>
												</select>
											</div>
			     						</div>
			     						<div class="box-footer clearfix">
			     							<button type="submit" class="pull-right btn btn-default">Crear <i class="fa fa-arrow-circle-right"></i></button>
			     						</div>
			     					</div>
			     				</form>
			     				<form name="provincias_nuevas" action="<?php echo base_url()."index.php/Localidades/nuevaProvincia"?>" class="form-horizontal" method="POST">
			     					<div class="col-xs-6 box box-danger" style="width: 48%;">
			                        	<div class="box-header" style="margin-bottom: 0px">
			                        		<div class="pull-right box-tools">                                        
			                                	<button type="button" class="btn btn-danger btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Datos"><i class="fa fa-minus"></i></button>
			                                </div>
			                                <p class="lead"><?php echo $this->lang->line('provincia')?></p>
			                                <hr style="margin-bottom: 0px;"/>
			                        	</div>
			                        	<div class="box-body">
			     							<input type="text" name="nueva_provincia" class="form-control" required placeholder="<?php echo $this->lang->line('provincia'); ?>" />
				     						<div style="margin-top: 20px;">
				     							<select name="nueva_provincia_pais" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('pais'); ?>" required>
													<option selected></option>
													<?php
									     			if($paises4){
									     				foreach($paises4 as $paises){
									     					echo '<option value="'.$paises->id_pais.'">'.$paises->nombre_pais.'</option>';
									     				}
									     			}
													?>
												</select>
											</div>
			     						</div>
			     						<div class="box-footer clearfix">
			     							<button type="submit" class="pull-right btn btn-default">Crear <i class="fa fa-arrow-circle-right"></i></button>
			     						</div>
			     					</div>
			     				</form>
			     				<form name="paises_nuevo" action="<?php echo base_url()."index.php/Localidades/nuevoPais"?>" class="form-horizontal" method="POST">
			     					<div class="col-xs-6 box box-primary" style="width: 48%;">
			                        	<div class="box-header" style="margin-bottom: 0px">
			                        		<div class="pull-right box-tools">                                        
			                                	<button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Datos"><i class="fa fa-minus"></i></button>
			                                </div>
			                                <p class="lead"><?php echo $this->lang->line('pais')?></p>
			                        		<hr style="margin-bottom: 0px;"/>
			                        	</div>
			                        	<div class="box-body">
			     							<input type="text" name="nuevo_pais" class="form-control" required placeholder="<?php echo $this->lang->line('pais'); ?>" />
			     						</div>
			     						<div class="box-footer clearfix">
			     							<button type="submit" class="pull-right btn btn-default">Crear <i class="fa fa-arrow-circle-right"></i></button>
			     						</div>
			     					</div>
			     				</form>
			     			</div>
			     		</div>
			     	</div>
		     	</div>
			</div>
		</div>
	</div>
</div>	     				
<script>
function pais_input(){
	var select = document.paises_edit.paises;
	$('#input_pais').val(select.options[select.selectedIndex].text);
}

function provincia_input(){
	var select = document.provincias_edit.provincias;
	$('#input_provincia').val(select.options[select.selectedIndex].text);
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Localidades/getPais', 
	 	data: 'id_provincia='+$('#provincias').val(), 
	 	success: function(resp) { 
	 		$('select#paises_provincias').attr('disabled',false); 
	 		$('select#paises_provincias option[value='+resp+']').attr('selected','selected');
	 		$("#paises_provincias").trigger("chosen:updated");
	 	}
	});
}

function departamento_input(){
	var select = document.departamentos_edit.departamentos;
	$('#input_departamento').val(select.options[select.selectedIndex].text);
	
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Localidades/getProvincia', 
	 	data: 'id_departamento='+$('#departamentos').val(), 
	 	success: function(resp) { 
	 		$('select#provincias_departamentos').attr('disabled',false); 
	 		$('select#provincias_departamentos option[value='+resp+']').attr('selected','selected');
	 		$("#provincias_departamentos").trigger("chosen:updated");
	 	},
	 	async: false
	});
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Localidades/getPais', 
	 	data: 'id_provincia='+$("#provincias_departamentos").val(), 
	 	success: function(resp) { 
	 		$('select#paises_departamentos').attr('disabled',false); 
	 		$('select#paises_departamentos option[value='+resp+']').attr('selected','selected');
	 		$("#paises_departamentos").trigger("chosen:updated");
	 	}
	});
}

function paises_activos(){
 	var id_pais = $('select#paises_departamentos').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/direcciones/getProvincias', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_pais='+id_pais, //Pasaremos por parámetro POST el id del pais
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('select#provincias_departamentos').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#provincias_departamentos").trigger("chosen:updated");
	 	}
	});
}
</script>