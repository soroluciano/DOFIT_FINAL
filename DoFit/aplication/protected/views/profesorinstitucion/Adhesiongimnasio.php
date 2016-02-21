<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>
<style type="text/css">
    body {
        background: url(../img/27.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php if(isset(Yii::app()->session['id_usuario'])){?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="principal" aria-labelledby="myLargeModalLabel">
        <?php $this->renderPartial('../menu/_menu');?>
		<div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
				    <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/index">&times;</a></span></button>
                    <h4 class="modal-title"><b>¡Adhirete a una institución como profesor!</b></h4>
				</div>
                <div class="container">
                    <div class="form">
                        <div class="col-md-9">
                            <div class="form-group">
                                <br/>
                                <?php $form=$this->beginWidget('CActiveForm', array('id'=>'usuario-form', 'enableAjaxValidation'=>false, 'enableClientValidation'=>true, 'clientOptions'=>array('validateOnSubmit'=>true,),));?>
                                <?php echo $form->labelEx($localidad,'Provincia'); ?>
                                <?php echo $form->dropDownList($localidad,'id_provincia',CHtml::listData(Provincia::model()->findAll(),'id_provincia','provincia'),
                                    array('ajax'=>array('type'=>'POST',
                                        'url'=>CController::createUrl('Usuario/SeleccionarLocalidad'),
                                        'update'=>'#'.CHtml::activeId($localidad,'id_localidad'),
                                    ),'prompt'=>'Seleccione tu Provincia','class'=>"form-control"));?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($localidad,'Localidad'); ?>
                                <div>
                                    <?php echo $form->dropDownList($localidad,'id_localidad',array('empty'=>"Selecciona tu localidad"),array('class'=>"form-control",'onchange'=>"ConsultarInstituciones();")); ?>
                                </div>
                                <br/>
                                <div id="mostrargimnasios">
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
				<div class='modal-footer'>
				     <a href="../site/index" class="btn btn-primary">Volver</a>
				</div>	 
				</div>   
            </div>
        </div>
    </div>
    <!-- Modal Exito !-->
    <div class='modal fade' id='solicitudok' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                   <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="location.reload();"><span aria-hidden='true'>&times;</span></button>
                    <h4 class='modal-title' id='myModalLabel'>¡Felicidades!</h4>
                </div>
                <div class='modal-body'>
                    Se envio la solicitud correctamente.
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal' onclick='location.reload();'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error !-->
    <div class='modal fade' id='solicituderror' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                </div>
                <div class='modal-body'>
                    Hubo un error al enviar la solicitud a la Instituci&oacute;n.
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error busqueda !-->
    <div class='modal fade' id='errorbusqueda' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="Resetarprovloc();"><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>¡Error!</h4>
                </div>
                <div class='modal-body'>
                    No se encontro ninguna institución para la provincia y localidad solicitada.
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="Resetarprovloc();">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
        <!-- Modal Solicitudes enviadas a todas las insitituciones !-->
    <div class='modal fade' id='solcompletas' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick="Resetarprovloc();"><span aria-hidden='true'>&times;</span></button>
					<h4 class='modal-title' id='myModalLabel'>¡Atención!</h4>
                </div>
                <div class='modal-body'>
                 Se enviaron solicitudes a todas las instituciones para la provincia y localidad seleccionada.
                 Consulte la opción <b>"Estado de las instituciones"</b> para mayor información. 
				</div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="Resetarprovloc();">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
	
    <?php
}
else
{
    $this->render('../site/login');
}
$this->endWidget();?>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#principal').modal({
           backdrop: 'static',
           keyboard: false
		});
		$('#principal').modal('show');
    });
</script>

<script type="text/javascript">
    function ConsultarInstituciones()
    {
        $('#mostrargimnasios').empty();
        var localidad = $('#Localidad_id_localidad').val();
        var data = {'localidad':localidad};
        $.ajax({
            url: baseurl + '/profesorinstitucion/MostrarInstituciones',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                if(response == "errorbusqueda"){
                    $("#errorbusqueda").modal('show');
                }
                if(response == "solcompletas"){
                    $("#solcompletas").modal('show');
                }
                if(response != "errorbusqueda" && response != "solcompletas")
                {
                    $('#mostrargimnasios').append(response);
                }
            }
        })
    }
</script>
<script type="text/javascript">
    function Enviarsolicitud(id_institucion)
    {
        var id_institucion = id_institucion;
        var data = {'id_institucion':id_institucion};
        $.ajax({
            url: baseurl + '/profesorinstitucion/EnviarSolicitud',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                if(response == "solicitudok"){
                    $('#solicitudok').modal('show');
                }
                if(response == "solicituderror"){
                    $("#solicituderror").modal('show');
                }
            }
        })
    }
</script>
<script type="text/javascript">
    function Resetarprovloc()
    {
        $('#Localidad_id_provincia').val("");
        $('#Localidad_id_localidad').val("");
    }
</script>

<script type="text/javascript">
    function Mostrarubicacion(nombre, direccion, localidad, provincia)
    {
        var nombre = nombre;
        var direccion = direccion;
        var localidad = localidad;
        var provincia = provincia;
        window.open("../fichaInstitucion/googlemaps?nombre="+nombre+"&direccion="+direccion+"&localidad="+localidad+"&provincia="+provincia+"",'','width=600, height=590');
    }
</script>   