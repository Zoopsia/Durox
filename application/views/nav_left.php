<?php
if ($this->uri->segment(1) === 'Clientes')
{
    $cliente 	= 'active';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= '';
	$presupuesto= '';
}
else if ($this->uri->segment(1) === 'Home')
{
    $cliente 	= '';
	$home 		= 'active';
	$vendedor 	= '';
	$pedidos	= '';
	$presupuesto= '';
}
else if ($this->uri->segment(1) === 'Vendedores')
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= 'active';
	$pedidos	= '';
	$presupuesto= '';
}
else if ($this->uri->segment(1) === 'Pedidos')
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= 'active';
	$presupuesto= '';
}
else if ($this->uri->segment(1) === 'Presupuestos')
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= '';
	$presupuesto= 'active';
}
else
{
    $cliente 	= '';
	$home 		= '';
	$vendedor 	= '';
	$pedidos	= '';
	$presupuesto= '';
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
        
        <li class="dropdown <?php echo $vendedor?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendedores <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1'?>">Listado de vendedores</a></li>
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'?>">Nuevo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab2'?>">Busqueda Avanzada</a></li>
          </ul>
        </li>   
        
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
        
        <li class="dropdown <?php echo $presupuesto?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Presupuestos <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab1'?>">Listado de pedidos</a></li>
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab1/add'?>">Nuevo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab2'?>">Busqueda Avanzada</a></li>
          </ul>
        </li> 
        
              
        </ul>
    </div>
  </div>
</nav>



