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
        background: url(../img/22.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<div class="modal fade" tabindex="-1" role="dialog" id="principal" aria-labelledby="myModalLabel">
    <?php $this->renderPartial('../menu/_menuInstitucion'); ?>
    <br>
    <br>
    <br>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Consultar pagos</h4>
            </div>
            <div class="container">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array('id'=>'pago-form', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                    <div class="col-md-6">
                        <br>
                        <?php echo CHtml::beginForm('InscripcionActividad','post'); ?>
                        <div class="form-group">
                            <?php
                            $criteria = new CDbCriteria;
                            $criteria->condition = 'id_usuario IN (select id_usuario from actividad_alumno where id_actividad IN ( select id_actividad from actividad where id_institucion = :institucion ))';
                            $criteria->params = array(':institucion' => Yii::app()->user->id );
                            $usuario = FichaUsuario:: model()->findAll($criteria);?>
                            <?php   echo $form->labelEx($ficha_usuario,'Alumno'); ?>
                            <?php   echo $form->dropDownList($ficha_usuario,'id_usuario',CHtml::listData(FichaUsuario:: model()->findAll($criteria),'id_usuario','nombre','apellido'),
                                array('ajax'=>array('type'=>'POST',
                                    'url'=>CController::createUrl('Pago/SeleccionarAño'),
                                    'update'=>'#'.CHtml::activeId($pago,'anio'),
                                ),'prompt'=>'Seleccione un alumno','class'=>"form-control",
                                    "onchange"=>"lista_pagos();"));?>
                            <?php   echo $form->error($ficha_usuario,'Alumno')?>
                        </div>
                        <div class="form-group">
                            <?php   echo $form->labelEx($pago,'Anio'); ?>
                            <?php   echo $form->dropDownList($pago,'anio',CHtml::listData(Pago:: model()->findAll(),'anio','anio'),
                                array('ajax'=>array('type'=>'POST',
                                    'url'=>CController::createUrl('Pago/SeleccionarMes'),
                                    'update'=>'#'.CHtml::activeId($pago,'mes'),
                                ),'prompt'=>'Seleccione el año','class'=>"form-control",
                                    "onchange"=>"lista_pagos();"));?>
                            <?php   echo $form->error($pago,'anio')?>
                        </div>
                        <div class="form-group">
                            <?php   echo $form->labelEx($pago,'mes'); ?>
                            <?php   echo $form->dropDownList($pago,'mes',array(''=>'Seleccione el mes'),array("class"=>"form-control",'prompt'=>'Seleccione el mes',"onchange"=>"lista_pagos();"));?>
                            <?php   echo $form->error($pago,'mes')?>
                        </div>
                        <a href="index" class="btn btn-primary">Volver</a>
                        <br>
                        <br>
                        <div id="lista">
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
                                        ¡Has eliminado el pago!
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
                                        No se ha eliminado el pago debido a un error.
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
    function lista_pagos(){
        var usuario = $('#FichaUsuario_id_usuario').val();
        var anio    = $('#Pago_anio').val();
        var mes     = $('#Pago_mes').val();
        $('#lista').html("");
        if(usuario != ""){
            if(anio != "") {
                if (mes!= "") {
                    var data = {'usuario': usuario, 'anio': anio, 'mes': mes};
                    $.ajax({
                        url: '../pago/ListarPagos',
                        type: 'POST',
                        data: data,
                        dataType: "json",
                        cache: false,
                        success: function (response) {
                            var html = "<table class='table table-bordered'><thead><tr><th>Actividad</th><th>Año</th><th>Mes</th><th>Monto</th></thead><tbody>";
                            for (i = 0; i < response.length; i++) {
                                html += "<tr><td>" + response[i].actividad + "</td><td>" + response[i].anio + "</td><td>" + response[i].mes + "</td><td>" + response[i].monto + "</td><td><button  onclick='ver_factura(this.value);' class='btn btn-primary' id='boton' value='" + response[i].id + "'>Ver factura </button></td><tr>";
                            }
                            html += "</tbody></table>";
                            $('#lista').html(html);
                        }, error: function (e) {
                            console.log(e);
                        }
                    });
                }
            }
        }
    }
</script>

<script type="text/javascript">
    function eliminar_pago(value) {
        var id = value;
        var usuario = $('#FichaUsuario_id_usuario').val();
        var anio = $('#Pago_anio').val();
        var mes = $('#Pago_mes').val();
        if (id != "") {
            if(usuario != ""){
                if(anio != ""){
                    if(mes != "") {
                        var data = {'id': id, 'usuario': usuario, 'anio': anio, 'mes': mes};
                        $.ajax({
                            url: '../pago/Eliminar',
                            type: 'POST',
                            data: data,
                            dataType: "html",
                            cache: false,
                            success: function (response) {
                                if (response == "ok") {
                                    $('#Ok').modal('show');
                                }
                                else {
                                    $('#Error').modal('show');
                                }
                            }
                        })
                    }
                }
            }
        }
    }
</script>

<script type="text/javascript">
    function ver_factura(value) {
        var id = value;
        var usuario = $('#FichaUsuario_id_usuario').val();
        var anio = $('#Pago_anio').val();
        var mes = $('#Pago_mes').val();
        if (id != "") {
            if(usuario != ""){
                if(anio != ""){
                    if(mes != "") {
                        window.open("../pago/factura?idusuario="+usuario+"&idactividad="+id+"&anio="+anio+"&mes="+mes,'','width=1000, height=1000');
                    }
                }
            }
        }
    }
</script>
