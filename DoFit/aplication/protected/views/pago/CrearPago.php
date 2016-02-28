<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
?>


<style type="text/css">
    body {
        background: url(../img/20.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: .9;
    }
</style>

<!-- Modal Error -->
<div class='modal fade' id='ErrorModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <?php $this->renderPartial('../menu/_menuInstitucion');?>
    <br>
    <br>
    <br>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>¡Lo sentimos!</h4>
            </div>
            <div class='modal-body' id='ErrorModalTexto'>

            </div>
            <div class='modal-footer'>
                <a href="index" class='btn btn-primary'>Cerrar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <?php $this->renderPartial('../menu/_menuInstitucion');?>
    <br>
    <br>
    <br>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Crear pago</b></h4>
            </div>
            <div class="container">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array('id'=>'pago-form', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                    <div class="col-md-6">
                        <br>
                        <?php echo CHtml::beginForm('InscripcionActividad','post'); ?>
                        <div class="form-group">
                            <?php   $criteria = new CDbCriteria;
                            $criteria->condition = 'id_usuario IN (select id_usuario from actividad_alumno where id_actividad IN (select id_actividad from actividad where id_institucion = :institucion ))';
                            $criteria->params = array(':institucion' => Yii::app()->user->id  );
                            $usuario = FichaUsuario:: model()->findAll($criteria);?>
                            <p><b>Alumno</b></p>
                            <?php   echo $form->dropDownList($ficha_usuario,'id_usuario',CHtml::listData(FichaUsuario:: model()->findAll($criteria),'id_usuario','nombre','apellido'),
                                array('ajax'=>array('type'=>'POST',
                                    'url'=>CController::createUrl('Pago/SeleccionarActividad'),
                                    'update'=>'#'.CHtml::activeId($actividad,'id_actividad'),
                                ),'prompt'=>'Seleccione un alumno','class'=>"form-control"));?>
                            <?php   echo $form->error($ficha_usuario,'Alumno')?>
                        </div>
                        <div class="form-group">
                            <p><b>Actividad</b></p>
                            <div>
                                <?php echo $form->dropDownList($actividad,'id_actividad',
                                    array(''=>"Selecciona actividad"),
                                    array('class'=>"form-control","onchange"=>"BuscoDetalle();")); ?>

                                <?php echo $form->error($actividad,'id_actividad'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="Detalle">
                        </div>
                        <div class="form-group">
                            <?php $anio = date("Y"); ?>
                            <p><b>Año</b></p>
                            <?php echo $form->dropDownList($pago,'anio',array(
                                ""=>"Seleccione el año",
                                $anio-3=>$anio-3,
                                $anio-2=>$anio-2,
                                $anio-1=>$anio-1,
                                $anio  =>  $anio,
                                $anio+1=>$anio+1),array('class'=>"form-control",'name'=>'anio[]'));?>
                        </div>
                        <div class="form-group">
                            <p><b>Mes</b></p>
                            <?php echo $form->dropDownList($pago,'anio',array(
                                ""=>"Seleccione el mes",
                                "1"=>"Enero",
                                "2"=>"Febrero",
                                "3"=>"Marzo",
                                "4"=>"Abril",
                                "5"=>"Mayo",
                                "6"=>"Junio",
                                "7"=>"Julio",
                                "8"=>"Agosto",
                                "9"=>"Septiembre",
                                "10"=>"Octubre",
                                "11"=>"Noviembre",
                                "12"=>"Diciembre",),array('class'=>"form-control",'name'=>'meses[]'));?>
                        </div>
                        <div class="form-group">
                            <p><b>Precio de la actividad</b></p>
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="monto"><b>$
                                    <p style="display:inline;" id="valoractividad"></p></b>
                            </div>
                            <br>
                            <?php echo $form->error($actividad,'valor_actividad')?>
                        </div>
                        <button type="button" name="button" class="btn btn-primary" onclick="Crear();">Crear</button>
                        <a href="index" class="btn btn-primary">Volver</a>
                        <br>
                        <br>
                        <!-- Modal OK -->
                        <div class='modal fade' id='Ok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h4 class='modal-title' id='myModalLabel'>Felicidades</h4>
                                    </div>
                                    <div class='modal-body'>
                                        ¡Has generado el pago!
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
                                    <div class='modal-body' id='modal-error'>
                                        No se ha generado el pago debido a un error.
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-primary' onclick="Cerrar();">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Duplicado -->
                        <div class='modal fade' id='Duplicado' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                                    </div>
                                    <div class='modal-body'>
                                        Pago duplicado. Verifique.
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: baseurl + '/pago/VerificarExistencia',
                type: "POST",
                dataType: "html",
                cache: false,
                success: function (response) {
                    debugger;
                    if (response == "ok") {
                        $('#principal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $('#principal').modal('show');
                    }
                    else {
                        if (response == "error_act") {
                            $('#ErrorModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#ErrorModalTexto').html("¡No existen actividades en tu institución!");
                            $('#ErrorModal').modal('show');
                        }
                        else{
                            $('#ErrorModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#ErrorModalTexto').html("¡No existen alumnos inscriptos en tus actividades!");
                            $('#ErrorModal').modal('show');
                        }

                    }
                }

            })
        })
    </script>

    <script type="text/javascript">
        function BuscoDetalle(){
            $('#Detalle').empty();
            $('#valoractividad').empty();
            var valor = $('#Actividad_id_actividad').val();
            if(valor != ""){
                var data = {'valor':valor};
                $.ajax({
                    url: baseurl + '/pago/VerificarActividad',
                    type: "POST",
                    data: data,
                    dataType: "html",
                    cache: false,
                    success: function (response) {
                        actividad = response.split("|");
                        $('#Detalle').append("<p>"+actividad[0]+"</p>");
                        //$('#valoractividad').addClass("input-group-addon");
                        $('#valoractividad').append(actividad[1]);

                    }

                })
            }
        }

    </script>

    <script type="text/javascript">
        function Cerrar(){
            $('#Error').modal('hide');
        }

    </script>

    <script type="text/javascript">
        function Crear(){
            var id_usuario = $('#FichaUsuario_id_usuario').val();
            var actividad  = $('#Actividad_id_actividad').val();
            var anio  = $('#anio').val();
            var meses = $('#meses').val();
            var monto = $('#valoractividad').text();
            if(id_usuario != ""){
                if(actividad!= ""){
                    if(anio != ""){
                        if(meses != ""){
                            if(monto != "" && monto > 0) {
                                var data = {'id_usuario': id_usuario, 'actividad': actividad, 'anio': anio, 'meses': meses, 'monto': monto};
                                $.ajax({
                                    url: baseurl + '/pago/CrearPago',
                                    type: "POST",
                                    data: data,
                                    dataType: "html",
                                    cache: false,
                                    success: function (response) {
                                        if (response == 'ok') {
                                            $('#Ok').modal('show');
                                        }

                                        else {
                                            if(response == 'error'){
                                                $('#Error').modal('show');
                                            }
                                            if(response == 'valor_incorrecto'){
                                                $('#incorrecto').modal('show');
                                            }
                                            else
                                            {
                                                $('#Duplicado').modal('show');
                                            }

                                        }
                                    }
                                })
                            }
                            else{
                                if(monto <= 0 && monto != ""){
                                    $('#modal-error').html("¡El importe no puede ser cero o menor a cero!");
                                    $('#Error').modal('show');
                                }
                                else{
                                    if(monto == ""){
                                        $('#modal-error').html("¡Ingrese el importe!");
                                        $('#Error').modal('show');
                                    }
                                }
                            }
                        }
                        else{
                            $('#modal-error').html("¡Seleccione el mes del pago!");
                            $('#Error').modal('show');
                        }
                    }
                    else{
                        $('#modal-error').html("¡Seleccione el año del pago!");
                        $('#Error').modal('show');
                    }
                }
                else{
                    $('#modal-error').html("¡Seleccione una actividad!");
                    $('#Error').modal('show');
                }
            }
            else{
                $('#modal-error').html("¡Ingrese el alumno!");
                $('#Error').modal('show');
            }
        }
    </script>
    