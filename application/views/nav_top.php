<nav class="navbar navbar-top navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a style="color:white" class="navbar-brand" href="<?php echo base_url().'index.php/Home/home/'?>">
	      	<?php 
	      	foreach ($empresas as $row) 
	      	{
			 	echo $row->nombre;
			}
	      	?>
	      </a>
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	   	  <ul class="nav navbar-nav">
	      	<li><a href="#"><?php echo $this->lang->line('novedades'); ?> <span class="badge">42</span></a></li>
	      	<li><a href="#"><?php echo $this->lang->line('documentos'); ?> <span class="badge">42</span></a></li>
	        <li><a href="#"><?php echo $this->lang->line('estadisticas'); ?> <span class="badge">42</span></a></li>
	      </ul>
	       
	      <ul class="nav navbar-nav navbar-right">  
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->lang->line('herramientas'); ?><span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#"><?php echo $this->lang->line('perfil'); ?></a></li>
	            <li><a href="#"><?php echo $this->lang->line('settings'); ?></a></li>
	            <li><a href="#"><?php echo $this->lang->line('acerca_de'); ?></a></li>
	            <li class="divider"></li>
	            <li><a href="#"><?php echo $this->lang->line('salir'); ?></a></li>
	          </ul>
	        </li>
	      </ul>
	        
	      
	      
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>
	
