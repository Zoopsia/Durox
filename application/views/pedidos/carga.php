<script>
function busqueda2(){
 	var id_vendedor = $('select#id_vendedor').val(); //Obtenemos el id del pais seleccionado en la lista
 	$.ajax({
	 	type: 'POST',
	 	url: '<?php echo base_url(); ?>index.php/Pedidos/getClientes', //Realizaremos la petición al metodo prueba del controlador direcciones
	 	data: 'id_vendedor='+id_vendedor, 
	 	success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
	 		//Activar y Rellenar el select de provincias
	 		$('#id_cliente').attr('disabled',false).html(resp);//Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de provincias
	 		$("#id_cliente").trigger("chosen:updated");
	 	}
	});
}
</script>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $this->lang->line('nuevo').' '.$this->lang->line('pedido'); ?>
				<li id="volver" class="pull-right desactive" style="display: block"><a href="#" data-toggle="tab"  onclick="javascript:document.location.reload();">Resetear Formulario</a></li>
			</div>
		  	<div class="panel-body">
		  		<div class="row">
		  			<div class="col-sm-6">
			  			<h3><div style="padding: 0 0 20px 60px">
							<a href="#">
								<?php echo $this->lang->line('nuevo').' '.$this->lang->line('pedido'); ?>
							</a>
						</div></h3>
					</div>
				</div>
				<form action="<?php echo base_url().'index.php/Pedidos/nuevoPedido/'; ?>" class="form-horizontal" method="post">
				<div style="padding: 0 50px">	
					<div class="form-group odd">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('vendedor').'*:'; ?></label>
						<div class="col-sm-8">
							<select id="id_vendedor" name="id_vendedor" class="form-control chosen-select" onchange=" busqueda2()" data-placeholder="Seleccione un <?php echo $this->lang->line('vendedor'); ?>" required>	
								<option></option>
								<?php
									foreach($vendedores as $row){
										echo '<option value="'.$row->id_vendedor.'">'.$row->nombre.', '.$row->apellido.'</option>';
									}
								?>
							</select>												      	 
						</div>
						<div class="col-sm-1">
							<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('vendedor');?>" style="margin-top: 15%">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</a>
						</div>
					</div>
	    								
	    			<div class="form-group even">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('cliente').'*:'; ?></label>
						<div class="col-sm-8">
							<select id="id_cliente" name="id_cliente" class="form-control chosen-select" data-placeholder="Seleccione un <?php echo $this->lang->line('cliente'); ?>" required>	
							<!-- SE LLENA CON AJAX -->
							</select> 
						</div>
						<div class="col-sm-1">
							<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>" style="margin-top: 15%">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</a>
						</div>
					</div>
									        								
		    		<div class="form-group odd">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('fecha').'*:'; ?></label>
						<div class="col-sm-8" id="date_add">
							<input type="text" name="fecha" class="form-control datepicker" value="" required autocomplete="off">	 
						</div>
					</div>
																		    
					<hr />
										
					<div class="form-group even">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-8">
							<button type="submit" class="btn btn-primary" id="button-submit" onclick="prueba()"><?php echo $this->lang->line('guardar'); ?></button>
							<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarPresupuesto()">
						</div>
					</div>
				</div>
				</form>
			</div><!--panel body-->
		</div><!-- panel -->
	</div>
</div>