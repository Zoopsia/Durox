<script>
$( document ).ready(function() {
    getAlarmas(<?php echo $id_presupuesto?>);
    if(location.hash == "#tab2")
    	$('.nav-pills a:last').tab('show');
});

function saveAlarm($id){
	<?php
	$cantidad_paginas = 0;
	if($alarmas){
		$cantidad_paginas = ceil(count($alarmas)/5);
	}
	echo 'var cant_pag = '.$cantidad_paginas.';';
	?>
	if($('#mensaje').val()){
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/Alarmas/insertAlarma', 
			data: { 'tipo' 		: $('#tipo').val(),
			 		'mensaje'	: $('#mensaje').val(),
			 		'id'		: $id, 
			 		'cruce'		: 'presupuestos'
			}, 
			success: function(resp) { 
				$('#box-alarmas'+cant_pag).append(resp);
				$('#formAlarma').trigger("reset");
				getAlarmas($id);
				$('#mensaje').removeClass();
			}
		});
	}
}

function getAlarmas($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Presupuestos/getAlarmas', 
		data: { 'id'		: $id,
				}, 
		success: function(resp) {
			$('#llenarAlarmas').html(resp);
		}
	});
}

function cambiarSelect(){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Alarmas/tipoAlarma', 
		data: { 'tipo' 		: $('#tipo').val(),
				}, 
		success: function(resp) { 
			$('#mensaje').removeClass();
			//$('#tipo').addClass('form-control alert-'+resp);
			$('#mensaje').addClass('alert-'+resp);
		}
	});
}

function imprimirConLogo(){
	$('#imagen-durox').show();
	setTimeout(function(){ $('#imagen-durox').hide(); }, 100);
}

var cotizar_cng = 0;

function cotizar(){
	if(cotizar_cng%2 == 0){
		$('.subtotal1').show();
		$('.subtotal2').hide();
		$('#sub-pesos').hide();
		$('#sub-otra-moneda').show("drop");
		cotizar_cng ++;
	}
	else{
		$('.subtotal1').hide();
		$('.subtotal2').show();
		$('#sub-pesos').show("drop");
		$('#sub-otra-moneda').hide();
		cotizar_cng ++;
	}
}
</script>

