<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css"></link>
</head>

<?php if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
$this->renderPartial('../menu/_menuInstitucion');
?>

<div class="container">
    <div class='row'>
        <?php
        echo"<br>
        <br>
        <br>
        <br>
        <br>
        <br>";
        if($actividades_alumno != null) {
            echo "<table id='veractividades' class='display' cellspacing='0' width='100%'>
	            <thead class='fuente'>
		          <tr><th>Deporte</th><th>Días y Horarios</th><th>Valor actividad</th><th>Desafectar actividad</th></tr>
		        </thead>
		        <tbody class='fuente'>";
            foreach ($actividades_alumno as $act_alum) {
                $act = Actividad::model()->findByAttributes(array('id_institucion' => $ins->id_institucion, 'id_actividad' => $act_alum->id_actividad));
                if ($act != null) {
					echo "<tr>";
                    echo "<input type='hidden' value='$act->id_actividad' id='idactividad'></input>";
                    echo "<input type='hidden' value='$act_alum->id_usuario' id='idalumno'></input>";
                    $deporte = Deporte::model()->findByAttributes(array('id_deporte' =>$act->id_deporte));
                    echo "<td id='depo'>$deporte->deporte</td>";
                    $acti_horarios = ActividadHorario::model()->findAllByAttributes(array('id_actividad' => $act->id_actividad));
                    echo "<td id='diahor'>";
                    foreach($acti_horarios as $act_hor){
                        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
                        $id_dia = $act_hor->id_dia-1;
                        echo $dias[$id_dia]."&nbsp;".$act_hor->hora .':'.($act_hor->minutos == '0' ? '0'.$act_hor->minutos : $act_hor->minutos)." - ";
                    }
                    echo "</td>";
				
                    ?>
                    <td id='valor'><?php echo  $act->valor_actividad;?></td>
                    <td id='elim'><a href="" data-toggle="modal" data-target="#myModal">Desafectar actividad</a></td>
                    </tr>
					<?php
                    echo "
                     <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
						<div class='modal-dialog' role='document'>
						 <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                      <h4 class='modal-title' id='myModalLabel'>Inscripción</h4>
                  </div>
                  <div class='modal-body'>
                   ¿Estas seguro que desea desafectar al alumno de la actividad?
                  </div>
                 <div class='modal-footer'>
                  <button type='button' class='btn btn-primary' onclick='javascript:desafectaractividad();'>Si</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>No</button>
                </div>
              </div>
            </div>
         </div>";
                }
            }
            echo "</tbody>
	           </table>";
        }
        else
        {
            echo "<h3>El usuario no se inscribio en ninguna actividad</h3><br/>";
        }
        ?>
    </div>
</div>
</html>
<script type="text/javascript">
    function desafectaractividad()
    {
        var idactividad = $('#idactividad').val();
        var idalumno = $('#idalumno').val();
        var data = {"idactividad":idactividad,"idalumno":idalumno};
        $.ajax({
            url :  baseurl + "/actividadalumno/DesafectarActividad",
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
    $('#veractividades').DataTable( {
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
</script>			 