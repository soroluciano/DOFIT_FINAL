
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

//$canal = Canal::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
//if($usuario->id_perfil==2){
//	if($canal==null){
//		$canal = new Canal();
//		$canal->id_usuario=$usuario->id_usuario;
//		//$nombre=md5($ficha->nombre);
//		//$nombre=md5("sasarasas");
//		$nombre=md5(strval($usuario->id_usuario)."".$ficha->nombre."".strval($ficha->id_ficha));
//		$canal->nombre=$nombre;
//		$canal->save();
//	}
//}


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
            break;			
		}
		case 2:{
			$dia="Martes";
			break;
		}
			case 3:{
			$dia="Miercoles";
			break;
		}
		case 4:{
			$dia="Jueves";
            break; 			
		}
		case 5:{
			$dia="Viernes";
			break;
		}
		case 6:{
			$dia="Sabado";
			break;
		}
		case 7:{
			$dia="Domingo";
			break;
		}
		
	}
    $act['minutos'] = ($act['minutos'] == '0' ? '0'.$act['minutos'] : $act['minutos']);
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
	</div>
    
<!--    <input type="hidden" id="canal" value="<?php // echo $canal->nombre;?>"/>
    <input type="hidden" id="id_canal" value="<?php // echo $canal->id_canal;?>"/>-->
    <input type="hidden" id="id_actividad_selected" value=""/>
    

	
	<div class="modal fade" id="uploadvideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Ingresar video</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="video" class="control-label">Ingrese la url del video de youtube</label>
            <input type="text" class="form-control" id="video"/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="addTagVideo();">Guardar</button>
      </div>
    </div>
  </div>
</div>
	
	


	
	<div id="respuesta_ajax">
	<?php	if($usuario->id_perfil==2){ ?>
        <div class=" col-lg-8 col-md-8 col-sm-5 contenedor-espaciado row">
<!--			<div class="widget-area no-padding blank">-->
				<div class="widgt-area">
				<div class="status-upload panel-shadow">
					<form action="" method="post">
						<textarea placeholder="¿Qué estas pensando?" id="input_mensaje"></textarea>
						<ul>
<!--					<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>-->
						<li><button id="btn-video" type="button" data-original-title="Video" data-toggle="modal" data-target="#uploadvideo"><i class="fa fa-video-camera"></i></button></li>
		<!--				<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>-->
						<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture" onclick="addImage()"><i class="fa fa-picture-o"></i></a></li>
						</ul>

						<button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Publicar</button>
						<?php echo "<div class='col-xs-5 col-sm-5 col-lg-5 col-md-5' data-placement='bottom'>".getActividades($usuario->id_usuario)."</div>"; ?>
					
					</form>
					
		</div><!-- Status Upload  -->
				<div class='propaganda-muro-profesor'>Publicite aqui</div>
			</div><!-- Widget Area -->

		</div><!--fin contenedor espaciado -->
		<?php }else{ ?>
			<div id="spacer"></div>
		<?php }?>
	</div>
		<?php	if($usuario->id_perfil==1){ ?>
    <div class='propaganda-muro-2'>Publicite aqui</div>
    <?php	}?>
		<div id="comentarios" class="row">
		 <script> getMensajesFromBase();</script>
    </div>
    <div id="boton_mas_comentarios"><input type='button' class='btn btn-custom' value='Cargar mas posts' onclick="getMoreMsgs()"/></div>   
</div>


</body>

</html>
