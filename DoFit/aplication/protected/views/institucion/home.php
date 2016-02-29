<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css"></link>
</head>
<?php
if(isset(Yii::app()->session['id_institucion'])){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
$this->renderPartial('../menu/_menuInstitucion');
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php if(isset(Yii::app()->session['id_institucion'])){ ?>
<div class="container marketing">
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4">
            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/1.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2><a href="../pago/index" class="btn btn-primary">Pagos</a></h2>
            <p>Gestioná los pagos de tus alumnos</a></p>
        </div>
        <div class="col-lg-4">
            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2><a href="../actividad/index" class="btn btn-primary">Actividades</a></h2>
            <p>Gestioná las actividades de tu institución</p>
        </div>
        <div class="col-lg-4">
            <img class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/2.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2><a href="ModificardatosInstitucion" class="btn btn-primary">Datos Personales</a></h2>
            <p>Modificá tus datos personales</p>
        </div>
    </div>
</div>
<br>
<br>
<?php } ?>