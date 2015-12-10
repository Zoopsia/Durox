<script>
var aux 			= 0;
var aux_coment 		= 0;
var subtotal 		= 0;
var lineascambiar 	= 0;
var arreglo_lineas	= [];
var valorInput;
$(document ).ready(function() {
	$('#producto').focus();
	if(sessionStorage['total_anterior']){
		subtotal = parseFloat(sessionStorage['total_anterior']);
	}
	
	if(sessionStorage['aux2'] > 0){
    	for(i = 1; i <= sessionStorage['aux2']; i++ ){
    		$('#2text-coment'+sessionStorage['posicion'+i]).val(sessionStorage['2comentario'+i]);
    	}
    }
    
	if(sessionStorage['nota-publica'] != 'undefined'){
    	$('#nota-publica').val(sessionStorage['nota-publica']);
    }
	if(sessionStorage['aux']){
		for(i = 0; i <= sessionStorage['aux']; i++ ){
			if(sessionStorage['estado'+i] == 1){
				$("#tablapedido > tbody").append('<tr>'+
					'<td><input type="hidden" id="id_producto'+i+'" value="'+sessionStorage['id_producto'+i]+'">'+sessionStorage['nomb'+i]+
						'<input type="text" id="nomb'+i+'" 			autocomplete="off" required hidden value="'+sessionStorage['nomb'+i]+'">'+
						'<input type="text" id="id_moneda'+i+'" 	autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+i]+'">'+
						'<input type="text" id="valor_moneda'+i+'" 	autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+i]+'">'+
						'<input type="text" id="estado'+i+'" 		autocomplete="off" required hidden value="'+sessionStorage['estado'+i]+'">'+
					'</td>'+
					'<td ondblclick="editar('+i+')">'+
						'<input type="text" id="cant'+i+'" class="editable" disabled onblur="editarCantidad('+i+')" autocomplete="off" required value="'+sessionStorage['cant'+i]+'">'+
					'</td>'+
					'<td>'+
						'<input type="text" id="precio'+i+'" 		autocomplete="off" required hidden value="'+sessionStorage['precio'+i]+'">'+sessionStorage['simbolo'+i]+' '+sessionStorage['precio'+i]+
						'<input type="text" id="simbolo'+i+'"		autocomplete="off" required hidden value="'+sessionStorage['simbolo'+i]+'">'+
					'</td>'+
					'<td>'+
						'$ <input type="text" id="subtotal'+i+'" class="editable" disabled autocomplete="off" required value="'+sessionStorage['subtotal'+i]+'">'+
					'</td>'+
					'<td>'+
						'Nuevo'+
					'</td>'+
					'<td>'+
						'<a class="btn btn-danger btn-xs" onclick="sacarProducto(this,'+i+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a>'+
					'</td>'+
					'<td class="text-center" style="width: 20px">'+
						'<button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px">'+
							'<i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i>'+
						'</button>'+
						'<span id="open-coment'+i+'" style="display:none">'+
							'<div class="talkbubble" >'+
								'<div class="talkbubble-rectangulo">'+
									'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+
									'</textarea>'+
								'</div>'+
							'</div>'+
						'</span>'+
					'</td>'+
				'</tr>');
			}
			else{
				$("#tablapedido > tbody").append('<tr style="background-color: #f56954 !important; color: #fff;">'+
											 			'<td><input type="text" id="id_producto'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+i]+'">'+sessionStorage['nomb'+i]+
											 				'<input type="text" id="nomb'+i+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+i]+'">'+
											 				'<input type="text" id="id_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+i]+'">'+
															'<input type="text" id="valor_moneda'+i+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+i]+'">'+
															'<input type="text" id="estado'+i+'" autocomplete="off" required hidden value="'+sessionStorage['estado'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+i+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+i]+'">'+sessionStorage['cant'+i]+'</td>'+
											 			'<td><input type="text" id="precio'+i+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+i]+'">'+sessionStorage['simbolo'+i]+' '+sessionStorage['precio'+i]+
											 				'<input type="text" id="simbolo'+i+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+i]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+i+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+i]+'">$ '+sessionStorage['subtotal'+i]+'</td>'+
											 			'<td>Imposible de Enviar</td>'+
											 			'<td><a class="btn btn-success btn-xs" onclick="cargarProducto2(this,'+i+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+i+'\').show(); $(\'#text-coment'+i+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+i+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+i+'" name="text-coment'+i+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+i+'\').hide(); guardarComentario('+i+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>'+
											 		'</tr>');
			}
			if(sessionStorage['comentario'+i]){
				$('#text-coment'+i).val(sessionStorage['comentario'+i]);
			}
			aux++;
		}
	}
	
	if(sessionStorage['cambiarLinea'] > 0){
		for(i = 0; i <= $('input.subtotal_anteriores').length; i++ ){
			if(sessionStorage['linea'+i]){
				$('#linea'+sessionStorage['linea'+i]).val(3);
				$('#tablapedido > tbody').find("tr:nth-child("+sessionStorage['row'+i]+")").css({"background-color": "#f56954 !important", "color": "#fff"});
				$('#tablapedido > tbody >tr:nth-child('+sessionStorage['row'+i]+')').find("td:nth-child(6)").html('<a class="btn btn-success btn-xs" onclick="agregarProducto(this,'+sessionStorage['linea'+i]+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a>');
				$('#tablapedido > tbody >tr:nth-child('+sessionStorage['row'+i]+')').find("td:nth-child(5)").html('Imposible de Enviar');
			}
		}
		lineascambiar = sessionStorage['cambiarLinea'];
	}
	
	armarTotales(<?php echo $anterior_presup;?>); 
});



