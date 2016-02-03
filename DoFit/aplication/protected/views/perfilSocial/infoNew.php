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
        if($val=="a_1"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->nombre."'></div>";} 
        if($val=="a_2"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->apellido."'></div>";}
        if($val=="a_3"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->dni."'></div>"; }
        if($val=="a_4"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->sexo."'></div>";}
        if($val=="a_5"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->fechanac."'></div>";}
        if($val=="a_6"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telfijo."'></div>"; }
        if($val=="a_7"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->celular."'></div>";}
        if($val=="a_8"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->conemer."'></div>"; }
        if($val=="a_9"){echo  "<div class='form-group'>".$name."<input type='text' class='form-control input-sm' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telemer."'></div>"; }
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
?>

<div class='left-column'>
</div>

<div class="contenido row">
   
   <!-- <div id='datos'>-->
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
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
            //columna("input","Provincia","b_1");        
            //columna("input","Localidad","b_2");            
            //columna("input","Direcci&oacute;n","b_3");            
            //columna("input","Piso","b_4");
            //columna("input","Depto","b_5");
        ?>
        </form>
        
    </div>
    
    
    
<!--    <div id='foto-profile' class='col-xs-12 col-sm-4 col-md-4 red' >
        <div id='img-profile'>
            <img src="<?php /*echo Yii::app()->request->baseUrl;*/ ?>/img/logo_blanco.png"' style='width:30%; height:50%'> 
        </div>
        <div id='buttons'>
            <button onclick=''>nuevo reemplazar por carga en la foto</button>
            <button onclick=''>editar</button>
            <button onclick=''>borrar</button>    
        </div>
    </div>-->
</div>

<div class='right-column'>
</div>