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
        background: url(../img/31.jpg) no-repeat center center fixed;
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
		td:nth-of-type(10):before { content: "Eliminar Profesor"; }
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
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <?php
        if(isset(Yii::app()->session['id_institucion'])){
            $idinstitucion = Yii::app()->user->id;
            $ficins = FichaInstitucion::model()->findByAttributes(array('id_institucion'=>$idinstitucion));
            $profesores = ProfesorInstitucion::model()->findAllByAttributes(array('id_institucion'=>$idinstitucion,'id_estado'=>1));
            if($profesores !=null){
                echo "<div class='fuenteprof'><h3>Profesores inscriptos en $fichains->nombre </h3></div>";
                echo "<br/>";
                echo "<div class='table-responsive'>";
                echo "<table id='lisprofesores' class='display' cellspacing='0' width='100%'>
                 <thead class='fuente'>
                 <th>Nombre</th><th>Apellido</th><th>Dni</th><th>Email</th><th>Sexo</th><th>Fecha Nacimiento</th><th>Tel&eacute;fonos</th><th>Direcci&oacute;n</th><th>Actividades</th><th>Eliminar Profesor</th></thead>
                 <tbody class='fuente'>";
                $cont = 0;
                $profe = array();
                foreach($profesores as $prof){
                    $profesor = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$prof->id_usuario));
                    $profe[$cont] = $prof->id_usuario;
                    ?>
                    <tr>
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
                        <td><input type="button" id="tel" value="Ver tel&eacute;fonos" class="btn btn-primary" onClick="javascript:Mostrartelefonos(<?php echo $prof->id_usuario;?>);"></input></td>
                        <td><input type="button" id="dir" value="Ver direcci&oacute;n" class="btn btn-primary" onClick="javascript:Mostrardireccion(<?php echo $prof->id_usuario;?>);")></input></td>
                        <td><input type="button" id="act" value="Ver actividades" class="btn btn-primary" value="Ver actividades" onClick="javascript:Mostraractividades(<?php echo $prof->id_usuario;?>);")></input></td>
                        <td><input type="button" class="btn btn-primary" value="Eliminar" onClick="javascript:Borrar(<?php echo $prof->id_usuario;?>);"></input></td>
                    </tr>

                    <?php
                    echo "<div class='modal fade' id='borrarprofemodal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                           <div class='modal-dialog' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                   <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                  <h4 class='modal-title' id='myModalLabel'>¡Atención!</h4>
                                </div>
                                <div class='modal-body'>
								<b>¿Estás seguro que desea eliminar al profesor de $ficins->nombre?</b>
								 <br><i><b>(Se borraran todos los alumnos y actividades asociadas a ese profesor).</b></i>
                                 </div>
                                <div class='modal-footer'>
                                  <button type='button' id='si' class='btn btn-primary'>Si</button>
                                  <button type='button' id='no' class='btn btn-default' data-dismiss='modal'>No</button>
                                </div>
                            </div>
                        </div>
                    </div>";
                    echo "<div class='modal fade'  id='mensajeerror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
				           <div class='modal-dialog' role='document'>
					        <div class='modal-content'>
						      <div class='modal-header'>
						          <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							      <h4 class='modal-title' id='myModalLabel'>Eliminar Profesor</h4>
						       </div>
						    <div class='modal-body'>
						       Hubo un error al eliminar el profesor de la instituci&oacute;n.
						    </div>
						    <div class='modal-footer'>
							   <a href='../profesorinstitucion/ListadoProfesores' class='btn btn-primary'>Cerrar</a>
						    </div>
					      </div>
					    </div>
				    </div>";
                    // Modal ok
                    echo "<div class='modal fade'  id='elimexito' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
				           <div class='modal-dialog' role='document'>
					        <div class='modal-content'>
						      <div class='modal-header'>
						          <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							      <h4 class='modal-title' id='myModalLabel'>Eliminar Profesor</h4>
						       </div>
						    <div class='modal-body'>
						       Se elimino el profesor de $ficins->nombre con éxito.
						    </div>
						    <div class='modal-footer'>
							    <a href='../profesorinstitucion/ListadoProfesores' class='btn btn-primary'>Cerrar</a>
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
                    echo "<div class='modal fade' tabindex='-1' role='dialog' id='erracti' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
							   <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                                  <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                               </div>
                                <div class='modal-body'>
                                  <div id='daterracti'></div>
								</div>
                                <div class='modal-footer'>     								
                                    <input type='button' value='Cerrar' id='cerrarmodalsinact' class='btn btn-primary'></input>
                                </div>
                            </div>
                        </div>
                    </div>";

                    // Modal Actividades
                    echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' id='datosactividades' aria-labelledby='myLargeModalLabel'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'> 
						<div class='modal-header'> 
						    <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h4 class='modal-title' id='myModalLabel'><div id='titulosacti'></div></h4>
                        </div>
					        <div class='container'>
                                <div class='col-md-8'> 
                                    <div class='form-group'>
                                        <div id='datosacti'>
                                        </div>
                                    </div>
                                </div>
                            </div>
				    <div class='modal-footer'>     								
                        <input type='button' value='Cerrar' id='cerrarmodalact' class='btn btn-primary'></input>
                    </div>
					</div>
                </div>
             </div>";
                    $cont++;
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            else{
                echo "<div class='modal fade' tabindex='-1' role='dialog' id='sinprofesores' aria-labelledby='myModalLabel'>
                <div class='modal-dialog'>
                    <div class='modal-content'> 
						<div class='modal-header'> 
						    <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h4 class='modal-title' id='myModalLabel'>¡Atención!</h4>
                        </div>
					        <div class='container'>
                                <div class='col-md-8'> 
                                    <br/>
									<div class='form-group'>
                                       <b>No hay profesores asociados a $ficins->nombre. </b>
                                    </div>
                                </div>
                            </div>
				    <div class='modal-footer'>     								
                        <input type='button' value='Cerrar' id='cerrarmodalprofe' class='btn btn-primary'></input>
                    </div>
					</div>
                </div>
             </div>";
			    ?>
				<script type="text/javascript">
				  $("#sinprofesores").modal('show');
				</script>  
			<?php 
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

        $("#cerrarmodaltel").click(function(){
            $("#datostelefonos").modal('hide');
        });

        $("#cerrarmodaldir").click(function(){
            $("#datosdireccion").modal('hide');
        });

        $("#cerrarmodalact").click(function(){
            $("#datosactividades").modal('hide');
        });

        $("#cerrarmodalsinact").click(function(){
            $("#erracti").modal('hide');
        });
		
		$("#cerrarmodalprofe").click(function(){
		   location.href = "../institucion/home";
		});   
    } );
