
	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-body">
		  				<div class="tab-content">
		  						
								<?php
	    							foreach($visita as $value){
	    						?>
								
	    						<form action="<?php echo base_url()."index.php/Visitas/editarVisita/".$value->id_visita; ?>" class="form-horizontal" method="post">
	    							<div style="padding: 0 50px">
	    								<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('vendedor'); ?></label>
												<div class="col-sm-8">
													<select name="id_vendedor" class="form-control chosen-select">	
														<?php
															foreach($vendedores as $row){
																if($row->id_vendedor == $value->id_vendedor){
																	echo '<option value="'.$row->id_vendedor.'" selected>'.$row->nombre.', '.$row->apellido.'</option>';
																}
																else {
																	echo '<option value="'.$row->id_vendedor.'">'.$row->nombre.', '.$row->apellido.'</option>';
																}
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
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('cliente'); ?></label>
												<div class="col-sm-8">
													<select name="id_cliente" class="form-control chosen-select">	
														<?php
															foreach($clientes as $row){
																if($row->id_cliente == $value->id_cliente){
																	echo '<option value="'.$row->id_cliente.'" selected>'.$row->nombre.', '.$row->apellido.'</option>';
																}
																else {
																	echo '<option value="'.$row->id_cliente.'">'.$row->nombre.', '.$row->apellido.'</option>';
																}
															}
														?>
													</select>												      	 
									     		</div>
									     		<div class="col-sm-1">
										      		<a role="button" class="btn btn-primary btn-sm" href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('agregar').' '.$this->lang->line('cliente');?>" style="margin-top: 15%">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
													</a>
									      		</div>
									    </div>
									      	  
									    <div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('epoca').' '.$this->lang->line('visita'); ?></label>
												<div class="col-sm-8">
													<select name="id_epoca_visita" class="form-control chosen-select">	
														<?php
															foreach($epocas as $row){
																if($row->id_epoca_visita == $value->id_epoca_visita){
																	echo '<option value="'.$row->id_epoca_visita.'" selected>'.$row->epoca.'</option>';
																}
																else{
																	echo '<option value="'.$row->id_epoca_visita.'">'.$row->epoca.'</option>';
																}	
															}
														?>
													</select>												      	 
									     		</div>
									    </div>
	    								
		    							<div class="form-group even">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('fecha'); ?></label>
												<div class="col-sm-8">
													<input type="text" name="date_upd" class="form-control datepicker" value="<?php echo date('d/m/Y', strtotime( $value->date_upd));?>">	 
												</div>
										</div>
										
										<div class="form-group odd">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('comentarios'); ?></label>
												<div class="col-sm-8">
													<textarea name="comentarios" style="width: 100%; height: 100px;" ><?php echo $value->descripcion;?></textarea>	 
												</div>
										</div>
										
										<div class="form-group even" style="padding-bottom: 1%">
											<label class="col-sm-2 control-label"><?php echo $this->lang->line('valoracion'); ?></label>
												<div class="col-sm-8" style="margin-top: 1%">
													<?php
													for ($i=1; $i <= 5; $i++) {
														if($value->valoracion == $i){ 
															echo '<input name="star1" type="radio" value="'.$i.'" class="star" checked/>';
														}
														else {
															echo '<input name="star1" type="radio" value="'.$i.'" class="star"/>';
														}
													}
													?>
												</div>
										</div>
										
										<hr />
										
										<div class="form-group even">
											<label class="col-sm-2 control-label"></label>
											<div class="col-sm-8">
												<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('guardar'); ?></button>
												<input type="button" value="<?php echo $this->lang->line('cancelar'); ?>" class="btn btn-danger" onclick="confirmarVisita()">
											</div>
									   	</div>
									</div>
	    						</form>
	    						<?php
	    						}
								?>	    						
	    				</div><!--contenedor de cada pestaña-->
		  			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    

