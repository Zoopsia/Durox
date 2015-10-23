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

function nuevo(){
	$(".cargarLinea").show();
	$('#nuevo_moneda').focus();
}

function guardarRegistroNuevo(){
	if($('#nuevo_moneda').val() && $('#nuevo_abreviatura').val() && $('#nuevo_simbolo').val() && $('#nuevo_valor').val()){
		var r = confirm("¿Desea guardar el nuevo registro?");
	    if (r == true) 
	    	return true;
	    else
	    	return false;
	}
	else
		return false;
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo $this->lang->line('moneda'); ?></th>
									<th><?php echo $this->lang->line('abreviatura'); ?></th>
									<th><?php echo $this->lang->line('simbolo'); ?></th>
									<th><?php echo $this->lang->line('valor'); ?></th>
								</tr>
							</thead>
																						 
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
										echo '<td class="col-eliminar"><input type="checkbox" class="check-eliminar" name="eliminar[]" value="'.$row->id_moneda.'"></td>';
										echo "</tr>";
										$j++;
									}
								}
								?>
							</tbody>
							
							<form action="<?php echo base_url().'/index.php/Monedas/guardarMoneda/'?>" onsubmit="return guardarRegistroNuevo()" method="post" name="formCondicion" id="formCondicion" class="form-horizontal">						 
								<tfoot>
									<tr class="cargarLinea" style="display: none">
										<td>
											<input type="text" id="nuevo_moneda" name="nuevo_moneda" onkeypress="if (event.keyCode==13){ $('#nuevo_abreviatura').focus(); return false;}" class="editable text-center txtmoneda" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('moneda'); ?>" required>
										</td>
										<td>
											<input type="text" id="nuevo_abreviatura" name="nuevo_abreviatura" onkeypress="if (event.keyCode==13){ $('#nuevo_simbolo').focus(); return false;}" class="editable text-center txtmoneda" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('abreviatura'); ?>" required>
										</td>
										<td>
											<input type="text" id="nuevo_simbolo" name="nuevo_simbolo" onkeypress="if (event.keyCode==13){ $('#nuevo_valor').focus(); return false;}" class="editable text-center txtmoneda" autocomplete="off" placeholder="<?php echo $this->lang->line('simbolo'); ?>" required>
										</td>
										<td>
											<input type="text" id="nuevo_valor" name="nuevo_valor" onkeypress="if (event.keyCode==13){ $('#formCondicion').submit(); return false;}" class="editable text-center txtmoneda" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('valor'); ?>" min="1" required>
										</td>	
										<td style="display: none"></td>
									</tr>
								</tfoot>
							</form>		
						</table>
					</div>
				</div>
				
				<div class="row">
                	<div class="col-xs-12">
                        <button type="button" id="btn-nuevo" class="btn btn-success btn-sm pull-right" onclick="nuevo()" style=" margin-left: 5px">
							<?php echo $this -> lang -> line('nuevo'); ?>
						</button>
						<button type="button" id="btn-cancelar" class="btn btn-primary btn-sm pull-right" onclick="cancelar()" style=" display:none; margin-left: 5px">
							<?php echo $this -> lang -> line('cancelar'); ?>
						</button>
						<button type="button" id="reg-eliminar" class="btn btn-danger btn-sm pull-right" onclick="eliminar()" style=" display:none; margin-left: 5px">
							<?php echo $this -> lang -> line('eliminar'); ?>
						</button>
                	</div>
            	</div>
			</div>
		</div>
	</div>
</div>	     				
