<style type="text/css">




    ol, ul {
        list-style: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    caption, th, td {
        text-align: left;
        font-weight: normal;
        vertical-align: middle;
    }

    q, blockquote {
        quotes: none;
    }
    q:before, q:after, blockquote:before, blockquote:after {
        content: "";
        content: none;
    }

    a img {
        border: none;
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
        display: block;
    }

    .hamburgerMenu span, .hamburgerMenu::before, .hamburgerMenu::after {
        display: block;
        width: 30px;
        height: 4px;
        background: #fff;
        position: absolute;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }


    .hamburgerMenu {
        height: 30px;
        width: 30px;
        margin: 20px;
        position: absolute;
        right: 0;
        z-index: 99;
    }
    .hamburgerMenu span {
        top: 13px;
        right: 0;
    }
    .hamburgerMenu::before, .hamburgerMenu::after {
        content: "";
    }
    .hamburgerMenu::before {
        top: 4px;
        margin-bottom: 4px;
    }
    .hamburgerMenu::after {
        bottom: 4px;
        margin-top: 4px;
    }
    .hamburgerMenu:hover {
        cursor: pointer;
    }
    .hamburgerMenu.open span {
        opacity: 0;
    }
    .hamburgerMenu.open::before {
        width: 38px;
        top: 50%;
        margin-left: -4px;
        margin-top: -2px;
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .hamburgerMenu.open::after {
        width: 38px;
        bottom: 50%;
        margin-left: -4px;
        margin-bottom: -2px;
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .menu {
        position: absolute;
        right: 0px;
        top: 70px;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
        width:1px;
    }
    .menu span {
        display: block;
        color: #fff;
        text-align: right;
        padding: 10px 20px;
        box-sizing: border-box;
        position: relative;
        right: -220px;
        background: rgba(100, 100, 100, 0.7);
        margin-bottom: 5px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;

    }
    .menu span:nth-of-type(1) {
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    .menu span:nth-of-type(2) {
        -moz-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }
    .menu span:nth-of-type(3) {
        -moz-transition: all 0.6s ease;
        -o-transition: all 0.6s ease;
        -webkit-transition: all 0.6s ease;
        transition: all 0.6s ease;
    }
    .menu span:hover {
        font-size: 1.5em;
        background: #646464;
        color:white;
        cursor: pointer;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    .menu.open {
        width: 200px;
    }
    .menu.open span {
        right: 0px;
    }

    .menu a:link {
        text-decoration: none;

    }
    .menu a {
        color:white;
        font-weight:bolder;

    }

    #top{
        margin-bottom: 10%;
    }


    .logo{
        float:left;
    }



</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.hamburgerMenu').click(function(){
            $(this).toggleClass('open');
            $('.menu').toggleClass('open');
        });
    });

</script>

<?php $usuario = Usuario::model()->findByPk(Yii::app()->user->id); ?>

<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <div class="hamburgerMenu"><span></span></div>
            <div class="menu">
                <a href="../site/index"><span>Home</span></a>
                <a href="../actividad/InscripcionActividad"><span>Inscribirme a Actividades</span></a>
				<a href="../actividadalumno/ListadoActividades"><span>Mis Actividades</span></a>
				<?php if($usuario->id_perfil==2){ ?>
                    <a href="../ProfesorInstitucion/Adhesiongimnasio"><span>Asociarme a una Institución</span></a>
                    <a href="../ProfesorInstitucion/ListadoActividades"><span>Clases que dicto</span></a>
					<a href="../profesorinstitucion/ConsultarEstadosInstituciones"><span>Estado Instituciones</span></a>
                <?php } ?>
				<a href="../pago/Consultarpagosalumno"><span>Mis Pagos</span></a>
                <a href="../red/"><span>Mi red</span></a>
				<?php echo "<span>".CHtml::link('Salir', array('site/logout'))."</span>"; ?>
            </div>
            <div class="logo">
                <a href="../site/login"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
                <a href="../" class="navbar-brand"></a>
                <li></li>
            </div>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="fuentemenu">
                    <?php
                    if(isset(Yii::app()->session['id_usuario'])){
                        //Es un usuario logueado.
                        $Us = Usuario::model()->findByPk(Yii::app()->user->id);
                        $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
                        echo $ficha->nombre."&nbsp".$ficha->apellido;
                    }?>
                </li>
            </ul>
        </nav>
    </div>
</header>
<br>
<br>
<br>          
            
            
            