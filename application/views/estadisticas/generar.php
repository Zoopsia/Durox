<script src=<?php echo base_url().'libraries/multiselect/js/jquery.multi-select.js'?>></script>
<link href="<?php echo base_url()?>libraries/multiselect/css/multi-select.css" rel="stylesheet">
<?php
if($this->input->post('campos')){
	foreach ($this->input->post('campos') as $key => $value) {
		$campos_post[] = $value;
	}
}else{
	$campos_post = FALSE;
}

$opciones = array(
	"igual",
	"mayor",
	"mayor_igual",
	"menor",
	"menor_igual",
	"distinto",
	"contiene"
);

$condiciones = array(
	" y ",
	" o ",
);

?>

<div class="row">
	<form class="form-horizontal" method="post">
		<div class="col-md-4">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $this->lang->line('columnas');?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<select class="form-control" multiple="multiple" id="campos" name="campos[]">
					<?php 
					$fields = $this->db->field_data('visitas');
					foreach ($fields as $field){
						if($campos_post && in_array($field->name, $campos_post)){
							echo "<option selected>".$field->name."</option>";	
						}else{
							echo "<option >".$field->name."</option>";
						}
					}
					?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $this->lang->line('filtros');?></h3>
					<div class="box-tools pull-right">
						<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-3">
							<select class="form-control" id="filtro" name="filtro">
							<?php 
							$fields = $this->db->field_data('visitas');
							foreach ($fields as $field){
								echo "<option>".$field->name."</option>";
							}
							?>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="opcion" name="opcion">
							<?php 
							foreach ($opciones as $opcion){
								echo "<option value=".$opcion.">".$opcion."</option>";
							}
							?>
							</select>
						</div>
						<?php 
						if($this->input->post('filtros') || $this->input->post('valor')){
						?>
						<div class="col-sm-4">
							<input class="form-control" id="valor" name="valor">
						</div>
						<div class="col-sm-2">
							<select class="form-control" id="condicion" name="condicion">
							<?php 
							foreach ($condiciones as $opcion){
								echo "<option value=".$opcion.">".$opcion."</option>";
							}
							?>
							</select>
						</div>
						<?php	
						}else{
						?>
						<div class="col-sm-6">
							<input class="form-control" id="valor" name="valor">
							<input type="hidden" name="condicion" value="-">
						</div>
						<?php	
						}	
						?>
						
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							
						<?php
						
						$valores = array();
						
						if($this->input->post('filtros')){
							foreach ($this->input->post('filtros') as $registro) {
								$valores['filtros'][] = $registro;	
							}
							foreach ($this->input->post('opciones') as $registro) {
								$valores['opciones'][] = $registro;	
							}
							foreach ($this->input->post('valores') as $registro) {
								$valores['valores'][] = $registro;	
							}
							foreach ($this->input->post('condiciones') as $registro) {
								$valores['condiciones'][] = $registro;	
							}
						}
						
						if($this->input->post('valor')){
							$valores['filtros'][]	= $this->input->post('filtro');
							$valores['opciones'][]	= $this->input->post('opcion');
							$valores['valores'][]	= $this->input->post('valor');
							$valores['condiciones'][]	= $this->input->post('condicion');
						}
						
						if($this->input->post('filtros') || $this->input->post('valor')){
							if($this->input->post('valor')){
								$extra = 1;
							}else{
								$extra = 0;
							}
							$cantidad = count($this->input->post('filtros')) + $extra ;
							
							for ($i=0; $i < $cantidad; $i++) {
								$class = 'col'.$i;
								echo '<input type="hidden" value="'.$valores['filtros'][$i].'" name="filtros[]" class="'.$class.'" checked/>';
								echo '<input type="hidden" value="'.$valores['opciones'][$i].'" name="opciones[]" class="'.$class.'" checked/>';
								echo '<input type="hidden" value="'.$valores['valores'][$i].'" name="valores[]" class="'.$class.'" checked/>';
								echo '<input type="hidden" value="'.$valores['condiciones'][$i].'" name="condiciones[]" class="'.$class.'" checked/>';
							}
							
							echo '<table class="table table-hover">';
							echo '<thead>';
							echo '<tr>';
							echo '<td>'.$this->lang->line('campo').'</td>';
							echo '<td>'.$this->lang->line('opcion').'</td>';
							echo '<td>'.$this->lang->line('valor').'</td>';
							echo '<td>'.$this->lang->line('condicion').'</td>';
							echo '<td></td>';
							echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							for ($i=0; $i < $cantidad; $i++) {
								$id = 'col'.$i;
								$id2 = "'col$i'";
								
								echo '<tr  id="'.$id.'">';
								echo '<td>'.$valores['filtros'][$i].'</td>';
								echo '<td>'.$valores['opciones'][$i].'</td>';
								echo '<td>'.$valores['valores'][$i].'</td>';
								echo '<td>'.$valores['condiciones'][$i].'</td>';
								echo '<td><button class="btn btn-danger btn-xs" onclick="borrar('.$id2.')"><i class="fa fa-minus-square"></i></button></td>';
								echo '</tr>';
							}
							echo '</tbody>';
							echo '</table>';
						}
						?>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-12">
							<a href="<?php echo base_url().'index.php/Estadisticas/generar' ?>" class="btn btn-lg btn-default"><?php echo $this->lang->line('cancelar'); ?></a>
							<button type="submit" class="btn btn-lg btn-primary pull-right"><?php echo $this->lang->line('crear'); ?></button>
					    </div>
					</div>	
				</div>
			</div>	
		</div>
		
	</form>
</div>



<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><?php echo $this->lang->line('columnas');?></h3>
				<div class="box-tools pull-right">
					<button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
			<?php 
			if($campos_post){
				echo '<table class="table table-hover prueba">';
				echo '<thead>';
				echo "<tr>";
				foreach ($campos_post as $value) {
					echo "<td>".$value."</td>";
				}
				echo "</tr>";
				echo '</thead>';
				echo '<body>';
				if($registros){
					foreach ($registros as $key_r => $value_r) {
						echo "<tr>";
						foreach ($campos_post as $value) {
							echo "<td>".$value_r[$value]."</td>";
						}
						echo "</tr>";
					}	
				}
				echo '</body>';
				echo "</table>";
			}
			?>
			</div>
		</div>
	</div>
</div>

<script>
$(function() {
	$('#campos').multiSelect();
});

function borrar(id){
	$('#'+id).remove();	
	$('.'+id).remove();	
}




</script>
		  		