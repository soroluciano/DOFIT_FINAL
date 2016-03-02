<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>
<style type="text/css">
    body {
        background: url(../img/28.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
		opacity: 0.96;
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
                                <?php 
                                foreach($anio as $an){
                                    echo "<option value=".$an['anio']." name=".$an['anio'].">".$an['anio']."</option>";
								}
                               	?>	
                            </select>								
                            <h5><b>Mes</b></h5>
                            <select id='mes' class="form-control" onchange="javascript:MostrarPagosAlumno();">
                                <option value='empty'>Seleccione un mes</option>
                                <?php 
								$arrmeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
								foreach($meses as $me){
								    $mes = $me['mes']-1;
								    echo "<option value=".$me['mes']." name=".$me['mes'].">".$arrmeses[$mes]."</option>";
                                }
                                ?>																   
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
        if($instituciones == NULL)
        {
            ?>
            <div class='modal fade' id='inserror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="location.href='../site/index'";><span aria-hidden='true'>&times;</span></button>
                            <h4 class='modal-title' id='myModalLabel'>&#161;Atenci&oacute;n!</h4>
                        </div>
                        <div class='modal-body'>
                            No se registraron pagos en las instituciones donde est&aacute;s inscripto.
                        </div>
                        <div class='modal-footer'>
                            <input type='button' class='btn btn-primary' id='cerrarmodalsi' value="Atras"></button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#inserror').modal('show');
            </script>
            <?php

        }
        ?>
        <div class='modal fade' id='modalerrpago' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title' id='myModalLabel'>&#161;Atenci&oacute;n!</h4>
                    </div>
                    <div class='modal-body'>
                        No se registraron pagos en <p id="ins"></p> para el a&ntilde;o y mes seleccionados.
                    </div>
                    <div class='modal-footer'>
                        <input type='button' class='btn btn-primary' value="Cerrar" id='cerrarerrpagos'></button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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
            location.href = '../site/index';
        });
    });

    function MostrarPagosAlumno()
    {
        $("#mostrarpagos").empty();
        $("#ins").empty();
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
                    respuesta = response.split("|");
                    if(respuesta[0] == "errorpago"){
                        $("#ins").css("display","inline");
                        $("#ins").append(respuesta[1]);
                        $("#modalerrpago").modal('show');
                    }
                    else{
                        $("#mostrarpagos").append(respuesta[0]);
                        $("#mostrarpagos").modal('show');
                    }
                }
            })

        }
    }
	
	function ver_factura(idactividad, idusuario, mes, anio) {
        var id = idactividad;
        var usuario = idusuario;
        var anio = anio;
        var mes = mes;
        if (id != "") {
            if(usuario != ""){
                if(anio != ""){
                    if(mes != "") {
                        window.open("../pago/factura?idusuario="+usuario+"&idactividad="+id+"&anio="+anio+"&mes="+mes,'','width=1000, height=1000');
                    }
                }
            }
        }
    }
	
</script>