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
	'=' 	=> "igual",
	'<'		=> "mayor",
	'<='	=> "mayor igual",
	'>'		=> "menor ",
	'>='	=> "menor igual",
	'!='	=> "distinto ",
	'LIKE'	=> "contiene"
);

?>

<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal" method="post">
				<div class="form-group">
					<div class="col-md-5">
						<label class="col-sm-2 control-label"><?php echo $this->lang->line('columnas');?></label>
						<div class="col-sm-8">
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
					<div class="col-md-6">
						<div class="row">
							<label class="col-sm-2 control-label"><?php echo $this->lang->line('filtros');?></label>
							<div class="col-sm-6">
								<select class="form-control" id="filtro" name="filtro">
									<?php 
									$fields = $this->db->field_data('visitas');
									foreach ($fields as $field){
										echo "<option>".$field->name."</option>";
									}
									?>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" id="opciones" name="opciones[]">
									<?php 
									foreach ($opciones as $key => $opcion){
										echo "<option value=".$key.">".$opcion."</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-8">
								<input class="form-control" id="valores" name="valores[]">
							</div>
							<div class="col-sm-2">
		      						<button class="btn btn-default">+</button>
		    				</div>
						</div>
						<div class="row">
							<?php
							if($this->input->post('filtro')){
								echo $this->input->post('filtro')."<br>";
							}
							?>
						</div>	
					</div>
					<div class="row">
						<div class="col-sm-10"></div>
						<div class="col-sm-2">
		      					<button type="submit" class="btn btn-default"><?php echo $this->lang->line('crear'); ?></button>
		    			</div>
		    		</div>
    			</div>
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
					foreach ($registros as $key_r => $value_r) {
						echo "<tr>";
						foreach ($campos_post as $value) {
							echo "<td>".$value_r[$value]."</td>";
						}
						echo "</tr>";
						
					}
					echo '</body>';
					echo "</table>";
				}
				?>
  				
			</form>
		</div>
	</div>
</div>

<script>
$(function() {
	$('#campos').multiSelect();
});

</script>
		  		