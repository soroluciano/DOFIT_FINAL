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
        background: url(../img/fondo1.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
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
            $cant_alumnos = 0;
            $actividades = Actividad::model()->findAll('id_institucion=:id_institucion',array(':id_institucion'=>$idinstitucion));
            if($actividades !=null){
                echo "<div><h3>Alumnos inscriptos en $fichains->nombre</h3></div>";
                echo "<br/>";
                echo "<table id='lisalumnos' class='display' cellspacing='0' width='100%'>
                      <thead>
                      <tr><th>Nombre</th><th>Apellido</th><th>Dni</th><th>Email</th><th>Sexo</th><th>Fecha Nacimiento</th><th>Tel&eacute;fonos</th><th>Direcci&oacute;n</th><th>Actividades</th></tr></thead>
                      <tbody>";
                foreach($actividades as $acti){
                    $actividades_alumnos = ActividadAlumno::model()->findAll('id_actividad=:id_actividad AND id_estado=:id_estado',array(':id_actividad'=>$acti->id_actividad,'id_estado'=>1));
                    if($actividades_alumnos != null){
                        $cant_alumnos++;
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
                                    <td><a id="tel" href="#" onClick="javascript:Mostrartelefonosalumno(<?php echo $id_usuario;?>);">Ver tel&eacute;fonos</a></td>
                                    <td><a id="dir" href="#" onClick="javascript:Mostrardireccionalumno(<?php echo $id_usuario;?>);")>Ver direcci&oacute;n</a></td>
                                    <td id="act"><a href="../actividadalumno/Veractividades/<?php echo $id_usuario?>">Ver actividades</a></td>
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
                                    <a href='../institucion/ListadoAlumnosxInstitucion' class='btn btn-primary'>Cerrar</a>
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
                                    <a href='../institucion/ListadoAlumnosxInstitucion' class='btn btn-primary'>Cerrar</a>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                echo"</tbody>";
                echo "</table>";
            }
            else{
                "<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h2 class='text-center'>No se crearon actividades para la instituci&oacute;n </h2>
                        </div>
                    </div>";
            }
            if($cant_alumnos == 0){
                echo"<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h2 class='text-center'>No hay alumnos inscriptos en la instituci&oacute;n </h2>
                        </div>
                    </div>";
            }
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