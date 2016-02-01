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
            <ul class="nav navbar-nav">
                <li>
                    <a href="../ProfesorInstitucion/ListadoProfesores">Listado de Profesores</a>
                </li>
                <li>
                    <a href="../institucion/ListadoAlumnosxInstitucion">Listado de Alumnos</a>
                </li>
                <li>
                    <a href="../actividad/CrearActividad">Crear Actividades</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Bienvenido! <?php echo $fichains->nombre; ?></a></li>
                <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
            </ul>
        </nav>
    </div>
</header>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear pago</h4>
            </div>
            <div class="container">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array('id'=>'pago-form', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                    <div class="col-md-6">
                        <br>
                        <?php echo CHtml::beginForm('InscripcionActividad','post'); ?>
                        <div class="form-group">
                            <?php   $criteria = new CDbCriteria;
                            $criteria->condition = 'id_usuario IN (select id_usuario from actividad_alumno where id_actividad IN ( select id_actividad from actividad where id_institucion = :institucion ))';
                            $criteria->params = array(':institucion' => Yii::app()->user->id  );
                            $usuario = FichaUsuario:: model()->findAll($criteria);?>
                            <?php   echo $form->labelEx($ficha_usuario,'Alumno'); ?>
                            <?php   echo $form->dropDownList($ficha_usuario,'id_usuario',CHtml::listData(FichaUsuario:: model()->findAll($criteria),'id_usuario','nombre','apellido'),
                                array('ajax'=>array('type'=>'POST',
                                    'url'=>CController::createUrl('Pago/SeleccionarActividad'),
                                    'update'=>'#'.CHtml::activeId($actividad,'id_actividad'),
                                ),'prompt'=>'Seleccione un alumno','class'=>"form-control"));?>
                            <?php   echo $form->error($ficha_usuario,'Alumno')?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($actividad,'actividad'); ?>
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
                            <?php echo $form->labelEx($pago,'Anio'); ?>
                            <?php echo $form->dropDownList($pago,'anio',array(
                                ""=>"Seleccione el año",
                                $anio-3=>$anio-3,
                                $anio-2=>$anio-2,
                                $anio-1=>$anio-1,
                                $anio  =>  $anio,
                                $anio+1=>$anio+1),array('class'=>"form-control",'name'=>'anio[]'));?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($pago,'Mes'); ?>
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
                            <?php echo $form->labelEx($actividad,'Monto Abonado'); ?>
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <?php $idinstitucion = Yii::app()->user->id;
                                ?>
                                <?php echo $form->dropDownList($actividad,'valor_actividad',CHtml::listData(Actividad::model()->findAllByAttributes(array('id_institucion'=>$idinstitucion)),'id_actividad','valor_actividad'),array('class'=>"form-control",'placeholder'=>"Monto"));?>
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
                                    <div class='modal-body'>
                                        No se ha generado el pago debido a un error.
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
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
                        <!-- Modal Correcto -->
                        <div class='modal fade' id='incorrecto' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                                    </div>
                                    <div class='modal-body'>
                                        Ingrese el importe correcto para esa actividad.
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Error -->
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
                        <?php echo CHtml::endForm(); ?>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#principal').modal('show');
        })
    </script>

    <script type="text/javascript">
        function BuscoDetalle(){
            $('#Detalle').empty();
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
                        deporte = response.split(":");
                        deporte[1] = deporte[1].replace(/\s/g, ''); // quito los espcios en Blanco del deporte
                        $('#Detalle').append("<p>"+response+"</p>");
                    }

                })
            }
        }

    </script>
    <script type="text/javascript">
        function Crear(){
            var id_usuario = $('#FichaUsuario_id_usuario').val();
            var actividad  = $('#Actividad_id_actividad').val();
            var anio  = $('#anio').val();
            var meses = $('#meses').val();
            var monto = $('#Actividad_valor_actividad').val();
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
                                    $('#error').modal('show');
                                }
                                else{
                                    if(monto == ""){
                                        $('#modal-error').html("¡Ingrese el importe!");
                                        $('#error').modal('show');
                                    }
                                }
                            }
                        }
                        else{
                            $('#modal-error').html("¡Seleccione el mes del pago!");
                            $('#error').modal('show');
                        }
                    }
                    else{
                        $('#modal-error').html("¡Seleccione el año del pago!");
                        $('#error').modal('show');
                    }
                }
                else{
                    $('#modal-error').html("¡Seleccione una actividad!");
                    $('#error').modal('show');
                }
            }
            else{
                $('#modal-error').html("¡Ingrese el usuario!");
                $('#error').modal('show');
            }
        }
    </script>
    