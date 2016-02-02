<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $usuarioins = Institucion::model()->findByPk(Yii::app()->user->id);
}
?>



<style type="text/css">
    body {
        background: url(../img/23.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../site/LoginInstitucion"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
            <a href="../" class="navbar-brand"></a>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Bienvenido! Raúl Rabuffeti</a></li>
                <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
            </ul>
        </nav>
    </div>
</header>




<input type="hidden" id="actividad" value="<?php echo $model->id_actividad; ?>">
<input type="hidden" id="usuario" value="<?php echo Yii::app()->user->id; ?>">

<div class='modal fade' id='confirmacion' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                <h4 class='modal-title' id='myModalLabel'>¡Estás a un paso de anotarte!</h4>
            </div>
            <div class='modal-body' id="modal-confirmacion">
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="Inscripcion()">Aceptar</button>
                <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="Volver()">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        actividad = $('#actividad').val();
        var data = {'actividad': actividad};
        $.ajax({
            url: '../actividad/ObtenerActividad',
            type: 'POST',
            data: data,
            dataType: "html",
            cache: false,
            success: function (response) {
                if (response != "error") {
                    $('#modal-confirmacion').html(response);
                    $('#confirmacion').modal('show');
                }
                else{
                    alert(response);
                }
            }
        })
    })
</script>

<script type="text/javascript">
    function Volver(){
        location.href='InscripcionActividad';
    }
</script>

<script type="text/javascript">
    function Inscripcion(){
        actividad = $('#actividad').val();
        usuario = $('#usuario').val();
        var data = {'actividad': actividad, 'usuario': usuario};
        $.ajax({
            url: '../actividad/Inscripcion',
            type: 'POST',
            data: data,
            dataType: "html",
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    location.href='../actividadalumno/ListadoActividades';
                }
                else{
                    alert(response);
                }
            }

        })
    }
</script>