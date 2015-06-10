<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			
		  			<div class="panel-body">
		  				
		  				
		  				<?php 
					      	foreach ($clientes as $row) 
					      	{
							 	echo "Nombre: "."<input type='text' name='nombre_cliente' value='$row->nombre_cliente' >";
								echo "<br><br>";
								echo "Apellido: "."<input type='text' name='apellido_cliente' value='$row->apellido_cliente' >";
							}
					    ?>
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
