<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="principal" aria-labelledby="myLargeModalLabel">
<?php $this->renderPartial('../menu/_menuInstitucion'); ?>
 <div class="modal-dialog modal-lg">
       <div class="modal-content">
            <div class="modal-header">
			   <h4 class="modal-title"><b><?php echo $ficha_institucion->nombre; ?></b></h4>
            </div> 			   
            <div class="modal-body">
               <div class="container">
                 <br>
                 <div class="form">
                   <?php $form=$this->beginWidget('CActiveForm', array('id'=>'InstitucionForm', 'enableAjaxValidation'=>true, 'enableClientValidation'=>false, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                   <div class="col-md-8">
                      <div class="form-group">
                         <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>"form-control",'placeholder'=>"Password"));?>
                <?php echo $form->error($model,'password',array("class"=>"error_pw")); ?>
            </div>
            <div class="form-group">
                <?php echo $form->hiddenField($model,'email',array('type'=>"hidden",'class'=>"form-control",'placeholder'=>"Email"));?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'nombre'); ?>
                <?php echo $form->textField($ficha_institucion,'nombre',array('size'=>200,'maxlength'=>200,'class'=>"form-control",'placeholder'=>"Gimnasio")); ?>
                <?php echo $form->error($ficha_institucion,'nombre'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'cuit'); ?>
                <?php echo $form->textField($ficha_institucion,'cuit',array('size'=>11,'maxlength'=>11,'class'=>"form-control",'placeholder'=>"Cuit")); ?>
                <?php echo $form->error($ficha_institucion,'cuit'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'telfijo'); ?>
                <?php echo $form->textField($ficha_institucion,'telfijo',array('class'=>"form-control",'placeholder'=>"Telefono")); ?>
                <?php echo $form->error($ficha_institucion,'telfijo'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'celular'); ?>
                <?php echo $form->textField($ficha_institucion,'celular',array('class'=>"form-control",'placeholder'=>"Celular")); ?>
                <?php echo $form->error($ficha_institucion,'celular'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'direccion'); ?>
                <?php echo $form->textField($ficha_institucion,'direccion',array('class'=>"form-control",'placeholder'=>"Dirección")); ?>
                <?php echo $form->error($ficha_institucion,'direccion'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'piso'); ?>
                <?php echo $form->textField($ficha_institucion,'piso',array('class'=>"form-control",'placeholder'=>"Piso")); ?>
                <?php echo $form->error($ficha_institucion,'piso'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($ficha_institucion,'depto'); ?>
                <?php echo $form->textField($ficha_institucion,'depto',array('class'=>"form-control",'placeholder'=>"Departamento")); ?>
                <?php echo $form->error($ficha_institucion,'depto'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($localidad,'Provincia'); ?>
                <?php echo $form->dropDownList($localidad,'id_provincia',CHtml::listData(Provincia::model()->findAll(),'id_provincia','provincia'),
                    array('ajax'=>array('type'=>'POST',
                        'url'=>CController::createUrl('Usuario/SeleccionarLocalidad'),
                        'update'=>'#'.CHtml::activeId($localidad,'id_localidad'),
                    ),'prompt'=>'Seleccione una Provincia','class'=>"form-control"));?>
                <?php echo $form->error($localidad,'id_provincia'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($localidad,'Localidad'); ?>
                <div>
                    <?php echo $form->dropDownList($localidad,'id_localidad',array('empty'=>"Selecciona tu localidad"),array('class'=>"form-control")); ?>
                </div>
                <?php echo $form->error($localidad,'id_localidad'); ?>
            </div>
            <div class="form-group">
                <br>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Registrarse': 'Modificar',array('class'=>'btn btn-primary')); ?>
            </div>
            <div class="form-group">
                <a href="../index" class="btn btn-primary">Volver</a>
            </div>
        </div>
    </form>
</div>
</div>

<?php $this->endWidget(); ?>
</div>
</div>
</div>
</div>
<script type="text/javascript">
 $("#principal").modal('show');
</script> 