function armarTotales($presupuesto){
	var presupuesto	= $presupuesto;
	var x = 0;
	x = x + subtotal;
	for(i = 0; i < aux; i++){
		if($('#estado'+i).val() == 1){
			if($('#subtotal'+i).val())
				x += parseFloat($('#subtotal'+i).val());
		}
	}		
	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Presupuestos/armarTotales', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: {	'presupuesto'	: presupuesto,
	 			'subtotal'		: x
	 			},
	 	success: function(resp) { 
	 		$('#table-totales').html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias 	
	 	}
	});	
}



function cargaProducto($id_cliente){
 	var producto 	= $('input#id_producto').val(); 
 	var cantidad 	= $('input#cantidad').val();
 	var cliente		= $id_cliente;
 	var presupuesto	= <?php echo $anterior_presup; ?>;
 	var pattern 	= /^([0-9])*$/;
 	if(producto && cantidad && pattern.test(cantidad)){
	 	$.ajax({
		 	type: 'POST',
		 	url: '<?php echo base_url(); ?>index.php/Presupuestos/cargaProducto', //Realizaremos la petición al metodo prueba del controlador direcciones
		 	data: {	'producto'		: producto,
		 		   	'cantidad'		: cantidad,
		 		   	'presupuesto'	: presupuesto,
		 		   	'cliente'		: cliente,
	 		  		'aux'			: aux,
		 		   },
		 	success: function(resp) { 
		 		$("#tablapedido > tbody").append(resp);
		 		
		 		sessionStorage.setItem('aux', aux);
	 		
		 		sessionStorage.setItem('id_producto'+aux, $('#id_producto'+aux).val());
		 		sessionStorage.setItem('nomb'+aux, $('#nomb'+aux).val());
		 		sessionStorage.setItem('id_moneda'+aux, $('#id_moneda'+aux).val());
		 		sessionStorage.setItem('valor_moneda'+aux, $('#valor_moneda'+aux).val());
		 		sessionStorage.setItem('estado'+aux, $('#estado'+aux).val());
		 		
		 		sessionStorage.setItem('cant'+aux, $('#cant'+aux).val());
		 		
		 		sessionStorage.setItem('precio'+aux, $('#precio'+aux).val());
		 		sessionStorage.setItem('simbolo'+aux, $('#simbolo'+aux).val());
		 		
		 		sessionStorage.setItem('subtotal'+aux, $('#subtotal'+aux).val());
		 		
		 		aux = aux+1;
		 		armarTotales(<?php echo $anterior_presup;?>);
		 		document.formProducto.reset(); 
				document.getElementById("producto").focus();
		 	}
		});
	}
}



function sacarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#f56954 !important", "color": "#fff"});
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").html('<td><input type="text" id="id_producto'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+fila]+'">'+sessionStorage['nomb'+fila]+
											 				'<input type="text" id="nomb'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+fila]+'">'+
											 				'<input type="text" id="id_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+fila]+'">'+
															'<input type="text" id="valor_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+fila]+'">'+
															'<input type="text" id="estado'+fila+'" autocomplete="off" required hidden value="3">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+fila]+'">'+sessionStorage['cant'+fila]+'</td>'+
											 			'<td><input type="text" id="precio'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+fila]+'">'+sessionStorage['simbolo'+fila]+' '+sessionStorage['precio'+fila]+
											 				'<input type="text" id="simbolo'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+fila]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+fila]+'">$ '+sessionStorage['subtotal'+fila]+'</td>'+
											 			'<td>Imposible de Enviar</td>'+
											 			'<td><a class="btn btn-success btn-xs" onclick="cargarProducto2(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+fila+'\').show(); $(\'#text-coment'+fila+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+fila+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+fila+'" name="text-coment'+fila+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+fila+'\').hide(); guardarComentario('+j+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>');
	if(sessionStorage['comentario'+fila]){
		$('#text-coment'+fila).val(sessionStorage['comentario'+fila]);
	}
	sessionStorage.setItem('estado'+fila, $('#estado'+fila).val());
	armarTotales(<?php echo $anterior_presup;?>);
}



function eliminarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	lineascambiar++;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#f56954 !important", "color": "#fff"});
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(6)").html('<a class="btn btn-success btn-xs" onclick="agregarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-plus"></i></a>');
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(5)").html('Imposible de Enviar');
	$('#linea'+fila).val(3);
	subtotal = subtotal - parseFloat($('#anterior_subtotal'+fila).val());
	armarTotales(<?php echo $anterior_presup;?>);
	sessionStorage.setItem('total_anterior', subtotal);
	sessionStorage.setItem('linea'+j, fila);
	sessionStorage.setItem('row'+j, j);
	sessionStorage.setItem('cambiarLinea', lineascambiar);
}



function agregarProducto(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	lineascambiar = lineascambiar - 1;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#FFFFFF !important", "color": "#333333"});
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(6)").html('<a class="btn btn-danger btn-xs" onclick="eliminarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Sacar Producto"><i class="fa fa-minus"></i></a>');
	$('#tablapedido > tbody >tr:nth-child('+j+')').find("td:nth-child(5)").html('En Espera');
	$('#linea'+fila).val(1);
	subtotal = subtotal + parseFloat($('#anterior_subtotal'+fila).val());
	armarTotales(<?php echo $anterior_presup;?>);
	sessionStorage.setItem('total_anterior', subtotal);
	sessionStorage.removeItem('linea'+j);
	sessionStorage.removeItem('row'+j);
	sessionStorage.setItem('cambiarLinea', lineascambiar);
}



