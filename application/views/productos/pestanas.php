<script>
$(function() {
			
	$( '#bb-bookblock' ).bookblock();

});


</script>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-archive"></i> <?php echo $this->lang->line('producto'); ?>
        </div>
		
		<div class="panel-body">
			<div class="row">
				<div class="col-md-5 col-lg-5 " align="center"> 
					<?php
						if($imagenes)
						{
					?>
					<div  id="bb-bookblock" class="bb-bookblock">
						<?php	
								foreach ($imagenes as $row)
								{
									if($row->url != '')
									{
										echo '<div class="bb-item">';
										echo '<img alt="User Pic" src="'.base_url().'img/productos/imagenes/'.$row->url.'" class="img-rounded img-responsive">';
										echo '</div>';
									}
								}
								
						?>
					</div>
					<nav>
						<a id="bb-nav-first" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-double-left fa-2x"></i></button></a>
						<a id="bb-nav-prev" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-left fa-2x"></i></button></a>
						<a id="bb-nav-next" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-right fa-2x"></i></button></a>
						<a id="bb-nav-last" href="#"><button class="btn-mover-fotos"><i class="fa fa-angle-double-right fa-2x"></i></button></a>
					</nav>
					<?php
						}
						else{
							echo '<a href="'.base_url().'index.php/productos/producto_imagen/'.$id.'">'.$this->lang->line('cargar').' '.$this->lang->line('imagen').'</a>';
						}
					?>
				</div>
				
				<div class=" col-md-7 col-lg-7 "><!--carga info cliente-->
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
								if($row->ficha_tecnica){
									echo  "<tr>";
									echo  '<td>'.$this->lang->line('ficha').':</td>';
									echo  '<td class="tabla-datos-importantes"><a href="'.base_url().'img/productos/documentos/'.$row->ficha_tecnica.'" download>'.$this->lang->line('descarga').' <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></td>';
									echo  "</tr>";
								}
								else{
									echo  "<tr>";
									echo  '<td>'.$this->lang->line('ficha').':</td>';
									echo  '<td class="tabla-datos-importantes"></td>';
									echo  "</tr>";
								}
								echo  "<tr>";
								echo  '<td  colspan="2" style="text-align: center">';
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
									echo "<blockquote><em>";
									echo $row->descripcion;
									echo "</em></blockquote>";
								}
								
								$precio_base = $row->precio;
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
<div class="modal fade" id="popPrecios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('informacion');?></h4>
      </div>
      <div class="modal-body">
      	<div class="row">	
      		<div class="col-lg-12">
      			<table table class="table table-striped" cellspacing="0" width="100%">
      				<thead>
						<tr>
							<th class="th1"><?php echo $this->lang->line("grupo")?></th>
							<th class="th1"><?php echo $this->lang->line("precio")?></th>
						</tr>
					</thead>
					<tbody>
      				<?php
      				if($precios)
      				{
      					foreach ($precios as $row){
							if($row->id_grupo_cliente == 1)
							{
								echo '<tr>
									      <td>'.$this->lang->line('precio').' '.$this->lang->line('base').'</td>
										  <td>$ '.$precio_base.'</td>
									 </tr>';		
							}
							else
							{
								echo '<tr>';
								echo '<td>'.$row->grupo_nombre.'</td>';
								if($row->aumento_descuento == 1)
								{
									$descuento 		= ($precio_base * $row->valor)/100;
									$preciofinal	= round($precio_base - $descuento, 2);
								}
								else 
								{
									$descuento 		= ($precio_base * $row->valor)/100;
									$preciofinal	= round($precio_base + $descuento, 2);
								}		  
										  
								echo '<td>$ '.$preciofinal.'</td>';
								echo '</tr>';	
							}
						}
      				}
      				?>
      				</tbody>
      			</table>
			</div>
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cerrar');?></button>
      </div>
    </div>
  </div>
</div>


<script>
	var Page = (function() {
	var config = {
		$bookBlock : $( '#bb-bookblock' ),
		$navNext : $( '#bb-nav-next' ),
		$navPrev : $( '#bb-nav-prev' ),
		$navFirst : $( '#bb-nav-first' ),
		$navLast : $( '#bb-nav-last' )
	},
	init = function() {
		config.$bookBlock.bookblock( {
		speed : 800,
		shadowSides : 0.8,
		shadowFlip : 0.7
		} );
		initEvents();
	},
	initEvents = function() {
	var $slides = config.$bookBlock.children();

	// add navigation events
	config.$navNext.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'next' );
		return false;
	} );

	config.$navPrev.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'prev' );
		return false;
	} );

	config.$navFirst.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'first' );
		return false;
	} );

	config.$navLast.on( 'click touchstart', function() {
		config.$bookBlock.bookblock( 'last' );
		return false;
	} );
						
	// add swipe events
	$slides.on( {
		'swipeleft' : function( event ) {
			config.$bookBlock.bookblock( 'next' );
			return false;
		},
		'swiperight' : function( event ) {
			config.$bookBlock.bookblock( 'prev' );
			return false;
		}
	} );

	// add keyboard events
	$( document ).keydown( function(e) {
	var keyCode = e.keyCode || e.which,
	arrow = {
		left : 37,
		up : 38,
		right : 39,
		down : 40
	};

	switch (keyCode) {
		case arrow.left:
			config.$bookBlock.bookblock( 'prev' );
			break;
		case arrow.right:
			config.$bookBlock.bookblock( 'next' );
			break;
	}
	} );
};

	return { init : init };

})();
</script>
<script>
	Page.init();
</script>
