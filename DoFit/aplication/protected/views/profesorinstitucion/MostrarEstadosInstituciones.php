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
            <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide">
            <a href="../" class="navbar-brand"></a>
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
        background: url(../img/27.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php if(isset(Yii::app()->session['id_usuario'])){
    if($profesor_institucion != NULL){
        ?>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modalsolicitudes" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>Instituciones a las que enviaste solicitudes de adhesi&oacute;n!</b></h4>
                    </div>
                    <br/>
                    <div class="container">
                        <div class="form">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <table id='insadherido' class='display' cellspacing='0' width='100%'>
                                        <thead>
                                        <tr>
                                            <th>Nombre</th><th>Cuit</th><th>Direcci&oacute;n</th><th>Tel&eacute;fono Fijo</th><th>Celular</th><th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($profesor_institucion as $prof_ins){
                                            $fic_ins = FichaInstitucion::model()->findByAttributes(array('id_institucion'=>$prof_ins->id_institucion));
                                            echo "<tr>";
                                            echo "<td id='nombre'>". $fic_ins->nombre . "</td>";
                                            echo "<td id='cuit'>". $fic_ins->cuit . "</td>";
                                            echo "<td id='direccion'>". $fic_ins->direccion . "</td>";
                                            echo "<td id='telfijo'>". $fic_ins->telfijo . "</td>";
                                            echo "<td id='celular'>". $fic_ins->celular . "</td>";
                                            if($prof_ins->id_estado == 1){
                                                echo "<td id='estado'><b>Estas adherido</b></td>";
                                            }
                                            if($prof_ins->id_estado == 0){
                                                echo "<td id='estado'><b>Solicitud pendiente</b></td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
        <?php
    }
}
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modalsolicitudes').modal('show');
    });

    $('#insadherido').DataTable( {
        'language' : {
            'sProcessing':     'Procesando...',
            'sLengthMenu':     'Mostrar _MENU_ registros',
            'sZeroRecords':    'No se encontraron resultados',
            'sEmptyTable':     'Ning�n dato disponible en esta tabla',
            'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
            'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
            'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
            'sInfoPostFix':    '',
            'sSearch':         'Buscar:',
            'sUrl':            '',
            'sInfoThousands':  ',',
            'sLoadingRecords': 'Cargando...',

            'oPaginate': {
                'sFirst':    'Primero',
                'sLast':     'Ultimo',
                'sNext':     'Siguiente',
                'sPrevious': 'Anterior'
            },

            'oAria': {
                'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                'sSortDescending': ': Activar para ordenar la columna de manera descendente'
            }
        }
    } );
</script>	
  		