function cargarProducto2(r, $row){
	var j 		= r.parentNode.parentNode.rowIndex;
	var fila 	= $row;
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").css({"background-color": "#FFFFFF", "color": "#333333"});
	$('#tablapedido > tbody').find("tr:nth-child("+j+")").html('<td><input type="text" id="id_producto'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_producto'+fila]+'">'+sessionStorage['nomb'+fila]+
											 				'<input type="text" id="nomb'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['nomb'+fila]+'">'+
											 				'<input type="text" id="id_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['id_moneda'+fila]+'">'+
															'<input type="text" id="valor_moneda'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['valor_moneda'+fila]+'">'+
															'<input type="text" id="estado'+fila+'" autocomplete="off" required hidden value="1">'+
											 			'</td>'+
											 			'<td><input type="text" id="cant'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['cant'+fila]+'">'+sessionStorage['cant'+fila]+'</td>'+
											 			'<td><input type="text" id="precio'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['precio'+fila]+'">'+sessionStorage['simbolo'+fila]+' '+sessionStorage['precio'+fila]+
											 				'<input type="text" id="simbolo'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['simbolo'+fila]+'">'+
											 			'</td>'+
											 			'<td><input type="text" id="subtotal'+fila+'" autocomplete="off" required hidden value="'+sessionStorage['subtotal'+fila]+'">$ '+sessionStorage['subtotal'+fila]+'</td>'+
											 			'<td>Nuevo</td>'+
											 			'<td><a class="btn btn-danger btn-xs" onclick="sacarProducto(this,'+fila+')" role="button" data-toggle="tooltip" data-placement="bottom" title="Cargar Producto"><i class="fa fa-minus"></i></a></td>'+
											 			'<td class="text-center" style="width: 20px"><button type="button" onclick="$(\'#open-coment'+fila+'\').show(); $(\'#text-coment'+fila+'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>'+
															'<span id="open-coment'+fila+'" style="display:none">'+
																'<div class="talkbubble" >'+
																	'<div class="talkbubble-rectangulo">'+
																		'<textarea rows="4" id="text-coment'+fila+'" name="text-coment'+fila+'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#open-coment'+fila+'\').hide(); guardarComentario('+j+')">'+
																		'</textarea>'+
																	'</div>'+
																'</div>'+
															'</span>'+
														'</td>');
	if(sessionStorage['comentario'+fila]){
		$('#text-coment'+fila).val(sessionStorage['comentario'+fila]);
	}
	sessionStorage.setItem('estado'+fila, $('#estado'+fila).val());
	armarTotales(<?php echo $anterior_presup;?>);
}



function ajaxSearch() {
	var producto = $('#producto').val();
    if (producto.length === 0) {
       	$('#suggestions').hide();
    } 
    else {
       	$.ajax({
        	type: "POST",
            url: '<?php echo base_url(); ?>index.php/Presupuestos/buscarProducto',
            data: {'producto': producto,},
            success: function(data) {
	            // return success
	            if (data.length > 0) {
	            	$('#suggestions').show();
	                $('#autoSuggestionsList').addClass('auto_list');
	                $('#autoSuggestionsList').html(data);
	            }
            }
		});
	}
}



function guardarComentario($linea){
	var j 	= $linea;
	sessionStorage.setItem('comentario'+j, $('#text-coment'+j).val());
}



function guardarComentario2($linea){
	aux_coment++;
	var j 	= $linea;
	sessionStorage.setItem('2comentario'+aux_coment, $('#2text-coment'+j).val());
	sessionStorage.setItem('posicion'+aux_coment, j);
	sessionStorage.setItem('aux2', aux_coment);
}



function funcion1($id_producto){
	
	var nombre 		= $('#id_valor'+$id_producto).val();
	var id_producto	= $id_producto;
	$('#producto').val(nombre);
	$('#id_producto').val(id_producto);
	$('#suggestions').hide();
	document.getElementById("cantidad").focus();
}



function cancelarCambios($presupuesto){
	var r = confirm("Desea Cancelar el presupuesto?\nAdventencia! - No podrá volver atrás");
	if (r == true) {
		sessionStorage.clear();
		window.history.back();
	}
}



