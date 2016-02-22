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

<?php  $this->renderPartial('../menu/_menuInstitucion'); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear Actividad</h4>
            </div>
            <div class="container">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array('id'=>'actividad-form'));?>
                    <div class="col-md-6">
                        <?php echo CHtml::beginForm('CrearActividad','post'); ?>
                        <br>
                        <div class="form-group">
                            <?php
                            echo $form->labelEx($deporte,'Deporte');
                            $form->labelEx($deporte,'Deporte'); ?>
                            <?php echo $form->dropDownList($actividad,'id_deporte',CHtml::listData(Deporte::model()->findAll(),'id_deporte','deporte'),array('empty'=>'Seleccione el deporte','class'=>"form-control"));?>
                        </div>
                        <div class="form-group">
                            <?php   $criteria = new CDbCriteria;
                            $criteria->condition = 'id_usuario IN (select id_usuario from profesor_institucion where id_institucion = :institucion )';
                            $criteria->params = array(':institucion' =>  Yii::app()->user->id );
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
                        <br/>
                        <input type="submit" value="Crear Actividad" class="btn btn-primary" onclick="return Crear();"/>
                        <a href="index" class="btn btn-primary">Volver</a>
                        <br>
                        <br>
                    </div>
                </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

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
    function Crear(){
        var deporte = $('#Actividad_id_deporte').val();
        var profesor = $('#Actividad_id_usuario').val();
        var valor = $('#Actividad_valor_actividad').val();
        var dia = $('input[name="dia[]"]:checked').length > 0;

        if(deporte == ""){
            $('#modal-error').html("¡Debe seleccionar al menos un deporte!");
            $('#error').modal('show');
            return false;
        }
        if(profesor == ""){
            $('#modal-error').html("¡Debe seleccionar un profesor!");
            $('#error').modal('show');
            return false;
        }
        if(valor == ""){
            $('#modal-error').html("¡Debe ingresar el precio de la actividad!");
            $('#error').modal('show');
            return false;
        }
        if(valor <= 0){
            $('#modal-error').html("¡El importe no puede ser cero o menor a cero!");
            $('#error').modal('show');
            return false;
        }
        if(dia == false){
            $('#modal-error').html("¡Debe seleccionar al menos un día de la semana!");
            $('#error').modal('show');
            return false;
        }
        return true;

    }
</script>

