<script>
$(function() {
			
	$( '#bb-bookblock' ).bookblock();

});

<?php
if($productos){
	foreach($productos as $row){
		echo "var precio =".$row->precio.";";
		echo "var descripcion ='".trim($row->descripcion)."';";
	}
}
?>

function editable(){
	$(".cambio").removeAttr("disabled");
	$(".cambio").removeClass("editable");
	$('#btn-guardar').show();
	$('#btn-cancelar').show();
	$('#btn-editar').hide();
	$('#btn-eliminar').hide();
	$('#precio').val(precio);
	$('#ficha_tecnica').show();
	$('#textarea').html('<textarea id="editor1" name="editor1" rows="10" cols="80">'+descripcion+'</textarea>');
	CKEDITOR.replace('editor1');
}

function eliminar($id){
	var r = confirm("¿Esta seguro que quiere eliminar el registro?");
    if (r == true) {
		window.location.assign("/Durox/index.php/Productos/delete_user/"+$id);
	}
}

function cancelar(){
	var r = confirm("¿Esta seguro que quiere cancelar los cambios?");
    if (r == true) {
		$(".cambio").attr("disabled", true);
		$(".cambio").addClass("editable");
		$('#btn-guardar').hide();
		$('#btn-cancelar').hide();
		$('#btn-eliminar').show();
		$('#btn-editar').show();
		$('#ficha_tecnica').hide();
		<?php
			if($productos){
				foreach($productos as $row){
					echo "$('#nombre').val('".$row->nombre."');";
					echo "$('#precio').val('$ ".$row->precio."');";	
					echo "$('#textarea').html('<blockquote><em>".trim($row->descripcion)."</em></blockquote>');";
					if($row->codigo)
						echo "$('#codigo').val('".$row->codigo."');";									
				}	
			}
		?>
	}
}



