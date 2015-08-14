<?php
	if($pedido){
		foreach ($pedido as $row) {
?>	
<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-heading">
		  				<div class="row">
		  					<div class="col-lg-2">
				  				<i class="fa fa-shopping-cart"></i> <?php echo $this->lang->line('pedido').' N° '.$row->id_pedido; ?>
		                  	</div>
		                   	<div id="imagen-durox" class="col-lg-3 col-lg-offset-2" align="center" style="display: none">
		                   		<img alt="DUROX" src="<?php echo base_url().'/img/durox.png'?>">
                   			</div>
                   		</div>
                   	</div>
		  			<div class="panel-body">
		  				  				
	    					<!--INFO GRAL DEL PEDIDO-->	
	    						
								 <div class="row invoice-info">
                        			<div class="col-sm-4 invoice-col">
                        				<b><?php echo $this->lang->line('vendedor');?></b>
                           			<address>
		                                <?php
		                                if($vendedores){
											foreach ($vendedores as $key) 
											{
												echo '<a class="sinhref" href="'.base_url().'index.php/vendedores/pestanas/'.$key->id_vendedor.'">';
												echo $key->apellido.', '.$key->nombre;
												echo '</a>';
												echo "<br>";
												echo "<div class='no-print'>";
												echo $this->lang->line('id').': '.$key->id_vendedor;
												echo "</div>";
												echo "<br>";
												if($key->eliminado == 0)
													$aux2 = 1;
											}
										}
										?>
									</address>
			                        </div><!-- /.col -->
			                        <div class="col-sm-4 invoice-col">
		                            	<b><?php echo $this->lang->line('cliente');?></b>
		                            <address>
		                                <?php
		                                if($clientes){
											foreach ($clientes as $key) 
											{
												echo '<a class="sinhref" href="'.base_url().'index.php/clientes/pestanas/'.$key->id_cliente.'">';
												echo $key->razon_social;
												echo '</a>';
												echo "<br>";
												echo $this->lang->line('cuit').': '.cuit($key->cuit);
												echo "<br>";
												foreach ($iva as $value) {
													if($value->id_iva == $key->id_iva){	
														echo $value->iva;
														echo "<br>";
													}
												}
												echo "<div class='no-print'>";
												echo $this->lang->line('id').': '.$key->id_cliente;
												echo "</div>";
												echo "<br>";
												if($key->eliminado == 0)
													$aux = 1;
											}
										}
										?>
		                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        	<b><?php echo $this->lang->line('presupuesto');?></b>
                            <?php
												echo '<div class="odd">';
												echo $this->lang->line('id').' '.$this->lang->line('presupuesto').': '.'<a class="sinhref" href="'.base_url().'index.php/Presupuestos/pestanas/'.$row->id_presupuesto.'">'.$row->id_presupuesto.'</a>';
												echo "</div>";
												echo '<div class="even">';
												echo $this->lang->line('id').' '.$this->lang->line('visita').': '.'<a class="sinhref" href="'.base_url().'index.php/Visitas/carga/'.$row->id_visita.'/0">'.$row->id_visita.'</a>';
												echo "</div>";
												echo '<div class="odd">';
												$date	= date_create($row->fecha);
												echo $this->lang->line('fecha').': '.date_format($date, 'd/m/Y');
												echo "</div>";
												foreach($estados as $key){
													if($key->id_estado_pedido == $row->id_estado_pedido){
														echo '<div class="even no-print">';	
														echo $this->lang->line('estado').': '.$key->estado;
														echo "</div>";
													}
												}
												echo '<div class="odd">';
												echo $this->lang->line('total').' '.$this->lang->line('presupuesto').': $ '.$row->total;
												echo "</div>";
												echo "<br>";							
								}
							}
							?>
						</div>
						</div>
						
						
						<div class="row">
                        <div class="col-xs-12 table-responsive">
                        	<?php echo $this->lang->line('detalle'); ?>
                                <?php
                                	if($pedido){
	     								foreach($pedido as $row)
	     								{
	     									if($row->id_estado_pedido == 3)
	     									{
	     										echo '<table class="table" cellspacing="0" width="100%">';
	     									}
											else {
												echo '<table class="table table-striped" cellspacing="0" width="100%">';
											}
	     								}
									}	
									$total = 0;
									if($pedidos)
									{
										foreach ($pedidos as $row) 
										{
											if($row->estado_linea != 3)
												$total = $row->subtotal + $total;
										}
									}	
	     							?>
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th><?php echo $this->lang->line('producto'); ?></th>
								                <th><?php echo $this->lang->line('cantidad'); ?></th>
								                <th><?php echo $this->lang->line('precio'); ?></th>
								                <th><?php echo $this->lang->line('subtotal'); ?></th>
								                <th class="no-print"><?php echo $this->lang->line('estado'); ?></th>
								            </tr>
								        </thead>
								 
								 		<tbody>
								        <?php	
								        if($pedidos)
										{
									        foreach ($pedidos as $row) 
									        {
												if($row->estado == 'Imposible de Enviar'){
													echo '<tr class="no-print" style="background-color: #f56954 !important; color: #fff;">';
												}
												else{
						     						echo '<tr>';	
												}
												echo '<td>'.$row->nombre.'</td>';
												echo '<td>'.$row->cantidad.'</td>';
												echo '<td>$ '.$row->precio.'</td>';
												echo '<td>$ '.$row->subtotal.'</td>';
												echo '<td class="no-print">'.$row->estado.'</th>';				
												echo '</tr>';
											}	
										}		
										?>
										</tbody>
								    </table>              
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
						<div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead no-print"><?php echo $this->lang->line('notas');?></p>
                            <p class="text-muted well well-sm no-shadow no-print" style="margin-top: 10px;">
                                
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead"><?php echo $this->lang->line('totales');?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%"><?php echo $this->lang->line('subtotal');?></th>
                                        <td>$ <?php echo round($total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('iva');?></th>
                                        <td>$ <?php echo round($total*1.21-$total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('total');?></th>
                                        <td>$ <?php echo round($total*1.21,2);?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					
					<div class="row no-print">
                        <div class="col-xs-12">
                        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
								<i class="fa fa-info-circle"></i>
							</button>
							
							<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
								
                         </div>
                    </div>	
                   	
			  		</div>
			  		
	</div>
</div>
 
		
		
		<!-- Modal -->
<?php if($pedido){ foreach($pedido as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Pedidos/editarVisto/".$row->id_presupuesto; ?>" class="form-horizontal" method="post">
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
		      			<?php echo $this->lang->line('pedido'); ?> 
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