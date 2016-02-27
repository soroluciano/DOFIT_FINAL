<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>
<style type="text/css">
    body {
        background: url(../img/26.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php if(isset(Yii::app()->session['id_usuario'])){?>
<?php if($instituciones != NULL){  ?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modalpagos" aria-labelledby="myLargeModalLabel">
    <?php  $this->renderPartial('../menu/_menu');?>
    <br/>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/index">&times;</a></span></button>
                <h4 class="modal-title"><b>Pagos realizados por
                        <?php
                        $Us = Usuario::model()->findByPk(Yii::app()->user->id);
                        $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
                        echo $ficha->nombre."&nbsp".$ficha->apellido;
                        ?></b>
                </h4>
            </div>
            <div class="container">
                <div class="form">
                    <div class="col-md-9">
                        <div class="form-group">
                            <br/>
                            <h5><b>Instituci&oacute;n </b></h5>
                            <select id="idinstitucion" class="form-control" onchange="javascript:MostrarPagosAlumno();">
                                <?php
                                echo "<option value='empty' class='form-control'>Seleccione una instituci&oacute;n</option>";
                                foreach($instituciones as $ins){
                                    echo "<option  value=".$ins['id_institucion']." name=".$ins['id_institucion'].">".$ins['nombre']."</option>";
                                }
                                ?>
                            </select>
                            <h5><b>A&ntilde;o</b></h5>
                            <select id='anio' class="form-control" onchange="javascript:MostrarPagosAlumno();">
                                <option value='empty'>Seleccione un a&ntilde;o</option>
                                <option value='2013'>2013</option>
                                <option value='2014'>2014</option>
                                <option value='2015'>2015</option>
                                <option value='2016'>2016</option>
                                <option value='2017'>2017</option>
                            </select>
                            <h5><b>Mes</b></h5>
                            <select id='mes' class="form-control" onchange="javascript:MostrarPagosAlumno();">
                                <option value='empty'>Seleccione un mes</option>
                                <option value='1'>Enero</option>
                                <option value='2'>Febrero</option>
                                <option value='3'>Marzo</option>
                                <option value='4'>Abril</option>
                                <option value='5'>Mayo</option>
                                <option value='6'>Junio</option>
                                <option value='7'>Julio</option>
                                <option value='8'>Agosto</option>
                                <option value='9'>Septiembre</option>
                                <option value='10'>Octubre</option>
                                <option value='11'>Noviembre</option>
                                <option value='12'>Diciembre</option>
                            </select>
                            <br/>
                            <div id="mostrarpagos"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <a href="../site/index" class="btn btn-primary">Volver</a>
            </div>
        </div>
        <?php
        }
        else{
            ?>
            <div class='modal fade' id='inserror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="location.href='../site/index'";><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                        </div>
                        <div class='modal-body'>
                            No estas inscripto en ninguna institución por lo tanto no generaste ningún pago.
                        </div>
                        <div class='modal-footer'>
                            <input type='button' class='btn btn-primary' id='cerrarmodalsi'>Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#inserror').modal('show');
            </script>
            <?php
        }
        }
        ?>
        <div class='modal fade' id='modalerrpago' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>¡Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        No se registraron pagos en la instituci&oacute;n para el a&ntilde;o y mes seleccionados.
                    </div>
                    <div class='modal-footer'>
                        <input type='button' class='btn btn-primary' value="Cerrar" id='cerrarerrpagos'></button>
                    </div>
                </div>
            </div>
        </div>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalpagos').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#modalpagos").modal('show');
        $("#cerrarerrpagos").click(function(){
            $("#modalerrpago").modal('hide');
        });
        $("#cerrarmodalsi").click(function(){
            $("#inserror").modal('hide');
        });
    });

    function MostrarPagosAlumno()
    {
        $("#mostrarpagos").empty();
        var idinstitucion = $("#idinstitucion").val();
        var mes = $("#mes").val();
        var anio = $("#anio").val();
        if(idinstitucion != "empty" && mes != "empty" && anio != "empty"){
            var data = {'idinstitucion':idinstitucion, 'mes': mes, 'anio': anio};
            $.ajax({
                url: baseurl + '/pago/MostrarPagosAlumno',
                type: "POST",
                data: data,
                dataType: "html",
                cache : false,
                success : function(response){
                    if(response == "errorpago"){
                        $("#modalerrpago").modal('show');
                    }
                    else{
                        $("#mostrarpagos").append(response);
                        $("#mostrarpagos").modal('show');
                    }
                }
            })

        }
    }
</script>