
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/red.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/contactos.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/muro.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/imagenes.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox.css" rel="stylesheet">
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
//$cs->registerScriptFile($baseUrl.'/js/perfil.js');
$cs->registerScriptFile($baseUrl.'/js/muroprofesor.js');
$cs->registerScriptFile($baseUrl.'/js/red.js');
//$cs->registerScriptFile($baseUrl.'/js/contactos.js');
$cs->registerScriptFile($baseUrl.'/js/galeria.js');
$cs->registerScriptFile($baseUrl.'/js/fancybox/jquery.fancybox.js');
$cs->registerScriptFile("http://js.pusherapp.com/1.9/pusher.min.js");



//buscar todos los canales y grabarlos en  lista de memoria js
$canal = Canal::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
if($canal==null){
	$canal = new Canal();
	$canal->id_usuario=$usuario->id_usuario;
	//$nombre=md5($ficha->nombre);
	//$nombre=md5("sasarasas");
	$nombre=md5(strval($usuario->id_usuario)."".$ficha->nombre."".strval($ficha->id_ficha));
	$canal->nombre=$nombre;
	$canal->save();
}


function getActividades($id){
				
	$listaActividades = Yii::app()->db->createCommand("select a.id_actividad,d.deporte,ao.hora,ao.minutos,ao.id_dia,fi.nombre from actividad a inner join actividad_horario ao on a.id_actividad=ao.id_actividad inner join institucion i on a.id_institucion=i.id_institucion inner join ficha_institucion fi on i.id_institucion=fi.id_institucion inner join deporte d on a.id_deporte=d.id_deporte where a.id_usuario=".$id)->queryAll();
	$respuesta="
		<select class='form-control' style='margin-top:5px;' id='sel1'>
		<option>Compartir con...</option>";
	
  foreach($listaActividades as $act ){
	$dia;
	switch($act['id_dia']){
		case 1:{
			$dia="Lunes";	
		}
		case 2:{
			$dia="Martes";
		}
			case 3:{
			$dia="Miercoles";
		}
		case 4:{
			$dia="Jueves";		
		}
		case 5:{
			$dia="Viernes";
		}
		case 6:{
			$dia="Sabado";
		}
		case 7:{
			$dia="Domingo";
		}
		
	}

	$respuesta.="<option id='".$act['id_actividad']."'><a href='#'>".$act['deporte']."-".$act['nombre']."-".$dia."(".$act['hora'].":".$act['minutos']." hs".")</a></li>";
  }
	$respuesta.="</select>";

  return $respuesta;
						
}

?>



<?php $this->renderPartial('../menu/_menu');?>

<div class="container marketing">

    <div class="row">
		<?php $this->renderPartial('../menu/_cabecera',array('perfil'=>$perfil,'nombre'=>$nombre,'apellido'=>$apellido)); ?>
	
    
		<input type="hidden" id="canal" value="<?php echo $canal->nombre;?>"/>
		<input type="hidden" id="id_canal" value="<?php echo $canal->id_canal;?>"/>
		<input type="hidden" id="id_actividad_selected" value=""/>
		
		<div id="respuesta_ajax">
	
			<?php	if($usuario->id_perfil==1){ ?>
			<div class='propaganda-muro-2'>Publicite aqui</div>
			<?php	}?>
			<div id="comentarios" class="row">
							<?php $this->renderPartial('galeria',array('perfil'=>$perfil)); ?>
			</div>
		
		</div>
	</div>
</div>


</body>

</html>
