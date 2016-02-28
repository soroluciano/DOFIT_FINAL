	
<?php

class MuroController extends Controller
{
	/*
				cargar canales cada 2 min y luego cerrarlos buscar como hacerlo
				si soy el que comenta ->carga datos automaticamente
				si soy el que escucha ->carga automaticamente todos mis cananales en 2 min
				ver si armar una tabla que relacione canales con alumnos para hacer una query que traiga los canales donde esta agregado
				si estoy sobre comentario no deberia recargarse nada
				si no hago ninguna accion -Ç>puede recargarse
				cada post deberia tener un canal (que pasaria si muchos comentan a la vez? se me recarga sin parar?)
				como se que canales recargar?
				deberia agregar todos mis canalaes escuchados por comentario
				cada 2 min y por post tmb.
	
	
	
	
	*/
	
	
	
		
		public function actionIndex()// Action para llamar al index dependiendo el tipo de usuario
		{	
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
				if($usuario->id_perfil == 1){
					$this->render('indexAlumno');
				}else{
					$this->render('indexProfesor');
				}
		
		} 
	
		public function actionMensajes() // action que trae los posteos
		{
			$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
			$size = null;
			
			if(isset($_POST['size'])){
				 $size = $_POST['size'];	
			}
			if($size!=null){
				$resultSet = Yii::app()->db->createCommand("select distinct pmp.id_posteo,pmp.posteo,ps.id_usuario,pmp.id_actividad,ps.fotoPerfil,fu.nombre,fu.apellido from perfil_muro_profesor pmp inner join actividad ac on pmp.id_actividad=ac.id_actividad left join actividad_alumno aa on ac.id_actividad=aa.id_actividad inner JOIN perfil_social ps on ps.id_usuario = ac.id_usuario inner join usuario usu on usu.id_usuario = ac.id_usuario inner join ficha_usuario fu on fu.id_usuario= usu.id_usuario where usu.id_usuario =". $usuario->id_usuario ." or aa.id_usuario=".$usuario->id_usuario." order by pmp.fhcreacion desc,pmp.fhultmod desc limit ".$size)->queryAll();			
			}else{
				$resultSet = Yii::app()->db->createCommand("select distinct pmp.id_posteo,pmp.posteo,ps.id_usuario,pmp.id_actividad,ps.fotoPerfil,fu.nombre,fu.apellido from perfil_muro_profesor pmp inner join actividad ac on pmp.id_actividad=ac.id_actividad left join actividad_alumno aa on ac.id_actividad=aa.id_actividad inner JOIN perfil_social ps on ps.id_usuario = ac.id_usuario inner join usuario usu on usu.id_usuario = ac.id_usuario inner join ficha_usuario fu on fu.id_usuario= usu.id_usuario where usu.id_usuario =". $usuario->id_usuario ." or aa.id_usuario=".$usuario->id_usuario." order by pmp.fhcreacion desc,pmp.fhultmod desc limit 4")->queryAll();
			}
			
			$this->renderPartial('_posts',array('resultSet'=>$resultSet,'usuario'=>$usuario->id_usuario));
		}
		
