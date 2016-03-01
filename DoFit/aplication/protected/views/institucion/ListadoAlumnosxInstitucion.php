<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css"></link>
</head>
<?php
if(isset(Yii::app()->session['id_institucion'])){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
$this->renderPartial('../menu/_menuInstitucion');
?>
<style type="text/css">
    body {
        background: url(../img/33.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    /*
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */
    @media
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr { border: 1px solid #ccc; }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            right: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: pre-wrap;
        }

        /*
        Label the data
        */
        td:nth-of-type(1):before { content: "Nombre"; }
        td:nth-of-type(2):before { content: "Apellido"; }
        td:nth-of-type(3):before { content: "Dni"; }
        td:nth-of-type(4):before { content: "Email"; }
        td:nth-of-type(5):before { content: "Sexo"; }
        td:nth-of-type(6):before { content: "Fecha Nacimiento"; }
        td:nth-of-type(7):before { content: "Teléfonos"; }
        td:nth-of-type(8):before { content: "Dirección"; }
        td:nth-of-type(9):before { content: "Actividades"; }
    }

    /* Smartphones (portrait and landscape) ----------- */
    @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px) {
        body {
            padding: 0;
            margin: 0;
            width: 320px; }
    }

    /* iPads (portrait and landscape) ----------- */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        body {
            width: 495px;
        }
    }
</style>
<div class="container">
    <div class='row'>
        <br>
        <br>
        <br>
        <br>
        <?php
        if(isset(Yii::app()->session['id_institucion'])){
            $id_usuarios_array = array();
            $idinstitucion = Yii::app()->user->id;
            $cont_act_alum = 0;
            $actividades = Actividad::model()->findAll('id_institucion=:id_institucion',array(':id_institucion'=>$idinstitucion));
            foreach($actividades as $acti){
                $actividades_alumno = ActividadAlumno::model()->find('id_actividad=:id_actividad',array(':id_actividad'=>$acti->id_actividad));
                if($actividades_alumno != null){
                    $cont_act_alum++;
                }
            }
            if($actividades !=null  && $cont_act_alum > 0){
                echo "<div style='color:#222222;'><h3>Alumnos inscriptos en $fichains->nombre</h3></div>";
                echo "<br/>";
                echo "<table id='lisalumnos' class='display' cellspacing='0' width='100%'>
                      <thead>
                      <th>Nombre</th><th>Apellido</th><th>Dni</th><th>Email</th><th>Sexo</th><th>Fecha Nacimiento</th><th>Tel&eacute;fonos</th><th>Direcci&oacute;n</th><th>Actividades</th></thead>
                      <tbody>";
                foreach($actividades as $acti){
                    $actividades_alumnos = ActividadAlumno::model()->findAll('id_actividad=:id_actividad AND id_estado=:id_estado',array(':id_actividad'=>$acti->id_actividad,'id_estado'=>1));
                    if($actividades_alumnos != null){

                        foreach ($actividades_alumnos as $act_alum){
                            $id_usuario = $act_alum->id_usuario;
                            $contador_veces = 0; // cuanta veces aparece el id_usuario en el array
                            array_push($id_usuarios_array, $id_usuario);
                            $ficha_usuario = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$id_usuario));
                            for($cont = 0; $cont< count($id_usuarios_array); $cont++){
                                if($id_usuarios_array[$cont] == $id_usuario){
                                    $contador_veces ++;
                                }
                            }
                            if($contador_veces == 1){
                                ?>
                                <tr>
                                    <td id="nombre"><?php echo $ficha_usuario->nombre ?></td>
                                    <td id="apellido"><?php echo $ficha_usuario->apellido ?></td>
                                    <td id="dni"><?php echo $ficha_usuario->dni ?></td>
                                    <td id="email">
                                        <?php
                                        $usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$id_usuario));
                                        echo $usuario->email?></td>
                                    <td id="sexo">
                                        <?php
                                        if($ficha_usuario->sexo == 'M'){
                                            echo "Masculino";
                                        }
                                        if($ficha_usuario->sexo == 'F'){
                                            echo "Femenino";
                                        }
                                        ?>
                                    </td>
                                    <td id="fecnac">
                                        <?php $fechanac = date("d-m-Y",strtotime($ficha_usuario->fechanac));
                                        echo $fechanac;?>
                                    </td>
                                    <td><input type="button" id="tel" value="Ver tel&eacute;fonos" class="btn btn-primary" onClick="javascript:Mostrartelefonosalumno(<?php echo $id_usuario;?>);"></input></td>
                                    <td><input type="button" id="dir" value="Ver direcci&oacute;n" class="btn btn-primary" onClick="javascript:Mostrardireccionalumno(<?php echo $id_usuario;?>);")></input></td>
                                    <td><a id='act' class='btn btn-primary' href='../actividadalumno/Veractividades/<?php echo $id_usuario;?>'>Ver actividades</a></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    // Modal telefonos
                    echo "<div class='modal fade' tabindex='-1' role='dialog' id='datostelefonos' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
							   <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                                  <h4 class='modal-title' id='myModalLabel'><div id='titulostel'></div></h4>
                               </div>
                                <div class='modal-body'>
                                    <div id='datostele'></div>
								</div>
                                <div class='modal-footer'>     								
                                    <input type='button' value='Cerrar' id='cerrarmodaltel' class='btn btn-primary'></input>
                                </div>
                            </div>
                        </div>
                    </div>";
                    // Modal Direccion
                    echo "<div class='modal fade' tabindex='-1' role='dialog' id='datosdireccion' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
							   <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                                  <h4 class='modal-title' id='myModalLabel'><div id='titulosdire'></div></h4>
                               </div>
                                <div class='modal-body'>
                                    <div id='datosdire'></div>
								</div>
                                <div class='modal-footer'>     								
                                    <input type='button' value='Cerrar' id='cerrarmodaldir' class='btn btn-primary'></input>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                echo"</tbody>";
                echo "</table>";
            }
            if($actividades == null)
            {
                "<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h2 class='text-center'>No se crearon actividades para la instituci&oacute;n </h2>
                        </div>
                    </div>";
            }
            if($cont_act_alum == 0){
                echo"<div class='modal fade' tabindex='-1' role='dialog' id='sinalumnos' aria-labelledby='myModalLabel'>
                <div class='modal-dialog'>
                    <div class='modal-content' style='margin-top:300px;'>
						<div class='modal-header'> 
						    <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h4 class='modal-title' id='myModalLabel'><b>¡Atención!</b></h4>
                        </div>
					        <div class='container'>
                                <div class='col-md-8'>
                                    <br/>
									<div class='form-group'>
                                       No hay alumnos inscriptos a $fichains->nombre
                                    </div>
                                </div>
                            </div>
				    <div class='modal-footer'>     								
                        <input type='button' value='Cerrar' id='cerrarmodalalum' class='btn btn-primary'></input>
                    </div>
					</div>
                </div>
             </div>";
            }
			?>
			<script type="text/javascript">
			  $("#sinalumnos").modal('show');
			</script> 
		<?php	
        }
        else {
            $this->redirect(array('../aplication/site/LoginInstitucion'));
        }
        ?>
    </div>
