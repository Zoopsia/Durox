<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Clientes</a></li>
					    	<li><a href="#tab2" data-toggle="tab">Pedidos</a></li>
					    	<li><a href="#tab3" data-toggle="tab">Vendedores</a></li>
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
	     						panel 2
	    					</div>
	    					<div class="tab-pane" id="tab3">
	     						<?php 
							      	foreach ($perros as $row) 
							      	{
									 	echo "Nombre: ".$row->nombre."   "."Apellido: ".$row->apellido;
										echo "<br><br>";
									}
							    ?>
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