</script>
<?php
$bandera = 0;
?>
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
					<div id="bb-bookblock" class="bb-bookblock">
						<?php	
								foreach ($imagenes as $row)
								{
									if($row->url != '')
									{
										echo '<div class="bb-item">';
										echo '<img alt="User Pic" src="'.base_url().'img/productos/imagenes/'.$row->url.'" class="img-rounded img-responsive img-bookblock">';
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
							echo '<a href="'.base_url().'index.php/productos/producto_imagen/'.$id.'">'.$this->lang->line('cargar').' '.$this->lang->line('imagen').' <i class="fa fa-upload"></i></a>';
						}
					?>
				</div>
				
				<div class=" col-md-7 col-lg-7 "><!--carga info cliente-->
					<form id="formulario" action="<?php echo base_url()."index.php/Productos/editarProducto/$row->id_producto"?>" class="form-horizontal" method="post" enctype="multipart/form-data"> 
						<div class="row">
							<div class=" col-md-12 col-lg-12 ">
								<table class="table table-striped table-user-information"> 
								<?php
								if($productos){
									foreach ($productos as $row) 
									{
										if($row->eliminado != 1)
										{
											echo "<tbody>";
											echo  "<tr>";
											echo  '<td class="padtop">'.$this->lang->line('nombre').':</td>';
											echo  '<td class="tabla-datos-importantes"><input class="form-control editable cambio" id="nombre" name="nombre" type="text" pattern="^[A-Za-z0-9._- ñáéíóú]+$" value="'.$row->nombre.'" maxlength="128" disabled placeholder="'.$this->lang->line('nombre').'" autocomplete="off" required></td>';
											echo  "</tr>";
											echo  "<tr>";
											echo  '<td class="padtop">'.$this->lang->line('id').':</td>';
											echo  '<td class="tabla-datos-importantes"><input type="text" name="id" class="form-control editable"  value="'.$row->id_producto.'" autocomplete="off" disabled style="width: 275px !important;"></td>';
											echo  "</tr>";
											echo  "<tr>";
											echo  '<td class="padtop">'.$this->lang->line('precio').':</td>';
											echo  '<td class="tabla-datos-importantes"><input type="text" name="precio" id="precio" class="form-control editable cambio" pattern="[0-9]*.{1,}" value="$ '.$row->precio.'" placeholder="'.$this->lang->line('precio').'" autocomplete="off" disabled required></td>';
											echo  "</tr>";
											echo  "<tr>";
											echo  '<td class="padtop">'.$this->lang->line('codigo').':</td>';
											echo  '<td class="tabla-datos-importantes"><input type="text" name="codigo" id="codigo" class="form-control editable cambio" value="'.$row->codigo.'" placeholder="'.$this->lang->line('codigo').'" autocomplete="off" disabled></td>';
											echo  "</tr>";
											echo  "<tr>";
											echo  '<td class="padtop">'.$this->lang->line('id').' '.$this->lang->line('id').':</td>';
											echo  '<td class="tabla-datos-importantes"><input type="text" name="id_sin" class="form-control editable"  value="'.$row->id_sin.'" autocomplete="off" disabled style="width: 275px !important;"></td>';
											echo  "</tr>";
											$date	= date_create($row->date_upd);
											echo  "<tr>";
											echo  '<td class="padtop" style="width: 251px">'.$this->lang->line('date').' '.$this->lang->line('sincronizacion').':</td>';
											echo  '<td class="tabla-datos-importantes"><input type="text" name="fecha" class="form-control editable"  value="'.date_format($date, 'd/m/Y').'" autocomplete="off" disabled></td>';
											echo  "</tr>";
											if($row->ficha_tecnica){
												echo  "<tr>";
												echo  '<td class="padtop">'.$this->lang->line('ficha').':</td>';
												echo  '<td class="tabla-datos-importantes"><a href="'.base_url().'img/productos/documentos/'.$row->ficha_tecnica.'" download>'.$this->lang->line('descarga').' <i class="fa fa-download"></i></a></td>';
												echo  "</tr>";
											}
											else{
												echo  "<tr>";
												echo  '<td class="padtop">'.$this->lang->line('ficha').':</td>';
												echo  '<td class="tabla-datos-importantes"><input type="file" name="ficha_tecnica" id="ficha_tecnica" style="display: none"></td>';
												echo  "</tr>";
											}
											echo  "<tr>";
											echo  '<td  class="padtop" colspan="2" style="text-align: center">';
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
															<h4>'.$this->lang->line('producto').' '.$this->lang->line('eliminado').'</h4>
															<p>
																			                    
															</p>
														</div>
													</div>
												  </div>';
											$bandera = 1;
										}
									}
								}
								?>
								</table>
							</div>
						</div>
						<div class="row">
							<div class=" col-md-12 col-lg-12 ">
								<?php
									if($productos)
									{
										foreach ($productos as $row) 
										{
											if($row->eliminado != 1)
											{
												echo '<div id="textarea">';
												echo "<blockquote><em>";
												echo $row->descripcion;
												echo "</em></blockquote>";
												echo "</div>";
											}
											
											$precio_base = $row->precio;
										}
									}
								?>
							</div>
						</div>
						<?php
						if($bandera != 1){
						?>
						<div class="row">
							<div id="div-mover" class="col-md-4 col-lg-4 col-lg-offset-8">
						    	<button type="button" id="btn-editar" class="btn btn-primary btn-sm" onclick="editable()">
									<?php echo $this->lang->line('editar');?>
								</button>
								<button type="button" id="btn-eliminar" class="btn btn-danger btn-sm" onclick="eliminar(<?php echo $id?>)">
									<?php echo $this->lang->line('eliminar');?>
								</button>
						        <button type="submit" id="btn-guardar" class="btn btn-primary btn-sm" style="display: none; margin-top: 15px;">
									<?php echo $this->lang->line('guardar');?>
								</button>
								<button type="button" id="btn-cancelar" class="btn btn-danger btn-sm" onclick="cancelar()" style="display: none; margin-top: 15px;">
									<?php echo $this->lang->line('cancelar');?>
								</button>
							</div>
						</div>
						<?php
						}
						?>
					</form>
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
