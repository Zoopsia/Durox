<?php	
	$cont_mensajes 	= 0;
	if($mensajeria){
		foreach($mensajeria as $mensajeria){
			if($mensajeria->visto == 0)
				$cont_mensajes++;
		}
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<!-- MENSAJERIA --->
				<div class="mailbox row">
                	<div class="col-xs-12">
                    	<div class="col-md-3 col-sm-4">
                        	<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_mensajes"><i class="fa fa-pencil"></i><?php echo ' '.$this->lang->line('redactar').' '.$this->lang->line('mensaje');?></a>
                            <!-- Navigation - folders-->
                            <div style="margin-top: 15px;" id="div-prueba">
	                            <ul class="nav nav-pills nav-stacked">
		                            <li class="header"><?php echo $this->lang->line('carpetas');?></li>
		                            <li class="active in"><a href="#mail1" data-toggle="tab" onclick="$('input').iCheck('uncheck');"><i class="fa fa-inbox"></i> <?php echo $this->lang->line('recibidos').' ('.$cont_mensajes.')';?></a></li>
		                            <li><a href="#mail2" data-toggle="tab" onclick="$('input').iCheck('uncheck');"><i class="fa fa-mail-forward"></i> <?php echo $this->lang->line('enviados');?></a></li>
		                            <li><a href="#mail3" data-toggle="tab" onclick="$('input').iCheck('uncheck');"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('papelera');?> </a></li>
	                            </ul>
                            </div>
						</div><!-- /.col (LEFT) -->
                        <div class="tab-content">
		     				<div class="tab-pane fade active in" id="mail1">            
                            	<div class="col-md-9 col-sm-8">
                            		<!-- BUSQUEDA Y ACCIONES -->
                            		<div class="row pad">
                                    	<div class="col-sm-6 btn-accion-mensajes">
                                        	<label style="margin-right: 10px;">
                                            	<div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" id="check-all-recibidos" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                            </label>
                                            <!-- Action button -->
                                        	<div class="btn-group">
                                            	<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                	<?php echo $this->lang->line('acciones')?> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
	                                                <li><a onclick="funcionLeido()"><?php echo $this->lang->line('marcar_leido')?></a></li>
	                                                <li><a onclick="funcionNoLeido()"><?php echo $this->lang->line('marcar_noleido')?></a></li>
	                                                <li class="divider"></li>
	                                                <li><a onclick="funcionPapelera()"><?php echo $this->lang->line('mover_papelera')?></a></li>
	                                                <li class="divider"></li>
	                                                <li><a href="#"><?php echo $this->lang->line('eliminar')?></a></li>
                                                </ul>
                                            </div>
										</div>
                                    </div>
                            		
	                            	<div class="row">
		                            	<div class="col-md-12 table-responsive">
	                                <!-- RECIBIDOS -->
		                                	<table class="table table-mailbox tablas-mensajes" style="width: 100% !important;">
		                                		<thead>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                		</thead>
		                                		<tbody>
		                                		<?php if($recibidos) { foreach($recibidos as $row) { if($row->visto == 0) { ?>
												<tr class="unread">
		                                        	<td class="small-col"><input type="checkbox" class="input-recibidos" name="recibidos[]" value="<?php echo $row->id_sin_mensaje_vendedor;?>"/></td>
		                                            <td class="small-col"><i class="fa fa-star"></i></td>
		                                            <td class="name"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
		                                            <td class="subject"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->asunto;?></a></td>
		                                            <td class="time"><?php $date	= date_create($row->date_add); echo ' '.date_format($date, 'd/m/Y');?></td>
		                                        </tr>
												<?php } else { ?>
												<tr>
		                                            <td class="small-col"><input type="checkbox" class="input-recibidos" name="recibidos[]" value="<?php echo $row->id_sin_mensaje_vendedor;?>"/></td>
		                                            <td class="small-col"><i class="fa fa-star-o"></i></td>
		                                            <td class="name"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
		                                            <td class="subject"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->asunto;?></a></td>
		                                            <td class="time"><?php $date	= date_create($row->date_add); echo ' '.date_format($date, 'd/m/Y');?></td>
		                                        </tr>
												<?php } } } else { ?>   
												<tr>
		                                            <td class="small-col" style="height: 43px"></td>
		                                            <td class="small-col"></td>
		                                            <td class="name"></td>
		                                            <td class="subject"></td>
		                                            <td class="time"></td>
		                                        </tr>
		                                        <?php } ?> 
		                                        </tbody>      
		                                    </table>
		                                </div><!-- /.table-responsive -->
		                        	</div>
								</div><!-- /.col (RIGHT) -->
							</div>
							<div class="tab-pane fade" id="mail2">
							<!-- /TAB2 -->
								<div class="col-md-9 col-sm-8">
                            		<!-- BUSQUEDA Y ACCIONES -->
                            		<div class="row pad">
                                    	<div class="col-sm-6 btn-accion-mensajes">
                                        	<label style="margin-right: 10px;" >
                                            	<div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" id="check-all-enviados" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                            </label>
                                            <!-- Action button -->
                                        	<div class="btn-group">
                                            	<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                	<?php echo $this->lang->line('acciones')?> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
	                                                <li><a onclick="funcionPapelera2()"><?php echo $this->lang->line('mover_papelera')?></a></li>
	                                                <li class="divider"></li>
	                                                <li><a ><?php echo $this->lang->line('eliminar')?></a></li>
                                                </ul>
                                            </div>
										</div>
                                    </div>
                            		<div class="row">
		                            	<div class="col-md-12 table-responsive">
		                                <!-- ENVIADOS-->
		                                	<table class="table table-mailbox tablas-mensajes">
		                                		<thead>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                		</thead>
		                                		<tbody>
		                                		<?php if($enviados) { foreach($enviados as $row) { if($row->visto == 0) { ?>
												<tr class="unread">
		                                        	<td class="small-col"><input type="checkbox" class="input-enviados" name="enviados[]" value="<?php echo $row->id_mensaje;?>"/></td>
		                                            <td class="small-col"><i class="fa fa-star"></i></td>
		                                            <td class="name"><a href="#mail5" data-toggle="tab" class="displayblock" onclick="mostrarMensaje2(<?php echo $row->id_mensaje;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
		                                            <td class="subject"><a href="#mail5" data-toggle="tab" class="displayblock" onclick="mostrarMensaje2(<?php echo $row->id_mensaje;?>)"><?php echo $row->asunto;?></a></td>
		                                            <td class="time"><?php $date	= date_create($row->date_add); echo ' '.date_format($date, 'd/m/Y');?></td>
		                                        </tr>
												<?php } else { ?>
												<tr>
		                                            <td class="small-col"><input type="checkbox" class="input-enviados" name="enviados[]" value="<?php echo $row->id_mensaje;?>"/></td>
		                                            <td class="small-col"><i class="fa fa-star-o"></i></td>
		                                            <td class="name"><a href="#mail5" data-toggle="tab" class="displayblock" onclick="mostrarMensaje2(<?php echo $row->id_mensaje;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
		                                            <td class="subject"><a href="#mail5" data-toggle="tab" class="displayblock" onclick="mostrarMensaje2(<?php echo $row->id_mensaje;?>)"><?php echo $row->asunto;?></a></td>
		                                            <td class="time"><?php $date	= date_create($row->date_add); echo ' '.date_format($date, 'd/m/Y');?></td>
		                                        </tr>
												<?php } } } else { ?>   
												<tr>
		                                            <td class="small-col" style="height: 43px"></td>
		                                            <td class="small-col"></td>
		                                            <td class="name"></td>
		                                            <td class="subject"></td>
		                                            <td class="time"></td>
		                                        </tr>
												<?php } ?> 
												</tbody> 
		                                    </table>
		                                </div><!-- /.table-responsive -->
	                                </div>
								</div>
							</div>
							<div class="tab-pane fade" id="mail3">
							<!-- /TAB3 -->
								<div class="col-md-9 col-sm-8">
                            		<!-- BUSQUEDA Y ACCIONES -->
                            		<div class="row pad">
                                    	<div class="col-sm-6 btn-accion-mensajes">
                                        	<label style="margin-right: 10px;" class="">
                                            	<div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" id="check-all-papelera" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                            </label>
                                            <!-- Action button -->
                                        	<div class="btn-group">
                                            	<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                	<?php echo $this->lang->line('acciones')?> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                	<li><a onclick="funcionRestaurar()"><?php echo $this->lang->line('restaurar').' '.$this->lang->line('mensaje')?></a></li>
	                                                <li class="divider"></li>
	                                                <li><a href="#"><?php echo $this->lang->line('eliminar')?></a></li>
                                                </ul>
                                            </div>
										</div>
                                    </div>
                            		
	                            	<div class="row">
		                            	<div class="col-md-12 table-responsive">
	                               		<!-- PAPELERA -->
	                                		<table class="table table-mailbox tablas-mensajes">
		                                		<thead>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                			<td></td>
		                                		</thead>
		                                		<tbody>
		                                		<?php if($papelera) { foreach($papelera as $row) {  ?>
												<tr>
		                                            <td class="small-col"><input type="checkbox" class="input-papelera" name="papelera[]" value="<?php echo $row->id_sin_mensaje_vendedor;?>"/></td>
		                                            <td class="small-col"><i class="fa fa-star-o"></i></td>
		                                            <?php if($row->id_origen == 1) { ?>
		                                            <td class="name"><a href="#mail6" data-toggle="tab" class="displayblock" onclick="mostrarMensaje3(<?php echo $row->id_sin_mensaje_vendedor;?>)">RECIBIDO</a></td>
		                                            <?php } else { ?>
		                                            <td class="name"><a href="#mail6" data-toggle="tab" class="displayblock" onclick="mostrarMensaje3(<?php echo $row->id_sin_mensaje_vendedor;?>)">ENVIADO</a></td>
		                                            <?php } ?>
		                                            <td class="subject"><a href="#mail6" data-toggle="tab" class="displayblock" onclick="mostrarMensaje3(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->asunto;?></a></td>
		                                            <td class="time"><?php $date	= date_create($row->date_add); echo ' '.date_format($date, 'd/m/Y');?></td>
		                                        </tr>
												<?php } } else { ?>   
												<tr>
		                                            <td class="small-col" style="height: 43px"></td>
		                                            <td class="small-col"></td>
		                                            <td class="name"></td>
		                                            <td class="subject"></td>
		                                            <td class="time"></td>
		                                        </tr>
												<?php } ?>  
												</tbody>     
		                                    </table>
		                                </div><!-- /.table-responsive -->
	                                </div>
								</div><!-- /.col (RIGHT) -->
							</div>
							<div class="tab-pane fade" id="mail4">
							<!-- /TAB4 -->
								<div class="col-md-9 col-sm-8">
									<form id="formResponder" action="<?php echo base_url().'index.php/Mensajes/responderMensaje/'?>" method="post">
										<div id="mostrarMensajes">
											
										</div>
										<div class="col-md-12" id="armarTextBox" style="margin-bottom: 15px">
											
										</div>
										<div id="div-botones">
											<button type="button" class="btn btn-default btn-sm" onclick="armarRespuesta()"> Responder</button>
											<a class="btn btn-default btn-sm pull-right" href="#mail1" data-toggle="tab" onclick="location.reload();"> volver</a>
										</div>
									</form>
								</div>
								
							</div>
							<div class="tab-pane fade" id="mail5">
							<!-- /TAB5 -->
								<div class="col-md-9 col-sm-8">
									<div id="mostrarMensajes2">
										
									</div>
									<div>
										<a class="btn btn-default btn-sm pull-right" href="#mail2" data-toggle="tab"> volver</a>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="mail6">
							<!-- /TAB6 -->
								<div class="col-md-9 col-sm-8">
									<div id="mostrarMensajes3">
										
									</div>
									<div>
										<a class="btn btn-default btn-sm pull-right" href="#mail3" data-toggle="tab"> volver</a>
									</div>
								</div>
							</div>
						</div>
                    </div><!-- /.col (MAIN) -->
				</div><!-- mailbox row --->
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div> 

<form id="mensajeria" action="<?php echo base_url()."index.php/Mensajes/nuevoMensaje" ?>" method="post">
	<div class="modal fade" id="modal_mensajes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" style="width: 800px">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	      	<h4 class="modal-title"><i class="fa fa-envelope"></i><?php echo ' '.$this->lang->line('mensaje').' '.$this->lang->line('nuevo'); ?></h4>
	      </div>
	      <div class="modal-body">
	      	<div class="form-group">
            	<select name="para[]" class="form-control chosen-select" multiple  data-placeholder="Enviar a: " required>
                	<?php
                	if($vendedores){
                		foreach($vendedores as $vendedor){
                			echo '<option value="'.$vendedor->id_vendedor.'">'.$vendedor->nombre.' '.$vendedor->apellido.'</option>';
                		}
                	}
					?>
                	<option value="0">Todos</option>
                </select>
          	</div>
            <div class="form-group">
                <input type="text" class="form-control" name="asunto" placeholder="Asunto "/ required>
            </div>
            <div>
                <textarea class="no-textarea" name="mensaje" placeholder="Mensaje" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
          	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button type="submit" form="mensajeria" class="pull-right btn btn-default" id="sendEmail">Crear <i class="fa fa-arrow-circle-right"></i></button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

<script>
function mostrarMensaje($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Mensajes/verDetalle', 
		data: { 'id' 	: $id, 
	 			}, 
	 	success: function(resp) { 
	 		$("#div-prueba").load(location.href + " #div-prueba");
			$("#div-mensajeria").load(location.href + " #div-mensajeria");
	 		$('#mostrarMensajes').attr('disabled',false).html(resp);
		},	
	});
}
function mostrarMensaje2($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Mensajes/verDetalle2', 
		data: { 'id' 	: $id, 
	 			}, 
	 	success: function(resp) { 
	 		$('#mostrarMensajes2').attr('disabled',false).html(resp);
		},	
	});
}
function mostrarMensaje3($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Mensajes/verDetalle3', 
		data: { 'id' 	: $id, 
	 			}, 
	 	success: function(resp) { 
	 		$('#mostrarMensajes3').attr('disabled',false).html(resp);
		},	
	});
}

