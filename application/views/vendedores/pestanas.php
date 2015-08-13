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
function editable(){
	$("#confirm_contraseña").removeClass("displaynone");
	$("#td_confirmar").html('Confirmar Contraseña');
	$(".cambio").removeAttr("disabled");
	$(".cambio").removeClass("editable");
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	$('#btn-editar').hide();
	$('#btn-eliminar').hide();
	$('#btn-print').hide();
	$('#span').show();
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true) {
    	$("#confirm_contraseña").addClass("displaynone");
    	$("#confirm_contraseña").removeAttr("required");
    	$("#confirm_contraseña").val('');
		$("#td_confirmar").html('');
		$(".cambio").attr("disabled", true);
		$(".cambio").addClass("editable");
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#btn-eliminar').show();
		$('#btn-editar').show();
		$('#btn-print').show();
		<?php
			if($vendedores){
				foreach($vendedores as $row){
					echo "$('#nombre').val('".$row->nombre."');";
					echo "$('#apellido').val('".$row->apellido."');";
					echo "$('#contraseña').val('".$row->contraseña."');";											
				}	
			}
		?>
	}
}

function eliminar($id){
	var r = confirm("¿Esta seguro que quiere eliminar el registro?");
    if (r == true) {
		window.location.assign("/Durox/index.php/Vendedores/delete_user/"+$id);
	}
}

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

function confirmarContraseña(){
	
	var contraseña  = $('#contraseña').val();
	<?php
	if($vendedores){
		foreach($vendedores as $row){
			echo "var aux = '".$row->contraseña."';";
		}
	}
	?>
	
	//----VER-----//
	if(contraseña != aux){
		if($('#contraseña').val() != $('#confirm_contraseña').val()){
			$("#confirm_contraseña").attr("required", true);
			alert("Las contraseñas no coinciden!");
			$("#confirm_contraseña").focus();
			return false;
		}
		else{
			return true;
		}
	}
}

			
</script>


<?php
$bandera = 0;
?>
<!--
<nav class="navbar" role="navigation">
	<div class="container">
