<?php 
	if($aux==1){
		if($aux2==1){
			$array_n = array(
				'tab1'				=> '',
				'tab2' 				=> 'active',
				'cliente1'			=> 'active in',
				'cliente2' 			=> '',
				'cliente3' 			=> '',
			);
		}
		else if($aux2==2){
			$array_n = array(
				'tab1'				=> '',
				'tab2' 				=> 'active',
				'cliente1'			=> '',
				'cliente2' 			=> 'active in',
				'cliente3' 			=> '',
			);
		}
		else if($aux2==3){
			$array_n = array(
				'tab1'				=> '',
				'tab2' 				=> 'active',
				'cliente1'			=> '',
				'cliente2' 			=> '',
				'cliente3' 			=> 'active in',
			);
		}
	}
	else {
		$array_n = array(
				'tab1'			=> 'active',
				'tab2' 			=> '',
				'cliente1'		=> '',
				'cliente2' 		=> '',
				'cliente3' 		=> '',
		);
	}
?>

<script>
$(document).ready(function(){	
	document.body.style.background = "url(<?php echo base_url().'/img/fondo.jpg' ?>) no-repeat";
});

function eliminarDireccion($id_direccion, $id_cliente, $tipo){
	var direccion	= $id_direccion;
	var usuario 	= $id_cliente;
	var tipo		= $tipo;
    var r = confirm("¿Esta seguro que quiere eliminar este registro?");
    if (r == true) {
        $.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/direcciones/eliminarDireccion', 
		 	data: { 'direccion' 	: direccion,
	 				'usuario'		: usuario,
	 				'tipo'			: tipo, 
		 	}, 
		 	success: function(resp) { 
		 		$('.tablaDirecciones').attr('disabled',false).html(resp);
		 		
		 	}
		});
    }
}

function eliminarTelefono($id_telefono, $id_cliente, $tipo){
	var telefono	= $id_telefono;
	var usuario 	= $id_cliente;
	var tipo		= $tipo;
    var r = confirm("¿Esta seguro que quiere eliminar este registro?");
    if (r == true) {
        $.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/telefonos/eliminarTelefono', 
		 	data: { 'telefono' 		: telefono,
	 				'usuario'		: usuario,
	 				'tipo'			: tipo, 
		 	}, 
		 	success: function(resp) { 
		 		$('.tablaTelefonos').attr('disabled',false).html(resp);
		 		
		 	}
		});
    }
}

function eliminarCorreo($id_mail, $id_cliente, $tipo){
	var correo		= $id_mail;
	var usuario 	= $id_cliente;
	var tipo		= $tipo;
    var r = confirm("¿Esta seguro que quiere eliminar este registro?");
    if (r == true) {
        $.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/mails/eliminarCorreo', 
		 	data: { 'correo' 		: correo,
	 				'usuario'		: usuario,
	 				'tipo'			: tipo, 
		 	}, 
		 	success: function(resp) { 
		 		$('.tablaCorreos').attr('disabled',false).html(resp);
		 		
		 	}
		});
    }
}				
</script>
<!--
<nav class="navbar" role="navigation">
	<div class="container">
