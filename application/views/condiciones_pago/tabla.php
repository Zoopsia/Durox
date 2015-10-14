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
			 	url: '<?php echo base_url(); ?>index.php/Condiciones_pago/editar', 
			 	data: { 'condicion' 			: $('#'+aux).attr("name"),
			 			'dias'			: $('#'+aux).val(),
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
	$('#nuevo_pago').focus();
}

function guardarRegistroNuevo(){
	var r = confirm("¿Desea guardar el nuevo registro?");
	if($('#nuevo_pago_dias').val() > 0){
    	if (r == true) {
    		return true;
    	}
    	else{
    		$(".cargarLinea").hide();
    		$('#nuevo_pago_dias').val("");
    		$('#nuevo_pago').val("");
    		return false;
    	}
    }
    else{
    	alert("Debe ingresar valores positivos!");
    	$('#nuevo_pago_dias').focus();
    	return false;
    }
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<form action="<?php echo base_url().'/index.php/Condiciones_pago/guardarCondicion/'?>" onsubmit="return guardarRegistroNuevo()" method="post" name="formCondicion" id="formCondicion" class="form-horizontal">
							<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><?php echo $this->lang->line('condicion').' de '.$this->lang->line('pago'); ?></th>
										<th><?php echo $this->lang->line('fecha').' '.$this->lang->line('limite'); ?></th>
									</tr>
								</thead>
													 
								<tbody>
									<?php
									if($condiciones){
										$i=0; $j=1;
										foreach($condiciones as $row){
											echo "<tr>";
											echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable text-center" id="'.$i.'" name="condicion" value="'.$row->condicion_pago.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')"></td>';
											$i++;
											echo '<td ondblclick="editar('.$i.');"><input type="number" class="editable text-center" id="'.$i.'" name="dias" value="'.$row->dias.'" autocomplete="off" disabled min="1" step="1" onblur="guardar('.$i.','.$j.')"></td>';
											$i++;
											echo "</tr>";
											$j++;
										}
									}
									?>
								</tbody>
													 
								<tfoot>
									<tr class="cargarLinea" style="display: none">
										<td>
											<input type="text" id="nuevo_pago" name="nuevo_pago" onkeypress="if (event.keyCode==13){ $('#nuevo_pago_dias').focus(); return false;}" class="editable text-center" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('condicion').' de '.$this->lang->line('pago'); ?>" required style="height: 20px">
										</td>
										<td>
											<input type="number" id="nuevo_pago_dias" name="nuevo_pago_dias" onkeypress="if (event.keyCode==13){ $('#formCondicion').submit(); return false;}" class="editable text-center" min="1" step="1" autocomplete="off" pattern="[0-9]*" placeholder="<?php echo $this->lang->line('dias'); ?>" style="height: 20px" required>
										</td>	
									</tr>
								</tfoot>
											
							</table>
						</form>
					</div>
				</div>
				<div class="row">
                        <div class="col-xs-12">
                        	<button type="button" id="btn-nuevo" class="btn btn-success btn-sm pull-right" onclick="nuevo()" style=" margin-left: 5px">
								<?php echo $this -> lang -> line('nuevo'); ?>
							</button>
                         </div>
                    </div>
			</div>
		</div>
	</div>
</div>	     				
