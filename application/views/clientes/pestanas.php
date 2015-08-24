<script>
<?php
if($clientes){
	foreach($clientes as $row){
		echo "var cuit =".$row->cuit.";";
	}
}
?>

function editable(){
	
	$(".cambio").removeAttr("disabled");
	$(".cambio").removeClass("editable");
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	$('#btn-editar').hide();
	$('#btn-eliminar').hide();
	$('#btn-print').hide();
	$("input#web").removeClass("web");
	$("input#web").removeAttr("onclick");
	$("input#web").removeAttr("readonly");
	$('#cuit').val(cuit);
	$('#span').show();
	$('#grupo').show();
	$('#input-grupo').hide();
	$('#iva').show();
	$('#input-iva').hide();
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true) {
		$(".cambio").attr("disabled", true);
		$(".cambio").addClass("editable");
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#btn-eliminar').show();
		$('#btn-editar').show();
		$('#btn-print').show();
		$("input#web").addClass("web");
		$('#grupo').hide();
		$('#input-grupo').show();
		$('#iva').hide();
		$('#input-iva').show();
		<?php
			if($clientes){
				foreach($clientes as $row){
					if($row->web){
						echo "$('input#web').attr('onClick',\"window.open('https://".$row->web."/')\");";
						echo '$("input#web").attr("readonly", true);';
						echo '$("input#web").attr("disabled", false);';
						echo "$('#web').val('".$row->web."');";
					}
					
					echo "$('#nombre').val('".$row->nombre."');";
					echo "$('#apellido').val('".$row->apellido."');";
					echo "$('#razon_social').val('".$row->razon_social."');";
					echo "$('#alias').val('".$row->nombre_fantasia."');";
					echo "$('#cuit').val('".cuit($row->cuit)."');";
															
				}	
			}
		?>
	}
}

