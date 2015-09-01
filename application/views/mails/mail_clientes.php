<script>
function pegarEtiqueta(){
	if($( "#btn-tag" ).val()){
		var caretPos 		= document.getElementById("txt").selectionStart;
	    var textAreaTxt 	= $('#txt').val();
	    var txtToAdd 		=  $( "#btn-tag" ).val();
		$("#txt").val(textAreaTxt.substring(caretPos) + txtToAdd);
	}
}

function insertInputTag(){
	$("#btn-tag" ).val($( "#etiquetas" ).val());
}

</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?php echo base_url().'index.php/Mails/modificarMail' ?>" class="form-horizontal" method="post">
					<div class="col-sm-2">
						<nav class="nav-tab nav-justified">
							<ul class="nav nav-sidebar">
								<li class="active in"><a href="#mail1" data-toggle="tab"><?php echo $this->lang->line('detalle').' '.$this->lang->line('correo'); ?></a></li>
							    <li class=""><a href="#mail2" data-toggle="tab"><?php echo $this->lang->line('configuraciones'); ?></a></li>
					        </ul>
					   	</nav>
					</div>
					<div class="tab-content">
		     			<div class="tab-pane fade active in" id="mail1">
		     				<div class="col-lg-10 col-md-10">
							<?php if($config_mail){ foreach($config_mail as $mail){?>
								<div class="form-group">
								   	<input type="text" class="form-control" name="para" placeholder="Enviar a: " required disabled>
								</div>
								<div class="form-group">
								  	<input type="text" class="form-control" name="titulo" placeholder="Titulo" required value="<?php echo $mail->asunto?>">
								</div>
								<div class="form-group">
								  	<textarea id="txt" class="texteditor" name="cuerpo" rows="10" cols="80">
										<?php echo $mail->cuerpo?>
									</textarea>
								</div>
								<div class="form-group">
								   	<textarea id="editora" name="cabecera" rows="10" cols="80" style="display:none;">
								   		<?php echo $mail->cabecera?>
								   	</textarea>
								</div>						   
								<?php $tags = traerTags();?>
								<div class="form-group">
								   	<div class="col-md-8">
								      	<select id="etiquetas" onchange="insertInputTag()" class="form-control" data-placeholder="Seleccione un tipo...">
								       		<option disabled selected>Etiquetas...</option>
								      		<?php 
								      		foreach($tags as $key => $value){
								    			echo '<option value="'.$value.'">'.$key.'</option>';
								       		}
											?>
								        </select>
									</div>
								    <div class="col-md-4">
								       	<input type="button" id="btn-tag" value="" onclick="pegarEtiqueta()" class="btn btn-default form-control">
								    </div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="mail2">
		     				<div class="col-lg-10 col-md-10">
		     					<div class="form-group" border="1">
									<?php if($mail->enviar_auto == 1){ ?>
									<fieldset>
    									<legend>Opciones:</legend>
    									<div class="row">
    										<div class="col-md-6 col-lg-6">
												<blockquote>
													<em>
														<p style="font-size: 14.5px">
															"Si selecciona esta opción un correo se enviará de forma automática cada vez que se apruebe un pedido.-"
														</p>
													</em>
												</blockquote>
											</div>
	    									<div class="col-md-6 col-lg-6">
												<label class="col-md-10 control-label">Enviar Mail Automáticamente: </label>
												<div class="col-md-2">
													<input type="checkbox" name="enviar_auto" checked value="1">
												</div>
											</div>
											
										</div>
									</fieldset>
									<?php }else{ ?>
									<fieldset>
    									<legend>Opciones:</legend>
    									<div class="row">
    										<div class="col-md-6 col-lg-6">
												<blockquote>
													<em>
														<p style="font-size: 14.5px">
															"Si selecciona esta opción un correo se enviará de forma automática cada vez que se apruebe un pedido.-"
														</p>
													</em>
												</blockquote>
											</div>
											<div class="col-md-6 col-lg-6">
												<label class="col-md-10 control-label">Enviar Mail Automáticamente: </label>
												<div class="col-md-2">
													<input type="checkbox" name="enviar_auto" value="0">
												</div>
											</div>
										</div>
									</fieldset>
									<?php } ?>
								</div>
		     				</div>
		     				<?php } }?>
		     			</div>
					</div>
					<div class="row">
				    	<div class="col-md-10 col-md-offset-1">
							<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm pull-right" onclick="location.reload();" style="margin-left: 5px">
								<?php echo $this->lang->line('cancelar');?>
							</button>
							<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px">
								<?php echo $this->lang->line('guardar');?>
							</button>
						</div>            
					</div>
				</form>	
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>