		public function actionQuantityOfPosts(){
			  $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
				$resultSet = Yii::app()->db->createCommand("select distinct pmp.id_posteo from perfil_muro_profesor pmp inner join actividad ac on pmp.id_actividad=ac.id_actividad inner JOIN perfil_social ps on ps.id_usuario = ac.id_usuario inner join usuario usu on usu.id_usuario = ac.id_usuario left join actividad_alumno aa on ac.id_actividad=aa.id_actividad  inner join ficha_usuario fu on fu.id_usuario= usu.id_usuario where usu.id_usuario =". $usuario->id_usuario ." or aa.id_usuario=".$usuario->id_usuario)->queryAll();			
				$count = count ( $resultSet );
				echo $count;
		}
		
	
		public function actionInsertarComentarioProfesor() //action que permite insertar los posteos
		{
			$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
			$fichaUsuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
			$actividad = $_POST['id_actividad'];
			$canal = Canal::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$actividad));//cambiar el id usuario por id canal
			
			
			$mensaje = $_POST['mensaje'];
						
			if($actividad !=null && $mensaje != null){
				if(is_numeric($actividad)){
		
					$mensajeFilter = mysql_real_escape_string(htmlentities($mensaje));			//le quito las etiquetas html
					//si la persona puede guardar utilizando esa actividad lo dejo guardar	
					$actividadBusqueda  = Yii::app()->db->createCommand("select act.id_actividad from actividad act where act.id_usuario=".$usuario->id_usuario." and act.id_actividad=".$actividad)->queryAll();
				
					if($actividadBusqueda != null){
									
						$muroProfesor = new PerfilMuroProfesor();
						$muroProfesor->posteo = $mensajeFilter;
						$muroProfesor->id_actividad = $actividad;
						$muroProfesor->id_canal = $canal->id_canal;
						$muroProfesor->fhcreacion= new CDbExpression('NOW()');
						$muroProfesor->cusuario="juancito";
						$muroProfesor->save();
						echo "saved";			
					}else{
						throw new ExceptionClass('No se ha podido guardar el comentario');
					}
				
				}else{
						echo "error de actividad";
				}
			}
			
		}
	
		public function actionUpdateComentarioProfesor() //action que permite modificar los comentarios
		{
				
				$id_posteo = $_POST['id_posteo'];
				$mensaje = $_POST['mensaje'];
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
							
				if( $mensaje != null ){
						$mensajeFilter = mysql_real_escape_string(htmlentities($mensaje));			//le quito las etiquetas html
						$muroProfesor =  PerfilMuroProfesor::model()->findByPk($id_posteo);					
						$posteo  = Yii::app()->db->createCommand("select pm.id_posteo from perfil_muro_profesor pm inner join actividad ac on pm.id_actividad = ac.id_actividad where ac.id_usuario=".$usuario->id_usuario." and pm.id_posteo=".$id_posteo)->queryAll();

						if($posteo != null)
						{
								$muroProfesor->posteo = $mensajeFilter;
								if($muroProfesor->update()){
									echo "updated";		
								}else{
									echo "error";	
								}
									
						}else{
								echo "no es posible modificar el post";
						}
	
				
				}
		
		}
		
		public function actionDeleteComentarioProfesor(){
				/* buscar todos las respuestas relacionadas con el comentario y borrarlas  */
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
				$id_posteo = $_POST['id_posteo'];

				$listaRespuesta =  Yii::app()->db->createCommand("select r.id_respuesta from respuesta r join perfil_muro_profesor pm on r.id_posteo = pm.id_posteo join actividad ac on pm.id_actividad = ac.id_actividad where r.id_posteo = ".$id_posteo." and ac.id_usuario =".$usuario->id_usuario)->queryAll();
				
				if($listaRespuesta != null){				
						Respuesta::model()->deleteAll('id_posteo = :id_posteo',array(':id_posteo' => $id_posteo));				
				}
				$posteo = PerfilMuroProfesor::model();
				if($posteo->deleteByPk($id_posteo) ){
					echo "deleted";	
				}else{
				    echo "error";
				}

		}
	
	
	
	
	
		public function actionGetCanales(){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);	
				$resultSet = Yii::app()->db->createCommand("select c.nombre from canal c join actividad a on c.id_actividad = a.id_actividad join actividad_alumno au on a.id_actividad = au.id_actividad join usuario u on au.id_usuario=u.id_usuario where au.id_usuario=".$usuario->id_usuario)->queryAll();				
				echo CJSON::encode($resultSet);
				Yii::app()->end();
				
		}
	
	
		public function actionGetCanal()
		{
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);	
				$perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
				$idActividad = $_POST['id_actividad'];
				$actividad = Actividad::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$idActividad));
				$canal = Canal::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$idActividad));
				$nombre="";
				if($canal==null){
						$canal = new Canal();
						$canal->id_actividad=$actividad->id_actividad;
						$nombre=md5(strval($actividad->id_actividad)."".time()."");
						$canal->nombre=$nombre;
						$canal->save();
				}else{
						echo trim($canal->nombre," \t\n\r");
				}
				
		}
	
		public function actionGetIdCanal()
		{
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
				$canal = Canal::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$idActividad));
				echo $canal->id_canal;
			
		}
	
	
		public function actionInsertarRespuesta()
		{	
				$comentario = $_POST['respuesta'];
				$id_posteo = $_POST['id_posteo'];
				$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
				
				$topIdRespuesta;
				
				//if($id_posteo != null && $id_posteo != "" && $res != null && $res != ""){
				$listaRespuesta =  Yii::app()->db->createCommand("select r.id_respuesta from respuesta r where r.id_posteo=".$id_posteo)->queryAll();
				if($listaRespuesta!=null){
					foreach($listaRespuesta as $res ){
						$topIdRespuesta=$res['id_respuesta'];
					}
					$topIdRespuesta++;
				}else{
					$topIdRespuesta=1;
				}
				
				$respuesta = new Respuesta();
				$respuesta->id_posteo = $id_posteo;
				$respuesta->id_usuario  = $usuario->id_usuario;
				$respuesta->respuesta = $comentario;
				$respuesta->id_respuesta = $topIdRespuesta;
				$respuesta->fhcreacion= new CDbExpression('NOW()');
				$respuesta->cusuario="juancito";
				$respuesta->save();
				
				echo "saved";
		
		}
	
		public function actionGetComentarios()
		{
				$idposteo = $_POST['idposteo'];
				$position = $_POST['position'];
				$response;
				if($position == "" || $position == null){
					$position = 4;
				}else{
					$position+= 4;
				}
				
				$show = false;
				$cantidad_respuestas = Yii::app()->db->createCommand("select count(res.id_respuesta) from respuesta res left join perfil_muro_profesor pm on res.id_posteo = pm.id_posteo left join ficha_usuario fu on res.id_usuario=fu.id_usuario left join perfil_social ps on ps.id_usuario=fu.id_usuario where pm.id_posteo =".$idposteo)->queryAll();
				if($cantidad_respuestas>$position){
					$show=true;
				}
				
				/*falta contar las posiciones para seguir avanzando de acuerdo*/
				
				$respuestas = Yii::app()->db->createCommand("select res.id_respuesta,res.respuesta,res.fhcreacion,res.fhultmod,fu.nombre,fu.apellido,ps.fotoPerfil from respuesta res left join perfil_muro_profesor pm on res.id_posteo = pm.id_posteo left join ficha_usuario fu on res.id_usuario=fu.id_usuario left join perfil_social ps on ps.id_usuario=fu.id_usuario where pm.id_posteo =".$idposteo." order by res.fhcreacion desc, res.fhultmod desc limit ".$position)->queryAll();
				
				$this->renderPartial('_respuestas',array('respuestas'=>$respuestas,'show'=>$show,'idposteo'=>$idposteo,'position'=>$position));
						
		}
		
		public function actionGetHtmlDecoded(){
				$valor = $_POST['val'];
		
				echo html_entity_decode($valor);
		}
		
		

	
	
		//public function actionPruebaJson() {
		//		$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		//		$resultSet = Yii::app()->db->createCommand("select pmp.id_posteo,pmp.posteo,ps.foto1,fu.nombre,fu.apellido from perfil_muro_profesor pmp inner join actividad ac on pmp.id_actividad=ac.id_actividad inner JOIN perfil_social ps on ps.id_usuario = ac.id_usuario inner join usuario usu on usu.id_usuario = ac.id_usuario inner join ficha_usuario fu on fu.id_usuario= usu.id_usuario where usu.id_usuario =". $usuario->id_usuario ." order by pmp.fhcreacion desc,pmp.fhultmod desc")->queryAll();
		//		echo CJSON::encode($resultSet);
		//		Yii::app()->end();
		//}
	
		//public function actionPruebaVista()
		//{
		//		$this->render('pruebaJson');
		//}

	
	
		public function actionLogout()
		{
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
		}




}

