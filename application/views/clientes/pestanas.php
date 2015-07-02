<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('cliente'); ?></a></li>
					    	<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('vendedores'); ?></a></li>
					    	<li role="presentation" class="dropdown">
							    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
							      <?php echo $this->lang->line('perfiles'); ?> <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu" role="menu">
							     	<li><a href="#tab3" data-toggle="tab"><?php echo $this->lang->line('telefonos'); ?></a></li>
							     	<li><a href="#tab4" data-toggle="tab"><?php echo $this->lang->line('direcciones'); ?></a></li>
							     	<li><a href="#tab5" data-toggle="tab"><?php echo $this->lang->line('correos'); ?></a></li>
							    </ul>
							</li>
					    		
					    	<li><a href="#tab6" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
					    	<li><a href="#tab7" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#tab8" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">		  				
		  				
		  				<div class="tab-content">
	    					<div class="tab-pane fade in active" id="tab1">
	    					<!--INFO GRAL DEL CLIENTE-->	
	    						<div class="row">
	    							
					                <div class="col-md-3 col-lg-3 " align="center"> 
					                	<?php
						                    	foreach ($clientes as $row) 
							      				{
					                				echo '<img alt="User Pic" src="'.base_url().'img/clientes/User'.$row->id_cliente.'.jpg" class="img-circle img-responsive">';
					                				$url = base_url().'index.php/Clientes/clientes_abm/tab1/edit/'.$row->id_cliente; 
												}
					                	?>
					                	<input type="button" class="btn-primary" style="margin-top: 10%" value="<?php echo $this->lang->line('editar'); ?>" onclick="document.location = '<?php echo $url; ?>'">
					                </div>
					                
					                <div class=" col-md-9 col-lg-9 "><!--carga info cliente-->
					                	<table class="table table-striped table-user-information"> 
						                    <?php
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
	     						<?php
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
	    					<div class="tab-pane fade" id="tab4">
	     						<!--TAB 4 DIRECCIONES CLIENTE -->
	     						<?php
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
	    					<div class="tab-pane fade" id="tab5">
	     						<!--TAB 5 E-MAILS CLIENTE -->					
	     						<?php
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
	    					
	    					<div class="tab-pane fade" id="tab6">
	     						<!--TAB 6 PANEL DE PEDIDOS -->
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
	    					
	    					<div class="tab-pane fade" id="tab7">
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
