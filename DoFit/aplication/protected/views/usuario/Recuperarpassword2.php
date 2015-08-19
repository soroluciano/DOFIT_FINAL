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
                   <a href='../../'> <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola!</a></li>
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
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/14.png" alt="First slide">
        </div>
    </div>
</div>
<div>

<div class="container">	
	<!-- <p class="note">Campos con <span class="required">*</span> son requeridos.</p>  -->
			<div class="row">
				<div class="col-md-6">
					<h2 class="bs-docs-featurette-title">Recuperar contraseña</h2>
	                <br>
                   <div class="form-group">
				     <div> Ingrese la contraseña que desea establecer para su cuenta</div>
					<br/>
					<?php $email = $_GET['email'];?>
					<form action="../Recuperarpassword3?email=<?php echo $email;?>" method="post">
                         <input type="password" id="pass" name="pass" class="form-control" placeholder="password"></input>  
					   <br>
					   <br>
                      <input type="submit" value="Enviar" class="btn btn-primary"></input>					
					<br/>
				  </div>
			</div>	  
</div>					
</div>
</div>