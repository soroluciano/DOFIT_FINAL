<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
</head>

<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="active"><a>Hola! Administrador</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuración <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../site/indexAdmin">Home</a></li>
                                    <li><a href="../deporte/index">ABM Deportes</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?php echo CHtml::link('Salir', array('site/logout')); ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel_min slide" data-ride="carousel">
    <div class="carousel-inner_min" role="listbox">
        <div class="item active">
            <img class="first-slide_min" src="<?php echo Yii::app()->request->baseUrl; ?>/img/10.jpg" alt="First slide">
        </div>
    </div>
</div>

<div class="container">
    <?php
    echo  "<div><h2>Gimnasios</h2></div>";
    echo    "<table class='display' id='mostrargimnasios'  cellspacing='0' width='100%'>
                        <thead>
                                <th>Id</th>
                                <th>Email</th>
                                <th>.</th>
                        </thead>";
    echo "<tbody>";
    if($institucion != null) {
        foreach ($institucion as $d) {
            echo "<tr>
                                    <td>$d->id_institucion</td>
                                    <td>$d->email</td>
                                    <td><a href='../institucion/update/$d->id_institucion' class='btn btn-primary'>Modificar</a></td>
								  </tr>";
        }
    }
    else {
        echo "<td>No hay gimnasios creados aún</td>";
    }
    echo "</tbody></table>";
    ?>
    <br/>
    <a href="../institucion/create" class="btn btn-primary">
        Crear institución
    </a>
    <a href="../site/indexAdmin" class="btn btn-primary">Volver</a>
</div>

<br>
<br>
<br>
<br>
<br>
<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <p>
            &copy; 2015 DoFit.
            &middot;
            <a href="#">Privacidad</a>
            &middot;
            <a href="#">Terminos</a>
        </p>
    </div>
</footer>


<script type="text/javascript">
    $(document).ready(function(){
        $('#mostrargimnasios').DataTable( {
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
        } );
    });
</script>