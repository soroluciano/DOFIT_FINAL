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
        background: url(../img/25.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php  $this->renderPartial('../menu/_menuInstitucion'); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar Actividad</h4>
            </div>
            <div class="container">
                <div class="form">
                    <div class="col-md-6">
                        <br>
                        <div class="form-group">
                            <?php
                            $query = "select actividad.id_actividad, concat(ficha_usuario.nombre,' ',ficha_usuario.apellido) profesor, deporte.deporte from actividad, ficha_usuario, deporte where actividad.id_usuario = ficha_usuario.id_usuario and actividad.id_deporte = deporte.id_deporte and actividad.id_institucion = ".Yii::app()->user->id;
                            $listaActividades = Yii::app()->db->createCommand($query)->queryAll();
                            $respuesta=" <select class='form-control' style='margin-top:5px;' id='actividades' name='options' onchange='MostrarActividad();'>
                                         <option id='0'>Selecciona actividad</option>";
                            foreach($listaActividades as $act ){
                                $query_horario = "select CASE id_dia WHEN 1 THEN 'Lunes' WHEN 2 THEN 'Martes' WHEN 3 THEN 'Miercoles' WHEN 4 THEN 'Jueves' WHEN 5 THEN 'Viernes' WHEN 6 THEN 'Sabado' WHEN 7 THEN 'Domingo' END dia,concat(lpad(hora,2,'0'),':',lpad(minutos,2,'0'))horario from actividad_horario where id_actividad = ".$act['id_actividad'];
                                $horario = Yii::app()->db->createCommand($query_horario)->queryAll();
                                $hora = "";
                                foreach($horario as $h) {
                                    $hora = $hora . ' - '.$h['dia'].' - '.$h['horario'];
                                }
                                $respuesta.="<option id='".$act['id_actividad']."'><a href='#'>".$act['profesor']." - ".$act['deporte'].$hora."</a></option>";
                            }
                            $respuesta.="</select>";
                            echo $respuesta;
                            ?>
                            <br>
                            <?php $form=$this->beginWidget('CActiveForm', array('id'=>'actividad-form'));?>
                            <div class="form-group">
                                <?php
                                echo $form->labelEx($deporte,'Deporte');
                                $form->labelEx($deporte,'Deporte'); ?>
                                <?php echo $form->dropDownList($actividad,'id_deporte',CHtml::listData(Deporte::model()->findAll(),'id_deporte','deporte'),array('empty'=>'Seleccione el deporte','class'=>"form-control"));?>
                            </div>
                            <div class="form-group">
                                <?php   $criteria = new CDbCriteria;
                                $criteria->condition = 'id_usuario IN (select id_usuario from actividad where id_actividad IN ( select id_actividad from actividad where id_institucion = :institucion ))';
                                $criteria->params = array(':institucion' => Yii::app()->user->id  );
                                $usuario = FichaUsuario:: model()->findAll($criteria);?>
                                <?php   echo $form->labelEx($ficha_usuario,'Profesor'); ?>
                                <?php   echo $form->dropDownList($actividad,'id_usuario',CHtml::listData(FichaUsuario:: model()->findAll($criteria),'id_usuario','nombre','apellido'),array('prompt'=>'Seleccione el profesor','class'=>"form-control"));?>
                            </div>
                            <div class="form-group">
                                <?php   echo $form->labelEx($actividad,'Precio'); ?>
                                <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <?php echo $form->textField($actividad,'valor_actividad',array('class'=>"form-control",'placeholder'=>"Precio"));?>
                                    <div class="input-group-addon">.00</div>
                                </div>
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <strong>Día</strong>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <strong>Hora</strong>
                                </div>
                                <div class="col-md-3">
                                    <strong>Minutos</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Lunes
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>1,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]' )); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Martes
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>2,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Miercoles
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>3,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Jueves
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>4,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Viernes
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>5,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Sábado
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>6,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    Domingo
                                </div>
                                <div class="col-md-2">
                                    <?php echo $form->checkBox($actividad_horario,'id_dia',array('value'=>7,'uncheckValue'=>null,'class'=>'form-control','name'=>'dia[]')); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'hora',array("00"=>"00",
                                        "01"=>"01",
                                        "02"=>"02",
                                        "03"=>"03",
                                        "04"=>"04",
                                        "05"=>"05",
                                        "06"=>"06",
                                        "07"=>"07",
                                        "08"=>"08",
                                        "09"=>"09",
                                        "10"=>"10",
                                        "11"=>"11",
                                        "12"=>"12",
                                        "13"=>"13",
                                        "14"=>"14",
                                        "15"=>"15",
                                        "16"=>"16",
                                        "17"=>"17",
                                        "18"=>"18",
                                        "19"=>"19",
                                        "20"=>"20",
                                        "21"=>"21",
                                        "22"=>"22",
                                        "23"=>"23",
                                        "24"=>"24"),
                                        array('class'=>"form-control",'name'=>'hora[]'));?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($actividad_horario,'minutos',array("00"=>"00",
                                        "15"=>"15",
                                        "30"=>"30",
                                        "45"=>"45"),
                                        array('class'=>"form-control",'name'=>'minutos[]'));?>
                                </div>
                            </div>
                            <a href="index" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php echo CHtml::endForm(); ?>

<div class='modal fade' id='error' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Oops!</h4>
            </div>
            <div class='modal-body' id="modal-error">
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal OK -->
<div class='modal fade' id='Ok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Felicidades</h4>
            </div>
            <div class='modal-body'>
                ¡Has eliminado la actividad correctamente!
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error -->
<div class='modal fade' id='Error' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
            </div>
            <div class='modal-body'>
                No se ha podido eliminar la actividad :(
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
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

<script type="text/javascript">
    function MostrarActividad(){
        var actividad = $('#actividades option:selected').attr("id");
        if(actividad != 0){
            var data = {'actividad': actividad};
            $.ajax({
                url: '../actividad/Eliminar',
                type: 'POST',
                data: data,
                dataType: "html",
                cache: false,
                success: function (response) {
                    if (response == "ok") {



                    }
                    else {
                        $('#Error').modal('show');
                    }
                }})}
        else{
            $('#modal-error').html("¡Debe seleccionar al menos una actividad!");
            $('#error').modal('show');
        }
    }
</script>

<script type="text/javascript">
    function Eliminar(){
        var actividad = $('#actividades option:selected').attr("id");
        if(actividad != 0){
            var data = {'actividad': actividad};
            $.ajax({
                url: '../actividad/Eliminar',
                type: 'POST',
                data: data,
                dataType: "html",
                cache: false,
                success: function (response) {
                    if (response == "ok") {
                        $("#actividades").find('option:selected').removeAttr("selected");
                        $('#Ok').modal('show');

                    }
                    else {
                        $('#Error').modal('show');
                    }
                }})}
        else{
            $('#modal-error').html("¡Debe seleccionar al menos una actividad!");
            $('#error').modal('show');
        }
    }
</script>