function eliminar($id){
	var r = confirm("¿Esta seguro que quiere eliminar el registro?");
    if (r == true) {
		window.location.assign("/Durox/index.php/Clientes/delete_user/"+$id);
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

function imprimir(){
	if(!$("input#web").val()){
		$("#no-web").addClass("no-print");
	}
	
	if(!$("input#alias").val()){
		$("#no-alias").addClass("no-print");
	}
}

function saveAlarm($id){
	if($('#mensaje').val()){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Alarmas/insertAlarma', 
			data: { 'tipo' 		: $('#tipo').val(),
			 		'mensaje'	: $('#mensaje').val(),
			 		'id'		: $id, 
			 		'cruce'		: 'clientes'
			}, 
			success: function(resp) { 
				$('#box-alarmas').append(resp);
				$('#formAlarma').trigger("reset");
			}
		});
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
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('cliente'); ?></a></li>
							<?php
								if($clientes){
									foreach ($clientes as $row){
										if($row->eliminado != 1){
							?>
					    	<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('vendedores'); ?></a></li>
					    	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('perfiles'); ?></a></li>
					    	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('visitas'); ?></a></li>
						 	<li><a href="#tab7" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
						 	<?php
										}
									}
								}
							?>
						</ul>
		  			</div>
		  			<div class="panel-body">		  				
		  				
		  				<div class="tab-content">
	    					<div class="tab-pane fade in active" id="tab1">
	    					<!--INFO GRAL DEL CLIENTE-->
	    						<div class="row">
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
						                    if($clientes)
											{
												foreach ($clientes as $row)
												{
													echo '<form action="'.base_url()."index.php/clientes/editarCliente/$row->id_cliente".'" class="form-horizontal" method="post" enctype="multipart/form-data">';
													if($row->imagen != '')
													{ 
							      						echo '<img alt="User Pic" src="'.$row->imagen.'" class="img-perfil img-circle img-responsive">';
													}
												}
											}	
					                	?>
					                	<span id="span" class="btn btn-dropbox btn-file editable cambio no-print" style="display: none">
					                		<?php echo $this->lang->line('imagen');?>
											<input type="file" id="imagen" class="form-group editable cambio" name="imagen">	 
										</span>
											
									</div>
					                
									<div class=" col-md-9 col-lg-9 "><!--carga info cliente-->
					                	<table class="table table-striped table-user-information"> 
						                    <?php
						                    /*---- MEJORAR ESTO !!! ---*/
						                    if($telefonos)
						                    {
						                    	$i = 0;					                
												foreach ($telefonos as $row) 
												{
													$i++;
													if($i == 1){
														$telefono = $row->telefono;
														$cod_area = $row->cod_area;
													}
												}
											}
											
											if($direcciones)
						                    {
						                    	$i = 0;					                
												foreach ($direcciones as $row) 
												{
													$i++;
													if($i == 1){
														$direccion = $row->direccion;
													}
												}
											}
											
											if($mails)
						                    {
						                    	$i = 0;					                
												foreach ($mails as $row) 
												{
													$i++;
													if($i == 1){
														$mail = $row->mail;
													}
												}
											}
											/*---- VER LA FORMA DE MEJORAR LOS FOREACH ---*/
						                    
							                    if($clientes){
							                    	foreach ($clientes as $row) 
								      				{
								      					if($row->eliminado != 1){
											            	echo "<tbody>";
											                echo  "<tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('razon_social').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="razon_social" name="razon_social" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->razon_social.'" maxlength="128" disabled placeholder="'.$this->lang->line('razon_social').'" autocomplete="off" required></td>';
											                echo  "</tr><tr id='no-web'>";					                     
											                echo  '<td class="padtop">'.$this->lang->line('web').':</td>';
											                echo  "<td class='tabla-datos-importantes'>";
											                if($row->web){
											                	echo  "<input type='text' name='web' id='web' class='form-control editable cambio web' pattern='^www.[a-zA-Z0.9._- ]{4,}$' value='".$row->web."' placeholder='www.sitio-web.com' autocomplete='off' readonly onclick=\"javascript:window.open('https://".$row->web."/')\">";											                
															}
															else{
																echo  "<input type='text' name='web' id='web' class='form-control editable cambio web' pattern='^www.[a-zA-Z0.9._- ]{4,}$' placeholder='www.sitio-web.com' autocomplete='off' disable>";
															}
											                echo  "</td>";
											                echo  "</tr>";
															echo  "<tr>";
											                echo  '<td class="padtop">'.$this->lang->line('nombre').' '.$this->lang->line('contacto').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="nombre" name="nombre" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre.'" maxlength="128" disabled placeholder="'.$this->lang->line('nombre').'" autocomplete="off" required></td>';
											                echo  "</tr>";
															echo  "<tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('apellido').' '.$this->lang->line('contacto').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="apellido" name="apellido" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->apellido.'" maxlength="128" disabled placeholder="'.$this->lang->line('apellido').'" autocomplete="off" required></td>';
											                echo  "</tr>";
											                echo  "<tr id='no-alias'>";
															echo  '<td class="padtop">'.$this->lang->line('alias').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="alias" id="alias" class="form-control editable cambio" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre_fantasia.'" placeholder="'.$this->lang->line('alias').'" autocomplete="off" disabled></td>';
											                echo  "</tr><tr>";		
											                echo  '<td class="padtop">'.$this->lang->line('cuit').':</td>';							
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="cuit" id="cuit" class="form-control editable cambio" pattern="[0-9]*.{10,11}" value="'.cuit($row->cuit).'" placeholder="'.$this->lang->line('cuit').'" maxlength="11" autocomplete="off" disabled required></td>';
											                echo  "</tr><tr>";	
											                echo  '<td class="padtop">'.$this->lang->line('iva').':</td>';
											                echo  '<td class="tabla-datos-importantes">';
															//--- HAY UN SELECT ESCONDIDO PARA EDITAR---//
															if($iva){
																echo  '<div id="iva" style="display: none">';
																echo '<select name="id_iva" id="id_iva" class="form-control cambio">';
																foreach ($iva as $key) {
																	if($key->id_iva == $row->id_iva){
																		$iva = $row->iva;
																		echo '<option value="'.$key->id_iva.'" selected>'.$key->iva.'</option>';
																	}	
																	else
																		echo '<option value="'.$key->id_iva.'">'.$key->iva.'</option>';
																}
																echo '</select>';	
																echo  '</div>';
																echo  '<span id="input-iva">';
																echo  '<input type="text" class="form-control editable cambio" value="'.$iva.'" autocomplete="off" disabled>';
																echo  '</span>';
															}	
															echo  '</div>';
											                echo  "</td>";
															echo  "</tr><tr>";	
															echo  '<td class="padtop">'.$this->lang->line('grupos_clientes').':</td>';
															echo  '<td class="tabla-datos-importantes">';
											                //--- HAY UN SELECT ESCONDIDO PARA EDITAR---//
											                if($grupos){
																echo  '<div id="grupo" style="display: none">';
																echo '<select name="id_grupo_cliente" id="id_grupo_cliente" class="form-control cambio">';
																foreach ($grupos as $key) {
																	if($key->id_grupo_cliente == $row->id_grupo_cliente){
																		$grupo = $row->grupo_nombre;
																		echo '<option value="'.$key->id_grupo_cliente.'" selected>'.$key->grupo_nombre.'</option>';
																	}	
																	else
																		echo '<option value="'.$key->id_grupo_cliente.'">'.$key->grupo_nombre.'</option>';
																}
																echo '</select>';	
																echo  '</div>';
																echo  '<span id="input-grupo">';
																echo  '<input type="text" class="form-control editable cambio" value="'.$grupo.'" autocomplete="off" disabled>';
																echo  '</span>';
															}
															echo  "</td>";
											                echo  "</tr>";
															if($telefonos){
												                echo  "<tr>";
																echo  '<td class="padtop">'.$this->lang->line('telefono').':</td>';
												                echo  '<td class="tabla-datos-importantes"><input type="text" name="telefono" class="form-control editable"  value="'.$cod_area.' - '.$telefono.'" autocomplete="off" disabled></td>';
																echo  "</tr>";
															}
															if($direcciones){
												                echo  "<tr>";
																echo  '<td class="padtop">'.$this->lang->line('direccion').':</td>';
												                echo  '<td class="tabla-datos-importantes"><input type="text" name="direccion" class="form-control editable"  value="'.$direccion.'" autocomplete="off" disabled></td>';		
												               	echo  "</tr>";
															}
															if($mails){
												                echo  "<tr>";
																echo  '<td class="padtop">'.$this->lang->line('correo').':</td>';
												                echo  '<td class="tabla-datos-importantes"><input type="text" name="mail" class="form-control editable"  value="'.$mail.'" autocomplete="off" disabled style="width: 300px !important;"></td>';
																echo  "</tr>";
															}
														    echo  "</tbody>";
											        	}
														else{
															echo '<div class="row">
														        	<div class="col-md-offset-3 col-sm-6 col-md-6">
														            	<div class="alert-message alert-message-danger">
														                	<h4>'.$this->lang->line('cliente').' '.$this->lang->line('eliminado').'</h4>
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
			                            
			                            <button type="button" class="btn btn-default" id="btn-print" onclick="imprimir(); window.print()"><i class="fa fa-print"></i> Print</button>
                            		
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
	    					</div> <!--TAB 1 INFO CLIENTE -->
	    					
	     					<div class="tab-pane fade" id="tab2">
	     					<!--TABLA DE VENDEDORES CON RESPECTO AL CLIENTE-->	
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('id'); ?></th>
							                <th><?php echo $this->lang->line('nombre'); ?></th>
							                <th><?php echo $this->lang->line('apellido'); ?></th>
							                <th><?php echo $this->lang->line('eliminado'); ?></th>
							                <th><?php echo $this->lang->line('acciones'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('id'); ?></th>
							                <th><?php echo $this->lang->line('nombre'); ?></th>
							                <th><?php echo $this->lang->line('apellido'); ?></th>
							                <th><?php echo $this->lang->line('eliminado'); ?></th>
							                <th><?php echo $this->lang->line('acciones'); ?></th>
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
													if($row->activo == 0)
														echo "<td>NO</td>";
													else 
														echo "<td>SI</td>";
													echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='btn btn-info btn-xs'>";
													echo $this->lang->line('ver')."</a></td>";
													echo "</a></tr>";
												}
											}
									 	?>
							        </tbody>
							    </table>
							    
	    					</div><!--TAB 2 VENDEDORES CLIENTE -->
	    				
	    					<div class="tab-pane fade" id="tab3">
	     						<!--TAB 3 TELEFONOS CLIENTE -->
	     						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="padding-top: 20px">
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
						     							if($clientes){
												        	foreach ($clientes as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/telefonos/telefonos/'.$row->id_cliente.'/1">';
																echo '<span class="ui-button-text">';
																echo $this->lang->line('añadir').' '.$this->lang->line('telefono').'</span>';
																echo "</a>";
																echo "</div>";
																echo '<div style="height:10px;"></div>';
															}
														}
													?>
													<div class="tablaTelefonos">
							     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
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
																      		foreach ($clientes as $key) {
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
																				echo '<a href="'.base_url().'index.php/telefonos/cargaEditar/'.$row->id_telefono.'/'.$key->id_cliente.'/1"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarTelefono('.$row->id_telefono.','.$key->id_cliente.',1)"';
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
						     					if($clientes){
												 	foreach ($clientes as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY TELÉFONO RELACIONADO CON EL CLIENTE</h4>
													                <p>
													                <a class="btn btn-default" href="<?php echo base_url().'index.php/telefonos/telefonos/'.$row->id_cliente.'/1'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('telefono'); ?></a>
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
								  
								  <!--TAB 3 DIRECCIONES CLIENTE -->
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
												<div class="col-md-12 ">
													<?php
														if($clientes){
												        	foreach ($clientes as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/direcciones/direcciones/'.$row->id_cliente.'/1">';
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
																	     	foreach ($clientes as $key) 
														    				{		
																		    	echo '<tr>';
																				echo '<td>'.$row->direccion.'</td>';
																				echo '<td>'.$row->tipo.'</td>';
																				echo '<td>'.$row->nombre_departamento.'</td>';
																				echo '<td>'.$row->nombre_provincia.'</td>';
																				echo '<td>'.$row->nombre_pais.'</td>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<td style="text-align: center;">';
																				echo '<a href="'.base_url().'index.php/direcciones/cargaEditar/'.$row->id_direccion.'/'.$key->id_cliente.'/1"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarDireccion('.$row->id_direccion.','.$key->id_cliente.',1)"';
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
						     					if($clientes){
												 	foreach ($clientes as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY DIRECCIÓN RELACIONADA CON EL CLIENTE</h4>
													                <p>
													                <a class="btn btn-default" href="<?php echo base_url().'index.php/direcciones/direcciones/'.$row->id_cliente.'/1'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('direccion'); ?></a>
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
								  <!--TAB 3 CORREOS CLIENTE -->
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
														if($clientes){
												        	foreach ($clientes as $row) 
													    	{
									     						echo "<div class='datatables-add-button'>";
																/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																echo '<a role="button" class="btn btn-success" href="'.base_url().'index.php/mails/mails/'.$row->id_cliente.'/1">';
																echo '<span class="ui-button-text">';
																echo $this->lang->line('añadir').' '.$this->lang->line('correo').'</span>';
																echo "</a>";
																echo "</div>";
																echo '<div style="height:10px;"></div>';
															}
														}
													?>
													<div class="tablaCorreos">
							     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
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
																      		foreach ($clientes as $key) {
																	      		echo '<tr>';
																				echo '<td>'.$row->mail.'</td>';
																				echo '<td>'.$row->tipo.'</td>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<td style="text-align: center;">';
																				echo '<a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_cliente.'/1"';
																				echo 'class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'" style="margin : 0 5px">';
																				echo '<i class="fa fa-edit"></i>';
																				echo '</a>';
																				/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																				echo '<a href="#" onclick="eliminarCorreo('.$row->id_mail.','.$key->id_cliente.',1)"';
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
						     					if($clientes){
												 	foreach ($clientes as $row) 
												  	{
											?>	
														<div class="row">
													        <div class="col-md-offset-3 col-sm-6 col-md-6">
													            <div class="alert-message alert-message-danger">
													                <h4>NO HAY CORREO RELACIONADO CON EL CLIENTE</h4>
													                <p>
													               	<a class="btn btn-default" href="<?php echo base_url().'index.php/mails/mails/'.$row->id_cliente.'/1'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('correo'); ?></a>
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
	    					</div><!--TAB 3 CIERRA PERFILES -->
	    					
	    					<div class="tab-pane fade" id="tab4">
	     						<!--TAB 4 PANEL DE PEDIDOS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('pedido'); ?></th>
							                <th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
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
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
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
													echo "<td><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
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
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
							            	<th><?php echo $this->lang->line('date'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
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
													echo "<td><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
													$date = date_create($row -> fecha);
													echo '<td>'.date_format($date, 'd/m/Y');
													echo "</td>";
													echo '<td>'.$row->estado.'</td>';
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table> 
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab6">
	     						<!--TAB 6 PANEL DE VISITAS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
							            	<th><?php echo $this->lang->line('date'); ?></th>
							            	<th><?php echo $this->lang->line('valoracion'); ?></th>
							            	<th><?php echo $this->lang->line('origen'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							            	<th><?php echo $this->lang->line('vendedor'); ?></th>
							            	<th><?php echo $this->lang->line('date'); ?></th>
							            	<th><?php echo $this->lang->line('valoracion'); ?></th>
							            	<th><?php echo $this->lang->line('origen'); ?></th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($visitas){							                
										      	foreach ($visitas as $row) 
										     	{
										     		echo '<tr>';
													echo "<td><a href='".base_url()."index.php/Visitas/carga/".$row->id_visita."/0' class='displayblock'>".$row->id_visita.'</a></td>';
													echo "<td><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
													$date = date_create($row -> fecha);
													echo '<td>'.date_format($date, 'd/m/Y');
													echo "</td>";
													echo '<td>'.valoracion($row->valoracion).'</td>';
													echo '<td>'.$row->origen.'</td>';
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table> 
	    					</div>
	    					
	    					<div class="tab-pane fade" id="tab7">
	     						<!--TAB 7 ALARMAS -->
	     						<div class="col-md-6">
	     							<div class="box box-primary">
		                                <div class="box-header">
		                                    <h3 class="box-title"><?php echo $this->lang->line('alarmas')?></h3>
		                                </div><!-- /.box-header -->
		                               
		                                <div class="box-body" id="box-alarmas">
		                                <?php
					     					if($alarmas){
												foreach($alarmas as $row){
													$arreglo	= array(
														'id_tipo'	=> $row->id_tipo_alarma,
														'tipo'		=> $row->tipo_alarma,
														'mensaje'	=> $row->mensaje
													);
													echo armarAlarma($arreglo);
												}
											}
										?>
		                            	</div><!-- /.box-body -->
		                            </div>
								</div>
								<form id="formAlarma">
								<div class="col-md-6">
									<div class="box box-info">
		                                <div class="box-header ui-sortable-handle" style="cursor: move;">
		                                    <i class="fa fa-envelope"></i>
		                                    <h3 class="box-title"><?php echo $this->lang->line('nueva')?></h3>
		                                    <!-- tools box -->
		                                    <!--
		                                    <div class="pull-right box-tools">
		                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
		                                    </div> 
		                                    -->
		                                </div>
		                                <div class="box-body">
		                                <div class="form-group">
		                                	<select class="form-control" id="tipo" name="tipo_alarma" style="font-family: 'FontAwesome', Helvetica;">
												<option value="1">&#xf087;<?php echo ' '.$this->lang->line('exito')?></option>
												<option value="2">&#xf129;<?php echo ' '.$this->lang->line('informacion')?></option>
		                                		<option value="3">&#xf071;<?php echo ' '.$this->lang->line('alerta')?></option>
		                            		</select> 
		                                </div>
		                                <div class="form-group">
		                                    <textarea id="mensaje" name="mensaje" style="resize: none; width: 100%; height: 150px"></textarea>
		                                </div>
		                                </div>
		                                <div class="box-footer clearfix">
		                                    <button type="button" class="pull-right btn btn-primary btn-sm" onclick="saveAlarm(<?php echo $id?>);"><?php echo $this->lang->line('guardar')?></button>
		                                </div>
	                           		</div>
	                           </div>
	                           </form>
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
<?php if($clientes){ foreach($clientes as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Clientes/editarVisto/".$row->id_cliente; ?>" class="form-horizontal" method="post">
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
		      			<?php echo $this->lang->line('cliente'); ?> 
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