-->
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading no-print">
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
					                	<?php if($vendedores) { ?>
					                	<form id="formulario" action="<?php echo base_url()."index.php/vendedores/editarVendedor/$row->id_vendedor"?>" class="form-horizontal" method="post" onsubmit="return confirmarContraseña()"enctype="multipart/form-data"> 
					                	<?php } ?>
					                	<?php
					                		if($vendedores){
						                    	foreach ($vendedores as $row)
 												{
 													if($row->imagen != '')
													{
														echo '<img alt="User Pic" src="'.$row->imagen.'" class="img-perfil img-circle img-responsive ">';
													}
												}
											}
					                	?>
					                	<span id="span" class="btn btn-dropbox btn-file editable cambio" style="display: none">
					                		<?php echo $this->lang->line('imagen');?>
											<input type="file" id="imagen" class="form-group editable cambio" name="imagen">	 
										</span>
											
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
											                echo  '<td class="padtop" style="width: 209px">'.$this->lang->line('nombre').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="nombre" name="nombre" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre.'" maxlength="128" disabled placeholder="'.$this->lang->line('nombre').'" autocomplete="off" required></td>';
											                echo  "</tr>";
															echo  "<tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('apellido').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="apellido" name="apellido" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->apellido.'" maxlength="128" disabled placeholder="'.$this->lang->line('apellido').'" autocomplete="off" required></td>';
											                echo  "</tr><tr class='no-print'>";	
											                echo  '<td class="padtop">'.$this->lang->line('id').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="id" class="form-control editable"  value="'.$row->id_vendedor.'" autocomplete="off" disabled style="width: 300px !important;"></td>';
											                echo  "</tr>";
															echo  "<tr class='no-print'>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('contraseña').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="contraseña" id="contraseña" class="form-control editable cambio" pattern="^[A-Za-z0-9 ]+$" value="'.$row->contraseña.'" placeholder="'.$this->lang->line('contraseña').'" autocomplete="off" disabled required></td>';
											                echo  "</tr>";	
											                echo  "<tr class='no-print'>";								                     
											                echo  '<td class="padtop transparente" id="td_confirmar"></td>';
											                echo  '<td class="tabla-datos-importantes transparente"><input type="text" name="confirm_contraseña" id="confirm_contraseña" class="form-control editable cambio displaynone" pattern="^[A-Za-z0-9 ]+$" value="" placeholder="'.$this->lang->line('confirmar').' '.$this->lang->line('contraseña').'" autocomplete="off" disabled></td>';
											                echo  "</tr>";	
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
															$bandera = 1;
														}
										            }
									            }
											?>
					                    </table>
					                </div>
					            </div>
					            
					            <?php
					            if($bandera != 1){
					            ?>
					            <div class="row no-print">
					            	<div class="col-xs-12">
					            		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
											<i class="fa fa-info-circle"></i>
										</button>
			                            
			                            <button type="button" class="btn btn-default" id="btn-print" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                            		
					            		
										<button type="button" id="btn-eliminar" class="btn btn-danger btn-sm pull-right" onclick="eliminar(<?php echo $id?>)" style="margin-left: 5px">
											<?php echo $this->lang->line('eliminar');?>
										</button>
										<button type="button" id="btn-editar" class="btn btn-primary btn-sm pull-right" onclick="editable()">
											<?php echo $this->lang->line('editar');?>
										</button>
					            		
										<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelar()" style="display: none; margin-left: 5px">
											<?php echo $this->lang->line('cancelar');?>
										</button>
										<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right" style="display: none;">
											<?php echo $this->lang->line('guardar');?>
										</button>
					            	</div>
					            </div>
					            <?php
								}
								?>
					            </form>
					            
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
																		$date = date_create($key->date_upd);
																		echo '<td>'.date_format($date, 'd/m/Y');
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
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('pedido'); ?></th>
							                <th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('cliente'); ?></th>
							            	<th><?php echo $this->lang->line('date'); ?></th>
							            	<th><?php echo $this->lang->line('monto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('pedido'); ?></th>
							                <th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('cliente'); ?></th>
							            	<th><?php echo $this->lang->line('date'); ?></th>
							            	<th><?php echo $this->lang->line('monto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($pedidos){							                
										      	foreach ($pedidos as $row) 
										     	{
										     		echo '<tr>';
													echo "<td><a href='".base_url()."index.php/pedidos/pestanas/".$row->id_pedido."' class='displayblock'>".$row->id_pedido.'</a>';
													echo "<td><a href='".base_url()."index.php/Presupuestos/pestanas/".$row->id_presupuesto."' class='displayblock'>".$row->id_presupuesto.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Visitas/carga/".$row->id_visita."/0' class='displayblock'>".$row->id_visita.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
													$date = date_create($row -> fecha);
													echo '<td>'.date_format($date, 'd/m/Y');
													echo "</td>";
													echo '<td>$ '.$row->total.'</td>';
													echo '<td>'.$row->estado.'</td>';
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table> 
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 PANEL DE PRESUPUESTOS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('cliente'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							                <th><?php echo $this->lang->line('estado'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('cliente'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							                <th><?php echo $this->lang->line('estado'); ?></th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($presupuestos){							                
										      	foreach ($presupuestos as $row) 
										     	{
										    		echo '<tr>';
													echo "<td><a href='".base_url()."index.php/Presupuestos/pestanas/".$row->id_presupuesto."' class='displayblock'>".$row->id_presupuesto.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Visitas/carga/".$row->id_visita."/0' class='displayblock'>".$row->id_visita.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
													$date = date_create($row -> fecha);
													echo '<td>'.date_format($date, 'd/m/Y');
													echo "</td>";
													echo '<td>'.$row->estado.'</td>';
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
		<!-- Modal -->
<?php if($vendedores){ foreach($vendedores as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Vendedores/editarVisto/".$row->id_vendedor; ?>" class="form-horizontal" method="post">
      <div class="modal-body">
      	<div class="row">
      		<table class="table table-striped">
      			<tr>
      				<td>
		      		<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('creacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_add)); ?>
					</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('modificacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_upd)); ?>
					</div>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('vendedor'); ?> 
		      			<?php echo $this->lang->line('visto').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<select name="visto" class="form-control chosen-select">	
							<?php
							if($row->visto == 1){
								echo '<option value="1" selected>SI</option>';
								echo '<option value="0">NO</option>';
							}
							else{
								echo '<option value="1">SI</option>';
								echo '<option value="0" selected>NO</option>';
							}
							?>
						</select>	
					</div>
					</td>
				</tr>
			</table>
			<input type="hidden" name="url" value="<?php echo current_url(); ?>">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      	<button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } } ?>
