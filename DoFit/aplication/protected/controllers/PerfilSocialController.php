<?php

class PerfilSocialController extends Controller
{

	public $layout='//layouts/column2';
/*
	public function accessRules()
	{
		return array(
			array('deny',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('indexA','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/*
	public function findPerfilByUserId(){

	  $Us = Usuario::model()->findByPk(Yii::app()->user->id); 
	  $perfilSocial = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));

		
	}
	*/


  public function actionIndex(){
		
		$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		$perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
		$fichaUsuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));


		if($perfil == null){ // se crea un nuevo perfil social si el usuario es nuevo
			$pefil = new PerfilSocial();
			$pefil->id_usuario=$usuario->id_usuario;
			$pefil->fhcreacion= new CDbExpression('NOW()');
			$pefil->cusuario=$usuario->id_usuario;
			$pefil->save();
		}
	
		$this->render('index',array(
			'perfil'=>$perfil,
			'Us'=>$usuario,
			'fichaUsuario'=>$fichaUsuario,
		));	
    }
	
	public function actionEdicion(){
		
		$Us = Usuario::model()->findByPk(Yii::app()->user->id);
		$model = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$fichaUsuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$fichaUsuario->id_localidad));
		$fuModel= new FileUpload();//modelo que permite subir archivos de imagen
		
		if($model == null){ // se crea un nuevo perfil social si el usuario nuevo
			$model = new PerfilSocial();
			$model->id_usuario=$Us->id_usuario;
			$model->fhcreacion= new CDbExpression('NOW()');
			$model->cusuario=$Us->id_usuario;
			$model->save();
		}

		$this->render('edicion',array(
			'model'=>$model,
			'fuModel'=>$fuModel,
			'Us'=>$Us,
			'fichaUsuario'=>$fichaUsuario,
			'localidad'=>$localidad
		));	
	
	}
	
	public function actionEdicionInfo(){
		
		$Us = Usuario::model()->findByPk(Yii::app()->user->id);
		$model = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$this->render('edicionInfo',array(
			'model'=>$model
		));	
	}
	
	
	public function actionInformacion(){
		
		$Us = Usuario::model()->findByPk(Yii::app()->user->id);
		$model = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$fichaUsuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$fichaUsuario->id_localidad));
		
		
		if($model == null){ // se crea un nuevo perfil social si el usuario nuevo
			$model = new PerfilSocial();
			$model->id_usuario=$Us->id_usuario;
			$model->fhcreacion= new CDbExpression('NOW()');
			$model->cusuario=$Us->id_usuario;
			$model->save();
		}
	
	
		$this->render('informacion',array(
			'model'=>$model,
			'Us'=>$Us,
			'fichaUsuario'=>$fichaUsuario,
			'localidad'=>$localidad
		));	
	
	}

	
	public function actionSaveInfo(){
		$Us = Usuario::model()->findByPk(Yii::app()->user->id);
		$fichaUsuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$fichaUsuario->id_localidad));
		$perfilSocial = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
		
		if(isset($_POST['descripcion'])){
			$perfilSocial->descripcion = $_POST['descripcion'];
			$perfilSocial->save();
		}
		
		echo $perfilSocial->descripcion;
	}

	
    
    public function actionLogout(){
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
    }


}