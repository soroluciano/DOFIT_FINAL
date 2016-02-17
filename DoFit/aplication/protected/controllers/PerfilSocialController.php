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

    
    public function actionFillProvincia(){
      	$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
       	$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$ficha->id_localidad));
		$provincia = Provincia::model()->find('id_provincia=:id_provincia',array(':id_provincia'=>$localidad->id_provincia));
		
		$localidades = Localidad::model()->findAll();
		$provincias = Provincia::model()->findAll();
        $result="";
      
        foreach($provincias as  $prov){
				if($prov['provincia']==$provincia->provincia){
					$result.="<option selected id='".$prov['id_provincia']."'>".$prov['provincia']."</option>";
				}else{
					$result.="<option  id='".$prov['id_provincia']."'>".$prov['provincia']."</option>";
				}
				
		  }
          echo $result;
    }
 
   public function actionFillLocalidad(){
    //llena la localidad de acuerdo a cada provincia
        if($_POST['id'] != 0){
          $id = $_POST['id'];
        }else{
          $id = null;
        }
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
       	$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$ficha->id_localidad));
		$provincia = Provincia::model()->find('id_provincia=:id_provincia',array(':id_provincia'=>$localidad->id_provincia));
        $result="";
        $localidades="";
        
        if($id != null){
          $localidades = Localidad::model()->findAll(
                        array(
                      'condition' => 'id_provincia = :id_provincia',
                      'params'    => array(':id_provincia' => $id)
                    )
          ); 
        }
        else{
          $localidades = Localidad::model()->findAll(
                        array(
                      'condition' => 'id_provincia = :id_provincia',
                      'params'    => array(':id_provincia' => $provincia->id_provincia)
                    )
        );
        }
        foreach($localidades as  $loc){
            if($loc['localidad']==$localidad->localidad){
                $result.="<option selected id='".$loc['id_localidad']."'>".$loc['localidad']."</option>";
            }else{
                $result.="<option id='".$loc['id_localidad']."'>".$loc['localidad']."</option>";
            }
            
        }
        echo $result;
    }
   
     public function actionUpdateDatos(){
      	$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		$model = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
		$ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
        $fichaService = new FichaUsuarioService;
        $tel="";
        $cel="";
        $cont="";
        $telem="";
        $dir="";
        $pis="";
        $dep="";

        if(empty($_POST['telfijo'])){
          $tel = "Ingrese un valor";
        }else{
           $tel = $fichaService->telfijo($_POST['telfijo']);
        }
        if(empty($_POST['celular'])){
          $cel = "Ingrese un valor";
        }else{
           $cel = $fichaService->cel($_POST['celular']);
        }
        if(empty($_POST['conemer'])){
          $cont = "Ingrese un valor";
        }else{
           $cont = $fichaService->contemer($_POST['conemer']);
        }
        if(empty($_POST['telemer'])){
          $telem = "Ingrese un valor";
        }else{
           $telem = $fichaService->telemer($_POST['telemer']);
        }
        if(empty($_POST['direccion'])){
         $dir = "Ingrese un valor";
        }else{
          $dir = $fichaService->direccion($_POST['direccion']);
         
        }
        if(empty($_POST['piso'])){
          $pis = "Ingrese un valor";
        }else{
           $pis = $fichaService->piso($_POST['piso']);
           
        }
        if(empty($_POST['depto'])){
          $dep = "Ingrese un valor";
        }else{
           $dep = $fichaService->depto($_POST['depto']);
        }
        $array="";
        $saved="";
        if($tel == "ok" && $cel=="ok" && $cont=="ok" && $telem=="ok" && $dir=="ok" && $pis=="ok" && $dep=="ok"){
          $saved="si";
          $ficha->telfijo = $_POST['telfijo'];
          $ficha->conemer = $_POST['conemer'];
          $ficha->telemer = $_POST['telemer'];
          $ficha->direccion = $_POST['direccion'];
          $ficha->piso = $_POST['piso'] ;
          $ficha->depto = $_POST['depto'];
          $ficha->celular = $_POST['celular'];
          $ficha->update();
          $array = Array('saved'=>$saved); 
          echo CJSON::encode($array);

        }else{
          $saved="no";
          $array = Array('telefono'=>$tel,'celular'=>$cel,'conemer'=>$cont,'telemer'=>$telem,'direccion'=>$dir,'piso'=>$pis,'depto'=>$dep,'saved'=>$saved);
           echo CJSON::encode($array);
        }
        
     }
   
   
}