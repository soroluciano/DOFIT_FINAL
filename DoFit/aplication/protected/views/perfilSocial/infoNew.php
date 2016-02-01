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
        if($val=="a_1"){echo  "<div class='col-xs-2 col-sm-4 col-md-2'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->nombre."'></div></div>";} 
        if($val=="a_2"){echo  "<div class='col-xs-2 col-sm-4 col-md-2'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->apellido."'></div></div>";}
        if($val=="a_3"){echo  "<div class='col-xs-2 col-sm-4 col-md-2'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->dni."'></div></div>"; }
        if($val=="a_4"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->sexo."'></div></div>";}
        if($val=="a_5"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->fechanac."'></div></div>";}
        if($val=="a_6"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telfijo."'></div></div>"; }
        if($val=="a_7"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->celular."'></div></div>";}
        if($val=="a_8"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->conemer."'></div></div>"; }
        if($val=="a_9"){echo  "<div class='col-xs-2 col-sm-4 col-md-4'><div class='input-group'><span class='input-group-addon'>".$name."</span><input type='text' class='form-control' aria-describedby='basic-addon1' id='".$val."' value='".$ficha->telemer."'></div></div>"; }
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

<div class="contenido">
    <div id='datos'>
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