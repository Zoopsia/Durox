
<nav class="navbar navbar-default navbar-top navbar-inverse">
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
	      	<li><a href="#">Novedades <span class="badge">42</span></a></li>
	      	<li><a href="#">Documentos <span class="badge">42</span></a></li>
	        <li><a href="#">Estadísticas <span class="badge">42</span></a></li>
	      </ul>
	       
	      <ul class="nav navbar-nav navbar-right">  
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Herramientas<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Perfil</a></li>
	            <li><a href="#">Settings</a></li>
	            <li><a href="#">Acerca de</a></li>
	            <li class="divider"></li>
	            <li><a href="#">Salir</a></li>
	          </ul>
	        </li>
	      </ul>
	        
	      
	      
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>
	
