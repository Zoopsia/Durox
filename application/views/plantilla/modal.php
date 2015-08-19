<?php $url = current_url();?>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Visita
--------------------------------------------------------------------------
------------------------------------------------------------------------->	
<form action="<?php echo base_url()."index.php/Visitas/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_visitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
		      			<th><?php echo $this->lang->line('visita')?></th>
		      			<th><?php echo $this->lang->line('cliente')?></th>
		      			<th><?php echo $this->lang->line('vendedor')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php 
	      			if($visitas_mensajes){
	      				foreach($visitas_mensajes as $row) { 
	      			?>
	      			<tr>
				  		<td><a href="<?php echo base_url().'index.php/Visitas/carga/'.$row->id_visita ?>/0" class="displayblock"><?php echo $row->id_visita ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Clientes/pestanas/'.$row->id_cliente ?>" class="displayblock"><?php echo $row->razon_social ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->Vapellido.', '.$row->Vnombre ?></a></td>
				  		<?php $date	= date_create($row->fecha); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
						<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_visita ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nueva')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_visita<?php echo $row->id_visita ?>" value="<?php echo $row->id_visita ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Clientes
--------------------------------------------------------------------------
------------------------------------------------------------------------->	
<form action="<?php echo base_url()."index.php/Clientes/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
		      			<th><?php echo $this->lang->line('id')?></th>
		      			<th><?php echo $this->lang->line('razon_social')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php
	      			if($clientes_mensajes){ 
	      				foreach($clientes_mensajes as $row) { 
	      			?>
	      			<tr>
	      				
				  		<td><a href="<?php echo base_url().'index.php/Clientes/pestanas/'.$row->id_cliente ?>" class="displayblock"><?php echo $row->id_cliente ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Clientes/pestanas/'.$row->id_cliente ?>" class="displayblock"><?php echo $row->razon_social ?></a></td>
				  		<?php $date	= date_create($row->date_add); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
				  		<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_cliente ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nuevo')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_cliente<?php echo $row->id_cliente ?>" value="<?php echo $row->id_cliente ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Vendedores
--------------------------------------------------------------------------
------------------------------------------------------------------------->	

<form action="<?php echo base_url()."index.php/Vendedores/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_vendedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
		      			<th><?php echo $this->lang->line('id')?></th>
		      			<th><?php echo $this->lang->line('nombre')?></th>
		      			<th><?php echo $this->lang->line('apellido')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php 
	      			if($vendedores_mensajes){
	      				foreach($vendedores_mensajes as $row) { ?>
	      			<tr>
	      				
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->id_vendedor ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->nombre ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->apellido ?></a></td>
				  		<?php $date	= date_create($row->date_add); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
				  		<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_vendedor ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nuevo')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_vendedor<?php echo $row->id_vendedor ?>" value="<?php echo $row->id_vendedor ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Productos
--------------------------------------------------------------------------
------------------------------------------------------------------------->	

<form action="<?php echo base_url()."index.php/Productos/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
		      			<th><?php echo $this->lang->line('id')?></th>
		      			<th><?php echo $this->lang->line('nombre')?></th>
		      			<th><?php echo $this->lang->line('precio')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php 
	      			if($productos_mensajes){
	      				foreach($productos_mensajes as $row) { 
	      			?>
	      			<tr>
	      				
				  		<td><a href="<?php echo base_url().'index.php/Productos/pestanas/'.$row->id_producto ?>" class="displayblock"><?php echo $row->id_producto ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Productos/pestanas/'.$row->id_producto ?>" class="displayblock"><?php echo $row->nombre ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Productos/pestanas/'.$row->id_producto ?>" class="displayblock"><?php echo $row->precio ?></a></td>
				  		<?php $date	= date_create($row->date_add); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
				  		<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_producto ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nuevo')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_producto<?php echo $row->id_producto ?>" value="<?php echo $row->id_producto ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Pedidos
--------------------------------------------------------------------------
------------------------------------------------------------------------->	

<form action="<?php echo base_url()."index.php/Pedidos/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_pedidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
	      				<th><?php echo $this->lang->line('pedido')?></th>
	      				<th><?php echo $this->lang->line('presupuesto')?></th>
		      			<th><?php echo $this->lang->line('visita')?></th>
		      			<th><?php echo $this->lang->line('cliente')?></th>
		      			<th><?php echo $this->lang->line('vendedor')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php
	      			if($pedidos_mensajes){
	      				foreach($pedidos_mensajes as $row) { 
	      			?>
	      			<tr>
	      				<td><a href="<?php echo base_url().'index.php/Pedidos/pestanas/'.$row->id_pedido ?>" class="displayblock"><?php echo $row->id_pedido ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Presupuestos/pestanas/'.$row->id_presupuesto ?>" class="displayblock"><?php echo $row->id_presupuesto ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Visitas/carga/'.$row->id_visita ?>/0" class="displayblock"><?php echo $row->id_visita ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Clientes/pestanas/'.$row->id_cliente ?>" class="displayblock"><?php echo $row->razon_social ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->Vapellido.', '.$row->Vnombre ?></a></td>
				  		<?php $date	= date_create($row->fecha); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
				  		<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_pedido ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nueva')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_pedido<?php echo $row->id_pedido ?>" value="<?php echo $row->id_pedido ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal Presupuestos
--------------------------------------------------------------------------
------------------------------------------------------------------------->	

<form action="<?php echo base_url()."index.php/Presupuestos/editarVisto/"?>" method="post">
	<div class="modal fade" id="modal_presupuestos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-car"></span><?php echo ' '.$this->lang->line('nuevas').' '.$this->lang->line('visitas') ?></h4>
	      </div>
	      <div class="modal-body">
	      	<table class="table table-hover">
	      		<thead>
	      			<tr>
	      				<th><?php echo $this->lang->line('presupuesto')?></th>
		      			<th><?php echo $this->lang->line('visita')?></th>
		      			<th><?php echo $this->lang->line('cliente')?></th>
		      			<th><?php echo $this->lang->line('vendedor')?></th>
		      			<th><?php echo $this->lang->line('date')?></th>
		      			<th><?php echo $this->lang->line('origen')?></th>
		      			<th><?php echo $this->lang->line('estado')?></th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php 
	      			if($presupuestos_mensajes){
	      				foreach($presupuestos_mensajes as $row) { 
	      			?>
	      			<tr>
	      				<td><a href="<?php echo base_url().'index.php/Presupuestos/pestanas/'.$row->id_presupuesto ?>" class="displayblock"><?php echo $row->id_presupuesto ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Visitas/carga/'.$row->id_visita ?>/0" class="displayblock"><?php echo $row->id_visita ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Clientes/pestanas/'.$row->id_cliente ?>" class="displayblock"><?php echo $row->razon_social ?></a></td>
				  		<td><a href="<?php echo base_url().'index.php/Vendedores/pestanas/'.$row->id_vendedor ?>" class="displayblock"><?php echo $row->Vapellido.', '.$row->Vnombre ?></a></td>
				  		<?php $date	= date_create($row->fecha); ?>
						<td><?php echo date_format($date, 'd/m/Y') ?></td>
				  		<td><?php echo $row->origen?></td>
				  		<td>
				  			<select name="estado<?php echo $row->id_presupuesto ?>">
				  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
								<option value="0"><?php echo $this->lang->line('nueva')?></option>
				  			</select>
				  		</td>
				  		<input type="hidden" name="id_presupuesto<?php echo $row->id_presupuesto ?>" value="<?php echo $row->id_presupuesto ?>">
				  	</tr>
			 		<?php 
			 			}					
					}
					?>
	      		</tbody>
	      	</table>
	      	<input type="hidden" name="url" value="<?php echo $url ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>