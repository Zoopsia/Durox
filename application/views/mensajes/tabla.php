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
                        	<div style="text-align: center;">
                        		<h3><i class="fa fa-inbox"></i><?php echo ' '.$this->lang->line('mensajeria');?></h3>
		                    </div>            
                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i><?php echo ' '.$this->lang->line('redactar').' '.$this->lang->line('mensaje');?></a>
                            <!-- Navigation - folders-->
                            <div style="margin-top: 15px;">
	                            <ul class="nav nav-pills nav-stacked">
		                            <li class="header"><?php echo $this->lang->line('carpetas');?></li>
		                            <li class="active in"><a href="#mail1" data-toggle="tab"><i class="fa fa-inbox"></i> <?php echo $this->lang->line('recibidos').' ('.$cont_mensajes.')';?></a></li>
		                            <li><a href="#mail2" data-toggle="tab"><i class="fa fa-mail-forward"></i> <?php echo $this->lang->line('enviados');?></a></li>
		                            <li><a href="#mail3" data-toggle="tab"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('papelera');?> </a></li>
	                            </ul>
                            </div>
						</div><!-- /.col (LEFT) -->
                        <div class="tab-content">
		     				<div class="tab-pane fade active in" id="mail1">            
                            	<div class="col-md-9 col-sm-8">
                            		<!-- BUSQUEDA Y ACCIONES -->
                            		<div class="row pad">
                                    	<div class="col-sm-6">
                                        	<label style="margin-right: 10px;" class="">
                                            	<div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" id="check-all" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                            </label>
                                            <!-- Action button -->
                                        	<div class="btn-group">
                                            	<button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                	Action <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
	                                                <li><a href="#">Mark as read</a></li>
	                                                <li><a href="#">Mark as unread</a></li>
	                                                <li class="divider"></li>
	                                                <li><a href="#">Move to junk</a></li>
	                                                <li class="divider"></li>
	                                                <li><a href="#">Delete</a></li>
                                                </ul>
                                            </div>
										</div>
                                        <div class="col-sm-6 search-form">
	                                        <form action="#" class="text-right">
		                                        <div class="input-group">                                                            
			                                        <input type="text" class="form-control input-sm" placeholder="Search">
			                                        <div class="input-group-btn">
			                                        	<button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
			                                        </div>
		                                        </div>                                                     
	                                        </form>
                                        </div>
                                    </div>
                            		
	                            	<div class="table-responsive">
	                                <!-- THE MESSAGES -->
	                                	<table class="table table-mailbox">
	                                		<?php if($recibidos) { foreach($recibidos as $row) { if($row->visto == 0) { ?>
											<tr class="unread">
	                                        	<td class="small-col"><input type="checkbox" /></td>
	                                            <td class="small-col"><i class="fa fa-star"></i></td>
	                                            <td class="name"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
	                                            <td class="subject"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->asunto;?></a></td>
	                                            <td class="time">12:30 PM</td>
	                                        </tr>
											<?php } else { ?>
											<tr>
	                                            <td class="small-col"><input type="checkbox" /></td>
	                                            <td class="small-col"><i class="fa fa-star-o"></i></td>
	                                            <td class="name"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->nombre.' '.$row->apellido; ?></a></td>
	                                            <td class="subject"><a href="#mail4" data-toggle="tab" class="displayblock" onclick="mostrarMensaje(<?php echo $row->id_sin_mensaje_vendedor;?>)"><?php echo $row->asunto;?></a></td>
	                                            <td class="time">12:30 PM</td>
	                                        </tr>
											<?php } } } ?>     
	                                    </table>
	                                </div><!-- /.table-responsive -->
	                                <div class="pull-right">
					                	<small>Showing 1-12/1,240</small>
					                	<button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>
					                	<button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>
				                    </div>
								</div><!-- /.col (RIGHT) -->
							</div>
							<div class="tab-pane fade" id="mail2">
							<!-- /TAB2 -->
							ENVIADOS
							</div>
							<div class="tab-pane fade" id="mail3">
							<!-- /TAB3 -->
							PAPELERA
							</div>
							<div class="tab-pane fade" id="mail4">
							<!-- /TAB4 -->
							<!--
								<div class="col-md-9 col-sm-8 mensajeria">
									<div>
		                            	<img src="" alt="user image" class="offline">
		                            	<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
		                            </div>
		                            <div>          
		                                        <p class="message">
		                                            <a href="#" class="name">
		                                               Jane Doe
		                                            </a>
		                                            I would like to meet you to discuss the latest news about
		                                            the arrival of the new theme. They say it is going to be one the
		                                            best themes on the market
		                                        </p>
		                            </div>
								</div>
							-->
								<div id="mostrarMensajes" class="col-md-9 col-sm-8">
									
								</div>
								<div class="col-md-9 col-sm-8">
									<a class="btn btn-default btn-sm pull-right" href="#mail1" data-toggle="tab"> volver</a>
								</div>
							</div>
						</div>
                    </div><!-- /.col (MAIN) -->
				</div><!-- mailbox row --->
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div> 

<script>
function mostrarMensaje($id){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/Mensajes/verDetalle', 
		data: { 'id' 	: $id, 
	 			}, 
	 	success: function(resp) { 
	 		$('#mostrarMensajes').attr('disabled',false).html(resp);
		},	
	});
}
</script> 
