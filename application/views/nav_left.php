<?php
if ($this->uri->segment(1) === 'Clientes')
{
    $cliente 	= 'active';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= '';
}
else if ($this->uri->segment(1) === 'Home')
{
    $cliente 	= '';
	$home 		= 'active';
	$vendedor 	= '';
	$pedidos	= '';
}
else if ($this->uri->segment(1) === 'Vendedores')
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= 'active';
	$pedidos	= '';
}
else if ($this->uri->segment(1) === 'Pedidos')
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= 'active';
}
else
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= '';
}

?>
<nav id="nav" class="navbar navbar-default sidebar" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	
        <li class="<?php echo $home?>"><a href="<?php echo base_url().'index.php/Home/home'?>">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>    
        <li class="<?php echo $vendedor?>"><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm'?>">Vendedores<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>    
       
        <li class="dropdown <?php echo $pedidos?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1'?>">Listado de pedidos</a></li>
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1/add'?>">Nuevo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab2'?>">Busqueda Avanzada</a></li>
          </ul>
        </li> 
        
        <li class="dropdown <?php echo $cliente?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1'?>">Listado de clientes</a></li>
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'?>">Nuevo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab2'?>">Busqueda Avanzada</a></li>
          </ul>
        </li>   
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedidos <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="#">Crear</a></li>
            <li><a href="#">Modificar</a></li>
            <li><a href="#">Reportar</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">Informes</a></li>
          </ul>
        </li>   
        <li ><a href="#">Visitas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>        
        <li ><a href="#">Seguridad<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
       	<li ><a href="#">Herramientas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
 		<li ><a href="#">Papelera<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
 		<li ><a href="#">Calendario<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
      </ul>
    </div>
  </div>
</nav>



