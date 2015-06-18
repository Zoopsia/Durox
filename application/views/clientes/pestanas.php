<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab">CLIENTE</a></li>
					    	<li><a href="#tab2" data-toggle="tab">Vendedores</a></li>
					    	<li role="presentation" class="dropdown">
							    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							      Perfiles <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu" role="menu">
							     	<li><a href="#tab3" data-toggle="tab">Telefonos</a></li>
							     	<li><a href="#tab4" data-toggle="tab">Direcciones</a></li>
							     	<li><a href="#tab5" data-toggle="tab">E-mails</a></li>
							    </ul>
							</li>
					    		
					    	<li><a href="#tab6" data-toggle="tab">Pedidos</a></li>
					    	<li><a href="#tab7" data-toggle="tab">Presupuestos</a></li>
					    	<li><a href="#tab8" data-toggle="tab">Alarmas</a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane active" id="tab1">
	    					<!--INFO GRAL DEL CLIENTE-->	
	    						<div class="row">
	    							
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
						                    	foreach ($clientes as $row) 
							      				{
					                				echo '<img alt="User Pic" src="'.base_url().'img/clientes/User'.$row->id_cliente.'.jpg" class="img-circle img-responsive">';
					                			}
					                	?> 
					                </div>
					                
					                <div class=" col-md-9 col-lg-9 "><!--carga info cliente-->
					                	<table class="table table-striped table-user-information"> 
						                    <?php
						                    	foreach ($clientes as $row) 
							      				{
									            	echo "<tbody>";
									                echo  "<tr>";
									                echo  "<td>Nombre:</td>";
									                echo  '<td class="tabla-datos-importantes">'.$row->nombre.'</td>';
									                echo  "</tr>";
													echo  "<tr>";								                     
									                echo  "<td>Apellido:</td>";
									                echo  '<td class="tabla-datos-importantes">'.$row->apellido.'</td>';
									                echo  "</tr><tr>";	
									                echo  "<td>Cuit:</td>";
									                echo  '<td class="tabla-datos-importantes">'.$row->cuit.'</td>';
									                echo  "</tr><tr>";	
									                echo  "<td>Razón Social:</td>";
									                echo  '<td class="tabla-datos-importantes">'.$row->razon_social.'</td>';
									                echo  "</tr>";	
									                echo  "</tbody>";
									            }
											?>
					                    </table>
					                </div>
					            </div>
					            			
	    					</div> <!--TAB 1 INFO CLIENTE -->
	     					<div class="tab-pane" id="tab2">
	     					<!--TABLA DE VENDEDORES CON RESPECTO AL CLIENTE-->	
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
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
							            	if($vendedores){							                
										      	foreach ($vendedores as $row) 
										      	{
										      		echo '<tr>';
													echo '<td>'.$row->id_vendedor.'</td>';
													echo '<td>'.$row->nombre.'</td>';
													echo "<td>".$row->apellido."</td>";
													echo '<td>'.$row->date_add.'</td>';
													echo "<td>".$row->eliminado."</td>";
													echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='btn btn-info btn-xs'>Ver</a></td>";
													echo "</a></tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
							    
	    					</div><!--TAB 2 VENDEDORES CLIENTE -->
	    				
	    					<div class="tab-pane" id="tab3">
	     						<!--TAB 3 TELEFONOS CLIENTE -->
	     						
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th>Teléfono</th>
							                <th>Tipo</th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th>Teléfono</th>
							                <th>Tipo</th>
							            </tr>
							        </tfoot>
							 
							        <tbody>
							        	<?php 
							            	if($telefonos){							                
										      	foreach ($telefonos as $row) 
										      	{
										      		echo '<tr>';
													echo '<td>'.$row->telefono.'</td>';
													echo '<td>'.$row->tipo.'</td>';
													//echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/vendedores_pestanas/".$row->id_vendedor."' class='btn btn-default'>Ver</a></td>";
													//echo "</a></tr>";
													echo "</tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
							    
	    					</div>
	    					<div class="tab-pane" id="tab4">
	     						<!--TAB 4 DIRECCIONES CLIENTE -->
	     						
								<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th>Dirección</th>
							                <th>Tipo</th>
							                <th>Departamento</th>
							                <th>Provincia</th>
							                <th>País</th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th>Dirección</th>
							                <th>Tipo</th>
							                <th>Departamento</th>
							                <th>Provincia</th>
							                <th>País</th>
							            </tr>
							        </tfoot>
							 
							        <tbody>
							        	<?php 
							            	if($direcciones){							                
										      	foreach ($direcciones as $row) 
										      	{
										      		echo '<tr>';
													echo '<td>'.$row->direccion.'</td>';
													echo '<td>'.$row->tipo.'</td>';
													echo '<td>'.$row->nombre_departamento.'</td>';
													echo '<td>'.$row->nombre_provincia.'</td>';
													echo '<td>'.$row->nombre_pais.'</td>';
													//echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/vendedores_pestanas/".$row->id_vendedor."' class='btn btn-default'>Ver</a></td>";
													//echo "</a></tr>";
													echo "</tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
	    					</div>
	    					<div class="tab-pane" id="tab5">
	     						<!--TAB 5 E-MAILS CLIENTE -->
	     						
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th>Correo</th>
							                <th>Tipo</th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th>Correo</th>
							                <th>Tipo</th>
							            </tr>
							        </tfoot>
							 
							        <tbody>
							        	<?php 
							            	if($mails){							                
										      	foreach ($mails as $row) 
										      	{
										      		echo '<tr>';
													echo '<td>'.$row->mail.'</td>';
													echo '<td>'.$row->tipo.'</td>';
													//echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/vendedores_pestanas/".$row->id_vendedor."' class='btn btn-default'>Ver</a></td>";
													//echo "</a></tr>";
													echo "</tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
	    					</div>
	    					
	    					<div class="tab-pane" id="tab6">
	     						<!--TAB 6 PANEL DE PEDIDOS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th>Pedido</th>
							                <th>Vendedor</th>
							                <th>Fecha</th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th>Pedido</th>
							                <th>Vendedor</th>
							                <th>Fecha</th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($pedidos){							                
										      	foreach ($pedidos as $row) 
										     	{
										    		echo '<tr>';
													echo '<td><a href="#">'.$row->id_pedido.'</a>';
													echo "</td>";
													echo "<td><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."'>".$row->v_nombre.'</a>';
													echo "</td>";
													echo '<td>'.$row->date_add;
													echo "</td>";
													//echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/vendedores_pestanas/".$row->id_vendedor."' class='btn btn-default'>Ver</a></td>";
													//echo "</a></tr>";
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table> 
	    					</div>
	    					
	    					<div class="tab-pane" id="tab7">
	     						<!--TAB 7 PANEL DE PRESUPUESTOS -->
	     						PRESUPUESTOS
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
