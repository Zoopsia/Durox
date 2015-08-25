<script>
function colorSelect(){
	var color = $('#color').val();
	$('#color').removeClass();
	$('#color').addClass('form-control alert-'+color);
}

</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
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
			  		<div class="col-sm-6">
					  	<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('nuevo').' '.$this->lang->line('tipo').' de '.$this->lang->line('alarma'); ?>
							</a>
						</div></h3>
					</div>
				</div>
				<form action="<?php echo base_url().'index.php/Alarmas/guardarTipoAlarma' ?>" class="form-horizontal" method="post">
					<div style="padding: 0 50px">
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
							<label class="col-sm-2 control-label"></label>
					    	<div class="col-md-8">
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
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  
