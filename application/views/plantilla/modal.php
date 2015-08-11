<!------------------------------------------------------------------------
--------------------------------------------------------------------------
					Modal mensaje
--------------------------------------------------------------------------
------------------------------------------------------------------------->	

<div class="modal fade" id="modal_mensajes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	      			<th><?php echo $this->lang->line('estado')?></th>
      			</tr>
      		</thead>
      		<tbody>
      			<?php foreach($visitas_mensajes as $row) { ?>
      			<tr>
			  		<td><a href="http://localhost/Durox/index.php/Visitas/carga/<?php echo $row->id_visita ?>/0" class="displayblock"><?php echo $row->id_visita ?></a></td>
			  		<td><a href="http://localhost/Durox/index.php/Clientes/pestanas/<?php echo $row->id_cliente ?>" class="displayblock"><?php echo $row->Capellido.', '.$row->Cnombre ?></a></td>
			  		<td><a href="http://localhost/Durox/index.php/Vendedores/pestanas/<?php echo $row->id_vendedor ?>" class="displayblock"><?php echo $row->Vapellido.', '.$row->Vnombre ?></a></td>
			  		<?php $date	= date_create($row->fecha); ?>
					<td><?php echo date_format($date, 'd/m/Y') ?></td>
			  		<td>
			  			<select name="estado<?php echo $row->id_visita ?>">
			  				<option value="1" selected><?php echo $this->lang->line('visto')?></option>
							<option value="0"><?php echo $this->lang->line('nueva')?></option>
			  			</select>
			  		</td>
			  		<input type="hidden" name="id_mensaje<?php echo $row->id_visita ?>" value="<?php echo $row->id_visita ?>">
			  	</tr>
		 		<?php }?>
      		</tbody>
      	</table>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
