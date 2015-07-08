<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('cliente'); ?></a></li>
					    	<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('vendedores'); ?></a></li>
					    	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('perfiles'); ?></a></li>
					    	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
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
												foreach ($clientes as $row){ 
							      					echo '<img alt="User Pic" src="'.$row->imagen.'" class="img-circle img-responsive">';
												}
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
															<h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('editar').' '.$this->lang->line('cliente'); ?></h4>
													</div>
													<?php foreach($clientes as $row){ ?>
													<form action="<?php echo base_url()."index.php/clientes/editarCliente/$row->id_cliente"?>" class="form-horizontal" method="post" enctype="multipart/form-data">
														<div class="modal-body">
											       				<div class="form-group">
																  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('alias'); ?></label>
																		<div class="col-sm-4 col-sm-offset-1">
																			<input type="text" name="alias" class="form-control" pattern="^[A-Za-z0-9 ]+$" value="<?php echo $row->nombre_fantasia ?>">	 
																		</div>
																</div>
																
																<div class="form-group">
																  	<label class="col-sm-1 col-sm-offset-1 control-label"><?php echo $this->lang->line('grupos_clientes'); ?></label>
																		<div class="col-sm-4 col-sm-offset-1">
																			<select name="id_grupo_cliente" class="form-control chosen-select">
																				<?php
																					if($grupos){
																						foreach ($grupos as $key) {
																							if($key->id_grupo_cliente == $row->id_grupo_cliente)
																								echo '<option value="'.$key->id_grupo_cliente.'" selected>'.$key->grupo_nombre.'</option>';
																							else
																								echo '<option value="'.$key->id_grupo_cliente.'">'.$key->grupo_nombre.'</option>';
																						}
																					}
																				?>
																			</select>	 
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
					                
					                <div class=" col-md-9 col-lg-9 "><!--carga info cliente-->
					                	<table class="table table-striped table-user-information"> 
						                    <?php
							                    if($clientes){
							                    	foreach ($clientes as $row) 
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
														echo  '<td>'.$this->lang->line('alias').':</td>';
										                echo  '<td class="tabla-datos-importantes">'.$row->nombre_fantasia.'</td>';
										                echo  "</tr><tr>";		
										                echo  '<td>'.$this->lang->line('cuit').':</td>';
										                echo  '<td class="tabla-datos-importantes">'.$row->cuit.'</td>';
										                echo  "</tr><tr>";	
										                echo  '<td>'.$this->lang->line('razon_social').':</td>';
										                echo  '<td class="tabla-datos-importantes">'.$row->razon_social.'</td>';
														echo  "</tr><tr>";	
										                echo  '<td>'.$this->lang->line('grupos_clientes').':</td>';
										                echo  '<td class="tabla-datos-importantes"><a href="'.base_url().'index.php/Grupos/getReglasGrupos/'.$row->id_grupo_cliente.'">';
										                echo  $row->grupo_nombre;
										                echo  "</a></td>";
										                echo  "</tr>";		
										                echo  "</tbody>";
										            }
										        }
											?>
					                    </table>
					                </div>
					            </div>
					            			
	    					</div> <!--TAB 1 INFO CLIENTE -->
	     					<div class="tab-pane fade" id="tab2">
	     					<!--TABLA DE VENDEDORES CON RESPECTO AL CLIENTE-->	
	     						<table class="table table-striped table-bordered prueba" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							            	<th><?php echo $this->lang->line('id'); ?></th>
							                <th><?php echo $this->lang->line('nombre'); ?></th>
							                <th><?php echo $this->lang->line('apellido'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
							                <th><?php echo $this->lang->line('eliminado'); ?></th>
							                <th><?php echo $this->lang->line('acciones'); ?></th>
							            </tr>
							        </thead>
							 
							        <tfoot>
							            <tr>
							            	<th><?php echo $this->lang->line('id'); ?></th>
							                <th><?php echo $this->lang->line('nombre'); ?></th>
							                <th><?php echo $this->lang->line('apellido'); ?></th>
							                <th><?php echo $this->lang->line('date'); ?></th>
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
													echo '<td>'.$row->date_add.'</td>';
													echo "<td>".$row->eliminado."</td>";
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
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/telefonos/cargaEditar/'.$row->id_telefono.'/'.$key->id_cliente.'/1" class="btn btn-primary btn-xs">';
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
											<div class="col-md-12">
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
														      		foreach ($clientes as $key) 
											    					{		
															      		echo '<tr>';
																		echo '<td>'.$row->direccion.'</td>';
																		echo '<td>'.$row->tipo.'</td>';
																		echo '<td>'.$row->nombre_departamento.'</td>';
																		echo '<td>'.$row->nombre_provincia.'</td>';
																		echo '<td>'.$row->nombre_pais.'</td>';
																		/*--- IMPORTANTE MANDAR EL TIPO AL FINAL 1 cliente 2 vendedor-----*/
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/direcciones/cargaEditar/'.$row->id_direccion.'/'.$key->id_cliente.'/1" class="btn btn-primary btn-xs">';
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
																		echo '<td style="text-align: center;"><a href="'.base_url().'index.php/mails/cargaEditar/'.$row->id_mail.'/'.$key->id_cliente.'/1" class="btn btn-primary btn-xs">';
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
	     						PRESUPUESTOS
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
	</div>
</nav>
