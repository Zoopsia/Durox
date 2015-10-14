<script>
var valorInput;
function editar($i){
	var aux = $i;
	$('#'+aux).removeAttr("disabled");
	$('#'+aux).removeClass("editable");
	$('#'+aux).focus();
	valorInput = $('#'+aux).val();
}

function guardar($i, $j){
	var aux = $i;
	var id	= $j;
	$('#'+aux).attr("disabled", true);
	$('#'+aux).addClass("editable");
	if($('#'+aux).val() != valorInput){
		var r = confirm("¿Desea guardar los cambios?");
    	if (r == true) {
    		$.ajax({
			 	type: 'POST',
			 	url: '<?php echo base_url(); ?>index.php/Monedas/editarMoneda', 
			 	data: { 'name' 			: $('#'+aux).attr("name"),
			 			'valor'			: $('#'+aux).val(),
			 			'id'			: id,
			 	}, 
			 	success: function(resp) { 
			 		alert(resp);
			 	}
			});
    	}
    	else{
    		$('#'+aux).val(valorInput);
    	}
	}
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('moneda'); ?></th>
							<th><?php echo $this->lang->line('abreviatura'); ?></th>
							<th><?php echo $this->lang->line('simbolo'); ?></th>
							<th><?php echo $this->lang->line('valor'); ?></th>
						</tr>
					</thead>
													 
					<tfoot>
						<tr>
							<th><?php echo $this->lang->line('moneda'); ?></th>
							<th><?php echo $this->lang->line('abreviatura'); ?></th>
							<th><?php echo $this->lang->line('simbolo'); ?></th>
							<th><?php echo $this->lang->line('valor'); ?></th>
						</tr>
					</tfoot>
													 
					<tbody>
						<?php
						if($monedas){
							$i=0; $j=1;
							foreach($monedas as $row){
								echo "<tr>";
								echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable text-center" id="'.$i.'" name="moneda" value="'.$row->moneda.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')"></td>';
								$i++;
								echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable text-center" id="'.$i.'" name="abreviatura" value="'.$row->abreviatura.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')"></td>';
								$i++;
								echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable text-center" id="'.$i.'" name="simbolo" value="'.$row->simbolo.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')"></td>';
								$i++;
								echo '<td ondblclick="editar('.$i.');"><input type="number" class="editable text-center" id="'.$i.'" name="valor" value="'.$row->valor.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')"></td>';
								$i++;
								echo "</tr>";
								$j++;
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>	     				
