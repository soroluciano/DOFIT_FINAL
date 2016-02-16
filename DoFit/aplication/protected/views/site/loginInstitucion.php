<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/coverlogingym.css" rel="stylesheet">

<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="masthead clearfix">
                <div class="inner">
                    <h2 class="masthead-brand"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></h2>
                </div>
            </div>
            <div class="inner cover">
                <h1 class="cover-heading">Acceso Instituciones</h1>
                <p class="lead"><a>
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'loginforminstitucion',
                            'enableClientValidation'=>true,
                            'clientOptions'=>array('validateOnSubmit'=>true,),)); ?>
                        <div class="form-group">
                            <?php echo $form->textField($model,'username',array('class'=>"form-control",'placeholder'=>"Email",'id'=>"inputEmail")); ?>
                        </div>
						<div class="form-group">
                            <?php echo $form->passwordField($model,'password',array('class'=>"form-control",'placeholder'=>"Password",'id'=>"inputPassword")); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->error($model,'username');?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->error($model,'password');?>
                        </div>
                        <?php echo CHtml::submitButton('Ingresar',array("class"=>"btn btn-primary ")); ?>
                        <?php $this->endWidget(); ;?>
                    </a></p>
            </div>
            <div class="mastfoot">
                <div class="inner">
                    <p>DoFit!</p>
                </div>
            </div>
        </div>
    </div>
</div>




