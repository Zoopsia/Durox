<script>
function buscar(){
	var file = new FormData();
	file.append("documento",document.getElementById('documento').files[0]);
	
	if(document.getElementById("documento").files.length > 0 ){
		if(file){
		 	$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/documentos/mostrarDocumento', //Realizaremos la petición al metodo prueba del controlador cliente
		 	data: file , //Pasaremos por parámetro POST el id del grupo
		 	processData: false,
	  		contentType: false,
	  		cache: false,
		 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
		 		$('#doc').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
		 		$('#btn-guardar').show();
				$('#btn-cancelar').show();
		 	}
			});
		}
	}	
	else{
		$('#doc').html('');
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
	}
}

function limpiardiv(){
	$('#doc').html('');
	$('#btn-guardar').hide();
	$('#btn-cancelar').hide();
}

function validarForm(){
	var file = document.getElementById('documento').files[0];
	if(file.type == "application/pdf")
		return true;
	else{
		alert("Formato no valido!");
		$('#doc').html('');
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		return false;
	}
}
function deleteDocumento($id){
	var r = confirm("¿Esta seguro que quiere eliminar el documento?");
	if(r == true){
		var id_documento = $id;
		if(id_documento){
			$.ajax({
			 	type: 'POST',
			 	url: '<?php echo base_url(); ?>index.php/documentos/deleteDocumento', //Realizaremos la petición al metodo prueba del controlador cliente
			 	data: 'id_documento='+id_documento , //Pasaremos por parámetro POST el id del grupo
			 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
			 		$('#mostrarDocumentos').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
			 	}
			});
		}
	}
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="formulario" action="<?php echo base_url().'index.php/documentos/guardarDocumento'?>" onsubmit="return validarForm()" class="form-horizontal" method="post" enctype="multipart/form-data"> 
					<div class="row">
						<label class="col-md-1 col-lg-1  col-md-offset-2 col-lg-offset-2 control-label"><?php echo $this->lang->line('documento').':'?></label>
						<div class="col-md-4 col-lg-4">
							<input type="file" name="documento" id="documento" class="form-control editable2" onchange="buscar()">
						</div>
					</div>
					<div class="row">	
						<div id="doc" class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-md-offset-5">
							<button type="submit" id="btn-guardar" class="btn btn-primary btn-sm" style="display: none; margin-top: 15px">
								<?php echo $this->lang->line('guardar');?>
							</button>
							<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm" onclick="reset();limpiardiv()" style="display: none; margin-top: 15px">
								<?php echo $this->lang->line('cancelar');?>
							</button>
						</div>
					</div>
				</form>
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-lg-12" id="mostrarDocumentos">
						<?php
						$i = 0;
						if($documentos){
							foreach ($documentos as $row) {
								echo '<div class="col-md-2">
									  	<div class="box-tools pull-right">
						              		<button class="btn btn-danger btn-xs" onclick="deleteDocumento('.$row->id_documento.')"><i class="fa fa-times"></i></button>
						              	</div>
						              	<a href="'.$row->documento.'" style="padding: 25% 0 25% 25%" target="_blank">
						              		<i class="fa fa-file-pdf-o fa-5x"></i>
						              	</a>
						              	<br>
						              	<p class="text-center">'.cortarCadena($row->documento).'</p>
						              </div>';
								$i ++;
								if($i%6 == 0){
									echo "<br><br><br><br><br>";
								}
							}
						}
						?>
					</div>
				</div>
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  