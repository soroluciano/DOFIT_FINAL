<?php  $this->renderPartial('../menu/_menuInstitucion');?>

<style type="text/css">
    body {
        background: url(../img/37.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<br>
<br>
<br>
<br>
<br>
<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="modal-dialog modal-lg" style="margin-top:140px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../actividad/CrearActividad" class="btn btn-primary">Crear Actividad</a></h2>
                        <p>Generá nuevas actividades</a></p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../actividad/EliminarActividades" class="btn btn-primary">Eliminar Actividad</a></h2>
                        <p>Eliminá las actividades</p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                        <h2><a href="../actividad/ModificarActividades" class="btn btn-primary">Modificar Actividades</a></h2>
                        <p>Modificá las actividades creadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#principal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#principal').modal('show');
    })
</script>