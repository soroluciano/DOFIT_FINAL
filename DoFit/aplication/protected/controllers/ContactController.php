<?php

class ContactController extends Controller
{
  
  
		public function actionIndex()
		{
        	$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
          $this->render('index',array('usuario'=>$usuario));
      
    }

  	
		public function actionLogout()
		{
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
		}

    
    public function actionGetContactos(){
      $busqueda = $_POST['busqueda'];
      $res = str_replace ( "," , "", $busqueda);
      $arr= str_split($res);
      $criteria = new CDbCriteria();
      $criteria->select = "*";
      $criteria->addInCondition('id_usuario', $arr);
      $res =  FichaUsuario::model()->findAll($criteria);
      $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
      $this->renderPartial('_contactos',array('contactos'=>$res,'usuario'=>$usuario));				
    }
    
    public function actionAmigo(){
      $id=$_POST['id'];
      $this->render('_amigo',array('id'=>$id));
    }
    
    
    public function actionGetGaleria(){
      $id = $_POST['id'];
      $usuario = Usuario::model()->findByPk($id);
      $imagen  = Yii::app()->db->createCommand("select * from imagen where id_usuario=".$usuario->id_usuario)->queryAll();
      $baseUrl = Yii::app()->baseUrl;
      $result ="";
      $i=0;
      
      if($imagen != null){
        foreach ($imagen as $img){
          
          
          if($i==0){
           $result.= "<a  id='firstId' class='fancybox' rel='group' href='".$baseUrl."/uploads/".$img['nombre']."'><img src='".$baseUrl."/uploads/".$img['nombre']."'/></a><br/>";
            
          }else{
            $result.= "<a class='fancybox' rel='group' href='".$baseUrl."/uploads/".$img['nombre']."'><img src='".$baseUrl."/uploads/".$img['nombre']."'/></a><br/>";
           
          }
          
            $i++;
        }

      }
      else{
          $result.= "<a  id='firstId' class='fancybox' rel='group' href='#default'><span id='default'>Lo sentimos su contacto aun no pos&eacute;e im&acute;agenes</span>></a><br/>";
      }
      echo $result;
  }



}
