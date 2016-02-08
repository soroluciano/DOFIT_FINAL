<?php  $this->renderPartial('../menu/_menuInstitucion');?>
<br>
<br>
<br>
<br>
<br>
<div class="container marketing">
    <!-- Three columns of text below the carousel -->
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
