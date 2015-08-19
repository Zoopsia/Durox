<?php 	
	$mensajes = 0;
	if($visitas_mensajes)
		$mensajes += count($visitas_mensajes);
	if($clientes_mensajes)
		$mensajes += count($clientes_mensajes);
	if($vendedores_mensajes)
		$mensajes += count($vendedores_mensajes);
	if($productos_mensajes)
		$mensajes += count($productos_mensajes);
	if($pedidos_mensajes)
		$mensajes += count($pedidos_mensajes);
	if($presupuestos_mensajes)
		$mensajes += count($presupuestos_mensajes);
	
?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url().'index.php/Home/' ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php
                	if($empresas)
					{
						foreach ($empresas as $row) 
						{
							echo $row->nombre;
						}
					}
                ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">4 Nuevas alarmas</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Vendedor X
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Proceso finalizado</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Vendedor T
                                                    <small><i class="fa fa-clock-o"></i> 2 horas</small>
                                                </h4>
                                                <p>Producto nuevo</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Vendedor Y
                                                    <small><i class="fa fa-clock-o"></i> 2 horas</small>
                                                </h4>
                                                <p>Nuevo cliente</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Vendedor T
                                                    <small><i class="fa fa-clock-o"></i> 1 día</small>
                                                </h4>
                                                <p>Productos en mal estado</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Vendedor Y
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Controlar descuentos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver todas las alarmas</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-plus-square"></i>
                                <?php if($mensajes>0){?>
                                <span class="label label-success"><?php echo $mensajes ?></span>
                                <?php } ?>
                            </a>
                            <?php
                            if($mensajes>0){
                            ?>	
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo ' '.$mensajes.' '.$this->lang->line('registros').' '.$this->lang->line('nuevos')?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    	<?php 
                                        if($productos_mensajes){
                                        ?>
                                    	<li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_productos">
                                                <i class="fa fa-archive primary"></i><?php echo ' '.count($productos_mensajes).' '.$this->lang->line('productos').' '.$this->lang->line('nuevos');?>
                                            </a>
                                        </li>
                                        <?php 
										}
                                        if($pedidos_mensajes){
                                        ?>
                                        <li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_pedidos">
                                                <i class="fa fa-shopping-cart success"></i><?php echo ' '.count($pedidos_mensajes).' '.$this->lang->line('pedidos').' '.$this->lang->line('nuevos');?>
                                            </a>
                                        </li>
                                        <?php 
                                        }
                                        if($clientes_mensajes){
                                        ?>
                                        <li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_clientes">
                                                <i class="fa fa-user warning"></i><?php echo ' '.count($clientes_mensajes).' '.$this->lang->line('clientes').' '.$this->lang->line('nuevos');?>
                                            </a>
                                        </li>
                                		<?php
										}
										if($visitas_mensajes){
                                        ?>
                                		<li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_visitas">
                                                <i class="fa fa-car danger"></i><?php echo ' '.count($visitas_mensajes).' '.$this->lang->line('visitas').' '.$this->lang->line('nuevas');?>
                                            </a>
                                        </li>
                                        <?php 
										}
                                        if($vendedores_mensajes){
                                        ?>
                                        <li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_vendedores">
                                                <i class="fa fa-briefcase bg-purple"></i><?php echo ' '.count($vendedores_mensajes).' '.$this->lang->line('vendedores').' '.$this->lang->line('nuevos');?>
                                            </a>
                                        </li>
                                        <?php
										}
                                        if($presupuestos_mensajes){
                                        ?>
                                        <li>
                                            <a  href='#' data-toggle="modal" data-target="#modal_presupuestos">
                                                <i class="fa fa-book bg-maroon"></i><?php echo ' '.count($presupuestos_mensajes).' '.$this->lang->line('presupuestos').' '.$this->lang->line('nuevos');?>
                                            </a>
                                        </li>
                                        <?php 
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver todos</a></li>
                            </ul>
                            <?php
                            }
							?>
                        </li>
                       
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>
								<?php echo $session_data['usuario'] ?>
								<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url()?>libraries/plantilla/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $session_data['usuario'] ?>
                                        <small>Administrador</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url()?>index.php/login/logout" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>