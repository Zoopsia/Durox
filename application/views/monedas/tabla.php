<script>
function editar($i){
	var aux = $i;
	$('#'+aux).removeAttr("disabled");
	$('#'+aux).removeClass("editable");
	$('#'+aux).focus();
}

function guardar($i){
	alert($i);
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th colspan="2"><?php echo $this->lang->line('moneda'); ?></th>
							<th><?php echo $this->lang->line('abreviatura'); ?></th>
							<th><?php echo $this->lang->line('simbolo'); ?></th>
							<th><?php echo $this->lang->line('valor'); ?></th>
						</tr>
					</thead>
													 
					<tfoot>
						<tr>
							<th colspan="2"><?php echo $this->lang->line('moneda'); ?></th>
							<th><?php echo $this->lang->line('abreviatura'); ?></th>
							<th><?php echo $this->lang->line('simbolo'); ?></th>
							<th><?php echo $this->lang->line('valor'); ?></th>
						</tr>
					</tfoot>
													 
					<tbody>
						<?php
						if($monedas){
							$i=0;
							foreach($monedas as $row){
								echo "<tr>";
								echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable" id="'.$i.'" name="moneda" value="'.$row->moneda.'" autocomplete="off" disabled onblur="guardar('.$i.')"></td>';
								$i++;
								echo '<td>'.$row->moneda.'</td>';
								echo '<td>'.$row->abreviatura.'</td>';
								echo '<td>'.$row->simbolo.'</td>';
								echo '<td>'.$row->valor.'</td>';
								echo "</tr>";
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	     				
