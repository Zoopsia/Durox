<div class="row">
	<div class="col-md-12">
		
	</div>
</div>
		<div class="row">
			<div class="col-md-12">
							
		  			<section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $productos_cantidad?>
                                    </h3>
                                    <p>
                                       <?php echo $this->lang->line('productos'); ?>
                                    </p>
                                </div>
                                <div class="icon">
                                   <i class="fa fa-archive"></i>
                                </div>
                                <a href="<?php echo base_url()?>index.php/Productos/productos_abm/tab1" class="small-box-footer">
                                     <?php echo $this->lang->line('leer_mas'); ?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $pedidos_cantidad?>
                                    </h3>
                                    <p>
                                       <?php echo $this->lang->line('pedidos'); ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="<?php echo base_url()?>index.php/Pedidos/pedidos_abm/tab1"  class="small-box-footer">
                                    <?php echo $this->lang->line('leer_mas'); ?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $clientes_cantidad?>
                                    </h3>
                                    <p>
                                        <?php echo $this->lang->line('clientes'); ?>
                                    </p>
                                </div>
                                <div class="icon">
                                   	<i class="fa fa-user"></i>
                                </div>
                                <a href="<?php echo base_url()?>index.php/Clientes/clientes_abm/tab1"  class="small-box-footer">
                                    <?php echo $this->lang->line('leer_mas'); ?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $visitas_cantidad?>
                                    </h3>
                                    <p>
                                        <?php echo $this->lang->line('visitas'); ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-car"></i>
                                </div>
                                <a href="<?php echo base_url()?>index.php/Visitas/visitas_abm/tab1" class="small-box-footer">
                                    <?php echo $this->lang->line('leer_mas'); ?> <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <!--
                                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        -->
                                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title"> <?php echo $this->lang->line('pedidos'); ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- bar chart -->
                                            <div class="chart" id="bar-chart" style="height: 250px;"></div>
                                        </div>
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" >
                                            <input type="text" class="knob" data-readonly="true" value="70" data-width="60" data-height="60" data-fgColor="#3c8dbc"/>
                                            <div class="knob-label"><?php echo $this->lang->line('enviado'); ?></div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center" >
                                            <input type="text" class="knob" data-readonly="true" value="25" data-width="60" data-height="60" data-fgColor="#00a65a"/>
                                            <div class="knob-label"><?php echo $this->lang->line('en_proceso'); ?></div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="5" data-width="60" data-height="60" data-fgColor="#f56954"/>
                                            <div class="knob-label"><?php echo $this->lang->line('imposible_enviar'); ?></div>
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->        
                            
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab"><?php echo $this->lang->line('area'); ?></a></li>
                                    <li><a href="#sales-chart" data-toggle="tab"><?php echo $this->lang->line('torta'); ?></a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> <?php echo $this->lang->line('visitas'); ?></li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
                                                
                            <!-- Calendar -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">Calendario</div>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                       
                       
                        <section class="col-lg-6 connectedSortable">
                                                       <!-- Chat box -->
                           

                             <!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header">
                                	<i class="fa fa-envelope"></i>
                                    <h3 class="box-title"><?php echo $this->lang->line('mensajes'); ?></h3>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <?php if($recibidos) { foreach($recibidos as $recibidos) { ?>
                                    <?php $date	= date_create($recibidos->date_add); ?>
                                    <div class="item">
                                        <img src="<?php echo $recibidos->imagen ?>" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i><?php echo date_format($date, 'd/m H:i')?></small>
                                              	 <?php echo $recibidos->nombre.' '.$recibidos->apellido; ?>
                                            </a>
                                            <?php echo $recibidos->mensaje ?>
                                            
                                        </p>
                                    </div><!-- /.item -->
                                    <?php } } ?>
                                </div><!-- /.chat -->
                            </div><!-- /.box (chat box) -->


                     <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title"><?php echo $this->lang->line('mensaje').' '.$this->lang->line('nuevo'); ?></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form id="mensajeria" action="<?php echo base_url()."index.php/Mensajes/nuevoMensaje" ?>" method="post">
                                        <div class="form-group">
                                        	<select name="para[]" class="form-control chosen-select" multiple  data-placeholder="Enviar a: " required>
                                        		<?php
                                        		if($vendedores){
                                        			foreach($vendedores as $vendedor){
                                        				echo '<option value="'.$vendedor->id_vendedor.'">'.$vendedor->nombre.' '.$vendedor->apellido.'</option>';
                                        			}
                                        		}
												?>
                                        		<option value="0">Todos</option>
                                        	</select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="asunto" placeholder="Asunto "/ required>
                                        </div>
                                        <div>
                                            <textarea class="textarea" name="mensaje" placeholder="Mensaje" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button type="submit" form="mensajeria" class="pull-right btn btn-default" id="sendEmail">Crear <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
                              </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
		  		
			</div><!--contenedor-->
		</div>    
		
<!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url()?>libraries/plantilla/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        
        
        
          <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url()?>libraries/plantilla/js/AdminLTE/dashboard.js" type="text/javascript"></script>        


