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
        td:nth-of-type(1):before { content: "Deporte"; }
        td:nth-of-type(2):before { content: "Días y horarios"; }
        td:nth-of-type(3):before { content: "Profesor"; }
        td:nth-of-type(4):before { content: "Estado"; }
        td:nth-of-type(5):before { content: "Valor Mensual"; }
        td:nth-of-type(6):before { content: "Mercado Pago"; }
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
<?php if(isset(Yii::app()->session['id_usuario'])){?>
<?php if($instituciones != NULL){  ?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="principal" aria-labelledby="myLargeModalLabel">
    <?php $this->renderPartial('../menu/_menu');?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                 <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><a href="../site/index">&times;</a></span></button>
				<h4 class="modal-title"><b>Actividades de
                        <?php
                        if(isset(Yii::app()->session['id_usuario'])){
                            //Es un usuario logueado.
                            $Us = Usuario::model()->findByPk(Yii::app()->user->id);
                            $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
                            echo $ficha->nombre."&nbsp".$ficha->apellido;
                        }
                        ?></b>
                </h4>
            </div>
            <div class="container">
                <div class="form">
                    <div class="col-md-9">
                        <div class="form-group">
                            <br/>
                            <h5><b>Instituci&oacute;n</b></h5>
                            <select id="idinstitucion" class="form-control" onchange="javascript:ConsultarActividades();">
                                <?php
                                echo "<option value='empty' class='form-control'>Seleccione una instituci&oacute;n</option>";
                                foreach($instituciones as $ins){
                                    echo "<option  value=".$ins['id_institucion']." name=".$ins['id_institucion'].">".$ins['nombre']."</option>";
                                }
                                ?>
                            </select>
                            <div id="mostraractividades">
                            </div>
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
                            No estas inscripto en ninguna institución.
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-primary' data-dismiss='modal' onclick="location.href='../site/index'";>Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#inserror').modal('show');
            </script>
        <?php }
        }
        else
        {
            $this->redirect("../aplication/");
        }
        ?>
</html>
<script type="text/javascript">
    $(document).ready(function() {
		$('#principal').modal({
           backdrop: 'static',
           keyboard: false
		});   
        $('#principal').modal('show');
    })
</script>

<script type="text/javascript">
    function ConsultarActividades(){
        $('#mostraractividades').empty();
        var idinstitucion = $('#idinstitucion').val();
        var data = {'idinstitucion':idinstitucion};
        $.ajax({
            url: baseurl + '/actividadalumno/ConsultarActividades',
            type: "POST",
            data: data,
            dataType: "html",
            cache : false,
            success : function(response){
                $('#mostraractividades').append(response);
            }
        })
    }
</script>	