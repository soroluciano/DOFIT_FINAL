<html>
<head>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/carrousel.css" rel="stylesheet"></link>
</head>
 <?php $this->renderPartial('../menu/_menu');?>
 <br/>
 <br/>
<?php  if(isset(Yii::app()->session['id_usuario'])){ 
          $Us = Usuario::model()->findByPk(Yii::app()->user->id);?>
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2><a href="../actividad/InscripcionActividad" class="btn btn-primary">Inscribite a una actividad</a></h2>
                <p>Inscribite a las actividades que te ofrece DoFit!</p>
            </div>
            <?php if($Us->id_perfil == 1){
                echo "<div class='col-lg-4'>
                </div>";
            }?>
            <div class="col-lg-4">
                <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2><a href="../actividadalumno/ListadoActividades" class="btn btn-primary">Mis actividades</a></h2>
                <p>Consulta el estado de tus actividades por institución y pagalas con Mercado Pago. </p>
            </div>

            <?php if($Us->id_perfil == 2){ ?>
                <div class="col-lg-4">
                    <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2><a href="../ProfesorInstitucion/Adhesiongimnasio" class="btn btn-primary">Asociate a una Institución</a></h2>
                    <p>Anotate como profesor a una Institución para dictar clases.</a></p>
                </div>
                <div class="col-lg-4">
                    <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                    <h2><a href="../ProfesorInstitucion/ListadoActividades" class="btn btn-primary">Clases que dicto</a></h2>
                    <p>Consulta las actividades en las que dictas clases y el detalle de los alumnos inscriptos.</a></p>
                </div>
				<div class="col-lg-4">
                   <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                   <h2><a href="../ProfesorInstitucion/ConsultarEstadosInstituciones" class="btn btn-primary">Estado de las instituciones</a></h2>
                   <p>Consulta las instituciones a las que enviaste solicitud para asociarte.</a></p>
                </div>
            <?php } ?>
            <div class="col-lg-4">
                <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                <h2><a href="../red/" class="btn btn-primary">Red Social de DoFit.</a></h2>
                <p>Ir a la red social de DoFit!</a></p>
            </div>
            <div class="col-lg-4">
            </div>
            
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
<?php }
else
{
    $this->redirect("../");
}
?>
</body>
</html>