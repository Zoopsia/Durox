<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
		  		<ul class="nav nav-pills">
					<li class="active"><a href="#tab1" data-toggle="tab"><?php echo 'Configurar Correo'; ?></a></li>
					<li class="pull-right"><a href="#tab2" data-toggle="tab"><?php echo 'Configuración Servidor Mail'; ?></a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
	    			<div class="tab-pane fade in active" id="tab1">
						<?php if($config_mail){ ?>
						<form action="<?php echo base_url()."index.php/Perfil/cambiarCorreoUsuario"?>" class="form-horizontal" method="post">
							<div class="col-md-10 col-md-offset-1">
								<div class="form-group odd">
									<label class="col-sm-4 control-label"><?php echo 'Correo: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="correo" class="form-control" value="<?php echo $config_mail['correo']; ?>" required> 	    	
									</div> 
								</div>
								<hr />
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-md-8">
										<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-sm btn-danger pull-right" id="btn-cancelar" onclick="cancelar()"  style="margin-left: 5px;">
										<button type="submit" class="btn btn-sm btn-primary pull-right" name="btn-save"><?php echo $this->lang->line('guardar'); ?></button> 
									</div>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
					<div class="tab-pane fade" id="tab2">
						<?php if($config_mail){ ?>
						<form action="<?php echo base_url()."index.php/Perfil/cambiarPerfil"?>" class="form-horizontal" method="post">
							<div class="col-md-10 col-md-offset-1">
								<div class="form-group even">
									<label class="col-sm-4 control-label"><?php echo 'Nombre: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="from" class="form-control" value="<?php echo $config_mail['from']; ?>" required> 	    	
									</div> 
								</div>
								<div class="form-group odd">
									<label class="col-sm-4 control-label"><?php echo 'Seguridad SMTP: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="seguridad_smtp" class="form-control" value="<?php echo $config_mail['seguridad_smtp']; ?>" required> 	    	
									</div> 
								</div>
								<div class="form-group even">
									<label class="col-sm-4 control-label"><?php echo 'Autorización SMTP: '; ?></label>
									<div class="col-sm-8">
										<?php if($config_mail['autorizacion_smtp'] == 1){ ?>
										<input type="checkbox" value="1" checked name="autorizacion_smtp" class="form-control"> 	
										<?php } else { ?>
										<input type="checkbox" value="1" name="autorizacion_smtp" class="form-control"> 
										<?php } ?>   	    	
									</div> 
								</div>
								<div class="form-group odd">
									<label class="col-sm-4 control-label"><?php echo 'HOST: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="host" class="form-control" value="<?php echo $config_mail['host']; ?>" required> 	    	
									</div> 
								</div>
								<div class="form-group even">
									<label class="col-sm-4 control-label"><?php echo 'PUERTO: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="puerto" class="form-control" value="<?php echo $config_mail['puerto']; ?>" required> 	    	
									</div> 
								</div>
								<div class="form-group odd">
									<label class="col-sm-4 control-label"><?php echo 'Lenguaje: '; ?></label>
									<div class="col-sm-8">
										<input type="text" name="lenguaje" class="form-control" value="<?php echo $config_mail['lenguaje']; ?>" required> 	    	
									</div> 
								</div>
								<div class="form-group even">
									<label class="col-sm-4 control-label"><?php echo 'HTML activado: '; ?></label>
									<div class="col-sm-8">
										<?php if($config_mail['html_enable'] == 1){ ?>
										<input type="checkbox" value="1" checked name="html_enable" class="form-control"> 	
										<?php } else { ?>
										<input type="checkbox" value="1" name="html_enable" class="form-control"> 
										<?php } ?>    	
									</div> 
								</div>
								<hr />
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-md-8">
										<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-sm btn-danger pull-right" id="btn-cancelar" onclick="cancelar()"  style="margin-left: 5px;">
										<button type="submit" class="btn btn-sm btn-primary pull-right" name="btn-save"><?php echo $this->lang->line('guardar'); ?></button> 
									</div>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!--panel-->
	</div><!--contenedor-->
</div> 
<script>
function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true)
    	location.reload();
}
</script>
