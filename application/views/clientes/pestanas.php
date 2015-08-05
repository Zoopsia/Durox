<script>

<?php
if($clientes){
	foreach($clientes as $row){
		echo "var cuit =".$row->cuit.";";
	}
}
?>
$(document).ready(function(){	
	document.body.style.background = "url(<?php echo base_url().'/img/otro_fondo.jpg' ?>) no-repeat";
	//$('#btn-guardar').hide();
	//$('#btn-cancelar').hide();		
});

function editable(){
	var r = confirm("¿Esta seguro que quiere editar este registro?");
    if (r == true) {
		$(".cambio").removeAttr("disabled");
		$(".cambio").removeClass("editable");
		$('#btn-guardar').show();
		$('#btn-cancelar').show();
		$('#btn-editar').hide();
		$("div#div-mover").removeClass("col-md-3 col-lg-3 col-md-offset-5");
		$("div#div-mover").addClass("col-md-3 col-lg-3 col-md-offset-4");
		$("input#web").removeClass("web");
		$("input#web").removeAttr("onclick");
		$("input#web").removeAttr("readonly");
		$('#cuit').val(cuit);
		$('#span').show();
	}
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true) {
		$(".cambio").attr("disabled", true);
		$(".cambio").addClass("editable");
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#btn-editar').show();
		$("div#div-mover").addClass("col-md-3 col-lg-3 col-md-offset-5");
		$("div#div-mover").removeClass("col-md-3 col-lg-3 col-md-offset-4");
		$("input#web").addClass("web");
		$('#id_iva').html('');
		$('#id_grupo_cliente').html('');
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
					
					if($iva){
						foreach ($iva as $key) {
							if($key->id_iva == $row->id_iva)
								echo "$('#id_iva').append(\"<option value='".$key->id_iva."' selected='selected'>".$key->iva."</option>\");";
							else
								echo "$('#id_iva').append(\"<option value='".$key->id_iva."'>".$key->iva."</option>\");";
						}
					}
					
					if($grupos){
						foreach ($grupos as $key) {
							if($key->id_grupo_cliente == $row->id_grupo_cliente)
								echo "$('#id_grupo_cliente').append(\"<option value='".$key->id_grupo_cliente."' selected='selected'>".$key->grupo_nombre."</option>\");";
							else
								echo "$('#id_grupo_cliente').append(\"<option value='".$key->id_grupo_cliente."'>".$key->grupo_nombre."</option>\");";
						}
					}												
				}	
			}
		?>
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
					                	<span id="span" class="btn btn-dropbox btn-file editable cambio" style="display: none">
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
											                echo  '<td class="padtop">'.$this->lang->line('nombre').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="nombre" name="nombre" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre.'" maxlength="128" disabled placeholder="'.$this->lang->line('nombre').'" autocomplete="off" required></td>';
											                //echo  '<td class="tabla-datos-importantes"><input type'.$row->nombre.'</td>';
											                echo  "</tr>";
															echo  "<tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('apellido').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="apellido" name="apellido" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->apellido.'" maxlength="128" disabled placeholder="'.$this->lang->line('apellido').'" autocomplete="off" required></td>';
											                echo  "</tr><tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('razon_social').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="razon_social" name="razon_social" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->razon_social.'" maxlength="128" disabled placeholder="'.$this->lang->line('razon_social').'" autocomplete="off" required></td>';
											                echo  "</tr><tr>";								                     
											                echo  '<td class="padtop">'.$this->lang->line('web').':</td>';
											                echo  "<td class='tabla-datos-importantes'>";
											                if($row->web){
											                	echo  "<input type='text' name='web' id='web' class='form-control editable cambio web' pattern='^www.[a-zA-Z0.9._- ]{4,}$' value='".$row->web."' placeholder='www.sitio-web.com' autocomplete='off' readonly onclick=\"javascript:window.open('https://".$row->web."/')\">";											                
															}
															else{
																echo  "<input type='text' name='web' id='web' class='form-control editable cambio web' pattern='^www.[a-zA-Z0.9._- ]{4,}$' placeholder='www.sitio-web.com' autocomplete='off' disable>";
															}
											                echo  "</td>";
											                echo  "</tr><tr>";
															echo  '<td class="padtop">'.$this->lang->line('alias').':</td>';
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="alias" id="alias" class="form-control editable cambio" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre_fantasia.'" placeholder="'.$this->lang->line('alias').'" autocomplete="off" disabled></td>';
											                echo  "</tr><tr>";		
											                echo  '<td class="padtop">'.$this->lang->line('cuit').':</td>';							
											                echo  '<td class="tabla-datos-importantes"><input type="text" name="cuit" id="cuit" class="form-control editable cambio" pattern="[0-9]*.{10,11}" value="'.cuit($row->cuit).'" placeholder="'.$this->lang->line('cuit').'" maxlength="11" autocomplete="off" disabled required></td>';
											                echo  "</tr><tr>";	
															
											                echo  '<td class="padtop">'.$this->lang->line('iva').':</td>';
											                echo  '<td class="tabla-datos-importantes">';
															echo '<select name="id_iva" id="id_iva" class="form-control editable cambio" disabled>';
																if($iva){
																	foreach ($iva as $key) {
																		if($key->id_iva == $row->id_iva)
																			echo '<option value="'.$key->id_iva.'" selected>'.$key->iva.'</option>';
																		else
																			echo '<option value="'.$key->id_iva.'">'.$key->iva.'</option>';
																	}
																}			
															echo '</select>';	 
											                echo  "</td>";
															echo  "</tr><tr>";	
															
															
											                echo  '<td class="padtop">'.$this->lang->line('grupos_clientes').':</td>';
															echo  '<td class="tabla-datos-importantes">';
											                echo '<select name="id_grupo_cliente" id="id_grupo_cliente" class="form-control editable cambio" disabled>';
																if($grupos){
																	foreach ($grupos as $key) {
																		if($key->id_grupo_cliente == $row->id_grupo_cliente)
																			echo '<option value="'.$key->id_grupo_cliente.'" selected>'.$key->grupo_nombre.'</option>';
																		else
																			echo '<option value="'.$key->id_grupo_cliente.'">'.$key->grupo_nombre.'</option>';
																	}
																}			
															echo '</select>';	 
											                echo  "</td>";
											                //<a href="'.base_url().'index.php/Grupos/getReglasGrupos/'.$row->id_grupo_cliente.'">';
											                //echo  $row->grupo_nombre;
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
														}
										            }
										        }
											?>
					                    </table>
					                </div>
					            </div>
					            	
					            <div class="row">
					            	<div id="div-mover" class="col-md-3 col-lg-3 col-md-offset-5">
					            		<button type="button" id="btn-editar" class="btn btn-primary btn-sm" onclick="editable()">
											<?php echo $this->lang->line('editar');?>
										</button>
										<!--submit boton cambiar-->
					            		<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm" style="display: none;">
											<?php echo $this->lang->line('guardar');?>
										</button>
										<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm" onclick="cancelar()" style="display: none;">
											<?php echo $this->lang->line('cancelar');?>
										</button>
					            	</div>
					            </div>
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
							                <th><?php echo $this->lang->line('vendedor'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('pedido'); ?></th>
							                <th><?php echo $this->lang->line('vendedor'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							            </tr>
							        </tfoot>
							 
							        <tbody>        
			     						<?php 
									       	if($pedidos){							                
										      	foreach ($pedidos as $row) 
										     	{
										    		echo '<tr>';
													echo "<td><a href='".base_url()."index.php/pedidos/pestanas/".$row->id_vendedor."'>".$row->id_pedido.'</a>';
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
	    					
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 PANEL DE PRESUPUESTOS -->
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('vendedor'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
							            	<th><?php echo $this->lang->line('estado'); ?></th>
							            	<th><?php echo $this->lang->line('visita'); ?></th>
							                <th><?php echo $this->lang->line('vendedor'); ?></th>
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
													echo "<td><a href='".base_url()."index.php/Vendedores/pestanas/".$row->id_vendedor."' class='displayblock'>".$row->apellido.', '.$row->nombre.'</a></td>';
													$date = date_create($row -> fecha);
													echo '<td>'.date_format($date, 'd/m/Y');
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
	     						<!--TAB 6 PANEL DE PRESUPUESTOS -->
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
