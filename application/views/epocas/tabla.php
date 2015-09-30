<?php
foreach($css_files as $file): 
?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<script>
function funcion(){
$(document).ready(function(){
	document.getElementById('dropdownMenu1').style.display = 'block';
});	
}	
</script>
<?php

if($this->uri->segment(3)!='add')
	echo "<script>funcion();</script>";
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-1 dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="display: none">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="<?php echo base_url().'index.php/Epocas/epocas_abm/add'?>"><?php echo $this->lang->line('nueva').' '.$this->lang->line('epoca'); ?></a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<?php echo $output; ?>
					</div>
				</div>
			</div><!--panel body-->
		</div><!--panel-->
	</div><!--contenedor-->
</div>  
<script>
$(function() {
	startTime();
    $(".center").center();
    $(window).resize(function() {
    	$(".center").center();
    });
});
</script>