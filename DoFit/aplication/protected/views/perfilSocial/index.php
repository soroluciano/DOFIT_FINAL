<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/carrousel.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/perfil.css" rel="stylesheet">
<!--<link href="<?php /*echo Yii::app()->request->baseUrl;*/ ?>/css/parsley.css" rel="stylesheet">-->


<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/perfil.js');
$cs->registerScriptFile($baseUrl.'/js/parsley.js');
$cs->registerScriptFile($baseUrl.'/js/es.js');

?>



<?php 

if(!Yii::app()->user->isGuest){
	//Es un usuario logueado.
     $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
     $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
  }
  ?>
  
</script>

  
  
  
  
<html>
<body>



 <?php 

	$nombre = $fichaUsuario->nombre;
	$apellido = $fichaUsuario->apellido;

 ?>

<?php $this->renderPartial('../menu/_menu');?>


	<div id="respuesta_ajax">
		<?php $this->renderPartial('infoNew');?>
	
	</div>

</body>

</html>