-->
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="<?php echo $array_n['tab1']; ?>"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('vendedor'); ?></a></li>
							<?php
								if($vendedores){
									foreach ($vendedores as $row){
										if($row->eliminado != 1){
							?>
					    	<li class="<?php echo $array_n['tab2']; ?>"><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('clientes'); ?></a></li>
					    	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('perfiles'); ?></a></li>
					    	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
							<?php
										}
									}
								}
							?>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane <?php echo $array_n['tab1']; ?>" id="tab1">
	    						<div class="row"><!--Cargo imagen vendedor-->
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
					                		if($vendedores){
						                    	foreach ($vendedores as $row)
 												{
 													if($row->imagen != '')
													{
														echo '<img alt="User Pic" src="'.$row->imagen.'" class="img-perfil img-circle img-responsive ">';
													}
													
													if($row->eliminado != 1)
													{
														echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#popEditar" style="margin-top: 10%">';
												  			echo $this->lang->line('editar');
														echo '</button>';
													}
												}
											}
					                	?>
									</div>
					               	<!-- Modal -->
										<div class="modal fade" id="popEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('editar').' '.$this->lang->line('vendedor'); ?></h4>
													</div>
													<?php foreach($vendedores as $row){ ?>
													<form action="<?php echo base_url()."index.php/vendedores/editarVendedor/$row->id_vendedor"?>" class="form-horizontal" method="post" enctype="multipart/form-data">
														<div class="modal-body">
											       				<div class="form-group">
																  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('contraseña'); ?></label>
																		<div class="col-sm-4 col-sm-offset-1">
																			<input type="text" name="contraseña" class="form-control" pattern="^[A-Za-z0-9 ]+$" value="<?php echo $row->contraseña ?>">	 
																		</div>
																</div>
																
																<div class="form-group">
																  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('imagen'); ?></label>
																		<div class="col-sm-4 col-sm-offset-1">
																			<input type="file" name="imagen">	 
																		</div>
																</div>	
																<?php } ?>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $this->lang->line('cancelar'); ?></button>
															<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
														</div>
											      	</form>
											    </div>
											</div>
										</div>
					                
					                <div class=" col-md-9 col-lg-9 "> 
					                	<table class="table table-striped table-user-information"> 
						                    <?php
							                    if($vendedores){
							                    	foreach ($vendedores as $row) 
								      				{
								      					if($row->eliminado != 1){
											            	echo "<tbody>";
											                echo  "<tr>";
											                echo  '<td>'.$this->lang->line('nombre').':</td>';
											                echo  '<td class="tabla-datos-importantes">'.$row->nombre.'</td>';
											                echo  "</tr>";
															echo  "<tr>";								                     
											                echo  '<td>'.$this->lang->line('apellido').':</td>';
											                echo  '<td class="tabla-datos-importantes">'.$row->apellido.'</td>';
											                echo  "</tr><tr>";	
											                echo  '<td>'.$this->lang->line('id').':</td>';
											                echo  '<td class="tabla-datos-importantes">'.$row->id_vendedor.'</td>';
											                echo  "</tr>";
															echo  "<tr>";								                     
											                echo  '<td>'.$this->lang->line('contraseña').':</td>';
											                echo  '<td class="tabla-datos-importantes">'.$row->contraseña.'</td>';
											                echo  "</tr><tr>";		
											                echo  "</tbody>";
											        	}
														else{
															echo '<div class="row">
														        	<div class="col-md-offset-3 col-sm-6 col-md-6">
														            	<div class="alert-message alert-message-danger">
														                	<h4>'.$this->lang->line('vendedor').' '.$this->lang->line('eliminado').'</h4>
														                	<p>
															               	</p>
														            	</div>
														        	</div>
																</div>';
														}
										            }
									            }
											?>
					                    </table>
					                </div>
					            </div>
					            		
					            <div id="editado">
					            	
					            </div>	
	    					</div> <!--TAB 1 INFO VENDEDOR -->
	     					<div class="tab-pane <?php echo $array_n['tab2']; ?>" id="tab2">
	     						
	     						<div class="col-sm-2">
							        <nav class="nav-tab nav-justified">
							        	<ul class="nav nav-sidebar">
							            	<li class="<?php echo $array_n['cliente1']; ?>"><a href="#cliente1" data-toggle="tab"><?php echo $this->lang->line('clientes').' '.$this->lang->line('actuales'); ?></a></li>
							                <li class="<?php echo $array_n['cliente2']; ?>"><a href="#cliente2" data-toggle="tab"><?php echo $this->lang->line('clientes').' '.$this->lang->line('no').' '.$this->lang->line('activos'); ?></a></li>
							            	<li class="<?php echo $array_n['cliente3']; ?>"><a href="#cliente3" data-toggle="tab"><?php echo $this->lang->line('agregar').' '.$this->lang->line('clientes'); ?></a></li>
							            </ul>
							    	</nav>
							    </div>
	     						
	     						<!--CLIENTES ACTUALES--->	
	     						<div class="tab-content">
		     						<div class="tab-pane fade <?php echo $array_n['cliente1']; ?>" id="cliente1">
		     							<div class="col-md-10">
											<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
										        <thead>
										            <tr>
										            	<th><?php echo $this->lang->line('id'); ?></th>
										                <th><?php echo $this->lang->line('nombre'); ?></th>
										                <th><?php echo $this->lang->line('apellido'); ?></th>
										                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
										            </tr>
										        </thead>
										 
										        <tfoot>
										            <tr>
										            	<th><?php echo $this->lang->line('id'); ?></th>
										                <th><?php echo $this->lang->line('nombre'); ?></th>
										                <th><?php echo $this->lang->line('apellido'); ?></th>
										                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
										            </tr>
										        </tfoot>
										 
										        <tbody>
										        	<?php
											        	foreach ($vendedores as $value) { 
											            	if($clientes){						                
														      	foreach ($clientes as $row) 
														      	{
														      		foreach($cruce as $key){
														      			if($key->id_cliente == $row->id_cliente && $key->eliminado==0){
																      		echo '<tr>';
																			echo '<td>'.$row->id_cliente.'</td>';
																			echo '<td>'.$row->nombre.'</td>';
																			echo "<td>".$row->apellido."</td>";
																			echo "<td style='text-align: center;'><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='btn btn-info btn-xs' style='margin : 0 5px'>";
																			echo '<i class="fa fa-search"></i>';
																			echo "</a>";
																			echo "<a href='".base_url()."index.php/Vendedores/sacarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-danger btn-xs' role='button'>";
																			echo '<i class="fa fa-minus"></i>';
																			echo "</a></td>";;
																			echo "</tr>";
																		}
																	}
																}
															}
														}
												 	?>
										        </tbody>
										    </table>
										</div>
		     						</div>
	     							
	     							<!--CLIENTES NO ACTIVOS--->
	     							<div class="tab-pane fade <?php echo $array_n['cliente2']; ?>" id="cliente2">
		     							<div class="col-md-10">
											<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
										        <thead>
										            <tr>
										            	<th><?php echo $this->lang->line('id'); ?></th>
										                <th><?php echo $this->lang->line('nombre'); ?></th>
										                <th><?php echo $this->lang->line('apellido'); ?></th>
										                <th><?php echo $this->lang->line('date'); ?></th>
										                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
										            </tr>
										        </thead>
										 
										        <tfoot>
										            <tr>
										            	<th><?php echo $this->lang->line('id'); ?></th>
										                <th><?php echo $this->lang->line('nombre'); ?></th>
										                <th><?php echo $this->lang->line('apellido'); ?></th>
										                <th><?php echo $this->lang->line('date'); ?></th>
										                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
										            </tr>
										        </tfoot>
										 
										        <tbody>
										        	<?php 
										            	if($clientes){							                
													      	foreach ($clientes as $row) 
													      	{
													      		foreach($cruce as $key){
													      			if($key->id_cliente == $row->id_cliente && $key->eliminado==1){
															      		echo '<tr>';
																		echo '<td>'.$row->id_cliente.'</td>';
																		echo '<td>'.$row->nombre.'</td>';
																		echo "<td>".$row->apellido."</td>";
																		echo '<td>'.$row->date_add.'</td>';
																		echo "<td style='text-align: center;'><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='btn btn-info btn-xs' style='margin : 0 5px'>";
																		echo '<i class="fa fa-search"></i>';
																		echo "</a>";
																		echo '<a href="'.base_url().'index.php/Vendedores/volverCargarCliente/'.$row->id_cliente.'/'.$value->id_vendedor.'" class="btn btn-success btn-xs" role="button">';
																		echo '<i class="fa fa-plus"></i>';
																		echo "</a></td>";
																		echo "</tr>";
																	}
																}
															}
														}
												 	?>
										        </tbody>
										    </table>
											
										</div>
		     						</div>
	     						
	     							<!--AGREGAR CLIENTES--->
	     							<div class="tab-pane fade <?php echo $array_n['cliente3']; ?>" id="cliente3">
		     							<div class="col-md-10">
		     								<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
											        <thead>
											            <tr>
											            	<th><?php echo $this->lang->line('id'); ?></th>
											                <th><?php echo $this->lang->line('nombre'); ?></th>
											                <th><?php echo $this->lang->line('apellido'); ?></th>
											                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
											            </tr>
											        </thead>
											 
											        <tfoot>
											            <tr>
											            	<th><?php echo $this->lang->line('id'); ?></th>
											                <th><?php echo $this->lang->line('nombre'); ?></th>
											                <th><?php echo $this->lang->line('apellido'); ?></th>
											                <th style="text-align: center"><?php echo $this->lang->line('acciones'); ?></th>
											            </tr>
											        </tfoot>
											 
											        <tbody>
											        	<?php
											        		foreach($vendedores as $value)
											        		{	
											        			if($clientes_todo)
											        			{
											        				if($clientes)
											        				{			                
																      	foreach ($clientes_todo as $row) 
																      	{
																      		$bandera = 0;
																      		foreach($clientes as $key)		
																			{
																				if($row->id_cliente == $key->id_cliente)
																      				$bandera = 1;
																			}
																			if($bandera == 0){
																				
																				echo '<tr>';
																				echo '<td>'.$row->id_cliente.'</td>';
																				echo '<td>'.$row->nombre.'</td>';
																				echo "<td>".$row->apellido."</td>";
																				echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/cargarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-success btn-xs' role='button'>";
																				echo '<i class="fa fa-plus"></i>';
																				echo "</a></td>";
																				echo "</tr>";
																				
																			}
																		}
																	}
																	else
																	{
																		foreach ($clientes_todo as $row) 
																	    {
																			echo '<tr>';
																			echo '<td>'.$row->id_cliente.'</td>';
																			echo '<td>'.$row->nombre.'</td>';
																			echo "<td>".$row->apellido."</td>";
																			echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/cargarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-success btn-xs' role='button'>";
																			echo '<i class="fa fa-plus"></i>';
																			echo "</a></td>";
																			echo "</tr>";
																		}
																	}
																}	
															}
													 	?>
											        </tbody>
			     								</table>
		     							</div>
		     						</div>
		     						
							    </div>
	    					</div><!--TAB 2 CLIENTES VENDEDOR -->
	    					
	    					<!--TAB 3 PERFILES VENDEDOR -->
	    					<div class="tab-pane fade" id="tab3">
	     						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="padding-top: 20px">
								  <!--TAB 3 TELEFONOS VENDEDOR -->
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								         	<?php echo $this->lang->line('telefonos'); ?>
								        </a>
								      </h4>
								    </div>
								    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								        <div class="row">
								        	<?php
								        	if($telefonos){
								        	?>	
												<div class="col-md-12">
													<?php
														if($vendedores){
												        	foreach ($vendedores as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/telefonos/telefonos/'.$row->id_vendedor.'/2">';
																echo '<span class="ui-button-text ">';
																echo $this->lang->line('añadir').' '.$this->lang->line('telefono').'</span>';
																echo "</a>";
																echo "</div>";
																echo '<div style="height:10px;"></div>';
															}
														}
													?>
													<div class="tablaTelefonos">
							     						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
													        <thead>
													            <tr>
													            	<th><?php echo $this->lang->line('cod_area'); ?></th>
													            	<th><?php echo $this->lang->line('telefonos'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('fax'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </thead>
													 
													        <tfoot>
													            <tr>
													            	<th><?php echo $this->lang->line('cod_area'); ?></th>
													            	<th><?php echo $this->lang->line('telefonos'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('fax'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </tfoot>
													 
													        <tbody>
													        	<?php 
													            	if($telefonos){							                
																      	foreach ($telefonos as $row) 
																      	{
																      		foreach ($vendedores as $key) {
																	      		echo '<tr>';
																				echo '<td>'.$row->cod_area.'</td>';
																				echo '<td>'.$row->telefono.'</td>';
																				echo '<td>'.$row->tipo.'</td>';
																				if($row->fax == 0)
																					echo "<td>NO</td>";
																				else
																					echo "<td>SI</td>";
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<td style="text-align: center;">';
																				echo '<a href="'.base_url().'index.php/telefonos/cargaEditar/'.$row->id_telefono.'/'.$key->id_vendedor.'/2"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarTelefono('.$row->id_telefono.','.$key->id_vendedor.',2)"';
																				echo 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('eliminar').'">';
																				echo '<i class="fa fa-minus"></i>';
																				echo '</a>';
																				echo '</td>';
																				echo "</tr>";
																			}
																		}
																	}
															 	?>
													        </tbody>
													    </table>
													</div>
												</div>
											<?php
											}
											else{
											
											?>
											<?php
						     					if($vendedores){
												 	foreach ($vendedores as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY TELÉFONO RELACIONADO CON EL VENDEDOR</h4>
													                <p>
													                	<a class="btn btn-default" href="<?php echo base_url().'index.php/telefonos/telefonos/'.$row->id_vendedor.'/2'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('telefono'); ?></a>
																	</p>
													            </div>
													        </div>
														</div>
											<?php	
													}/*---FOREACH---*/
												}/*---IF CLIENTES---*/
											}/*---ELSE---*/
											?>
										</div>
								      </div>
								    </div>
								  </div>
								  
								  <!--TAB 3 DIRECCIONES VENDEDOR -->
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingTwo">
								      <h4 class="panel-title">
								        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								        	<?php echo $this->lang->line('direcciones'); ?>
								        </a>
								      </h4>
								    </div>
								    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								      <div class="panel-body">
								      	<div class="row">
								      		<?php
								        	if($direcciones){
								        	?>
												<div class="col-md-12">
													<?php
														if($vendedores){
												        	foreach ($vendedores as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/direcciones/direcciones/'.$row->id_vendedor.'/2">';
																echo '<span class="ui-button-text">';
																echo $this->lang->line('añadir').' '.$this->lang->line('direccion').'</span>';
																echo "</a>";
																echo "</div>";
																echo '<div style="height:10px;"></div>';
															}
														}
													?>
													<div class="tablaDirecciones">
														<table class="table table-striped table-bordered" cellspacing="0" width="100%">
													        <thead>
													            <tr>
													            	<th><?php echo $this->lang->line('direccion'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('departamento'); ?></th>
													                <th><?php echo $this->lang->line('provincia'); ?></th>
													                <th><?php echo $this->lang->line('pais'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </thead>
													 
													        <tfoot>
													            <tr>
													            	<th><?php echo $this->lang->line('direccion'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('departamento'); ?></th>
													                <th><?php echo $this->lang->line('provincia'); ?></th>
													                <th><?php echo $this->lang->line('pais'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </tfoot>
													 
													        <tbody>
													        	<?php 
													            	if($direcciones){							                
																      	foreach ($direcciones as $row) 
																      	{
																      		foreach ($vendedores as $key) 
													    					{		
																	      		echo '<tr>';
																				echo '<td>'.$row->direccion.'</td>';
																				echo '<td>'.$row->tipo.'</td>';
																				echo '<td>'.$row->nombre_departamento.'</td>';
																				echo '<td>'.$row->nombre_provincia.'</td>';
																				echo '<td>'.$row->nombre_pais.'</td>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<td style="text-align: center;">';
																				echo '<a href="'.base_url().'index.php/direcciones/cargaEditar/'.$row->id_direccion.'/'.$key->id_vendedor.'/2"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarDireccion('.$row->id_direccion.','.$key->id_vendedor.',2)"';
																				echo 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('eliminar').'">';
																				echo '<i class="fa fa-minus"></i>';
																				echo '</a>';
																				echo '</td>';
																				echo "</tr>";
																			}
																		}
																	}
															 	?>
													        </tbody>
													    </table>
													</div>
												</div>
											<?php
											}
											else{
											
											?>
											<?php
						     					if($vendedores){
												 	foreach ($vendedores as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY DIRECCIÓN RELACIONADA CON EL VENDEDOR</h4>
													                <p>
													                	<a class="btn btn-default" href="<?php echo base_url().'index.php/direcciones/direcciones/'.$row->id_vendedor.'/2'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('direccion'); ?></a>
																	</p>
													            </div>
													        </div>
														</div>
											<?php	
													}/*---FOREACH---*/
												}/*---IF CLIENTES---*/
											}/*---ELSE---*/
											?>
										</div>
								      </div>
								    </div>
								  </div>
								  <!--TAB 3 CORREOS VENDEDOR -->
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingThree">
								      <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
								         	<?php echo $this->lang->line('correos'); ?>
								        </a>
								      </h4>
								    </div>
								    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								      <div class="panel-body">
								        <div class="row">
								        	<?php
								        	if($mails){
								        	?>
												<div class="col-md-12">
													<?php
														if($vendedores){
												        	foreach ($vendedores as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/mails/mails/'.$row->id_vendedor.'/2">';
																echo '<span class="ui-button-text">';
																echo $this->lang->line('añadir').' '.$this->lang->line('correo').'</span>';
																echo "</a>";
																echo "</div>";
																echo '<div style="height:10px;"></div>';
															}
														}
													?>
													<div class="tablaCorreos">
							     						<table class="table table-striped table-bordered" cellspacing="0" width="100%">
													        <thead>
													            <tr>
													            	<th><?php echo $this->lang->line('correo'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </thead>
													 
													        <tfoot>
													            <tr>
													            	<th><?php echo $this->lang->line('correo'); ?></th>
													                <th><?php echo $this->lang->line('tipo'); ?></th>
													                <th><?php echo $this->lang->line('acciones'); ?></th>
													            </tr>
													        </tfoot>
													 
													        <tbody>
													        	<?php 
													            	if($mails){							                
																      	foreach ($mails as $row) 
																      	{
																      		foreach ($vendedores as $key) {
																	      		echo '<tr>';
																				echo '<td>'.$row->mail.'</td>';
																				echo '<td>'.$row->tipo.'</td>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<td style="text-align: center;">';
																				echo '<a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_vendedor.'/2"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarCorreo('.$row->id_mail.','.$key->id_vendedor.',2)"';
																				echo 'class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('eliminar').'">';
																				echo '<i class="fa fa-minus"></i>';
																				echo '</a>';
																				echo '</td>';
																				echo "</tr>";
																			}
																		}
																	}
															 	?>
													        </tbody>
													    </table>
													</div>
												</div>
											<?php
											}
											else{
											
											?>
											<?php
						     					if($vendedores){
												 	foreach ($vendedores as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY CORREO RELACIONADO CON EL VENDEDOR</h4>
													                <p>
														                <a class="btn btn-default" href="<?php echo base_url().'index.php/mails/mails/'.$row->id_vendedor.'/2'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('correo'); ?></a>
																	</p>
													            </div>
													        </div>
														</div>
											<?php	
													}/*---FOREACH---*/
												}/*---IF CLIENTES---*/
											}/*---ELSE---*/
											?>
										</div>
								      </div>
								    </div>
								  </div>
								</div>
	     						
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab4">
	     						<!--TAB 4 PANEL DE PEDIDOS -->
	     						PEDIDOS
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 PANEL DE PRESUPUESTOS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('cliente'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('cliente'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($presupuestos){							                
										      	foreach ($presupuestos as $row) 
										     	{
										    		echo '<tr>';
													echo "<td><a href='".base_url()."index.php/Presupuestos/pestanas/".$row->id_presupuesto."' class='displayblock'>".$row->id_presupuesto.'</a></td>';
													echo '<td>'.$row->estado.'</td>';
													echo "<td><a href='".base_url()."index.php/Visitas/carga/".$row->id_visita."/0' class='displayblock'>".$row->id_visita.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
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
	    					
	    					<div class="tab-pane fade" id="tab6">
	     						<!--TAB 6 ALARMAS -->
	     						ALARMAS
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
