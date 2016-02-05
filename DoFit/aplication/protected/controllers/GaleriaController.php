<?php

class GaleriaController extends Controller
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

    
    public function actionAmigo(){
      $id=$_POST['id'];
      $this->render('_amigo',array('id'=>$id));
    } 

    public function actionMostrarImagenes(){
        $this->render('_imagenes');	
    }
    
	public function actionGetPage(){
		$page = $_POST['page'];
		$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
		$limita = "";
		$limitb = "";
   
		if($page!=0){
		 $limita = ($limita+1)*8; 
		 $limitb = $limita*2;
		}else{
		 $limita = $page;
		 $limitb = 8;
		}
   
   
		$imagenes = Yii::app()->db->createCommand("select * from imagen where id_usuario = ".$usuario->id_usuario." limit ".$limita.",".$limitb."")->queryAll(); 
		$mensaje="";
   
		foreach($imagenes as $img){
					$mensaje.= "<div class='col-md-3 col-sm-4 col-xs-6 img_class' ><img class='img-responsive' style='overflow:hidden;' src='".Yii::app()->request->baseUrl."/uploads/".$img["nombre"]."' /></div>";
			  }
			  echo $mensaje;
		}
		
	public function actionGetLinks(){
		$page = $_POST['page'];
		$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $imagenes = Yii::app()->db->createCommand("select * from imagen where id_usuario = ".$usuario->id_usuario )->queryAll(); 
        $count = count ($imagenes);
		$max = 8;
		$paginas = ceil ($count/$max);
		$resultado = "";
		$j = 0;
		for($i=0; $i<$paginas; $i++){	
		  $j = $i+1;
		  if($page == $i){
			$resultado.= "<li class='active'><a onclick='getPage(".$i.")'>".$j."</a></li>";
		  	
		  }else{
				$resultado.= "<li class><a onclick='getPage(".$i.")'>".$j."</a></li>";
		  
		  }
		  $j = 0;
		
		}
		$res = "<ul class='pagination'>".$resultado."</ul>";
		echo $res;
		
   }	
		
}	
		