<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php if($mostrar_registro == 1){ ?>	
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="alert alert-success alert-dismissible slideDown" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							El registro <?php echo ' '.$this->lang->line('insert_ok');?>
						</div>
					</div>
				</div>
				<?php }  else if($mostrar_registro == 2){ ?>	
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="alert alert-success alert-dismissible slideDown" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							El registro <?php echo ' '.$this->lang->line('delete_ok');?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo $this->lang->line('tiempo').' de '.$this->lang->line('entrega'); ?></th>
								</tr>
							</thead>
																						 
							<tbody>
								<?php
								if($tiempos_entrega){
									$i=0; $j=1;
									foreach($tiempos_entrega as $row){
										echo "<tr>";
										echo '<td ondblclick="editar('.$i.');"><input type="text" class="editable text-center" id="'.$i.'" name="tiempo_entrega" value="'.$row->tiempo_entrega.'" autocomplete="off" disabled onblur="guardar('.$i.','.$j.')" style="width: 100%"></td>';
										$i++;
										echo '<td class="col-eliminar"><input type="checkbox" class="check-eliminar" name="eliminar[]" value="'.$row->id_tiempo_entrega.'"></td>';
										echo "</tr>";
										$j++;
									}
								}
								?>
							</tbody>
							
							<form action="<?php echo base_url().'/index.php/Tiempos_entrega/guardarTiempo/'?>" onsubmit="return guardarRegistroNuevo()" method="post" name="formCondicion" id="formCondicion" class="form-horizontal">						 
								<tfoot>
									<tr class="cargarLinea" style="display: none">
										<td>
											<input type="text" id="nuevo_tiempo" name="nuevo_tiempo" onkeypress="if (event.keyCode==13){ $('#formCondicion').submit(); return false;}" class="editable text-center txtmoneda" autocomplete="off" pattern="^[A-Za-z0-9 ]+$" placeholder="<?php echo $this->lang->line('tiempo').' de '.$this->lang->line('entrega'); ?>" required>
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
<script>
var valorInput;
var varCheck = 0;
$('.check-eliminar').on('ifChecked', function(){
	$('#btn-nuevo').hide();
	$('#btn-cancelar').show();
	$(".cargarLinea").hide();
	$('#reg-eliminar').show();
	varCheck ++;
});

$('.check-eliminar').on('ifUnchecked', function(){
	varCheck --;
	if(varCheck == 0)
		armarNuevo();
});

function armarNuevo(){
	$('#btn-nuevo').show();
	$('#btn-cancelar').hide();
	$('#reg-eliminar').hide();
}

function cancelar(){
	varCheck = 0;
	$('.check-eliminar').iCheck('uncheck');
	armarNuevo();
}

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
			 	url: '<?php echo base_url(); ?>index.php/Tiempos_entrega/editarTiempo', 
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
	$('#nuevo_tiempo').focus();
}

function guardarRegistroNuevo(){
	if($('#nuevo_tiempo').val()){
		var r = confirm("¿Desea guardar el nuevo registro?");
	    if (r == true) 
	    	return true;
	    else
	    	return false;
	}
	else
		return false;
}

function eliminar(){
	var aux =  $( ".check-eliminar:checked" ).length;
	if(aux>0){
		var Datos = $('.check-eliminar').serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Tiempos_entrega/eliminarTiempo', 
			data: Datos, 
		 	success: function(resp) { 
		 		if(resp){
					alert("Hay registros que no se pueden eliminar ya que han sido usados previamente!");	
					window.location.replace('<?php echo base_url()."index.php/Tiempos_entrega/Tiempos_entrega/";?>');
				}
				else
					window.location.replace("Delete");
			},	
		});
	}
}
</script>