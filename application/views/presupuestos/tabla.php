<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

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
							<li class="<?php echo $array_n['listado']?>"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li class="pull-right <?php echo $array_n['busqueda']?>"><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
						</ul>
		  			</div>
		  			
		  			<div class="panel-body">
		  				<div class="tab-content">
		  					<!--TABLA PRINCIPAL CON PEDIDOS-->
		  					<!--
		  					<div class="row">
		    					<div class="col-md-1">
		    						<a role="button" class="btn btn-success" href="<?php echo base_url().'index.php/Presupuestos/carga/'; ?>">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<span class="ui-button-text"><?php echo $this->lang->line('agregar').' '.$this->lang->line('presupuesto'); ?></span>
									</a>
		    					</div>
	    					</div>
		  					-->
		  					
		  					<div class="tab-pane <?php echo $array_n['listado']?>" id="tab1">
	    						<?php echo $output; ?>
	    					</div>
	    					<!--BUSQUEDA AVANZADA DE PEDIDOS-->
	    					<div class="tab-pane <?php echo $array_n['busqueda']?>" id="tab2">
	    						BUSQUEDA
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