<?php
$aux  = 0;
$aux2 = 0;
?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div id="imagen-durox" class="col-lg-3 col-lg-offset-2" align="center" style="display: none; margin-top: 20px">
	    	<p style="position: absolute; left: 15px;"><?php echo $this->lang->line('presupuesto'); ?></p>
	    	<img alt="DUROX" src="<?php echo base_url().'/img/durox.png'?>">
	      	<hr>
	    </div>
		<div class="panel-heading no-print">
			<ul class="nav nav-pills">
				<li class="active"><a href="#tab1" data-toggle="tab">
					<i class="fa fa-book"></i> <?php echo $this->lang->line('presupuesto'); ?>
				</a></li>
				<li style="position: absolute; right: 30px">
					<a href="#tab2" data-toggle="tab"><?php echo $this -> lang -> line('alarmas'); ?>
						<span class="badge">
							<div id="llenarAlarmas">
							 					
							</div>
						</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab1"> 
		  		<!--INFO GRAL DEL PRESUPUESTO-->	
	    		<?php
					if($presupuesto){
						foreach ($presupuesto as $row) {
				?>	
					<div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        	<b><?php echo $this->lang->line('vendedor');?></b>
                           	<address>
		                    <?php
		                    	if($vendedores){
									foreach ($vendedores as $key) 
									{
										echo '<a class="sinhref" href="'.base_url().'index.php/vendedores/pestanas/'.$key->id_vendedor.'">';
										echo $key->nombre.' '.$key->apellido;
										echo '</a>';
										echo "<br>";
										echo "<div class='no-print'>";
										echo $this->lang->line('id').': '.$key->id_vendedor;
										echo "</div>";
										echo "<br>";
										if($key->eliminado == 0)
											$aux2 = 1;
									}
								}
							?>
							</address>
						</div><!-- /.col -->
			            <div class="col-sm-4 invoice-col">
		                	<b><?php echo $this->lang->line('cliente');?></b>
		                    <address>
		                    <?php
		                    	if($clientes){
									foreach ($clientes as $key) 
									{
										echo '<a class="sinhref" href="'.base_url().'index.php/clientes/pestanas/'.$key->id_cliente.'">';
										echo $key->razon_social;
										echo '</a>';
										echo "<br>";
										echo $this->lang->line('cuit').': '.cuit($key->cuit);
										echo "<br>";
										foreach ($iva as $value) {
											if($value->id_iva == $key->id_iva){	
												echo $value->iva;
												echo "<br>";
											}
										}
										echo "<div class='no-print'>";
										echo $this->lang->line('id').': '.$key->id_cliente;
										echo "</div>";
										echo "<br>";
										if($key->eliminado == 0)
											$aux = 1;
									}
								}
							?>
		                    </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        	<b><?php echo $this->lang->line('presupuesto');?></b>
                            <?php
								echo '<div class="odd">';
								echo $this->lang->line('id').' '.$this->lang->line('presupuesto').': '.'<a class="sinhref" href="#">'.$row->id_presupuesto.'</a>';
								echo "</div>";
								echo '<div class="even">';
								echo $this->lang->line('id').' '.$this->lang->line('visita').': '.'<a class="sinhref" href="'.base_url().'index.php/Visitas/carga/'.$row->id_visita.'/0">'.$row->id_visita.'</a>';
								echo "</div>";
								echo '<div class="odd">';
								$date	= date_create($row->fecha);
								echo $this->lang->line('fecha').': '.date_format($date, 'd/m/Y');
								echo "</div>";
								foreach($estados as $key){
									if($key->id_estado_presupuesto == $row->id_estado_presupuesto){
										echo '<div class="even no-print">';	
										echo $this->lang->line('estado').': '.$key->estado;
										echo "</div>";
									}
								}
								echo '<div class="odd">';
								echo $this->lang->line('total').' '.$this->lang->line('presupuesto').': $ '.$row->total;
								echo "</div>";
								echo "<br>";							
							}
							}
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-lg-1">
							<?php echo $this -> lang -> line('detalle'); ?>
						</div>
					</div>
					<div class="row">
                    	<div class="col-xs-12 table-responsive">
                        	 	<?php
                                	if($presupuesto){
	     								foreach($presupuesto as $row)
	     								{
	     									if($row->id_estado_presupuesto == 3 || $row->id_estado_presupuesto == 2)
	     									{
	     										echo '<table class="table" cellspacing="0" width="100%">';
	     									}
											else{
												echo '<table class="table table-striped" cellspacing="0" width="100%">';
											}
	     								}
									}	
									$total = 0;
									if($presupuestos)
									{
										foreach ($presupuestos as $row) 
										{
											if($row->estado_linea != 3)
												$total = $row->subtotal + $total;
										}
									}
								?>
								        <thead class="tabla-datos-importantes">
								            <tr>
								            	<th style="width: 210px"><?php echo $this->lang->line('producto'); ?></th>
								                <th style="width: 200px"><?php echo $this->lang->line('cantidad'); ?></th>
								                <th><?php echo $this->lang->line('precio'); ?></th>
								                <th><?php echo $this->lang->line('subtotal'); ?></th>
								                <th class="no-print"><?php echo $this->lang->line('estado'); ?></th>
								            	<th class="text-center" style="width: 20px"></th>
								            </tr>
								        </thead>
								 
								 		<tbody>
								        <?php
								        $cotizacion = array();	
								        if($presupuestos)
										{
									        foreach ($presupuestos as $row) 
									        {
												if($row->estado == 'Rechazado'){
													echo '<tr class="no-print" style="background-color: #f56954 !important; color: #fff;">';
												}
												else if($row->estado == 'Aceptado'){
													echo '<tr style="background-color: #5CB85C !important; color: #fff;">';
												}
												else{
						     						echo '<tr>';	
												}
												echo '<td>'.$row->nombre.'</td>';
												echo '<td>'.$row->cantidad.'</td>';
												echo '<td>'. $row->abreviatura.$row->simbolo.' '.$row->precio.'</td>'; // Aca debe ir el signo de la moneda que se esta usando
												
												echo '<td class="subtotal1" style="display: none">'.$row->abreviatura.$row->simbolo.' '.round($row -> precio*$row -> cantidad, 2).'</td>';
													if(array_key_exists($row->abreviatura.$row->simbolo, $cotizacion))
														$cotizacion[$row->abreviatura.$row->simbolo] += round($row -> precio*$row -> cantidad, 2);
													else 
														$cotizacion[$row->abreviatura.$row->simbolo] = round($row -> precio*$row -> cantidad, 2);
												echo '<td class="subtotal2">$ '.$row->subtotal.'</td>';
												
												echo '<td class="no-print">'.$row->estado.'</td>';				
													if($row->comentario){
																echo '<td class="text-center no-print" style="width: 20px"><button type="button" onclick="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').show(); $(\'#2text-coment'.$row -> id_linea_producto_presupuesto.'\').focus()" style="background: transparent; border: transparent; padding-left: 0px"><i class="fa fa-sticky-note-o fa-2x fa-rotate-180"></i></button>
																	<span id="2open-coment'.$row -> id_linea_producto_presupuesto.'" style="display:none">
																		<div class="talkbubble" >
																			<div class="talkbubble-rectangulo">
																				<textarea rows="4" id="2text-coment'.$row -> id_linea_producto_presupuesto.'" name="2text-coment'.$row -> id_linea_producto_presupuesto.'" style="resize: none; width: 100%; background-color: transparent" onblur="$(\'#2open-coment'.$row -> id_linea_producto_presupuesto.'\').hide();">'.$row->comentario.'</textarea>
																			</div>
																		</div>
																	</span>
																</td>';
													}
													else{
														echo "<td></td>";
													}
												echo '</tr>';
											}	
										}		
										?>
										</tbody>
								    </table>              
                        </div><!-- /.col -->
                    </div><!-- /.row -->
					<div class="row">
                    <!-- accepted payments column -->
                        <div class="col-xs-6" id="div-info-extra">
                            <p class="lead"><?php echo $this -> lang -> line('informacion'); ?></p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <?php 
                               		
                                	if($presupuesto){
                                		$arreglo_condiciones 	= array();
										$arreglo_tiempos		= array();
										$arreglo_modos			= array();
										
                                		foreach($presupuesto as $row){
                                			if($condiciones_pago){
				                           		foreach($condiciones_pago as $condicion){
				                           			if($condicion->id_condicion_pago == $row->id_condicion_pago)
														$arreglo_condiciones[$condicion->id_condicion_pago] = $condicion->condicion_pago;
												}
											}
											
											if($tiempos_entrega){
				                            	foreach($tiempos_entrega as $tiempo){
				                            		if($tiempo->id_tiempo_entrega == $row->id_tiempo_entrega)
                                						$arreglo_tiempos[$tiempo->id_tiempo_entrega] = $tiempo->tiempo_entrega;
												}
											}
											
											if($sin_modos){
			                           			if($modos_pago){
                                					foreach($modos_pago as $modos){
                                						foreach($sin_modos as $row){
				                           					if($modos->id_modo_pago == $row->id_modo_pago)
																$arreglo_modos[$modos->id_modo_pago] = $modos->modo_pago;
				                           				}
													}
												}
											}
										} 
									} 
                                	
									echo armarInformacion(
                                		$arreglo_info=array(
                                			$this->lang->line('modos').' de '.$this->lang->line('pago') 		=> $arreglo_modos,
                                			$this->lang->line('condiciones').' de '.$this->lang->line('pago') 	=> $arreglo_condiciones,
                                			$this->lang->line('tiempos').' de '.$this->lang->line('entrega')	=> $arreglo_tiempos
										)
									);
									
									if($presupuesto){ foreach($presupuesto as $row){ echo $row->nota_publica; } }  
								?>
                            </p>
                        </div><!-- /.col -->
                        
                        <div class="col-xs-6" id="sub-pesos">
                            <p class="lead"><?php echo $this->lang->line('totales');?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%"><?php echo $this->lang->line('subtotal');?></th>
                                        <td>$ <?php echo round($total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('iva');?></th>
                                        <td>$ <?php echo round($total*1.21-$total,2);?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo $this->lang->line('total');?></th>
                                        <td>$ <?php echo round($total*1.21,2);?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        
                        <div class="col-xs-6" id="sub-otra-moneda" style="display: none;">
                            <p class="lead"><?php echo $this->lang->line('totales')?></p>
                            <div class="table-responsive" id="table-totales">
                            	<table class="table">
                            	<?php if($cotizacion){ foreach ($cotizacion as $key => $value) { ?>
									<tr>
                                        <th style="width:50%"><?php echo $this -> lang -> line('subtotal'); ?></th>
                                        <td><?php echo $key.' '.$value; ?></td>
                                    </tr>
                                <?php } } ?>
                                </table>
                            </div>
                        </div><!-- /.col --> 
                    </div><!-- /.row -->
					
					<div class="row no-print">
                        <div class="col-xs-12">
                        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#informacion">
								<i class="fa fa-info-circle"></i>
							</button>
                            
                            <button class="btn btn-default" onclick="imprimirConLogo();window.print();"><i class="fa fa-print"></i> Print</button>
                            
                            <button type="button" id="btn-cotizacion" class="btn btn-default" onclick="cotizar();"><i class="fa fa-usd"></i> Cotización</button>
                            <?php
                            	$tengopedido = 0;
                            	if($presupuesto){
								    if($aux == 1 && $aux2 == 1){ 
									    foreach($presupuesto as $row){
									    	if($row->id_estado_presupuesto != 2)
											{
									    ?>
									   		<a role="button" class="btn btn-primary pull-right" onclick="sessionStorage.clear();" href="<?php echo base_url().'/index.php/Presupuestos/generarNuevoPresupuesto/'.$row->id_presupuesto ?>">
									   			<?php echo $this->lang->line('generar').' '.$this->lang->line('presupuesto') ?>
									   		</a>
											
									    <?php
											
									    		if($row->id_estado_presupuesto != 2 && $row->id_estado_presupuesto != 3)
									    		{
											    echo ' <a role="button" class="btn btn-primary pull-right" href="'.base_url().'/index.php/Pedidos/generarNuevoPedido/'.$row->id_presupuesto.'"  style="margin-right: 5px;">'.$this->lang->line('generar').' '.$this->lang->line('pedido').'</a>';
												}
												$tengopedido = 1;
											}
										}
									}
								
								
									if($pedido){
										if($tengopedido == 0){
											foreach($pedido as $row){
												echo 	'<a role="button" class="btn btn-success pull-right" href="'.base_url().'/index.php/Pedidos/pestanas/'.$row->id_pedido.'">
															'.$this->lang->line('ver').' '.$this->lang->line('pedido').'
														</a>';
											}
										}
									}
								}
							?>		
                         </div>
                    </div>	
            	</div>
            	<div class="tab-pane fade" id="tab2">
	     			<!--TAB 2 ALARMAS -->
	     			<div class="col-md-6">
	     				<div class="box box-primary">
		            	    <div class="box-header">
		                	    <h3 class="box-title"><?php echo $this->lang->line('alarmas')?></h3>
		                    </div><!-- /.box-header -->
		                    <?php
		                    	$cantidad_paginas = 0;
					     		if($alarmas){
					     			$cantidad_paginas = ceil(count($alarmas)/5);
									foreach($alarmas as $row){
										$arreglo[]	= array(
											'id_tipo'	=> $row->id_tipo_alarma,
											'tipo'		=> $row->tipo_alarma,
											'mensaje'	=> $row->mensaje,
											'nombre'	=> $row->nombre,
											'color'		=> $row->color
										);
									}
								}
							?>     
		                    <div class="tab-content">
		                    	<?php
		                    	$k=0;
		                    	for($i=0; $i<$cantidad_paginas; $i++){
		                    		if($i == 0)
										echo	'<div class="tab-pane fade in active" id="body'.($i+1).'">';  
									else 
										echo	'<div class="tab-pane fade in" id="body'.($i+1).'">';
			                    	echo			'<div class="box-body" id="box-alarmas'.($i+1).'">';
									for($j=$k; $j<count($alarmas); $j++){
			                   			echo 		armarAlarma($arreglo[$j]);
										$k++;
										if($k%5==0)
											break;
									}
			                   		echo 			'</div>';
		                    		echo 		'</div>';
									
								}
								
								if($cantidad_paginas == 0){
									echo	'<div class="tab-pane fade in active" id="body'.$cantidad_paginas.'">';
									echo		'<div class="box-body" id="box-alarmas'.$cantidad_paginas.'">';
									echo 		'</div>';
		                    		echo 	'</div>';
								}
		                    	?>
		                    </div>
		                    
		                    <div class="box-footer" align="center">
		                    	<nav>
								  <ul class="pagination">
								    <?php 
								    	for($i=0 ; $i< $cantidad_paginas; $i++){
								    		if($i == 0)
								    			echo '<li class="active"><a href="#body'.($i+1).'" data-toggle="tab">'.($i+1).'</a></li>';
											else
												echo '<li><a href="#body'.($i+1).'" data-toggle="tab">'.($i+1).'</a></li>';
										}
										
										if($cantidad_paginas == 0){
											/*--- No mostrar nada por ahora ----*/
										}
									?>
								  </ul>
								</nav>
		                    </div>
						</div>
					</div>
					<form id="formAlarma">
					<div class="col-md-6">
						<div class="box box-info">
		                	<div class="box-header ui-sortable-handle" style="cursor: move;">
		                    	<i class="fa fa-envelope"></i>
		                        <h3 class="box-title"><?php echo $this->lang->line('nueva')?></h3>
		                    </div>
		                    <div class="box-body">
			                	<div class="form-group">
			                    	<select class="form-control" id="tipo" name="tipo_alarma" style="font-family: 'FontAwesome', Helvetica;" onchange="cambiarSelect()">
				                    	<option disabled selected>Seleccione un Icono...</option>
				                        <?php
								     		if($tipos_alarmas){
												foreach($tipos_alarmas as $row){
													echo '<option value="'.$row->id_tipo_alarma.'">'.unicodeIcono($row->tipo_alarma).' '.$row->nombre.'</option>';
												}
											}
										?>
									</select>
								</div>
			                    <div class="form-group">
			                    	<textarea id="mensaje" name="mensaje" style="resize: none; width: 100%; height: 150px"></textarea>
			                    </div>
							</div>
		                    <div class="box-footer clearfix">
		                    	<button type="button" class="pull-right btn btn-danger btn-sm" onclick="location.reload();" style="margin-left: 5px"><?php echo $this->lang->line('cancelar');?></button>
		                    	<button type="button" class="pull-right btn btn-primary btn-sm" onclick="saveAlarm(<?php echo $id_presupuesto?>);"><?php echo $this->lang->line('guardar')?></button>
		                    </div>
						</div>
					</div>
	                </form>		
				</div>
        	</div>
		</div>	  		
	</div>
</div>
 
		
		
		<!-- Modal -->
<?php if($presupuesto){ foreach($presupuesto as $row){ ?>
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <form action="<?php echo base_url()."index.php/Presupuestos/editarVisto/".$row->id_presupuesto; ?>" class="form-horizontal" method="post">
      <div class="modal-body">
      	<div class="row">
      		<table class="table table-striped">
      			<tr>
      				<td>
		      		<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('creacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_add)); ?>
					</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('fecha'); ?> 
		      			<?php echo $this->lang->line('modificacion').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<?php echo date('d-m-Y H:i:s', strtotime($row->date_upd)); ?>
					</div>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="col-lg-8">
		      			<?php echo $this->lang->line('presupuesto'); ?> 
		      			<?php echo $this->lang->line('visto').' :'; ?> 
					</div>
					</td>
					<td>
					<div class="col-lg-8">
						<select name="visto" class="form-control chosen-select">	
							<?php
							if($row->visto_back == 1){
								echo '<option value="1" selected>SI</option>';
								echo '<option value="0">NO</option>';
							}
							else{
								echo '<option value="1">SI</option>';
								echo '<option value="0" selected>NO</option>';
							}
							?>
						</select>	
					</div>
					</td>
				</tr>
			</table>
			<input type="hidden" name="url" value="<?php echo current_url(); ?>">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      	<button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } } ?>