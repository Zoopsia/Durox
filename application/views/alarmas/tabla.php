<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-sm-2">
					<nav class="nav-tab nav-justified">
						<ul class="nav nav-sidebar">
							<li class="active in"><a href="#mail1" data-toggle="tab"><?php echo $this->lang->line('alarmas'); ?></a></li>
						    <li class=""><a href="#mail2" data-toggle="tab"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('tipo').' de '.$this->lang->line('alarma'); ?></a></li>
					    </ul>
					</nav>
				</div>
				<div class="tab-content">
		     		<div class="tab-pane fade active in" id="mail1">
		     			<div class="col-lg-10 col-md-10">
		     				<?php if($id_alarma != 0) { ?>
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="alert alert-success alert-dismissable">
			                        	<i class="fa fa-check"></i>
			                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                        	<?php echo $this->lang->line('el_registro'); ?>
										<a href=""><?php echo $id_alarma; ?></a>
										<?php echo $this->lang->line('insert_ok'); ?>
			                    	</div> 
								</div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="col-md-4">
									<table class="table table-bordered table-hover" cellspacing="0" width="100%">
								        <thead>
								            <tr>
								            	<th class="text-center"><?php echo $this->lang->line('nombre'); ?></th>
								            </tr>
								        </thead>
								 		<tbody class="text-center">
								 		<?php
											if($alarmas){
												foreach($alarmas as $row){
													echo "<tr>";
													$tipo_alarma = str_replace('<i class="fa ', "", $row->tipo_alarma);
													$tipo_alarma = str_replace('"></i>', "", $tipo_alarma);
													
													echo "<td style='cursor: pointer' id='col".$row->id_tipo_alarma."' onclick='armarEditar(\"{$row->id_tipo_alarma}\",\"{$row->nombre}\",\"{$row->color}\",\"{$tipo_alarma}\")'>".$row->nombre."</td>";
													echo "</tr>";
												}
											}
										?>
										</tbody>
									</table>
								</div>
								<div class="col-md-8" id="alarma_formato">
								
								</div>
								<div class="col-md-8" id="alarma_editar" style="display: none; padding: 0 30px 0 50px">
									<form action="<?php echo base_url().'index.php/Alarmas/editarTipoAlarma' ?>" class="form-horizontal" method="post">
									<div class="form-group odd">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('nombre').'*:'; ?></label>
										<div class="col-sm-8">
											<input type="text" name="nombre_editar" id="nombre_editar" class="form-control" placeholder="Nombre Alarma" required>	 
											<input type="text" name="id_alarma_editar" id="id_alarma_editar" class="form-control" required style="display:none">	
										</div>
									</div>
									<div class="form-group even">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('icono').'*:'; ?></label>
										<div class="col-sm-8">
											<select class="form-control" id="icono_editar" name="icono_editar" style="font-family: 'FontAwesome', Helvetica;" required>
												<option value='<i class="fa fa-thumbs-up"></i>'>&#xf087;</option>
												<option value='<i class="fa fa-info"></i>'>&#xf129;</option>
					                            <option value='<i class="fa fa-warning"></i>'>&#xf071;</option>
					                            <option value='<i class="fa fa-exclamation"></i>'>&#xf12a;</option>
					                            <option value='<i class="fa fa-star"></i>'>&#xf005;</option>
					                            <option value='<i class="fa fa-hourglass-end"></i>'>&#xf253;</option>
					                            <option value='<i class="fa fa-check"></i>'>&#xf00c;</option>
					                            <option value='<i class="fa fa-ban"></i>'>&#xf05e;</option>
					                            <option value='<i class="fa fa-thumbs-o-down"></i>'>&#xf088;</option>
					                            <option value='<i class="fa fa-user"></i>'>&#xf007;</option>
					                            <option value='<i class="fa fa-users"></i>'>&#xf0c0;</option>
					                            <option value='<i class="fa fa-user-plus"></i>'>&#xf234;</option>
					                            <option value='<i class="fa fa-user-times"></i>'>&#xf235;</option>
					                        </select> 	 
										</div>
									</div>
									<div class="form-group odd">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('color').'*:'; ?></label>
										<div class="col-sm-8">
											<select class="form-control" id="color_editar" name="color_editar" style="font-family: 'FontAwesome', Helvetica;" required onchange="colorSelect()">
												<option class="alert-success" value="success">Verde</option>
												<option class="alert-info" value="info">Azul</option>
												<option class="alert-warning" value="warning">Amarillo</option>
												<option class="alert-danger" value="danger">Rojo</option>
					                        </select>  
										</div>
									</div>
									<hr />
									<div class="row">
								    	<div class="pull-right">
								    		<button type="submit" id="btn-guardar" class="btn btn-primary">
												<?php echo $this->lang->line('guardar');?>
											</button>
											<button type="button" id="btn-cancelar" class="btn btn-danger" onclick="location.reload();">
												<?php echo $this->lang->line('cancelar');?>
											</button>
										</div>            
									</div>
									</form>
								</div>
							</div>
						</div>
					</div><!--tab 1-->
					<div class="tab-pane fade" id="mail2">
						<div class="col-lg-10 col-md-10">
							<form action="<?php echo base_url().'index.php/Alarmas/guardarTipoAlarma' ?>" class="form-horizontal" method="post">
								<div style="padding: 20px 50px 0px 50px">
									<div class="form-group odd">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('nombre').'*:'; ?></label>
										<div class="col-sm-8">
											<input type="text" name="nombre" class="form-control" placeholder="Nombre Alarma" required>	 
										</div>
									</div>
									<div class="form-group even">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('icono').'*:'; ?></label>
										<div class="col-sm-8">
											<select class="form-control" id="icono" name="icono" style="font-family: 'FontAwesome', Helvetica;" required>
												<option disabled selected>Seleccione un Icono...</option>
												<option value='<i class="fa fa-thumbs-up"></i>'>&#xf087;</option>
												<option value='<i class="fa fa-info"></i>'>&#xf129;</option>
					                            <option value='<i class="fa fa-warning"></i>'>&#xf071;</option>
					                            <option value='<i class="fa fa-exclamation"></i>'>&#xf12a;</option>
					                            <option value='<i class="fa fa-star"></i>'>&#xf005;</option>
					                            <option value='<i class="fa fa-hourglass-end"></i>'>&#xf253;</option>
					                            <option value='<i class="fa fa-check"></i>'>&#xf00c;</option>
					                            <option value='<i class="fa fa-ban"></i>'>&#xf05e;</option>
					                            <option value='<i class="fa fa-thumbs-o-down"></i>'>&#xf088;</option>
					                            <option value='<i class="fa fa-user"></i>'>&#xf007;</option>
					                            <option value='<i class="fa fa-users"></i>'>&#xf0c0;</option>
					                            <option value='<i class="fa fa-user-plus"></i>'>&#xf234;</option>
					                            <option value='<i class="fa fa-user-times"></i>'>&#xf235;</option>
					                        </select> 	 
										</div>
									</div>
									<div class="form-group odd">
										<label class="col-sm-2 control-label"><?php echo $this->lang->line('color').'*:'; ?></label>
										<div class="col-sm-8">
											<select class="form-control" id="color" name="color" style="font-family: 'FontAwesome', Helvetica;" required onchange="colorSelect()">
												<option disabled selected>Seleccione un Color...</option>
												<option class="alert-success" value="success">Verde</option>
												<option class="alert-info" value="info">Azul</option>
												<option class="alert-warning" value="warning">Amarillo</option>
												<option class="alert-danger" value="danger">Rojo</option>
					                        </select>  
										</div>
									</div>
								
									<hr />
									<div class="row">
										<label class="col-sm-7 control-label"></label>
								    	<div class="col-md-4">
								    		<button type="submit" id="btn-guardar" class="btn btn-primary">
												<?php echo $this->lang->line('guardar');?>
											</button>
											<button type="button" id="btn-cancelar" class="btn btn-danger" onclick="location.reload();">
												<?php echo $this->lang->line('cancelar');?>
											</button>
										</div>            
									</div>
								</div>
							</form>
						</div>
					</div><!--tab 1-->
				</div><!--tab content-->
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  

<script src=<?php echo base_url().'libraries/main/views/alarmas/js/tabla.js'?>></script>
<script>
$(function() {
	startTime();
    $(".center").center();
    $(window).resize(function() {
    	$(".center").center();
    });
});

function armarEditar($id,$nombre,$color,$tipo_alarma){
	
	$('#alarma_editar').show('slow','linear');	
	
	$('td').css("background-color", "#fff");
	$('#col'+$id).css("background-color", "#ccc");
	
	$('#alarma_formato').html('<div class="alert alert-'+$color+' alert-dismissable">'+
	'<i class="fa '+$tipo_alarma+'"></i>'+
	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
	'<br>'+
	'</div>');

	var tipo = new RegExp($tipo_alarma,"g");

	$('#id_alarma_editar').val($id);
	
	$('#nombre_editar').val($nombre);
	$("#color_editar option").each(function(){
   		if($(this).val() == $color)
   			$(this).prop('selected', true);
	});
	
	$("#icono_editar option").each(function(){
   		if(tipo.test($(this).val()))
   			$(this).prop('selected', true);
	});
}
</script>