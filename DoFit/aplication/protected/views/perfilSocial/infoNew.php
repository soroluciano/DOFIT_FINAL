<?php
    function getValue($val,$name){
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));

		$sexo = $ficha->sexo=="M"?"Masculino":"Femenino";		
        if($val=="a_1"){
			inputDisable($name,$val,$ficha->nombre);
		} 
        if($val=="a_2"){
			inputDisable($name,$val,$ficha->apellido);
		}
        if($val=="a_3"){
			inputDisable($name,$val,$ficha->dni);
		}
        if($val=="a_4"){
			inputDisable($name,$val,$sexo);
		}
        if($val=="a_5"){
			inputDisable($name,$val,$ficha->fechanac);
		}
        if($val=="a_6"){
			inputEnable($name,$val,$ficha->telfijo);
		}
        if($val=="a_7"){
			inputEnable($name,$val,$ficha->celular);
		}
        if($val=="a_8"){
			inputEnable($name,$val,$ficha->conemer);
		}
        if($val=="a_9"){
			inputEnable($name,$val,$ficha->telemer);
		}	
		if($val=="b_1"){
			echo "<div class='select-div'>".$name."<select id='provincia' class='form-control'></select></div>";
		}
		if($val=="b_2"){
			echo "<div class='select-div'>".$name."<select id='localidad' class='form-control'></select></div>";
		}

        if($val=="b_3"){
			inputEnable($name,$val,$ficha->direccion);
		}
        if($val=="b_4"){
			inputEnable($name,$val,$ficha->piso);
		}
        if($val=="b_5"){
			inputEnable($name,$val,$ficha->depto);
		}
    }
    
	function inputDisable($name,$id,$info){
		echo  "<div class='input-class'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$id."' value='".$info."'></div>";
	}
	
	function inputEnable($name,$id,$info){
		echo  "<div class='input-class'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$id."' value='".$info."'><span class='".$id." redspan'></span></div>";
	}
    function columna($type,$name,$id){    
        if($type=="input"){
            getValue($id,$name);
        }

    }
	$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	$perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
	
?>

<div class='left-column'>
</div>

<div class="contenido row" >
	<div style="width:100%;">

			<div id='foto-profile' >
				<div id='img-profile'>
					<?php
					if($perfil->fotoperfil == "profile_defect_picture.png"){
						echo "<img src=".Yii::app()->request->baseUrl."/images/profile_defect_picture.png>";	
					}else{
						echo "<img src=".Yii::app()->request->baseUrl."/uploads/".$perfil->fotoperfil.">";		
					}
					?>
				</div>
			</div>
      
      <ul class="nav nav-tabs" style='padding-left:10%;'>
        <li class="active"><a data-toggle="tab" href="#columnas-inputs">Informacion</a></li>
<!--        <li><a data-toggle="tab" href="#info-publica">Info publica</a></li>-->
      </ul>
		  <div class="tab-content">
			<div id="columnas-inputs" class="tab-pane fade in active borde">
			  <p>Informacion</p>
			  <p>Esta informacion solo sera compartida con aquellos gimnasios a los que se ha adherido</p>
			  <form role="form" id='form'>
			  <?php
				columna("input","Nombre","a_1");
				columna("input","Apellido","a_2");
				columna("input","Dni","a_3");
				columna("input","Sexo","a_4");            
				columna("input","Fecha de nacimiento","a_5");            
				columna("input","Telefono fijo","a_6");            
				columna("input","Celular","a_7");            
				columna("input","Contacto de emergencia","a_8");            
				columna("input","Telefono de emergencia","a_9");            
				columna("input","Direcci&oacute;n","b_3");            
				columna("input","Piso","b_4");
				columna("input","Depto","b_5");
				columna("input","Provincia","b_1");        
				columna("input","Localidad","b_2");  
			  ?>
			  <div id="save-button" class="borde"><input type='button' class="btn btn-success" value='guardar' onclick='validateData();' /></div>
			  </form>
			</div>
      
      </div>

		
    </div>
</div>

<div class='right-column'>
</div>