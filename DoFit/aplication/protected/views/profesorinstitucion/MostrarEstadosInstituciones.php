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
<body>
<?php if(isset(Yii::app()->session['id_usuario'])){
    if($profesor_institucion != NULL){
        ?>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modalsolicitudes" aria-labelledby="myLargeModalLabel">
            <?php $this->renderPartial('../menu/_menu');?>
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
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#insadherido').DataTable( {
            'language' : {
                'sProcessing':     'Procesando...',
                'sLengthMenu':     'Mostrar _MENU_ registros',
                'sZeroRecords':    'No se encontraron resultados',
                'sEmptyTable':     'Ningún dato disponible en esta tabla',
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
        });
    });
	$('#modalsolicitudes').modal({
           backdrop: 'static',
           keyboard: false
	});
    $('#modalsolicitudes').modal('show');
</script>

