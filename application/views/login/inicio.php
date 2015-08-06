   <!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        if($empresas)
		{
			foreach ($empresas as $row) 
			{
				echo '<title>'.$row->nombre.'</title>';
			}
		}
        ?>

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header bg-light-blue">
            	<?php
                	if($empresas)
					{
						foreach ($empresas as $row) 
						{
							echo $row->nombre;
						}
					}
                ?>
            </div>
           	<form action="<?php echo base_url()?>index.php/login/control" method="post">
           		
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username"  id="username" class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-light-blue btn-block">Login</button>  
                </div>
            </form>
            <br>
            	<?php
           		if(isset($error))
				{
					echo '<div class="alert alert-danger alert-dismissable">
                             <i class="fa fa-ban"></i>
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <b>Error!</b> Usuario y password incorrectos
                           </div>';
				}
				?>

          
        </div>

   

    </body>
