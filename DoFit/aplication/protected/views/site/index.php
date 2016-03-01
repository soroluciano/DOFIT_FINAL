<head>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/carrousel.css" rel="stylesheet"/>
</head>

<?php  if(isset(Yii::app()->session['id_usuario'])){ 
          $Us = Usuario::model()->findByPk(Yii::app()->user->id);
          echo "<input type='hidden' value='$Us->id_perfil' id='perfil'>";
}?>

<style type="text/css">
    body {
        background: url(../img/38.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: .9;
    }
</style>


<div class="modal fade" tabindex="-1"  id="alumno" aria-labelledby="myModalLabel">
    <?php if($Us->id_perfil == 1){ $this->renderPartial('../menu/_menu'); } ?>
    <br>
    <br>
    <br>
    <div class="container marketing">
        <div class="modal-dialog modal-lg" style="margin-top:150px;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../actividad/InscripcionActividad" class="btn btn-primary">Inscribite a una actividad</a></h2>
                            <p>Inscribite a las actividades que te ofrece DoFit!</p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../red/" class="btn btn-primary">Red Social de DoFit.</a></h2>
                            <p>Ir a la red social de DoFit!</a></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../actividadalumno/ListadoActividades" class="btn btn-primary">Mis actividades</a></h2>
                            <p>Consulta el estado de tus actividades por institución y pagalas con Mercado Pago. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="profesor" aria-labelledby="myModalLabel">
    <?php if($Us->id_perfil == 2){ $this->renderPartial('../menu/_menu'); } ?>
    <br>
    <br>
    <br>
    <div class="container marketing">
        <div class="modal-dialog modal-lg" style="margin-top:0px;" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../actividad/InscripcionActividad" class="btn btn-primary">Inscribite a una actividad</a></h2>
                            <p>Inscribite a las actividades que te ofrece DoFit!</p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../red/" class="btn btn-primary">Red Social de DoFit.</a></h2>
                            <p>Ir a la red social de DoFit!</a></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../actividadalumno/ListadoActividades" class="btn btn-primary">Mis actividades</a></h2>
                            <p>Consulta el estado de tus actividades por institución y pagalas con Mercado Pago. </p>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var id = $('#perfil').val();
        if (id == "1") {
            $('#alumno').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#alumno').modal('show');
        }
        else{
                $('#profesor').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#profesor').modal('show');
        }
    })
</script>