function armarRespuesta(){
	$('#armarTextBox').html('<textarea class="texteditor" id="editor" name="editor" rows="3" cols="109" style="resize: none;" placeholder="Respuesta..."></textarea>');
	$('#editor').focus();
	$('#div-botones').html('<button type="button" class="btn btn-primary btn-sm" onclick="responderMensaje()"> Enviar</button><a class="btn btn-default btn-sm pull-right" href="#mail1" data-toggle="tab" onclick="location.reload();"> volver</a>');
}

function responderMensaje(){
	$('#formResponder').submit();
}

$('#check-all-recibidos').on('ifChecked', function(event){
	$('.input-recibidos').iCheck('check');	
});

$('#check-all-recibidos').on('ifUnchecked', function(event){
	$('.input-recibidos').iCheck('uncheck');
});

$('#check-all-enviados').on('ifChecked', function(event){
	$('.input-enviados').iCheck('check');
});

$('#check-all-enviados').on('ifUnchecked', function(event){
	$('.input-enviados').iCheck('uncheck');
});

$('#check-all-papelera').on('ifChecked', function(event){
	$('.input-papelera').iCheck('check');
});

$('#check-all-papelera').on('ifUnchecked', function(event){
	$('.input-papelera').iCheck('uncheck');
});

function funcionNoLeido(){
	var aux =  $( ".input-recibidos:checked" ).length;

	if(aux>0){
		console.log($('.input-recibidos' ).serializeArray());
		var Datos = $('.input-recibidos' ).serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Mensajes/NoLeido', 
			data: Datos, 
		 	success: function(resp) { 
		 		//$('#mail1').attr('disabled',false).html(resp);
		 		//$("#div-prueba").load(location.href + " #div-prueba");
				//$("#div-mensajeria").load(location.href + " #div-mensajeria");
				location.reload();
			},	
		});
	}
}

