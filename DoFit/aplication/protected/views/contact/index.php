
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/red.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/contactos.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/muro.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<?php
//archivos javascript


if(!Yii::app()->user->isGuest){
	//Es un usuario logueado.
     $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
     $perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
     $nombre = $ficha->nombre;
     $apellido = $ficha->apellido;
  }






$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/perfil.js');
$cs->registerScriptFile($baseUrl.'/js/muroprofesor.js');
$cs->registerScriptFile($baseUrl.'/js/red.js');
$cs->registerScriptFile($baseUrl.'/js/contactos.js');
$cs->registerScriptFile("http://js.pusherapp.com/1.9/pusher.min.js");


?>

<?php $this->renderPartial('../menu/_menu');?>

<div class="container marketing">

    <div class="row">
		<?php $this->renderPartial('../menu/_cabecera',array('perfil'=>$perfil,'nombre'=>$nombre,'apellido'=>$apellido)); ?>
	</div>
    
		
				<div id='content-contacts'>
		<div class="contacto-filter">
			<span class="title">Contactos</span>
			<div class="filter">
				
				<?php
				
					$this->widget('application.extensions.autocomplete.AutoComplete', array(
						'theme' => 'facebook',
						'name' => 'searchqueryid',
						//'prePopulate' => CJavaScript::encode($array),
						'sourceUrl' => Yii::app()->createUrl('red/pruebaAjax'),
						'hintText' => 'Buscar contactos',
						'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Buscar contactos'),
						//'widthInput' => '150px',
						//'widthToken' => '250px',
					));
				?>
				 
				 <button type="button" id ="btn_s" class="btn btn-default btn-sm" onclick="getContactos();">
						<span class="glyphicon glyphicon-search"></span> Buscar 
				</button>
			</div>
		
    
	<div id="respuesta_ajax"></div>


	</div>
			<div class='propaganda-muro-3'>Publicite aqui</div>
		

</div>


</body>

</html>
