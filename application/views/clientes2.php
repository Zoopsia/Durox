<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Clientes</a></li>
					    	<li><a href="#tab2" data-toggle="tab">Vendedores</a></li>
					    	<li><a href="#tab3" data-toggle="tab">Pedidos</a></li>
					    	<li><a href="#tab4" data-toggle="tab">Busqueda</a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane active" id="tab1">
	    						<?php 
							      	foreach ($clientes as $row) 
							      	{
									 	echo "Nombre: "."<input type='text' name='nombre_cliente' value='$row->nombre' >";
										echo "<br><br>";
										echo "Apellido: "."<input type='text' name='apellido_cliente' value='$row->apellido' >";
									}
							    ?>
	    					</div>
	     					<div class="tab-pane" id="tab2">
	     						
	     						<table id="example" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
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
												 	//echo '<a href="'.base_url().'index.php/Clientes/prueba2/'.$row->id_vendedor.'">';
													echo '<td>'.$row->id_vendedor.'</td>';
													echo '<td>'.$row->nombre.'</td>';
													echo "<td>".$row->apellido."</td>";
													echo '<td>'.$row->date_add.'</td>';
													echo "<td>".$row->eliminado."</td>";
													echo "<td><a href='".$row->id_vendedor."' class='btn btn-default'>Ver</a></td>";
													echo "</a></tr>";
												}
											}

									 	?>
							        </tbody>
							    </table>
							    
	    					</div>
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
