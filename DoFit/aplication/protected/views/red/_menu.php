<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../site/login"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
            <a href="../" class="navbar-brand"></a>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <!-- <li><a href="javascript:onclick="getMensajesFromBase();" alt="mensajes"><span class="glyphicon glyphicon-envelope"></span><span class="alerta_new"><?php //echo "1";?></span></a></li>-->
                <li><a onclick="getMensajesFromBase();resetAlertas();" style="cursor:pointer;" alt="notificaciones"><span class="glyphicon glyphicon-globe"></span><span class="alerta_new" id="notificacion"></span></a></li>
                <li><a href="">Bienvenidoe!</a></li>
                <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
            </ul>
        </nav>
    </div>
</header>
<br>
<br>
<br>
<br>
<br>

<br>