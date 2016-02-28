<html>
<head>
</head>
<style type="text/css">
    body {
        background: url(../img/30.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<body>
<?php $this->renderPartial('../menu/_menuInstitucion'); ?>
<div class="container marketing">
    <div class="modal-dialog modal-lg" style="margin-top:90px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><?php echo "Modificar datos de&nbsp" . $ficha_institucion->nombre; ?></b></h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form">
                        <?php $form=$this->beginWidget('CActiveForm', array('id'=>'InstitucionForm', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                        <div class="col-md-8">
                            <div class="form-group">
                                <?php echo $form->hiddenField($model,'password',array('type'=>"hidden",'class'=>"form-control",'placeholder'=>"Password"));?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->hiddenField($model,'email',array('type'=>"hidden",'class'=>"form-control",'placeholder'=>"Email"));?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'nombre'); ?>
                                <?php echo $form->textField($ficha_institucion,'nombre',array('size'=>200,'maxlength'=>200,'class'=>"form-control",'placeholder'=>"Gimnasio")); ?>
                                <?php echo $form->error($ficha_institucion,'nombre',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'cuit'); ?>
                                <?php echo $form->textField($ficha_institucion,'cuit',array('size'=>11,'maxlength'=>11,'class'=>"form-control",'placeholder'=>"Cuit")); ?>
                                <?php echo $form->error($ficha_institucion,'cuit',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'telfijo'); ?>
                                <?php echo $form->textField($ficha_institucion,'telfijo',array('class'=>"form-control",'placeholder'=>"Telefono")); ?>
                                <?php echo $form->error($ficha_institucion,'telfijo',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'celular'); ?>
                                <?php echo $form->textField($ficha_institucion,'celular',array('class'=>"form-control",'placeholder'=>"Celular")); ?>
                                <?php echo $form->error($ficha_institucion,'celular',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'direccion'); ?>
                                <?php echo $form->textField($ficha_institucion,'direccion',array('class'=>"form-control",'placeholder'=>"Dirección")); ?>
                                <?php echo $form->error($ficha_institucion,'direccion',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'piso'); ?>
                                <?php echo $form->textField($ficha_institucion,'piso',array('class'=>"form-control",'placeholder'=>"Piso")); ?>
                                <?php echo $form->error($ficha_institucion,'piso',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'depto'); ?>
                                <?php echo $form->textField($ficha_institucion,'depto',array('class'=>"form-control",'placeholder'=>"Departamento")); ?>
                                <?php echo $form->error($ficha_institucion,'depto',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'coordenada_x'); ?>
                                <?php echo $form->textField($ficha_institucion,'coordenada_x',array('class'=>"form-control",'placeholder'=>"Coordenada x")); ?>
                                <?php echo $form->error($ficha_institucion,'coordenada_x',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'coordenada_y'); ?>
                                <?php echo $form->textField($ficha_institucion,'coordenada_y',array('class'=>"form-control",'placeholder'=>"Coordenada y")); ?>
                                <?php echo $form->error($ficha_institucion,'coordenada_y',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($ficha_institucion,'Acepta MP'); ?>
                                <?php echo $form->dropDownList($ficha_institucion,'acepta_mp',array('empty'=>'Seleccione si Acepta MP','S'=>'Sí','N'=>'No'),array('class'=>"form-control",'id'=>'acepta_mp')); ?>
                                <?php echo $form->error($ficha_institucion,'acepta_mp',array('class'=>'error_pw'));?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($localidad,'Provincia'); ?>
                                <?php echo $form->dropDownList($localidad,'id_provincia',CHtml::listData(Provincia::model()->findAll(),'id_provincia','provincia'),
                                    array('ajax'=>array('type'=>'POST',
                                        'url'=>CController::createUrl('Usuario/SeleccionarLocalidad'),
                                        'update'=>'#'.CHtml::activeId($localidad,'id_localidad'),
                                    ),'prompt'=>'Seleccione una Provincia','class'=>"form-control"));?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($localidad,'Localidad'); ?>
                                <?php echo $form->dropDownList($localidad,'id_localidad',array('empty'=>"Selecciona tu localidad"),array('class'=>"form-control")); ?>
                                <?php echo $form->error($localidad,'id_localidad',array('class'=>'error_pw')); ?>
                            </div>
                            <div class="form-group">
                                <br>
                                <?php echo CHtml::submitButton('Modificar',array('class'=>'btn btn-primary')); ?>
                                <a href="../institucion/home" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


<div class='modal fade'  id='modexito' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Modificar datos</h4>
            </div>
            <div class='modal-body'>
                Se actualizaron los datos de correctamente.
            </div>
            <div class='modal-footer'>
                <input type='button' value='Cerrar' id='cerrarmodexito' class='btn btn-primary'></input>
            </div>
        </div>
    </div>
</div>

<body>
</html>


<script type="text/javascript">
    $(document).ready(function(){
        $('#principal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#principal").modal('show');
    });
</script>

<?php
if($guardar == 1){
    ?>
    <script type="text/javascript">
        $("#modexito").modal('show');
        $("#cerrarmodexito").click(function(){
            location.href = '../institucion/home';
        });
    </script>
    <?php
}
?>