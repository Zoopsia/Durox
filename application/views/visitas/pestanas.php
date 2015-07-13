<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('pedido'); ?></a></li>
					    	<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('vendedores'); ?></a></li>
					    	<li role="presentation" class="dropdown">
							    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							      <?php echo $this->lang->line('perfiles'); ?> <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu" role="menu">
							     	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('telefonos'); ?></a></li>
							     	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('direcciones'); ?></a></li>
							     	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('correos'); ?></a></li>
							    </ul>
							</li>
					    		
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab7" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab8" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane active" id="tab1">
	    					<!--INFO GRAL DEL PEDIDO-->	
	    						<div class="row">
					                <div class=" col-md-12 col-lg-12 "><!--carga info pedido-->
					                	<table class="table table-striped table-bordered" cellspacing="0" width="100%">
									        <thead>
									            <tr>
									            	<th><?php echo $this->lang->line('nombre'); ?></th>
									                <th><?php echo $this->lang->line('cantidad'); ?></th>
									                <th><?php echo $this->lang->line('precio'); ?></th>
									                <th><?php echo $this->lang->line('estado'); ?></th>
									            </tr>
									        </thead>
									 
									        <tbody>
									        	<?php 
									            	if($pedidos){							                
												      	foreach ($pedidos as $row) 
												      	{
												      		echo '<tr>';
															echo '<td>'.$row->nombre.'</td>';
															echo '<td>'.$row->cantidad.'</td>';
															echo "<td>".$row->precio."</td>";
															echo '<td>'.$row->estado.'</td>';
															echo "</tr>";
														}
													}
											 	?>
									        </tbody>
							    		</table>
					                </div>
					            </div>
					            			
	    					</div> 
	     					<div class="tab-pane" id="tab2">
	     						<!--TAB 2-->
    
	    					</div>
	    					<div class="tab-pane" id="tab3">
	     						<!--TAB 3-->
							    
	    					</div>
	    					<div class="tab-pane" id="tab4">
	     						<!--TAB 4-->
	     						
	    					</div>
	    					<div class="tab-pane" id="tab5">
	     						<!--TAB 5-->
	     						
	    					</div>	
	    					<div class="tab-pane" id="tab6">
	     						<!--TAB 6-->
	     						
	    					</div>
	    					<div class="tab-pane" id="tab7">
	     						<!--TAB 7 -->
	     						
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>