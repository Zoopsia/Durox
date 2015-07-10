<script>

</script>

<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('vendedor'); ?></a></li>
					    	<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('clientes'); ?></a></li>
					    	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('perfiles'); ?></a></li>
					    	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<div class="tab-content">
	    					<div class="tab-pane fade in active" id="tab1">
	    						<div class="row"><!--Cargo imagen vendedor-->
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
					                		if($vendedores){
						                    	foreach ($vendedores as $row) 
							      					echo '<img alt="User Pic" src="'.$row->imagen.'" class="img-circle img-responsive">';
											}
					                	?> 
					                	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#popEditar" style="margin-top: 10%">
										  <?php echo $this->lang->line('editar'); ?>
										</button>
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
									            }
											?>
					                    </table>
					                </div>
					            </div>
					            		
					            <div id="editado">
					            	
					            </div>	
	    					</div> <!--TAB 1 INFO VENDEDOR -->
	     					<div class="tab-pane fade" id="tab2">
	     						
	     						<div class="col-sm-2">
							        <nav class="nav-tab nav-justified">
							        	<ul class="nav nav-sidebar">
							            	<li><a href="#cliente1" data-toggle="tab"><?php echo $this->lang->line('clientes').' '.$this->lang->line('actuales'); ?></a></li>
							                <li><a href="#cliente2" data-toggle="tab"><?php echo $this->lang->line('clientes').' '.$this->lang->line('no').' '.$this->lang->line('activos'); ?></a></li>
							            	<li><a href="#cliente3" data-toggle="tab"><?php echo $this->lang->line('agregar').' '.$this->lang->line('clientes'); ?></a></li>
							            </ul>
							    	</nav>
							    </div>
	     						
	     						<!--CLIENTES ACTUALES--->	
	     						<div class="tab-content">
		     						<div class="tab-pane fade" id="cliente1">
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
																			echo "<td style='text-align: center;'><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='btn btn-info btn-xs glyphicon glyphicon-search' style='margin : 0 5px'>";
																			echo "</a>";
																			echo "<a href='".base_url()."index.php/Vendedores/sacarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-danger btn-xs glyphicon glyphicon-minus' role='button'>";
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
	     							<div class="tab-pane fade" id="cliente2">
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
																		echo "<td style='text-align: center;'><a href='".base_url()."index.php/Clientes/pestanas/".$row->id_cliente."' class='btn btn-info btn-xs glyphicon glyphicon-search'>";
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
	     							<div class="tab-pane fade" id="cliente3">
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
																				echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/cargarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-success btn-xs glyphicon glyphicon-plus' role='button'>";
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
																			echo "<td style='text-align: center;'><a href='".base_url()."index.php/Vendedores/cargarCliente/".$row->id_cliente."/".$value->id_vendedor."' class='btn btn-success btn-xs glyphicon glyphicon-plus' role='button'>";
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
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/telefonos/cargaEditar/'.$row->id_telefono.'/'.$key->id_vendedor.'/2"';
																		echo 'class="btn btn-primary btn-xs glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('editar').'">';
																		echo "</a></td>";
																		echo "</tr>";
																	}
																}
															}
													 	?>
											        </tbody>
											    </table>
											</div>
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
												<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
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
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/direcciones/cargaEditar/'.$row->id_direccion.'/'.$key->id_vendedor.'/2" class="btn btn-primary btn-xs">';
																		echo $this->lang->line('editar')."</a></td>";
																		echo "</tr>";
																	}
																}
															}
													 	?>
											        </tbody>
											    </table>
												
											</div>
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
														      		foreach ($vendedores as $key) {
															      		echo '<tr>';
																		echo '<td>'.$row->mail.'</td>';
																		echo '<td>'.$row->tipo.'</td>';
																		/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_vendedor.'/2" class="btn btn-primary btn-xs">';
																		echo $this->lang->line('editar')."</a></td>";
																		echo "</tr>";
																	}
																}
															}
													 	?>
											        </tbody>
											    </table>
												
											</div>
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
	     						
	     						
	     						<div class="row">
	     							<div class="col-md-11 col-md-offset-1">
	     								<form class="form-inline">
											<div class="form-group col-md-offset-1">
												<label><?php echo $this->lang->line('producto'); ?></label>
												<input type="text" id="productos" name="producto" class="numeric form-control" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('producto'); ?>" required>
											</div>
											<div class="form-group col-md-offset-1">
												<label><?php echo $this->lang->line('cantidad'); ?></label>
												<input type="text" id="cantidad" name="cantidad" class="numeric form-control" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('cantidad'); ?>" required>
											</div>
											<div class="form-group col-md-offset-1">
												<button type="button" class="btn btn-success btn-xs glyphicon glyphicon-plus" onclick=""></button>
											</div>
										</form>
									</div>
								</div>
	     						<div class="row">	
									<div class="col-md-10 col-md-offset-1">
					     				<table class="table table-striped table-hover" cellspacing="0" width="100%">
											<thead>
												<tr>
											     	<th><?php echo $this->lang->line('codigo'); ?></th>
											       	<th><?php echo $this->lang->line('producto'); ?></th>
											        <th><?php echo $this->lang->line('cantidad'); ?></th>
											        <th><?php echo $this->lang->line('precio'); ?></th>
											        <th><?php echo $this->lang->line('subtotal'); ?></th>
											        <th></th>
											    </tr>
											</thead>
											 
											<tfoot>
											    <tr>
											      	<th></th>
											       	<th></th>
											      	<th></th>
											        <th><ins><?php echo $this->lang->line('total'); ?></ins></th>
											        <th>$$$$$</th>
											        <th></th>
												</tr>
											</tfoot>
											
											<tbody> 
												<tr>
											    	<th>910</th>
											    	<th>Producto 1</th>
											   		<th>10</th>
											    	<th>$ 10</th>
											    	<th>$100.00</th>
											    	<th style="text-align: center"><a href='#' class='btn btn-danger btn-xs glyphicon glyphicon-minus' role='button' onclick="alert()"></a></th>
											    </tr>
											</tbody>
										</table>
									</div>
								</div>
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
	</div>
</nav>
