<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">VENDEDOR</a></li>
					    	<li><a href="#tab2" data-toggle="tab">Clientes</a></li>
					    	<li><a href="#tab3" data-toggle="tab">Pedidos</a></li>
					    	<li><a href="#tab4" data-toggle="tab">Busqueda</a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane active" id="tab1">
	    						
	    						<div class="row"><!--Cargo imagen vendedor-->
	    							
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
						                    	foreach ($vendedores as $row) 
							      				{
					                				echo '<img alt="User Pic" src="'.base_url().'img/vendedores/User'.$row->id_vendedor.'.jpg" class="img-circle img-responsive">';
					                			}
					                	?> 
					                </div>
					                
					                <div class=" col-md-9 col-lg-9 "> 
					                	<table class="table table-user-information"> 
						                    <?php
						                    	foreach ($vendedores as $row) 
							      				{
									            	echo "<tbody>";
									                echo  "<tr>";
									                echo  "<td>Nombre:</td>";
									                echo  '<td>'.$row->nombre.'</td>';
									                echo  "</tr>";
													echo  "<tr>";								                     
									                echo  "<td>Apellido:</td>";
									                echo  '<td>'.$row->apellido.'</td>';
									                echo  "</tr><tr>";	
									                echo  "<td>ID:</td>";
									                echo  '<td>'.$row->id_vendedor.'</td>';
									                echo  "</tr><tr>";	
									                echo  "</tbody>";
									            }
											?>
					                    </table>
					                </div>
					            </div>
					            			
	    					</div> <!--TAB 1 INFO VENDEDOR -->
	     					<div class="tab-pane" id="tab2">
	     						
	     						<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th>ID</th>
							                <th>Nombre</th>
							                <th>Apellido</th>
							                <th>Date</th>
							                <th>Eliminado</th>
							                <th>Eliminado</th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th>ID</th>
							                <th>Nombre</th>
							                <th>Apellido</th>
							                <th>Date</th>
							                <th>Eliminado</th>
							                <th>Eliminado</th>
							            </tr>
							        </tfoot>
							 
							        <tbody>
							        	<?php 
							            	if($clientes){							                
										      	foreach ($clientes as $row) 
										      	{
										      		echo '<tr>';
													echo '<td>'.$row->id_cliente.'</td>';
													echo '<td>'.$row->nombre.'</td>';
													echo "<td>".$row->apellido."</td>";
													echo '<td>'.$row->date_add.'</td>';
													echo "<td>".$row->eliminado."</td>";
													echo "<td style='text-align: center;'><a href='".base_url()."index.php/Clientes/clientes_pestanas/".$row->id_cliente."' class='btn btn-default'>Ver</a></td>";
													echo "</a></tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
							    
	    					</div><!--TAB 2 CLIENTES VENDEDOR -->
	    					<div class="tab-pane" id="tab3">
	     						Panel 3
	    					</div>
	    					<div class="tab-pane" id="tab4">
	     						panel 4
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
