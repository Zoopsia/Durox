<?php 
$array_activo = moduloActivo($this->uri->segment(1));
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url()?>libraries/plantilla/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $session_data['usuario'] ?></p>

                            <a href="#">Administrador</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
						<li class="<?php echo $array_activo['home']?>">
                       		<a href="<?php echo base_url().'index.php/Home/'?>">
                       			<span class="glyphicon glyphicon-home"></span>
                       			<?php echo $this->lang->line('home'); ?>
                       		</a>
                       	</li> 
                       	
                       	<!-- CLIENTES -->   
				        
						<li class="treeview <?php echo $array_activo['clientes']?>">
							<a href="#" >
								<i class="fa fa-user"></i>
								<?php echo $this->lang->line('clientes'); ?>
								<i class="fa pull-right fa-angle-left"></i>
                            </a> 
                            
							<ul class="treeview-menu" style="display: none;">
					           <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('clientes'); ?></a></li>
					           <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('cliente'); ?></a></li>
					           <li class="divider"></li>
					           <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
				          	</ul>
				        </li>
                       	
                       	<!-- VENDEDORES -->   
        
						<li class="treeview <?php echo $array_activo['vendedores']?>">
							<a href="#">
								<i class="fa fa-briefcase"></i>
                               	<?php echo $this->lang->line('vendedores'); ?>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>  
				          		
							<ul class="treeview-menu" style="display: none;">
								<li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('vendedores'); ?></a></li>
								<li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('vendedor'); ?></a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
							</ul>
				        </li>   
				        
				        <!-- PEDIDOS -->   
				        
				        <li class="treeview <?php echo $array_activo['pedidos']?>">
							<a href="#">
								<i class="fa fa-shopping-cart"></i>
                               	<?php echo $this->lang->line('pedidos'); ?>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>  
							<ul class="treeview-menu" style="display: none;">
					            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('pedidos'); ?></a></li>
					        <!--<li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('pedido'); ?></a></li>-->
					            <li class="divider"></li>
					            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
				          	</ul>
				        </li> 
				        
				        <!-- PRESUPUESTOS -->   
				        
				        <li class="treeview <?php echo $array_activo['presupuestos']?>">
							<a href="#">
								<i class="fa fa-book"></i>
                               	<?php echo $this->lang->line('presupuestos'); ?>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a> 
                            <ul class="treeview-menu" style="display: none;">
					            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('presupuestos'); ?></a></li>
					            <li><a href="<?php echo base_url().'index.php/Presupuestos/carga/'?>"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('presupuesto'); ?></a></li>
					            <li class="divider"></li>
					            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
				         	</ul>
				        </li> 
				        
				       	<!-- VISITAS -->   
				        
				        <li class="treeview <?php echo $array_activo['visitas']?>">
							<a href="#">
								<i class="fa fa-car"></i>
                               	<?php echo $this->lang->line('visitas'); ?>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a> 
                            <ul class="treeview-menu" style="display: none;">
                            	<li><a href="<?php echo base_url().'index.php/Visitas/visitas_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('visitas'); ?></a></li>
				          		<li><a href="<?php echo base_url().'index.php/Visitas/carga'?>"><?php echo $this->lang->line('nueva').' '.$this->lang->line('visita'); ?></a></li>
							</ul>
				        </li>
				        
				        <!-- PRODUCTOS -->   
				        
				        <li class="treeview <?php echo $array_activo['productos']?>">
							<a href="#">
								<i class="fa fa-archive"></i>
                               	<?php echo $this->lang->line('productos'); ?>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a> 
                            <ul class="treeview-menu" style="display: none;">
					            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('productos'); ?></a></li>
					            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo').' '.$this->lang->line('producto'); ?></a></li>
					            <li class="divider"></li>
					            <!--<li><a href="<?php echo base_url().'index.php/Productos/reglas/'?>"><?php echo $this->lang->line('reglas_descuento'); ?></a></li>
					          	<li class="divider"></li>-->
					            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>   
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
				          		<li><a href="<?php echo base_url().'index.php/Tipos/tipos_abm/'?>"><?php echo $this->lang->line('tipos').' de '.$this->lang->line('perfiles'); ?></a></li>
				          		<li><a href="<?php echo base_url().'index.php/Documentos/documentos_abm/'?>"><?php echo $this->lang->line('documentos'); ?></a></li>
				          		<li><a href="<?php echo base_url().'index.php/Epocas/epocas_abm/'?>"><?php echo $this->lang->line('epocas').' '.$this->lang->line('visitas'); ?></a></li>
				          		<li><a href="<?php echo base_url().'index.php/Mails/editarMailsClientes/'?>"><?php echo $this->lang->line('editar').' '.$this->lang->line('correo'); ?></a></li>
				          	</ul>
				        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo strtoupper($title)?>
                        <small><?php echo $subtitle?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->uri->segment(1);?></a></li>
                        <li><a href="#"><?php echo $this->uri->segment(2);?></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 