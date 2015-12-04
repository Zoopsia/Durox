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
if(isset($css_files)){
	foreach($css_files as $file){
		echo '<link type="text/css" rel="stylesheet" href="'.$file.'" />';
	} 	
} 
if(isset($js_files)){
	foreach($js_files as $file){
	echo '<script src="'.$file.'"></script>';
	}
}
?>




<?php $array_n = pestañaActiva($this->uri->segment(3));?>	
<!--
<nav class="navbar" role="navigation">
	<div class="container">
	-->
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-pills">
							<li class="<?php echo $array_n['listado']?>"><a href="<?php echo base_url().'index.php/visitas/visitas_abm/tab1'?>"><?php echo $this->lang->line('visitas'); ?></a></li>
					    	<li class="pull-right <?php echo $array_n['busqueda']?>"><a href="<?php echo base_url().'index.php/visitas/visitas_abm/tab2'?>" ><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
						</ul>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<!--TABLA PRINCIPAL CON PEDIDOS-->
		  					<div class="tab-pane <?php echo $array_n['listado']?>" id="tab1">
	    						<!--
	    						<div class="row">
		    						<div class="col-md-1">
		    							<a role="button" class="btn btn-success" href="<?php echo base_url().'index.php/Visitas/carga/'; ?>">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											<span class="ui-button-text"><?php echo $this->lang->line('agregar').' '.$this->lang->line('visita'); ?></span>
										</a>
		    						</div>
	    						</div>
	    						-->
	    						
	    						<div>
	    							<?php echo $output; ?>
	    						</div>
	    					</div>
	    					<!--BUSQUEDA AVANZADA DE PEDIDOS-->
	    					
	    					<div class="tab-pane <?php echo $array_n['busqueda']?>" id="tab2">
	    						<div class="panel panel-default">
									<div class="panel-body">
								    	<form class="form-inline">
											<label class="col-md-1">
												<?php echo $this->lang->line('clientes');?>
											</label>
											<div class="col-md-5">	
										    	<select class="form-control col-md-6" id="clientes">
										    		<option value=""></option>
										    		<?php 
										    		foreach ($clientes as $row) {
														echo '<option>'.$row->razon_social.'</option>';
													}
													?>
										    	</select>
										    </div>
										    <label class="col-md-1">
												<?php echo $this->lang->line('vendedores');?>
											</label>
											<div class="col-md-5">	
										    	<select class="form-control col-md-6" id="clientes">
										    		<option value=""></option>
										    		<?php 
										    		foreach ($vendedores as $row) {
														echo '<option>'.$row->nombre.' '.$row->apellido.'</option>';
													}
													?>
										    	</select>
										    </div>
										  	
										  	<div class="form-group">
										  		<label for="exampleInputEmail2"></label>
										  		<button type="submit" class="btn btn-default">Buscar</button>
										  	</div>
										</form>
									</div>
								</div>	
	    					</div>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>  
		<!--  
	</div>
</nav>
-->
<script>
$(function() {
	startTime();
    $(".center").center();
    $(window).resize(function() {
    	$(".center").center();
    });
});
</script>
