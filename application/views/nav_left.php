<?php $array_activo = moduloActivo($this->uri->segment(1));?>
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
      	
        <li class="<?php echo $array_activo['home']?>"><a href="<?php echo base_url().'index.php/Home/home'?>"><?php echo $this->lang->line('home'); ?><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>    
        
        <li class="dropdown <?php echo $array_activo['vendedores']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('vendedores'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('vendedores'); ?></a></li>
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Vendedores/vendedores_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
          </ul>
        </li>   
        
        <li class="dropdown <?php echo $array_activo['clientes']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('clientes'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('clientes'); ?></a></li>
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Clientes/clientes_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
          </ul>
        </li>
        
        <li class="dropdown <?php echo $array_activo['pedidos']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('pedidos'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('pedidos'); ?></a></li>
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Pedidos/pedidos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
          </ul>
        </li> 
        
        <li class="dropdown <?php echo $array_activo['presupuestos']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('presupuestos'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('presupuestos'); ?></a></li>
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Presupuestos/presupuestos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>
          </ul>
        </li> 
        
        <li class="dropdown <?php echo $array_activo['productos']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('productos'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('productos'); ?></a></li>
            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab1/add'?>"><?php echo $this->lang->line('nuevo'); ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Productos/reglas/'?>"><?php echo $this->lang->line('reglas_descuento'); ?></a></li>
          	<li class="divider"></li>
            <li><a href="<?php echo base_url().'index.php/Productos/productos_abm/tab2'?>"><?php echo $this->lang->line('busqueda_avanzada'); ?></a></li>   
          </ul>
        </li> 
        
        <li class="dropdown <?php echo $array_activo['visitas']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('visitas'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-shopping-cart"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Visitas/visitas_abm/tab1'?>"><?php echo $this->lang->line('listado_de').' '.$this->lang->line('visitas'); ?></a></li>
          </ul>
        </li>
        
        <li class="dropdown <?php echo $array_activo['administracion']?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('administracion'); ?> <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="<?php echo base_url().'index.php/Grupos/adminClientes/tab1'?>"><?php echo $this->lang->line('grupos'); ?></a></li>
          </ul>
        </li>
              
        </ul>
    </div>
  </div>
</nav>



