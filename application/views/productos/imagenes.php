<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>

 	<div class="row">
 		
 	
					<div class="col-md-3">
                            <!-- Primary box -->
                            <div class="box box-primary">
                                <div class="box-header" data-toggle="tooltip" title="" data-original-title="Header tooltip">
                                    <h3 class="box-title">
                                    <?php 
                                    	$id = $this->uri->segment(3);
										
										$producto = $this->productos_model->getRegistro($id); 
										
										foreach ($producto as $row) 
										{
											echo $row->nombre;
										}
									?>
									</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <p><?php echo $this->lang->line('codigo'); ?>: <code><?php echo $row->codigo;?></code></p>
                                    <p><?php echo $this->lang->line('precio'); ?>: <code><?php echo $row->precio;?></code></p>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <a href="<?php echo base_url().'index.php/productos/pestanas/'.$id ?>" class="btn btn-default">
                                    	<?php echo $this->lang->line('ficha'); ?>
                                    </a>
                                    <a href="<?php echo base_url().'index.php/productos/productos_abm/tab1' ?>" class="btn btn-default">
                                    	<?php echo $this->lang->line('productos'); ?>
                                    </a>
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>

	
    <div class="col-md-9">
    	 <div class="box box-primary">
 			<div class="box-body">
				<?php echo $output; ?>
			</div>
		</div>
    </div>
    
    </div>

