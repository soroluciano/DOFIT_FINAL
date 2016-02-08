<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
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
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <?php
        if(isset(Yii::app()->session['id_institucion'])){
            $idinstitucion = Yii::app()->user->id;
            $profesores = ProfesorInstitucion::model()->findAll('id_institucion=:id_institucion',array(':id_institucion'=>$idinstitucion));
            if($profesores !=null){
                echo "<div><h3>Profesores inscriptos en $fichains->nombre </h3></div>";
                echo "<br/>";
                echo "<table id='lisprofesores' class='display' cellspacing='0' width='100%'>
                 <thead class='fuente'>
                 <th>Nombre</th><th>Apellido</th><th>Dni</th><th>Email</th><th>Sexo</th><th>Fecha Nacimiento</th><th>Tel&eacute;fonos</th><th>Direcci&oacute;n</th><th>Actividades</th><th>Eliminar Profesor</th></thead>
                 <tbody class='fuente'>";
                foreach($profesores as $prof){
                    $profesor = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$prof->id_usuario));
                    ?>
                    <tr>
                        <input type="hidden" value="<?php echo $prof->id_usuario?>" name="idprofesor" id="idprofesor">
                        </input>
                        <input type="hidden" name="valor" id="valor"></input>
                        <td id="nombre"><?php echo $profesor->nombre;?></td>
                        <td id="apellido"><?php echo $profesor->apellido;?></td>
                        <td id="dni"><?php echo $profesor->dni; ?></td>
                        <td id="email">
                            <?php
                            $usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$prof->id_usuario));
                            echo $usuario->email;?></td>
                        <td id="sexo">
                            <?php
                            if($profesor->sexo == 'M'){
                                echo "Masculino";
                            }
                            if($profesor->sexo == 'F'){
                                echo "Femenino";
                            }
                            ?>
                        </td>
                        <td id="fecnac">
                            <?php $fechanac = date("d-m-Y",strtotime($profesor->fechanac));
                            echo $fechanac;?>
                        </td>
                        <td><a id="tel"  href="#" onClick="javascript:Mostrartelefonos(<?php echo $prof->id_usuario;?>);">Ver Tel&eacute;fonos</a></td>
                        <td><a id="dir"  href="#" onClick="javascript:Mostrardireccion(<?php echo $prof->id_usuario;?>);")>Ver Direcci&oacute;n</a></td>
                        <td><a id="act"  href="#" onClick="javascript:Mostraractividades(<?php echo $prof->id_usuario;?>);")>Ver Actividades</td>
                        <td><a href="#" data-toggle="modal" data-target="#borrarprofemodal">Eliminar de la Institución</a></td>
                    </tr>

                    <?php
                    echo "<div class='modal fade' id='borrarprofemodal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                           <div class='modal-dialog' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                   <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                  <h4 class='modal-title' id='myModalLabel'>Inscripción</h4>
                                </div>
                                <div class='modal-body'>
                                ¿Estas seguro que desea elimnar al profesor de la instituci&oacute;n?
                                 </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-primary' onclick='javascript:Borrarprofesor($prof->id_usuario);'>Si</button>
                                  <button type='button' class='btn btn-default' data-dismiss='modal'>No</button>
                                </div>
                            </div>
                        </div>
                    </div>";
                    echo "<div class='modal fade'  id='mensajeerror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
				           <div class='modal-dialog' role='document'>
					        <div class='modal-content'>
						      <div class='modal-header'>
						          <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							      <h4 class='modal-title' id='myModalLabel'>Recuperar contraseña</h4>
						       </div>
						    <div class='modal-body'>
						       Hubo un error al eliminar el profesor de la instituci&oacute;n.
						    </div>
						    <div class='modal-footer'>
							   <button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>
						    </div>
					      </div>
					    </div>
				    </div>";
                    // Modal telefonos
              echo "<div class='modal fade' tabindex='-1' role='dialog' id='datostelefonos' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
							   <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                                  <h4 class='modal-title' id='myModalLabel'><center><b>Datos Tel&eacute;fonicos de&nbsp;" .$profesor->nombre."&nbsp".$profesor->apellido."</b></center></h4>
                               </div>
                                <div class='modal-body'>
                                    <div id='datostele'></div>
								</div>
                                <div class='modal-footer'>     								
                                    <a href='../profesorinstitucion/ListadoProfesores' class='btn btn-primary'>Cerrar</a>
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
                                  <h4 class='modal-title' id='myModalLabel'><center><b>Datos domiciliarios de&nbsp;" .$profesor->nombre."&nbsp".$profesor->apellido."</b></center></h4>
                               </div>
                                <div class='modal-body'>
                                    <div id='datosdire'></div>
								</div>
                                <div class='modal-footer'>     								
                                    <a href='../profesorinstitucion/ListadoProfesores' class='btn btn-primary'>Cerrar</a>
                                </div>
                            </div>
                        </div>
                    </div>";

                    // Modal Actividades
                    echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' id='datosactividades' aria-labelledby='myLargeModalLabel'>
                    <div class='modal-dialog modal-lg'>
                        <div class='modal-content'>
                            <div class='container'>
                                <div class='col-md-8'>
                                    <div class='form-group'>
                                        <div id='datosacti'>
                                        </div>
                                        <a href='../profesorinstitucion/ListadoProfesores' class='btn btn-primary'>Cerrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                echo "</tbody>";
                echo "</table>";
            }
            else{
                echo "<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h2 class='text-center'>No hay Profesores asociados a la instituci&oacute;n</h2>
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
        $('#lisprofesores').DataTable( {
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
    function Borrarprofesor(idprofesor)
    {
        var idprofesor = $('#idprofesor').val();
        var data = {"idprofesor":idprofesor};
        $.ajax({
            url :  baseurl + "/ProfesorInstitucion/BorrarProfesor",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                if(response == "ok"){
                    location.reload();
                }
                if (response == "error"){
                    $('#mensajeerror').modal('show');
                }
            }	,
            error: function (e) {
                console.log(e);
            }
        });

    }
</script>

<script type="text/javascript">
    function Mostrartelefonos(idusuario){
        $('#datostele').empty();
        var idusuario = idusuario;
        var data = {"idusuario":idusuario};
        $.ajax({
            url :  baseurl + "/ProfesorInstitucion/MostrarTelefonos",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                $('#datostele').append(response);
                $('#datostelefonos').modal('show');
            }
        });
    }
</script>


<script type="text/javascript">
    function Mostrardireccion(idusuario){
        $('#datosdire').empty();
        var idusuario = idusuario;
        var data = {"idusuario":idusuario};
        $.ajax({
            url :  baseurl + "/ProfesorInstitucion/MostrarDireccion",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                $('#datosdire').append(response);
                $('#datosdireccion').modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
    function Mostraractividades(idusuario){
        $('#datosacti').empty();
        var idusuario = idusuario;
        var data = {"idusuario":idusuario};
        $.ajax({
            url :  baseurl + "/ProfesorInstitucion/MostrarActividades",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){
                $('#datosacti').append(response);
                $('#datosactividades').modal('show');
            }
        });
    }
</script>
