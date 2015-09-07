<script>
function redirectAlarm($alarma){
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/alarmas/buscarAlarma', 
		data: { 'alarma' 	: $alarma, 
	 			}, 
	 	success: function(resp) { 
			window.location.assign(resp);
		},	
	});
}
</script>


<?php 	
	$mensajes 		= 0;
	$cont_alarmas 	= 0;
	$cont_mensajes 	= 0;
	
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
	
	if($alarmas_mensajes){
    	foreach($alarmas_mensajes as $alarmas){
			$cont_alarmas++;
		}
	}
	
	if($mensajeria){
		foreach($mensajeria as $mensajeria){
			if($mensajeria->visto == 0)
				$cont_mensajes++;
		}
	}
	
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
                <div class="navbar-right" id="div-mensajeria">
                    <ul class="nav navbar-nav">
                        <!-- ALARMAS -->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <?php if($cont_alarmas > 0){ ?>
                                <span class="label label-success"><?php echo $cont_alarmas?></span>
                            	<?php } ?>
                            </a>
                            <?php if($cont_alarmas > 0){ ?>
                            <ul class="dropdown-menu">
                            	<li class="header"><?php echo $cont_alarmas.' ';?>Nuevas alarmas</li>
								<li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                    	<?php if($alarmas_mensajes) { foreach($alarmas_mensajes as $alarmas) { if($alarmas->id_origen == 2) { ?>	<!-- Admin ---->
										<li><!-- start message -->
                                            <a href="#" onclick="redirectAlarm(<?php echo $alarmas->id_alarma?>)">
                                                <div class="pull-left">
                                                    <img src="<?php echo $alarmas->Uimagen; ?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                  	<?php echo $alarmas->usuario ?>
                                                    <small><i class="fa fa-clock-o"></i><?php $date	= date_create($alarmas->date_add); echo ' '.date_format($date, 'd/m H:i:s'); ?></small>
                                                </h4>
                                                <p>
                                                <?php 
                                                	if(strlen($alarmas->mensaje) > 30)
                                                		echo substr( $alarmas->mensaje, 0 , 30).'...'; 
                                                	else
                                                		echo $alarmas->mensaje;
                                                ?>
                                                </p>
                                            </a>
                                        </li><!-- end message -->
										<?php } else { ?> <!-- Vendedor ---->
										<li><!-- start message -->
                                            <a href="#" onclick="redirectAlarm(<?php echo $alarmas->id_alarma?>)">
                                                <div class="pull-left">
                                                    <img src="<?php echo $alarmas->Vimagen; ?>" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                  	<?php echo $alarmas->nombre.' '.$alarmas->apellido; ?>
                                                    <small><i class="fa fa-clock-o"></i><?php $date	= date_create($alarmas->date_add); echo ' '.date_format($date, 'd/m H:i:s'); ?></small>
                                                </h4>
                                                <p>
                                                <?php 
                                                	if(strlen($alarmas->mensaje) > 30)
                                                		echo substr( $alarmas->mensaje, 0 , 30).'...'; 
                                                	else
                                                		echo $alarmas->mensaje;
                                                ?>
                                                </p>
                                            </a>
                                        </li><!-- end message -->
										<?php }	} } ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver todas las alarmas</a></li>
                            </ul>
                            
                            <?php } ?>
                        </li>
                        <!-- MENSAJES --->
                        <li class="dropdown messages-menu">
                            <a href="<?php echo base_url()."index.php/Mensajes/verMensajes"?>">
                                <i class="fa fa-envelope"></i>
                                <?php if($cont_mensajes > 0){ ?>
                                <span class="label label-success"><?php echo $cont_mensajes?></span>
                            	<?php } ?>
                            </a>
                        </li>
                        <!-- NUEVOS-->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-plus-square"></i>
                                <?php if($mensajes>0){?>
                                <span class="label label-success"><?php echo $mensajes ?></span>
                                <?php } ?>
                            </a>
                            <?php if($mensajes>0) { ?>	
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
                                        <?php } ?>
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