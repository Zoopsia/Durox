<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>


	    <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
		  			<div class="panel-body">
						<div>
							<?php echo $output; ?>
						</div>
	    			</div><!--panel body-->
				</div><!--panel-->
			</div><!--contenedor-->
		</div>    

