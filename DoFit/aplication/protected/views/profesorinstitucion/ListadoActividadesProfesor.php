<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>
<style type="text/css">
    body {
        background: url(../img/futbol.jpg) no-repeat center center fixed;
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
<br/>
<br/>
<br/>
<br/>
<?php
if(isset(Yii::app()->session['id_usuario'])){
    //Es un usuario logueado.
    $Us = Usuario::model()->findByPk(Yii::app()->user->id);
    $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
}
?>
<?php  if(isset(Yii::app()->session['id_usuario'])){ ?>
    <?php if($instituciones != NULL){  ?>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="principal" aria-labelledby="myLargeModalLabel">
            <?php $this->renderPartial('../menu/_menu');?>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
					    <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/index">&times;</a></span></button>
                        <h4 class='modal-title'>
                            <b>Actividades dictadas por
                                <?php if(isset(Yii::app()->session['id_usuario'])){
                                    //Es un usuario logueado.
                                    $Us = Usuario::model()->findByPk(Yii::app()->user->id);
                                    $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
                                    echo $ficha->nombre . "&nbsp" . $ficha->apellido;
                                } ?>
                            </b>
                        </h4>
                    </div>
                    <div class='modal-body'>
                        <h5><b>Instituci&oacute;n</b></h5>
                        <select id="idinstitucion" class="form-control" onchange="javascript:ConsultarActividadesInscripto();">
                            <?php
                            if(isset(Yii::app()->session['id_usuario'])){
                                echo "<option value='empty' class='form-control'>Seleccione una instituci&oacute;n</option>";
                                foreach($instituciones as $ins){
                                    echo $ins['nombre'];
                                    echo "<option  value=".$ins['id_institucion']." name=".$ins['id_institucion'].">".$ins['nombre']."</option>";
                                }
                            }
                            ?>
                        </select>
                        <br/>
                        <div class="form-group" id="mostraractividades">
                        </div>
                        <br/>
                    </div>
                    <div class='modal-footer'>
                        <a href="../site/index" class="btn btn-primary" align="center">Volver</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="aluminsc" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss='modal'  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Alumnos inscriptos en <p id="actividad"></p> en <p id="institucion"></p></b></h4>
                    </div>
                    <div class='modal-body'>
                        <div id="actaluminsc">
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Error -->
        <div class='modal fade' id='erroractividades' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        No dictas ninguna actividad para esa Instituci&oacute;n
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
		<div class="modal fade" tabindex="-1" role="dialog" id="sinalumnos" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss='modal' aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>¡Atención!</p></b></h4>
                    </div>
                    <div class='modal-body'>
                        <h5><b>No hay alumnos inscriptos en <p id="acti"></p> en <p id="insti"></p></b></h5>
                    </div>
                    <div class='modal-footer'>
                        <button class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
			$('#principal').modal({
               backdrop: 'static',
               keyboard: false
		    });
            $("#principal").modal('show');			
        </script>
    <?php }
    else{?>
        <div class='modal fade' id='inserror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="location.href='../site/index'";><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                    </div>
                    <div class='modal-body'>
                        No estas inscripto en ninguna institución.
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="location.href='../site/index'";>Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $("#inserror").modal('show');
        </script>
        <?php
    }
}
else
{
    $this->redirect("../aplication/site/Login");
}
?>
</html>
<script type="text/javascript">
    function ConsultarActividadesInscripto()
    {
        $('#mostraractividades').empty();
        var idinstitucion = $('#idinstitucion').val();
        var data = {'idinstitucion':idinstitucion};
        $.ajax({
            url: baseurl + '/profesorinstitucion/ConsultarActividadesInscripto',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                if(response == "error"){
                    $('#erroractividades').modal('show');
                }
                else{
                    $('#mostraractividades').append(response);
                }
            }
        })
    }
</script>

<script type="text/javascript">
    function AlumnosInscriptos(idactividad)
    {
        $('#actividad').empty();
		$('#institucion').empty();
		$("#acti").empty();
		$("#insti").empty();
		$('#actaluminsc').empty();
        var id_actividad = idactividad;
        var data = {'idactividad':id_actividad};
        $.ajax({
            url: baseurl + '/profesorinstitucion/AlumnosInscriptosActividad',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
				aluminscriptos = response.split("|");
			    $("#actividad").css("display","inline");
				$("#institucion").css("display","inline");
				$("#actividad").append(aluminscriptos[1]);
			    $("#institucion").append(aluminscriptos[2]);
                if(aluminscriptos[0] == "sinalumnos"){
                   $("#acti").css("display","inline");
				   $("#insti").css("display","inline");
				   $("#acti").append(aluminscriptos[1]);
			       $("#insti").append(aluminscriptos[2]);
				   $("#sinalumnos").modal('show');
				}
				else{
				   $('#actaluminsc').append(aluminscriptos[0]);
				   $('#aluminsc').modal('show');
				}   
            } 
        })
    }
</script>
  
