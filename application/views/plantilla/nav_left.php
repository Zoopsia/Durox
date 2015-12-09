<?php 
$array_activo = moduloActivo($this->uri->segment(1));

$menu_item = array(
	'visitas'	=> array(
		'icon'		=> 'fa fa-car',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
	'presupuestos'	=> array(
		'icon'		=> 'fa fa-book',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
	'pedidos'	=> array(
		'icon'		=> 'fa fa-shopping-cart',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
	'productos'	=> array(
		'icon'		=> 'fa fa-archive',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
	'clientes'	=> array(
		'icon'		=> 'fa fa-user',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
	'vendedores'	=> array(
		'icon'		=> 'fa fa-briefcase',
		'items'		=> array(
			'listado_de', 'carga', 'busqueda_avanzada'
		),
	),
);
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
	<aside class="left-side sidebar-offcanvas">                
		<section class="sidebar">
			
			<!-- PANEL DE USUARIO -->
			
			<div class="user-panel">
				<div class="pull-left image">
					<?php
					if( $session_data['imagen'] != '' ){ 
						$url = getimagesize($session_data['imagen']);
						if(is_array($url)){
							$src = $session_data['imagen'];
						}else{
							$src = base_url().'img/icon-user-default.png';
						}
					}else{
						$src = base_url().'img/icon-user-default.png';
					}
					
					echo '<img src="'.$src.'" class="img-circle" alt="User Image" />';	
					
					?>
				</div>
				<div class="pull-left info">
					<p><?php echo $session_data['usuario'] ?></p>
					<div class="headline text-center" id="time"></div>
				</div>
				<br><br><hr />
	            <div class="text-center">
					<p><em><b>
							<?php
								echo fechaEspañol(date('l j , F'));
							?>
					</b></em></p>
				</div>
			</div>
			
			<!-- MENU -->
			
			<ul class="sidebar-menu">
				<li class="<?php echo $array_activo['home']?>">
					<a href="<?php echo base_url().'index.php/Home/'?>">
						<span class="glyphicon glyphicon-home"></span>
						<?php echo $this->lang->line('home'); ?>
					</a>
				</li> 
				
				<?php
				foreach ($menu_item as $name => $option) {
					echo '<li class="treeview '.$array_activo[$name].'" >';
					echo '<a href="#">';
					echo 	'<i class="'.$option['icon'].'"></i>';
					echo  		$this->lang->line($name);
					echo 	'<i class="fa pull-right fa-angle-left"></i>'; 
					echo '</a>';  
					echo '<ul class="treeview-menu" style="display: none;">';
					foreach ($option['items'] as $items) {
						if($items == 'listado_de'){
					 		echo '<li><a href="'.base_url().'index.php/'.$name.'/'.$name.'_abm/tab1">'.$this->lang->line('listado_de').' '.$this->lang->line($name).'</a></li>';
					 	}else if($items == 'carga'){
					 		echo '<li><a href="'.base_url().'index.php/'.$name.'/carga">'.$this->lang->line('nuevo_'.$name).'</a></li>';
						}else if($items == 'busqueda_avanzada'){
							echo '<li><a href="'.base_url().'index.php/'.$name.'/'.$name.'_abm/tab2">'.$this->lang->line('busqueda_avanzada').'</a></li>';
						}
					}
					echo '</ul>';
					echo '</li>';
				}
				?>
				
				<!-- LISTADOS -->   
				        
				<li class="treeview <?php echo $array_activo['estadisticas']?>">
					<a href="#">
						<i class="fa fa-bar-chart"></i>
						<?php echo $this->lang->line('estadisticas'); ?>
						<i class="fa pull-right fa-angle-left"></i>
					</a> 
					<ul class="treeview-menu" style="display: none;">
						<li><a href="<?php echo base_url().'index.php/Estadisticas/sistemas'?>"><?php echo $this->lang->line('visitas'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Estadisticas/generar'?>"><?php echo $this->lang->line('visitas').' '.$this->lang->line('avanzado'); ?></a></li>
					</ul>
				</li>
				
				<!-- ADMINISTRACIÓN -->   
				        
				<li class="treeview <?php echo $array_activo['administracion']?>">
					<a href="#">
						<i class="fa fa-cog"></i>
						<?php echo $this->lang->line('administracion'); ?>
						<i class="fa pull-right fa-angle-left"></i>
					</a> 
					<ul class="treeview-menu" style="display: none;">
						<li><a href="<?php echo base_url().'index.php/Grupos/adminClientes/tab1'?>"><?php echo $this->lang->line('grupos').' de '.$this->lang->line('clientes'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Documentos/documentos_abm/'?>"><?php echo $this->lang->line('documentos'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Mails/editarMailsClientes/'?>"><?php echo $this->lang->line('editar').' '.$this->lang->line('correo'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Alarmas/nuevaAlarma/'?>"><?php echo $this->lang->line('tipo').' de '.$this->lang->line('alarma'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Diccionarios/Diccionarios/'?>"><?php echo $this->lang->line('diccionarios'); ?></a></li>
						<li><a href="<?php echo base_url().'index.php/Mssql/Sincronizacion/'?>"><?php echo $this->lang->line('sincronizacion'); ?></a></li>
					</ul>
				</li>
			</ul>
		</section>
	</aside>
	
	<!-- CABECERA DEL CONTENIDO -->
	
	<aside class="right-side">                
		<section class="content-header">
			<h1>
				<?php 
				echo strtoupper($title);
				if(isset($subtitle)){
					echo '<small>'.$subtitle.'</small>';	
				}
				?>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->uri->segment(1);?></a></li>
				<li><a href="#"><?php echo $this->uri->segment(2);?></a></li>
			</ol>
		</section>
	
        <section class="content">