<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#visita" data-toggle="tab"><?php echo $this->lang->line('visita'); ?></a></li>
					    	<li><a href="#presupuestos" data-toggle="tab"><?php echo $this->lang->line('presupuestos'); ?></a></li>
					    	<li><a href="#pedidos" data-toggle="tab"><?php echo $this->lang->line('pedidos'); ?></a></li>
						</ul>
		  			</div>
		  			
					<div class="panel-body">
						<?php
							if($visita){
								if($tipo!=0){?>
									<div class="row">
										<div class="col-md-10 col-md-offset-1">
											<div class="alert alert-success alert-dismissible" role="alert">
						  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  						La visita <a href="<?php echo base_url().'index.php/Visitas/editar/'.$visita; ?>"><?php echo $visita; ?></a> fué insertada con exito
											</div>	
										</div>
									</div>
						<?php 	} 
							}
						?>
						
						<div class="tab-content">
							<div class="tab-pane fade in active" id="visita">
								<?php
									if($visita){
										foreach ($visitas as $row) {
								?>	
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										<div class="alert alert-message-default alert-dismissible" role="alert">
						  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  						<div class="panel-heading">
													<h3 class="panel-title" style="text-align: center"><?php echo $this->lang->line('vendedor'); ?></h3>
												</div>
												<div class="panel-body">
													<hr style="margin: 0 0 20 0" />
													<div class="row">
														<div class="col-md-6">
															<?php
																foreach ($vendedores as $key) {
																	if($row->id_vendedor == $key->id_vendedor){
																		echo '<img alt="User Pic" src="'.$key->imagen.'" class="img-circle img-responsive">';
															?>
														</div>
														<div class="col-md-6">
															<?php
																		echo '<a href="'.base_url().'index.php/vendedores/pestanas/'.$key->id_vendedor.'">';
																		echo $key->nombre.', '.$key->apellido;
																		echo '</a>';
																		echo "<br>";
																		echo $this->lang->line('id').': '.$key->id_vendedor;
																		echo "<br>";
																	}
																}
															?>
														</div>
													</div>
												</div>
										</div>	
									</div>
									<div class="col-md-5">
										<div class="alert alert-message-default alert-dismissible" role="alert">
						  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  						<div class="panel-heading">
													<h3 class="panel-title" style="text-align: center"><?php echo $this->lang->line('cliente'); ?></h3>
												</div>
												<div class="panel-body">
													<hr style="margin: 0 0 20 0" />
													<div class="row">
														<div class="col-md-6">
															<?php
																foreach ($clientes as $key) {
																	if($row->id_cliente == $key->id_cliente){
																		echo '<img alt="User Pic" src="'.$key->imagen.'" class="img-circle img-responsive">';
															?>
														</div>
														<div class="col-md-6">
															<?php
																		echo '<a href="'.base_url().'index.php/clientes/pestanas/'.$key->id_cliente.'">';
																		echo $key->nombre.', '.$key->apellido;
																		echo '</a>';
																		echo "<br>";
																		echo $this->lang->line('cuit').': '.$key->cuit;
																		echo "<br>";
																		foreach ($razon_social as $value) {
																			if($value->id_razon_social == $key->id_razon_social){	
																				echo $value->razon_social;
																				echo "<br>";
																			}
																		}
																		echo $this->lang->line('id').': '.$key->id_cliente;
																		echo "<br>";
																	}
																}
															?>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="panel panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title" style="text-align: center"><?php echo $this->lang->line('visita'); ?></h3>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-8 text-center">
														<?php
														echo '<div class="odd">';
														echo $this->lang->line('id').': '.$row->id_visita;
														echo "</div>";
														echo '<div class="even">';
														echo $this->lang->line('fecha').': '.$row->date_upd;
														echo "</div>";
														foreach($epocas as $key){
															if($key->id_epoca_visita == $row->id_epoca_visita){
																echo '<div class="odd">';	
																echo $this->lang->line('epoca').': '.$key->epoca;
																echo "</div>";
															}
														}
														echo '<div class="even">';
														echo $this->lang->line('valoracion').': '.valoracion($row->valoracion);
														echo "</div>";
														echo "<br>";
														?>
														<div class="col-md-1 col-md-offset-5">
															<a role="button" class="btn btn-info" href="<?php echo base_url().'index.php/Visitas/editar/'.$row->id_visita; ?>"><?php echo $this->lang->line('editar'); ?></a>
														</div>
													</div>
													<div class="col-md-4">
														<?php echo $row->descripcion; ?>
													</div>
												</div>
												<?php
													
														}
													}
												?>
											</div>
										</div>
									</div>
								</div>								
							</div>
	    					<div class="tab-pane fade" id="presupuestos">
	    						<?php
	    							if($presupuesto){
	    						?>		
										<div class="row">
									        <div class="col-md-offset-2 col-md-8">
									            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
											        <thead>
											            <tr>
											            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
											            	<th><?php echo $this->lang->line('estado'); ?></th>
											            </tr>
											        </thead>
											 
											        <tfoot>
											            <tr>
											            	<th><?php echo $this->lang->line('presupuesto'); ?></th>
											            	<th><?php echo $this->lang->line('estado'); ?></th>
											            </tr>
											        </tfoot>
											 
											        <tbody>
											        	<?php						                
															foreach ($presupuesto as $row) 
														    {
																echo '<tr>';
																echo '<td>'.$row->id_presupuesto.'</td>';
																
																foreach($estados as $key){
																	if($key->id_estado_presupuesto == $row->id_estado_presupuesto)	
																		echo '<td>'.$key->estado.'</td>';
																}
																//echo '<td>'.$row->id_estado_presupuesto.'</td>';
																echo "</tr>";
															}
													 	?>
											        </tbody>
											    </table>
									        </div>
										</div>
								<?php	
	    							}
									else {
								?>
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PRESUPUESTO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="<?php echo base_url().'index.php/Presupuestos/carga/'.$visita; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('presupuesto'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php
									}	
								?>
	    					</div>
	    					<div class="tab-pane fade" id="pedidos">
	    						<?php
	    							if($pedido){
	    						?>		
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-success">
									                <h4>PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="#"><?php echo $this->lang->line('ver').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php	
	    							}
									else {
								?>
										<div class="row">
									        <div class="col-md-offset-3 col-sm-6 col-md-6">
									            <div class="alert-message alert-message-danger">
									                <h4>NO HAY PEDIDO RELACIONADO CON LA VISITA</h4>
									                <p>
									                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. For performance
									                    reasons, the Tooltip and Popover data-apis are opt-in, meaning 
													<a href="<?php echo base_url().'index.php/Pedidos/carga/'; ?>"><?php echo $this->lang->line('agregar').' '.$this->lang->line('pedido'); ?></a>
													</p>
									            </div>
									        </div>
										</div>
								<?php
									}	
								?>
	    					</div>
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>
