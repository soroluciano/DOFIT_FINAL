<?php
if(isset(Yii::app()->session['id_institucion'])){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
?>

<style type="text/css">
    body {
        background: url(../img/39.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: .9;
    }
</style>



<div class="modal" tabindex="-1" role="dialog" id="gimnasio" aria-labelledby="myModalLabel">
    <?php $this->renderPartial('../menu/_menuInstitucion');  ?>
    <br>
    <br>
    <br>
    <div class="container marketing">
        <div class="modal-dialog modal-lg" style="margin-top:60px;">
            <div class="modal-content" >
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../pago/index" class="btn btn-primary">Pagos</a></h2>
                            <p>Gestioná los pagos de tus alumnos</a></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../actividad/index" class="btn btn-primary">Actividades</a></h2>
                            <p>Gestioná las actividades de tu institución</p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="ModificardatosInstitucion" class="btn btn-primary">Datos Personales</a></h2>
                            <p>Modificá tus datos personales</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/3.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../institucion/SolicitudesPendientes" class="btn btn-primary">Solicitudes pendientes</a></h2>
                            <p>Adherí alumnos y profesores a tu institución</a></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../institucion/ListadoDeAlumnosxInstitucion" class="btn btn-primary">Tus alumnos</a></h2>
                            <p>Consultá los alumnos asociados a tu gimnasio</a></p>
                        </div>
                        <div class="col-lg-4">
                            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
                            <h2><a href="../ProfesorInstitucion/ListadoProfesores" class="btn btn-primary">Tus profesores</a></h2>
                            <p>Consultá los profesores asociados a tu gimnasio.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#gimnasio').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#gimnasio').modal('show');
    })
</script>