function guardarLineasNuevas($presupuesto){
	var presupuesto		= $presupuesto;
	if($('#tiempo_entrega').val() && $('#condicion_pago').val() && $('#modos_pago').val()){
		if(aux > 0){
			for(i = 0; i < aux; i++){
				var producto 	= $('#id_producto'+i).val();
				var cantidad 	= $('#cant'+i).val();
				var precio 		= $('#precio'+i).val();
				var subtotal 	= $('#subtotal'+i).val();
				var id_moneda	= $('#id_moneda'+i).val();
				var valor_moneda= $('#valor_moneda'+i).val();
				var comentario	= $('#text-coment'+i).val();
				var estado		= $('#estado'+i).val();
				if(producto){
					$.ajax({
					 	type: 'POST',
					 	url: '<?php echo base_url(); ?>index.php/Presupuestos/guardarLineasPresupuesto', //Realizaremos la petición al metodo prueba del controlador direcciones
					 	data: {'producto'		: producto,
					 		   'cantidad'		: cantidad,
					 		   'precio'			: precio,
					 		   'subtotal'		: subtotal,
					 		   'presupuesto'	: presupuesto,
					 		   'id_moneda'		: id_moneda,
					 		   'valor_moneda'	: valor_moneda,
					 		   'comentario'		: comentario,
					 		   'estado'			: estado
					 		   },
					 	success: function(resp) { 
					 		sessionStorage.clear();
					 	},
					 	async: false
					});
				}
				if(estado == 3){
					$('#estado_presupuesto').val(3);
				}
			}
			return true;
		}
		else{
			<?php if($detalle){ echo "return true;"; } ?>
			alert("ERROR! - No hay lineas en el presupuesto!");
			$('#producto').focus();
			return false;
		}
	}
	else{
		alert("ERROR! - Falta agregar Información al presupuesto!");
		return false;
	}
}



function guardarLineasViejas($presupuesto){
	<?php 
		if($detalle){
			foreach ($detalle as $row) {
				if ($row -> estado_linea != 3) {
					echo "arreglo_lineas.push(".$row->id_linea_producto_presupuesto.");";
				}
			}
		}
	?>
	
	for(i = 0; i < arreglo_lineas.length; i++ ){
		if($('#linea'+arreglo_lineas[i]).val() == 3){
			$('#estado_presupuesto').val(3);
		}
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Presupuestos/guardarLineasViejas', //Realizaremos la petición al metodo prueba del controlador direcciones
			data: {	'estado'			: $('#linea'+arreglo_lineas[i]).val(),
				 	'linea'				: arreglo_lineas[i],
				 	'comentario'		: $('#2text-coment'+arreglo_lineas[i]).val(),
					'id_presupuesto'	: $presupuesto		  
			},
		 	success: function(resp) { 
		 		console.log(resp);
		 	},
		 	async: false
		});
	}
	
	return true;
}

function editar($i){
	var aux = $i;
	$('#cant'+aux).removeAttr("disabled");
	$('#cant'+aux).removeClass("editable");
	$('#cant'+aux).focus();
	valorInput = $('#cant'+aux).val();
}

function editarCantidad($i){
	var aux 		= $i;
	var subtotal	= 0;
	var pattern 	= /^([0-9])*$/;
	if(pattern.test($('#cant'+aux).val())){
		/*-- Armo subtotal --*/
		var precio 		= $('#precio'+aux).val();
		var moneda		= $('#valor_moneda'+aux).val();
		var cantidad 	= $('#cant'+aux).val();
		subtotal 		=  cantidad * moneda * precio;
		$('#subtotal'+aux).val(subtotal.toFixed(2));
		/*-- Armo cantidad --*/
		$('#cant'+aux).attr("disabled", true);
		$('#cant'+aux).attr("value", $('#cant'+aux).val());
		$('#cant'+aux).addClass("editable");
		sessionStorage.setItem('cant'+aux, $('#cant'+aux).val());
		sessionStorage.setItem('subtotal'+aux, $('#subtotal'+aux).val());
		armarTotales(<?php echo $anterior_presup;?>); 
		
	}
	else{
		$('#cant'+aux).val(valorInput);
	}
}
</script>
