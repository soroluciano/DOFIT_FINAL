<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola! </a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuraci�n <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Anotarme en actividades</a></li>
                                    <li><a href="#">Ver mis actividades</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Privacidad</li>
                                    <li><a href="#">Configuraci�n</a></li>
                                    <li><a href="#"><?php echo CHtml::link('Salir', array('site/logout')); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Carousel
================================================== -->

<div id="myCarousel" class="carousel_min slide" data-ride="carousel">
    <div class="carousel-inner_min" role="listbox">
        <div class="item active">
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/8.png" alt="First slide">
        </div>
    </div>
</div>

<?php
$this->pageTitle=Yii::app()->name . ' - Subir Imagen';
$this->breadcrumbs=array(
	'Subir Imagen',
);
?>

<h1>�Como subir una Imagen con Yii?</h1>
<?php if(Yii::app()->user->hasFlash("error_imagen")){?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash("error_imagen"); ?>   
</div>
<?php }?>
<?php if(Yii::app()->user->hasFlash("noerror_imagen")){?>
<div class="flash-success">    
    <?php echo Yii::app()->user->getFlash("noerror_imagen"); ?>    
</div>
<?php }?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imagen-form',
	'enableClientValidation'=>true,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Los Campos con<span class="required">*</span> Son Boligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'foto'); ?>
		<?php echo $form->fileField($model,'foto'); ?>
		<?php echo $form->error($model,'foto'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Subir Imagen'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php if(Yii::app()->user->hasFlash("imagen")){?>
<div class="flash-success">    
    <?php echo CHtml::image(Yii::app()->request->baseUrl."".Yii::app()->user->getFlash("imagen"));?>    
</div>
<?php }?>