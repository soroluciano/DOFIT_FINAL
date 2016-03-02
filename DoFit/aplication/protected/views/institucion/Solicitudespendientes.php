<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css"></link>
</head>
<body>
<style>
    body {
        background: url(../img/40.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: 0.9;
    }
</style>	
<?php 
if(isset(Yii::app()->session['id_institucion'])){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
$this->renderPartial('../menu/_menuInstitucion');
?>
<?php if(isset(Yii::app()->session['id_institucion'])){ ?>
<div class="container marketing">
    <div class="modal-dialog modal-lg"  style="margin-top:90px;width:100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Profesores que se quieren unir a <?php echo $fichains->nombre;?></b></h4>
            </div> 
	        <div class="modal-body">   
	<?php
    if($profesor_pen != null){
        echo    "<table id='profegim' class='display' cellspacing='0' width='100%'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
								<th>Dni</th>
								<th>E-Mail</th>
								<th> Telefono Fijo</th>
								<th>Celular</th>
								<th>Aceptar</th>
								<th>Cancelar</th>
                            </tr>
                        </thead>
						<tbody>";
        foreach($profesor_pen as $f){
            $fu = FichaUsuario::model()->findAll('id_usuario=:id_usuario',array(':id_usuario'=>$f->id_usuario));
            foreach($fu as $p){
                echo "<tr>
                           <td>$p->nombre</td>
                           <td>$p->apellido</td>
					       <td>$p->dni</td>";
                $usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$f->id_usuario));
                echo "<td>$usuario->email</td>
                           <td>$p->telfijo</td>
                           <td>$p->celular</td>							 
						   <td><input type='button' class='btn btn-primary' value='Aceptar' onclick='Aceptarprofesor($p->id_usuario);'></input></td>
                           <td><input type='button' class='btn btn-primary' value='Cancelar' onclick='Cancelarprofesor($p->id_usuario);'></input></td>
                       </tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
    }
    else
    {
        echo    "<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h5 class='text-center'>No hay solicitud de profesores</h5>
                        </div>
                    </div>";
    }
    echo "</div>
	    </div>
	</div>	
</div>";	
?>
	
<div class="container marketing">
    <div class="modal-dialog modal-lg" style="width:100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Alumnos que se anotaron en actividades</b></h4>
            </div> 
	        <div class="modal-body">   
	<?php		
    if($actividades_pen != null){
        echo    "<table id='alumgim' class='display' cellspacing='0' width='100%'>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
								<th>Dni</th>
								<th>Email</th>
								<th>Telfijo</th>
								<th>Celular</th>
                                <th>Actividad</th>
								<th>Aceptar</th>
								<th>Cancelar</th>
                            </tr>
                        </thead>
						<tbody>";
        foreach($actividades_pen as $a){
            $fua = FichaUsuario::model()->findAll('id_usuario=:id_usuario',array(':id_usuario'=>$a->id_usuario));
            $actividad = Actividad::model()->findByPk($a->id_actividad);
            $deporte = Deporte::model()->findByPk($actividad->id_deporte);

            $actividad_horario = ActividadHorario::model()->findAll('id_actividad = :id',array(':id'=>$a->id_actividad));

            $var = $deporte->deporte. ' - ';

            foreach($actividad_horario as $ah){
                if($ah->id_dia == 1){$dia = "Lunes";};
                if($ah->id_dia == 2){$dia = "Martes";};
                if($ah->id_dia == 3){$dia = "Miercoles";};
                if($ah->id_dia == 4){$dia = "Jueves";};
                if($ah->id_dia == 5){$dia = "Viernes";};
                if($ah->id_dia == 6){$dia = "Sabado";};
                if($ah->id_dia == 7){$dia = "Domingo";};

                $var = $var . ' Dia: '.$dia. ' Horario: '.str_pad($ah->hora,2,'0',STR_PAD_LEFT).':'.str_pad($ah->minutos,2,'0',STR_PAD_LEFT);
            }

            foreach($fua as $t){
                echo "<tr>
                         <td>$t->nombre</td>
                         <td>$t->apellido</td>
					     <td>$t->dni</td>";
                $usuario = Usuario::model()->findByAttributes(array('id_usuario'=>$a->id_usuario));
                echo "<td>$usuario->email</td>
					     <td>$t->telfijo</td>
					     <td>$t->celular</td>
					     <td>$var</td>
                         <td><input type='button' class='btn btn-primary' value='Aceptar' onclick='Aceptaralumno($t->id_usuario,$a->id_actividad);'></input></td>
                         <td><input type='button' class='btn btn-primary' value='Cancelar' onclick='Cancelaralumno($t->id_usuario,$a->id_actividad);'></input></td>
                      </tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
    }
    else
    {
        echo    "<div class='row'>
                        <div class='.col-md-6 .col-md-offset-3'>
                            <h5 class='text-center'>No hay solicitud de inscripción a actividades</h5>
                        </div>
                    </div>";
    }
	echo "</div>
	    </div>
	</div>
</div>";	
    }
    else {
        $this->redirect(array('../aplication/site/LoginInstitucion'));
    }
    ?>
</body>
</html>   
    <script type="text/javascript">
        $(document).ready(function() {
            $('#profegim').DataTable( {
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
        $(document).ready(function() {
            $('#alumgim').DataTable( {
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

<!-- Modals !-->
   <div class='modal fade' id='aceprof' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        <p id='profesor'></p> se adhiri&oacute; correctamente a <?php echo $fichains->nombre;?>.
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' onclick="Recargar();">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>
   <div class='modal fade' id='canceprof' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        Se cancelo la solicitud de <p id='profesorcanc'></p> a <?php echo $fichains->nombre;?>.
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' onclick="Recargar();">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>

   <div class='modal fade' id='acepalumn' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        <p id='alumno'></p> se inscribio correctamente a la actividad.
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' onclick="Recargar();">Cerrar</button>
                    </div>
            </div>
        </div>
    </div>

    <div class='modal fade' id='cancalumn' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
               <div class='modal-header'>
                    <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                </div>
                    <div class='modal-body'>
                        Se cancelo la inscripción de <p id='alumnocanc'></p> a la actividad.
                    </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' onclick="Recargar();">Cerrar</button>
                </div>
            </div>
        </div>
    </div>   	
	
<script type="text/javascript">
 function Aceptarprofesor(idprofesor)
 {
	var idprofesor = idprofesor;
	var data = {'idprofesor':idprofesor};
        $.ajax({
            url: baseurl + '/institucion/Aceptar',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                respuesta = response.split("|");
				if(respuesta[0] == "ok"){
				   $("#profesor").css('display','inline');
				   $("#profesor").append(respuesta[1]);
				   $("#aceprof").modal('show');
                }  
            }
        })
 }
 
 function Cancelarprofesor(idprofesor)
 {
	var idprofesor = idprofesor;
	var data = {'idprofesor':idprofesor};
        $.ajax({
            url: baseurl + '/institucion/Cancelar',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                respuesta = response.split("|");
				if(respuesta[0] == "ok"){
				   $("#profesorcanc").css('display','inline');
				   $("#profesorcanc").append(respuesta[1]);
				   $("#canceprof").modal('show');
                }  
            }
        })
 }
</script> 

<script type="text/javascript">
function Aceptaralumno(idalumno, idactividad)
{
    var idalumno = idalumno;
    var idactividad = idactividad;
    var data = {'idalumno':idalumno,'idactividad': idactividad};
        $.ajax({
            url: baseurl + '/institucion/AceptarAlumno',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                respuesta = response.split("|");
				if(respuesta[0] == "ok"){
				   $("#alumno").css('display','inline');
				   $("#alumno").append(respuesta[1]);
				   $("#acepalumn").modal('show');
                }  
            }
        })
}

function Cancelaralumno(idalumno, idactividad)
{
    var idalumno = idalumno;
    var idactividad = idactividad;
    var data = {'idalumno':idalumno,'idactividad': idactividad};
        $.ajax({
            url: baseurl + '/institucion/CancelarAlumno',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                respuesta = response.split("|");
				if(respuesta[0] == "ok"){
				   $("#alumnocanc").css('display','inline');
				   $("#alumnocanc").append(respuesta[1]);
				   $("#cancalumn").modal('show');
                }  
            }
        })
}		
</script>		
<script type="text/javascript">
 function Recargar(){ 
   location.reload();	 
 }
</script> 


