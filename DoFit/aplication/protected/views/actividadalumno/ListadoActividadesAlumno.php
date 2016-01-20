<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide">
            </a></img>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Bienvenido! <?php
                        if(isset(Yii::app()->session['id_usuario'])){
                            //Es un usuario logueado.
                            $Us = Usuario::model()->findByPk(Yii::app()->user->id);
                            $ficha = FichaUsuario::model()->find('id_usuario=:id_usuario',array(':id_usuario'=>$Us->id_usuario));
                            echo $ficha->nombre."&nbsp".$ficha->apellido;
                        } ?></a></li>
                <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
            </ul>
        </nav>
    </div>
</header>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="principal" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Actividades de <?php echo $ficha->nombre . "&nbsp". $ficha->apellido;?></b></h4>
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
                                    echo $ins['nombre'];
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
        ?>
</html>
<script type="text/javascript">
    $(document).ready(function() {
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