</div>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#lisalumnos').DataTable( {
            "language" : {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",

                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ultimo",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }

        } );

        $("#cerrarmodaltel").click(function(){
            $("#datostelefonos").modal('hide');
        });

        $("#cerrarmodaldir").click(function(){
            $("#datosdireccion").modal('hide');
        });
		
		$("#cerrarmodalalum").click(function(){
		  location.href = '../institucion/home';
        });		  
    } );
</script>
<script type="text/javascript">
    function Mostrartelefonosalumno(idusuario){
        $('#titulostel').empty();
        $('#datostele').empty();
        var idusuario = idusuario;
        var data = {"idusuario":idusuario};
        $.ajax({
            url :  baseurl + "/Institucion/MostrarTelefonosAlumno",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                var telefonos = response.split("|");
                $('#titulostel').append(telefonos[0]);
                $('#datostele').append(telefonos[1]);
                $('#datostelefonos').modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
    function Mostrardireccionalumno(idusuario){
        $('#titulosdire').empty();
        $('#datosdire').empty();
        var idusuario = idusuario;
        var data = {"idusuario":idusuario};
        $.ajax({
            url :  baseurl + "/Institucion/MostrarDireccionAlumno",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                var direcciones = response.split("|");
                $('#titulosdire').append(direcciones[0]);
                $('#datosdire').append(direcciones[1]);
                $('#datosdireccion').modal('show');
            }
        });
    }
</script>