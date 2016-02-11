<!--
            id_ficha
            id_usuario
            nombre  1
            apellido  2
            dni 3
            sexo
            fechanac
            telfijo 1
            celular 2
            conemer 3
            telemer 4
            id_localidad 
            direccion 
            piso
            depto
            fhcreacion
            fhultmod
            cusuario
-->


<?php
    function getValue($val,$name){
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
        $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
		$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$ficha->id_localidad));
		$provincia = Provincia::model()->find('id_provincia=:id_provincia',array(':id_provincia'=>$localidad->id_provincia));
		
		$localidades = Localidad::model()->findAll();
		$provincias = Provincia::model()->findAll();
				
        if($val=="a_1"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$val."' value='".$ficha->nombre."'></div>";} 
        if($val=="a_2"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$val."' value='".$ficha->apellido."'></div>";}
        if($val=="a_3"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$val."' value='".$ficha->dni."'></div>"; }
		$sexo = $ficha->sexo=="M"?"Masculino":"Femenino";
        if($val=="a_4"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$val."' value='".$sexo."'></div>";}
        if($val=="a_5"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' readonly id='".$val."' value='".$ficha->fechanac."'></div>";}
        if($val=="a_6"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telfijo."'></div>"; }
        if($val=="a_7"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->celular."'></div>";}
        if($val=="a_8"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->conemer."'></div>"; }
        if($val=="a_9"){echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telemer."'></div>"; }
		
		if($val=="b_1"){
		//	echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name.
		//"<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$provincia->provincia."'>
		//</div>";
			echo "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name;
			echo "<select id='provincia' class='form-control'>";
			foreach($provincias as  $prov){
				if($prov['provincia']==$provincia->provincia){
					echo "<option selected id='".$prov['id_provincia']."'>".$prov['provincia']."</option>";
				}else{
					echo "<option  id='".$prov['id_provincia']."'>".$prov['provincia']."</option>";
				}
				
			}
			echo "</select></div>";
		}
		if($val=="b_2"){
		//	echo  "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name.
		//"<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$localidad->localidad."'>
			echo "<div  style='float:left;padding-right:10px;margin-botton:10px;height:100px;width:30%;font-weight:bold;'>".$name;
			echo "<select id='localidad' class='form-control'>";
			foreach($localidades as  $loc){
				if($loc['localidad']==$localidad->localidad){
					echo "<option selected id='".$loc['id_localidad']."'>".$loc['localidad']."</option>";
				}else{
					echo "<option id='".$loc['id_provincia']."'>".$loc['localidad']."</option>";
				}
				
			}
			echo "</select><div>";
		}
	
		
		//$localidad = Localidad::model()->find('id_localidad=:id_localidad',array(':id_localidad'=>$ficha->id_localidad));
        //$provincia = Provincia::model()->find('id_provincia=:id_provincia',array(':id_provincia'=>$ficha->id_provincia));
        //if($val=="b_1"){echo $provincia->provincia;}
        //if($val=="b_2"){echo $localidad->localidad;}
        //if($val=="b_3"){echo $ficha->direccion;}
        //if($val=="b_4"){echo $ficha->piso;}
        //if($val=="b_5"){echo $ficha->depto;}
    }
    
    function columna($type,$name,$id){    
        if($type=="input"){
            getValue($id,$name);
        }
        if($type=""){
            
        }
        if($type=""){
            
        }
    }
	$usuario = Usuario::model()->findByPk(Yii::app()->user->id);
	$perfil = PerfilSocial::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$usuario->id_usuario));
	
?>

<div class='left-column'>
</div>

<div class="contenido row">
   
   <!-- <div id='datos'>-->
<!--        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">-->
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
<!--				<div id='buttons'>
					<button onclick=''>cargar foto</button>
					<button onclick=''>borrar</button>    
				</div>-->
			</div>
			<div id="columnas-inputs">
				
				<form role="form">
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
					columna("input","Provincia","b_1");        
					columna("input","Localidad","b_2");            
					//columna("input","Direcci&oacute;n","b_3");            
					//columna("input","Piso","b_4");
					//columna("input","Depto","b_5");
				?>
				</form>
			</div>
		
    </div>
</div>

<div class='right-column'>
</div>