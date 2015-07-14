<script>
function busqueda(){
	var id_visita 			= $('input#id_visita').val();
	var date_upd 			= $('input#date_upd').val();
	var cliente_nombre	 	= $('input#cliente_nombre').val();
	var cliente_apellido 	= $('input#cliente_apellido').val();
	var vendedor_nombre 	= $('input#vendedor_nombre').val();
	var vendedor_apellido 	= $('input#vendedor_apellido').val();
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/visitas/busqueda', 
	 	data: {	'id_visita'			: id_visita,
	 			'date_upd'			: date_upd,
	 			'cliente_nombre'	: cliente_nombre,
	 			'cliente_apellido'	: cliente_apellido,
	 			'vendedor_nombre'	: vendedor_nombre,
	 			'vendedor_apellido'	: vendedor_apellido
	 	}, 
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#busqueda').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 	}
	});
}

</script>

<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>




<?php $array_n = pestañaActiva($this->uri->segment(3));?>	
<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-pills">
							<li class="<?php echo $array_n['listado']?>"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('visitas'); ?></a></li>
					    	<li class="pull-right <?php echo $array_n['busqueda']?>"><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
						</ul>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<!--TABLA PRINCIPAL CON PEDIDOS-->
		  					<div class="tab-pane <?php echo $array_n['listado']?>" id="tab1">
	    						<div class="row">
		    						<div class="col-md-1">
		    							<a role="button" class="btn btn-success" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											<span class="ui-button-text"><?php echo $this->lang->line('agregar').' '.$this->lang->line('visita'); ?></span>
										</a>
		    						</div>
	    						</div>
	    						
	    						<div>
	    							<?php echo $output; ?>
	    						</div>
	    					</div>
	    					<!--BUSQUEDA AVANZADA DE PEDIDOS-->
	    					<div class="tab-pane <?php echo $array_n['busqueda']?>" id="tab2">
	    						<div id="busqueda" style="padding: 0 50px">
	    							
	    						</div>
	    						
	    						<form action="<?php echo base_url()."index.php/visitas/busqueda"?>" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    							
	    								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="padding-top: 20px">
										  <div class="panel panel-default">
										    <div class="panel-heading" role="tab" id="headingOne">
										      <h4 class="panel-title">
										        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										         	<?php echo $this->lang->line('visitas'); ?>
										        </a>
										      </h4>
										    </div>
										    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										      <div class="panel-body">
										        <div class="form-group odd"><!--PANEL DE BUSQUEDA POR VISITA-->
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('visita'); ?></label>
														<div class="col-sm-3">
															<input type="text" id="id_visita" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('numero'); ?>"> 	    	
														</div>
															
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('fecha'); ?></label>
														<div class="col-sm-3">
															<input type="date" id="date_upd" class="numeric form-control" placeholder="<?php echo $this->lang->line('fecha'); ?>"> 	    	
												  		</div>
												</div>
											  </div>
										    </div>
										  </div>
										  <div class="panel panel-default">
										    <div class="panel-heading" role="tab" id="headingTwo">
										      <h4 class="panel-title">
										        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										        	<?php echo $this->lang->line('clientes'); ?>
										        </a>
										      </h4>
										    </div>
										    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										      <div class="panel-body">
										      	<div class="form-group even"><!--PANEL DE BUSQUEDA POR CLIENTE-->
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('nombre'); ?></label>
														<div class="col-sm-3">
															<input type="text" id="cliente_nombre" class="numeric form-control" pattern="[A-Za-z ]+" placeholder="<?php echo $this->lang->line('nombre'); ?>"> 	    	
														</div>
															
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('apellido'); ?></label>
														<div class="col-sm-3">
															<input type="text" id="cliente_apellido" class="numeric form-control" pattern="[A-Za-z ]+" placeholder="<?php echo $this->lang->line('apellido'); ?>"> 	    	
														</div>
												</div>
										      </div>
										    </div>
										  </div>
										  <div class="panel panel-default">
										    <div class="panel-heading" role="tab" id="headingThree">
										      <h4 class="panel-title">
										        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										        	<?php echo $this->lang->line('vendedores'); ?>
										        </a>
										      </h4>
										    </div>
										    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
										      <div class="panel-body">
										      	<div class="form-group odd"><!--PANEL DE BUSQUEDA POR VENDEDOR-->
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('nombre'); ?></label>
														<div class="col-sm-3">
															<input type="text" id="vendedor_nombre" class="numeric form-control" pattern="[A-Za-z ]+" placeholder="<?php echo $this->lang->line('nombre'); ?>"> 	    	
														</div>
														
													<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('apellido'); ?></label>
														<div class="col-sm-3">
															<input type="text" id="vendedor_apellido" class="numeric form-control" pattern="[A-Za-z ]+" placeholder="<?php echo $this->lang->line('apellido'); ?>"> 	    	
														</div>
												</div>
										      </div>
										    </div>
										  </div>
										</div>	

										<div class="form-group">
										  	<label class="col-sm-1 control-label"></label>
									      		<div class="col-md-6 col-md-offset-4">
											  		<button type="button" class="btn btn-primary" name="btn-save" value="1" onclick="busqueda()"><?php echo $this->lang->line('buscar'); ?></button>	
										  			<input type="reset" class="btn btn-default" value="<?php echo $this->lang->line('resetear').' '.$this->lang->line('filtro'); ?>">
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
	</div>
</nav>
