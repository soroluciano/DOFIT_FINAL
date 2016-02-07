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
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../profesorinstitucion/ListadoActividades">&times;</a></span></button>
                        <h4 class="modal-title"><b>Alumnos Inscriptos en la actividad</b></h4>
                    </div>
                    <br/>
                    <div class='modal-body'>
                        <div id="actaluminsc">
                        </div>
                    </div>
                    <br/>
                    <div class='modal-footer'>
                        <a href="../profesorinstitucion/ListadoActividades" class="btn btn-primary">Cerrar</a>
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
        <script type="text/javascript">
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
                $('#actaluminsc').append(response);
                $('#aluminsc').modal('show');
            }
        })
    }
</script>
  
