<script>
$(function() {
    var availableTags = [
      <?php
      	if($productos){	
      		foreach ($productos as $row) {
				echo '"'.$row->nombre.'",';
		  	}
		}
      ?>
      ""
    ];
    $( "#producto" ).autocomplete({
      source: availableTags
    });
  });
</script>


<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#presupuestos" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#pedidos" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
						</ul>
		  			</div>
		  			
					<div class="panel-body">
						<?php
							if($visita){?>
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="alert alert-success alert-dismissible" role="alert">
					  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  						La visita <a href="#"><?php echo $visita; ?></a> fué insertada con exito
										</div>	
									</div>
								</div>
						<?php } ?>
						
						<div class="tab-content">
	    					<div class="tab-pane fade in active" id="presupuestos">
	    						<?php
	    							if($presupuesto){
	    						?>		
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-success">
									                <h4>PRESUPUESTO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="#"><?php echo $this->lang->line('ver').' '.$this->lang->line('presupuesto'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php	
	    							}
									else {
								?>
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PRESUPUESTO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="<?php echo base_url().'index.php/Presupuestos/carga/'.$visita; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('presupuesto'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php
									}	
								?>
	    					</div>
	    					<div class="tab-pane fade" id="pedidos">
	    						<?php
	    							if($pedido){
	    						?>		
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-success">
									                <h4>PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="#"><?php echo $this->lang->line('ver').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php	
	    							}
									else {
								?>
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="<?php echo base_url().'index.php/Pedidos/carga/'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php
									}	
								?>
	    					</div>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