</script>
<script type="text/javascript">
    function Borrar(idusuario){
        $("#borrarprofemodal").modal('show');
        $("#si").click(function(){
            var idprofesor;
            idprofesor = idusuario;
            Borrarprofesor(idprofesor);
        });
        $("#no").click(function(){
            location.reload();
        });
    }
</script>
<script type="text/javascript">
    function Borrarprofesor(idprofesor){
        var data = {"idprofesor":idprofesor};
        $.ajax({
            url :  baseurl + "/ProfesorInstitucion/BorrarProfesor",
            type: "POST",
            dataType : "html",
            data : data,
            cache: false,
            success: function (response){               
				if(response == "ok"){
                    $("#borrarprofemodal").modal('hide');
					$("#elimexito").modal('show');
                }
                if (response == "error"){
                    $('#mensajeerror').modal('show');
                }
            }	,
            error: function (e) {
                console.log(e);
            }
        })
    }

</script>

<script type="text/javascript">
    function Mostrartelefonos(idusuario){
        $('#titulostel').empty();
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
                var telefonos = response.split("|");
                $('#titulostel').append(telefonos[0]);
                $('#datostele').append(telefonos[1]);
                $('#datostelefonos').modal('show');
            }
        });
    }
</script>


<script type="text/javascript">
    function Mostrardireccion(idusuario){
        $('#titulosdire').empty();
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
                var direcciones = response.split("|");
                $('#titulosdire').append(direcciones[0]);
                $('#datosdire').append(direcciones[1]);
                $('#datosdireccion').modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
    function Mostraractividades(idusuario){
        $('#titulosacti').empty();
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
                var actividades = response.split("|");
                if(actividades[0] == "erracti"){
                    $('#daterracti').append(actividades[1]);
                    $("#erracti").modal('show');
                }
                else{
                    $('#titulosacti').append(actividades[0]);
                    $('#datosacti').append(actividades[1]);
                    $('#datosactividades').modal('show');
                }
            }
        });
    }
</script>