function funcionLeido(){
	var aux =  $( ".input-recibidos:checked" ).length;

	if(aux>0){
		console.log($('.input-recibidos' ).serializeArray());
		var Datos = $('.input-recibidos' ).serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Mensajes/Leido', 
			data: Datos, 
		 	success: function(resp) { 	 		
				location.reload();
			},	
		});
	}
}

function funcionPapelera(){
	var aux =  $( ".input-recibidos:checked" ).length;

	if(aux>0){
		console.log($('.input-recibidos' ).serializeArray());
		var Datos = $('.input-recibidos' ).serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Mensajes/Papelera', 
			data: Datos, 
		 	success: function(resp) { 
		 		
				location.reload();
			},	
		});
	}
}

function funcionPapelera2(){
	var aux =  $( ".input-enviados:checked" ).length;

	if(aux>0){
		console.log($('.input-enviados' ).serializeArray());
		var Datos = $('.input-enviados' ).serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Mensajes/Papelera2', 
			data: Datos, 
		 	success: function(resp) { 
		 		
				location.reload();
			},	
		});
	}
}

function funcionRestaurar(){
	var aux =  $( ".input-papelera:checked" ).length;

	if(aux>0){
		console.log($('.input-papelera' ).serializeArray());
		var Datos = $('.input-papelera' ).serializeArray();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Mensajes/Restaurar', 
			data: Datos, 
		 	success: function(resp) { 
		 		
				location.reload();
			},	
		});
	}
}

$(document).ready(function(){

    $('.tablas-mensajes').DataTable({
    	"ordering": false,
    	"lengthChange": false,
    	"language": {
    		"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "",
			"sInfoEmpty":      "",
			"sInfoFiltered":   "",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			}
		}
    });
});
</script> 
