<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php if($sincronizacion){ ?>
				<form action="<?php echo base_url().'/index.php/Mssql/guardarActualizacion/'?>" onsubmit="return guardar()" method="post" class="form-horizontal">
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<table class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Elegir los datos que va a actualizar diariamente</th>
									<th><input type="checkbox" id="select-all"/></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach($sincronizacion as $row){
									if($row->columna != "id_db"){	
										echo "<tr>";
										echo '<td style="padding-top: 15px;">Actualizar <strong><u>'.str_replace("_"," ",$row->columna).'</u></strong> de <mark>'.substr($row->origen,7).'</mark></td>';
										if($row->actualiza == 1)
											echo '<td><input type="checkbox" checked class="input-seleccion" name="actualizar[]" value="'.$row->id_sincronizacion.'"/></td>';
										else
											echo '<td><input type="checkbox" class="input-seleccion" name="actualizar[]" value="'.$row->id_sincronizacion.'"/></td>';
										
										echo "</tr>";
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="row">
                	<div class="col-xs-12">
                		<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="cancelar()"style="margin-left: 5px">
							<?php echo $this -> lang -> line('cancelar'); ?>
						</button>
                        <button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right"  style="margin-left: 5px">
							<?php echo $this -> lang -> line('guardar'); ?>
						</button>
                	</div>
            	</div>
            	</form>
            	<?php } ?>
			</div>
		</div>
	</div>
</div>	     				
<script>

$('.content-header > h1').html('SINCRONIZACIÓN<small><?php echo $this->lang->line("mssql_tabla");?></small>');

$('#select-all').on('ifChecked', function(event){
	$('.input-seleccion').iCheck('check');
});

$('#select-all').on('ifUnchecked', function(event){
	$('.input-seleccion').iCheck('uncheck');
});

function guardar(){
	var r = confirm("¿Esta seguro que quiere guardar los cambios?");
    if (r == true)
    	return true;
    else
    	return false;
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true)
    	location.reload();
}
</script>