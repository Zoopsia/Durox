<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-archive"></i> <?php echo $this->lang->line('producto'); ?>
        </div>
		
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4 col-lg-4 " align="center"> 
				<?php
					if($imagenes)
					{
						foreach ($imagenes as $row)
						{
							if($row->url != '')
							{ 
								echo '<img alt="User Pic" src="'.base_url().'img/productos/imagenes/'.$row->url.'" class="img-thumbnail img-responsive">';
							}
						}
					}	
				?>
				</div>
				
				<div class=" col-md-8 col-lg-8 "><!--carga info cliente-->
					<table class="table table-striped table-user-information"> 
					<?php
					if($productos){
						foreach ($productos as $row) 
						{
							if($row->eliminado != 1)
							{
								echo "<tbody>";
								echo  "<tr>";
								echo  '<td>'.$this->lang->line('nombre').':</td>';
								echo  '<td class="tabla-datos-importantes">'.$row->nombre.'</td>';
								echo  "</tr>";
								echo  "<tr>";
								echo  '<td>'.$this->lang->line('id').':</td>';
								echo  '<td class="tabla-datos-importantes">'.$row->id_producto.'</td>';
								echo  "</tr>";
								echo  "<tr>";
								echo  '<td>'.$this->lang->line('precio').':</td>';
								echo  '<td class="tabla-datos-importantes">$ '.$row->precio.'</td>';
								echo  "</tr>";
								if($row->codigo)
								{
									echo  "<tr>";
									echo  '<td>'.$this->lang->line('nombre').':</td>';
									echo  '<td class="tabla-datos-importantes">'.$row->codigo.'</td>';
								}
								echo  "</tr>";
								echo  "<tr>";
								echo  '<td>'.$this->lang->line('id').' '.$this->lang->line('id').':</td>';
								echo  '<td class="tabla-datos-importantes">'.$row->id_sin.'</td>';
								echo  "</tr>";
								
								$date	= date_create($row->date_upd);
								echo  "<tr>";
								echo  '<td style="width: 251px">'.$this->lang->line('date').' '.$this->lang->line('sincronizacion').':</td>';
								echo  '<td class="tabla-datos-importantes">'.date_format($date, 'd/m/Y').'</td>';
								echo  "</tr>";
								echo  "<tr>";
								echo  '<td></td>';
								echo  '<td>';
								echo '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#popPrecios">';
								echo $this->lang->line('ver').' '.$this->lang->line('precios');
								echo '</button>';
								echo '</td>';
								echo  "</tr>";
								echo  "</tbody>";
							}
							else
							{
								echo '<div class="row">
										<div class="col-md-offset-3 col-sm-6 col-md-6">
											<div class="alert-message alert-message-danger">
												<h4>'.$this->lang->line('cliente').' '.$this->lang->line('eliminado').'</h4>
												<p>
																                    
												</p>
											</div>
										</div>
									  </div>';
							}
						}
					}
					?>
					</table>
					
					<div>
					<?php
						if($productos)
						{
							foreach ($productos as $row) 
							{
								if($row->eliminado != 1)
								{
									echo "<blockquote> - <em>";
									echo $row->ficha_tecnica;
									echo "</em></blockquote>";
								}
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>  		
	</div>
</div>
 
		
		
		<!-- Modal -->
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <div class="modal-body">
      	<div class="row">	
      		<div class="col-lg-4">
      			<!--<?php echo $this->lang->line('fecha'); ?> -->
      			<!--<?php echo $this->lang->line('creacion'); ?> -->
			</div>
			<div class="col-lg-8">
				<!--<?php echo date('d-m-Y H:i:s', strtotime($row->date_add)); ?>-->
			</div>
			
			<div class="col-lg-4">
      			<!--<?php echo $this->lang->line('fecha'); ?> -->
      			<!--<?php echo $this->lang->line('modificacion'); ?> -->
			</div>
			<div class="col-lg-8">
				<!--<?php echo date('d-m-Y H:i:s', strtotime($row->date_upd)); ?> -->
			</div>
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      </div>
    </div>
  </div>
</div>