<script>
$(document).ready(function(){	
	document.body.style.background = "url(<?php echo base_url().'/img/fondorepetir.jpg' ?>)";
});		
	
</script>

<?php
$aux  = 0;
$aux2 = 0;
?>
<nav class="navbar" role="navigation">
	<div class="container">
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#tab1" data-toggle="tab"><?php echo $this->lang->line('presupuesto'); ?></a></li>
							<li><a href="#tab2" data-toggle="tab"><?php echo $this->lang->line('detalle'); ?></a></li>
						</ul>
		  			</div>
		  			<div class="panel-body">
		  				<?php
							if($id_presupuesto){
								if($tipo!=1){?>
									<div class="row">
										<div class="col-md-10 col-md-offset-1">
											<div class="alert alert-success alert-dismissible" role="alert">
						  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  						El Presupuesto <a href="#"><?php echo $id_presupuesto; ?></a> fué insertado con exito
											</div>	
										</div>
									</div>
						<?php 	} 
							}
						?>
		  				<div class="tab-content">
	    					<div class="tab-pane fade in active" id="tab1">
	    					<!--INFO GRAL DEL PRESUPUESTO-->	
	    						<?php
									if($presupuesto){
										foreach ($presupuesto as $row) {
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
																		$aux2 = 1;
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
																		$aux = 1;
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
												<h3 class="panel-title" style="text-align: center"><?php echo $this->lang->line('presupuesto'); ?></h3>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12 text-center">
														<?php
														echo '<div class="odd">';
														echo $this->lang->line('id').' '.$this->lang->line('presupuesto').': '.'<a href="#">'.$row->id_presupuesto.'</a>';
														echo "</div>";
														echo '<div class="even">';
														echo $this->lang->line('id').' '.$this->lang->line('visita').': '.'<a href="'.base_url().'index.php/Visitas/carga/'.$row->id_visita.'/0">'.$row->id_visita.'</a>';
														echo "</div>";
														echo '<div class="odd">';
														$date	= date_create($row->date_upd);
														echo $this->lang->line('fecha').': '.date_format($date, 'd/m/Y');
														echo "</div>";
														foreach($estados as $key){
															if($key->id_estado_presupuesto == $row->id_estado_presupuesto){
																echo '<div class="even">';	
																echo $this->lang->line('estado').': '.$key->estado;
																echo "</div>";
															}
														}
														echo '<div class="odd">';
														echo $this->lang->line('total').' '.$this->lang->line('presupuesto').': $ '.$row->total;
														echo "</div>";
														echo "<br>";
														
														?>
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
	     					<div class="tab-pane fade" id="tab2">
	     						<div class="col-md-10 col-md-offset-1">
	     							<?php
	     								foreach($presupuesto as $row){
	     									if($row->id_estado_presupuesto==3){
	     										echo '<table class="table" cellspacing="0" width="100%">';
	     									}
											else {
												echo '<table class="table table-striped" cellspacing="0" width="100%">';
											}
	     								}
										
										$total = 0;
										foreach ($presupuestos as $row) {
											if($row->estado_linea != 3)
												$total = $row->subtotal + $total;
										}
										
	     							?>
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th><?php echo $this->lang->line('producto'); ?></th>
								                <th><?php echo $this->lang->line('cantidad'); ?></th>
								                <th><?php echo $this->lang->line('precio').' '.$this->lang->line('base'); ?></th>
								                <th><?php echo $this->lang->line('precio'); ?></th>
								                <th><?php echo $this->lang->line('subtotal'); ?></th>
								                <th><?php echo $this->lang->line('estado'); ?></th>
								            </tr>
								        </thead>
								 
								        <tfoot class="tabla-datos-importantes">
								            <tr>
								            	<th></th>
								                <th></th>
								                <th></th>
								                <th style="text-decoration: underline"><?php echo $this->lang->line('total'); ?></th>
								                <th><?php echo '$ '.$total; ?></th>
								                <th></th>
								            </tr>
								        </tfoot>
								 
								 		<tbody>
								        <?php	
								        foreach ($presupuestos as $row) {
											
											if($row->estado == 'Rechazado'){
												echo '<tr style="background-color: rgba(182, 13, 13, 1);">';
											}
											else{
					     						echo '<tr>';	
											}
											echo '<td>'.$row->nombre.'</td>';
											echo '<td>'.$row->cantidad.'</td>';
											echo '<td>$ '.$row->preciobase.'</td>';
											echo '<td>$ '.$row->precio.'</td>';
											echo '<td>$ '.$row->subtotal.'</td>';
											echo '<th>'.$row->estado.'</th>';				
											echo '</tr>';
										}			
										?>
										</tbody>
								    </table>
								    <?php
								    if($aux == 1 && $aux2 == 1){ 
									    foreach($presupuesto as $row){
									    ?>
									    <div class="row">
									    	<div class="col-md-2 col-md-offset-4">
												<a role="button" class="btn btn-info" href="<?php echo base_url().'/index.php/Presupuestos/generarNuevoPresupuesto/'.$row->id_presupuesto ?>"><?php echo $this->lang->line('generar').' '.$this->lang->line('presupuesto') ?></a>
											</div>
									    <?php
									    	if($row->id_estado_presupuesto == 1){
											    echo '<div class="col-md-2">
														<a role="button" class="btn btn-info" href="#">'.$this->lang->line('generar').' '.$this->lang->line('pedido').'</a>
													  </div>';
											}
										}
									}
									?>
									</div>
							    </div>
	    					</div>
	    					<div class="tab-pane" id="tab3">
	     						<!--TAB 3-->
							    
	    					</div>
	    					<div class="tab-pane" id="tab4">
	     						<!--TAB 4-->
	     						
	    					</div>
	    					<div class="tab-pane" id="tab5">
	     						<!--TAB 5-->
	     						
	    					</div>	
	    					<div class="tab-pane" id="tab6">
	     						<!--TAB 6-->
	     						
	    					</div>
	    					<div class="tab-pane" id="tab7">
	     						<!--TAB 7 -->
	     						
	    					</div>
	    				</div><!--contenedor de cada pestaña-->	
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    
	</div>
</nav>