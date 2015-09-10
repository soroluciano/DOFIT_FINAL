<html>
 <head>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/chat.css"></link>
 </head> 

<?php 
if(!Yii::app()->user->isGuest){
	//Es un usuario logueado.
     $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
     $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
 }
?>
  
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <a href='../'> <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola!  <?php echo $ficha->nombre."&nbsp".$ficha->apellido; ?></a></li>
							<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Anotarme en actividades</a></li>
                                    <li><a href="#">Ver mis actividades</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Privacidad</li>
                                    <li><a href="#">Configuración</a></li>
                                    <li><a href="#"><?php echo CHtml::link('Salir', array('site/logout')); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Carousel
================================================== -->

<div id="myCarousel" class="carousel_min slide" data-ride="carousel">
    <div class="carousel-inner_min" role="listbox">
        <div class="item active">
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/8.png" alt="First slide">
        </div>
    </div>
</div>
  <body>
    <div class="container-fluid">
	    <section  style="padding: 3%;">			
		  <div class="row" id="centrado">				
			<img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" alt="First slide"> 
			<img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/chat.jpg" alt="First slide"> 
		   </div>
            <br/>			
			<div class="row">
			    <div class="form-group">
				<?php 
				   /*
		 			    $actividadalumno = ActividadAlumno::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>Yii::app()->user->id)); // actividad que corresponde al usuario logueado								     
				        $actividaduser = $actividadalumno->id_actividad;
                        $actividad = Actividad::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$actividaduser));
				        $deporte = Deporte::model()->find('id_deporte=:id_deporte',array(':id_deporte'=>$actividad->id_deporte));
				   */ 
				 ?>
				  <label for="user"> Seleccione el usuario con el que desea chatear</label>  
					<div class="row"> 
					    <div class="col-md-9">
						    <div class="pantalla">
				           <?php			 
								   $usuariosalu = Usuario::model()->findAll('id_perfil=:id_perfil',array(':id_perfil'=>2));
                                   echo "<label for='user'>Profesores</label>";								   
							 foreach($usuariosalu as $user){
								  
						             $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$user->id_usuario));
											if($user->id_usuario != Yii::app()->user->id){									
								 ?>
						               
									   <form action="../chat/Chat" name="formu" id="formu" method="post">
						                  <input type="hidden" value="<?php echo $user->id_usuario;?>" name="idusuario"></input>
						                  <input type="hidden" value="<?php echo $ficha->nombre;?>" name="nombre"></input>
						                  <input type="hidden" value="<?php echo $ficha->apellido;?>" name="apellido"></input>										
										  <input type="submit" id="chat" value="<?php echo $ficha->nombre .' '. $ficha->apellido;?>"></input>
	                 	                </form>
						                <br/> 
	         			      <?php
									
						          }  // fin del if
						        } // llave del foreach	 
					          
							   $usuariosprof = Usuario::model()->findAll('id_perfil=:id_perfil',array(':id_perfil'=>1));
                                   echo "<label for='user'>Alumnos</label>";								   
							 foreach($usuariosprof as $user){
								  
						             $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$user->id_usuario));
											if($user->id_usuario != Yii::app()->user->id){									
								 ?>
						               
									   <form action="../chat/Chat" name="formu" id="formu" method="post">
						                  <input type="hidden" value="<?php echo $user->id_usuario;?>" name="idusuario"></input>
						                  <input type="hidden" value="<?php echo $ficha->nombre;?>" name="nombre"></input>
						                  <input type="hidden" value="<?php echo $ficha->apellido;?>" name="apellido"></input>										
										  <input type="submit" id="chat" value="<?php echo $ficha->nombre .' '. $ficha->apellido;?>"></input>
										</form>
						                <br/> 
	         			      <?php
									
						          }  // fin del if
						        } // llave del foreach	
							  ?>	
					        </div>
					    </div>	 
			        </div>
				    <br/>  					 
		        </div>    
            </div>
        </section> 			
    </div>
  </body>
</html>  
