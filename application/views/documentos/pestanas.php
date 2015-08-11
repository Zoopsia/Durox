<script>

var tipos = new Array(); 

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
				$('#id_tipo_documento').show();
		 	}
			});
		}
	}	
	else{
		$('#doc').html('');
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#id_tipo_documento').hide();
	}
}

function limpiardiv(){
	$('#doc').html('');
	$('#btn-guardar').hide();
	$('#btn-cancelar').hide();
	$('#id_tipo_documento').hide();
}

function validarForm(){
	var extensiones_permitidas = new Array(".docx", ".doc", ".xlsx",".xls", ".pdf"); 
	var archivo = document.getElementById('documento').value;
	var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
	permitida = false; 
    for (var i = 0; i < extensiones_permitidas.length; i++) { 
    	if (extensiones_permitidas[i] == extension) { 
        permitida = true; 
        break; 
        } 
    } 
    if (!permitida) { 
    	alert("Formato no valido!");
		$('#doc').html('');
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#id_tipo_documento').hide();
		return false;
	}else{ 
    	return true;
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

function ordenarDocumentos(id_tipo_documento){
	
	//$('#tipo'+id_tipo_documento).css("background-color", "#3C8DBC");
	//$('#tipo'+id_tipo_documento).css("color", "white");
	if(id_tipo_documento!=0){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/documentos/ordenarDocumento', //Realizaremos la petición al metodo prueba del controlador cliente
			data: 'id_tipo_documento='+id_tipo_documento , //Pasaremos por parámetro POST el id del grupo
			success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
				$('#mostrarDocumentos').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
			 }
		});
	}
	else{
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/documentos/ordenarDocumento', //Realizaremos la petición al metodo prueba del controlador cliente
			data: 'id_tipo_documento='+id_tipo_documento , //Pasaremos por parámetro POST el id del grupo
			success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
				$('#mostrarDocumentos').attr('disabled',false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de reglas
			 }
		});
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
					<div class="row" style=" margin-top: 15px">
						<div class="col-md-8 col-lg-8 col-md-offset-2">
							<span id="id_tipo_documento" style="display: none">
								<select name="tipo_documento[]" class="form-control chosen-select" multiple  data-placeholder="Etiquetas...">
									<option></option>
									<?php
										if($tipos){
											foreach ($tipos as $row) {
												echo '<option value="'.$row->id_tipo_documento.'">'.$row->tipo_documento.'</option>';
											}
										}
									?>
								</select>
							</span>
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
					<div class="col-md-1 dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li class="dropdown-submenu">
								<a href="#"><?php echo $this->lang->line('ordenar').' por:'; ?></a>
								<ul class="dropdown-menu">
									<?php
										if($tipos){
											foreach ($tipos as $row) {
												echo '<li id="tipo'.$row->id_tipo_documento.'"><a href="#" onclick="ordenarDocumentos('.$row->id_tipo_documento.')">'.$row->tipo_documento.'</a></li>';
											}
										}
										echo '<li><a href="#" onclick="ordenarDocumentos(0)">Todo</a></li>';
									?>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 col-lg-12" id="mostrarDocumentos">
						<?php
						$i = 0;
						$mensaje = '';
						if($documentos){
							foreach ($documentos as $row) {
								$mensaje	.= '<div class="col-md-2">
											  	<div class="box-tools pull-right">
								              		<button class="btn btn-danger btn-xs" onclick="deleteDocumento('.$row->id_documento.')"><i class="fa fa-times"></i></button>
								              	</div>
								              	<a href="'.$row->documento.'" style="padding: 25% 0 25% 25%" target="_blank">';
						        $cadena		 = substr($row->documento,strrpos($row->documento,'.'));
								if($cadena == '.pdf')
									$mensaje .=    	'<i class="fa fa-file-pdf-o fa-5x"></i>';
								else if($cadena == '.docx' || $cadena == '.doc')
									$mensaje .=    	'<i class="fa fa-file-word-o fa-5x"></i>';
								else if($cadena == '.xlsx' || $cadena == '.xls')
									$mensaje .=    	'<i class="fa fa-file-excel-o fa-5x"></i>';
						        $mensaje  	 .= '</a>
									              	<br>
									              	<p class="text-center">'.cortarCadena($row->documento).'</p>
									             </div>';
								$i ++;
								if($i%6 == 0){
									$mensaje .= "<br><br><br><br><br><br><br>";
								}
							}
							
							echo $mensaje;
						}
						?>
					</div>
				</div>
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  