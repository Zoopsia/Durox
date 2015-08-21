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
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
							<div class="form-group">
						    	<input type="text" class="form-control" name="para" placeholder="Enviar a: " required disabled>
							</div>
						    <?php if($config_mail){ foreach($config_mail as $mail){?>
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
						    <?php } }?>
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