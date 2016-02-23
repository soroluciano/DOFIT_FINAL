<html>
<head>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.jqueryui.min.css"></link>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/datatable/css/dataTables.smoothness.css"></link>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/datatable/js/dataTables.jqueryui.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css"></link>
</head>

<?php if(!Yii::app()->user->isGuest){
    //Es un usuario logueado.
    $ins = Institucion::model()->findByPk(Yii::app()->user->id);
    $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
}
?>
<style type="text/css">
	ol, ul {
        list-style: none;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    caption, th, td {
        text-align: left;
        font-weight: normal;
        vertical-align: middle;
    }

    q, blockquote {
        quotes: none;
    }
    q:before, q:after, blockquote:before, blockquote:after {
        content: "";
        content: none;
    }

    a img {
        border: none;
    }

    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
        display: block;
    }

    .hamburgerMenu span, .hamburgerMenu::before, .hamburgerMenu::after {
        display: block;
        width: 30px;
        height: 4px;
        background: #fff;
        position: absolute;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }


    .hamburgerMenu {
        height: 30px;
        width: 30px;
        margin: 20px;
        position: absolute;
        right: 0;
        z-index: 99;
    }
    .hamburgerMenu span {
        top: 13px;
        right: 0;
    }
    .hamburgerMenu::before, .hamburgerMenu::after {
        content: "";
    }
    .hamburgerMenu::before {
        top: 4px;
        margin-bottom: 4px;
    }
    .hamburgerMenu::after {
        bottom: 4px;
        margin-top: 4px;
    }
    .hamburgerMenu:hover {
        cursor: pointer;
    }
    .hamburgerMenu.open span {
        opacity: 0;
    }
    .hamburgerMenu.open::before {
        width: 38px;
        top: 50%;
        margin-left: -4px;
        margin-top: -2px;
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .hamburgerMenu.open::after {
        width: 38px;
        bottom: 50%;
        margin-left: -4px;
        margin-bottom: -2px;
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .menu {
        position: absolute;
        right: 0px;
        top: 70px;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
        width:1px;
    }
    .menu span {
        display: block;
        color: #fff;
        text-align: right;
        padding: 10px 20px;
        box-sizing: border-box;
        position: relative;
        right: -220px;
        background: rgba(100, 100, 100, 0.7);
        margin-bottom: 5px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;

    }
    .menu span:nth-of-type(1) {
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }
    .menu span:nth-of-type(2) {
        -moz-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }
    .menu span:nth-of-type(3) {
        -moz-transition: all 0.6s ease;
        -o-transition: all 0.6s ease;
        -webkit-transition: all 0.6s ease;
        transition: all 0.6s ease;
    }
    .menu span:hover {
        font-size: 1.5em;
        background: #646464;
        color:white;
        cursor: pointer;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    .menu.open {
        width: 200px;
    }
    .menu.open span {
        right: 0px;
    }

    .menu a:link {
        text-decoration: none;

    }
    .menu a {
        color:white;
        font-weight:bolder;

    }

    #top{
        margin-bottom: 10%;
    }


    .logo{
        float:left;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.hamburgerMenu').click(function(){
            $(this).toggleClass('open');
            $('.menu').toggleClass('open');
        });
    });

</script>

<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <div class="hamburgerMenu"><span></span></div>
            <div class="menu">
                <span><a href="../../../aplication/institucion/home">Home</a></span>
                <span><a href="../../../aplication/ProfesorInstitucion/ListadoProfesores">Listado de Profesores</a></span>
                <span><a href="../../../aplication/institucion/ListadoAlumnosxInstitucion">Listado de Alumnos</a></span>
                <span><a href="../../../aplication/actividad/index">Actividades</a></span>
                <span><a href="../../../aplicationpago/index">Pagos</a></span>
                <span><?php echo CHtml::link('Salir', array('site/LoginInstitucion')); ?></span>
            </div>
            <div class="logo">
                <a href="../site/login"><img class="navbar-brand-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_blanco.png" alt="First slide"></a>
                <a href="../" class="navbar-brand"></a>
                <li></li>
            </div>
        </div>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="fuentemenu">
                    <?php
                    if(isset(Yii::app()->session['id_institucion'])){
                        //Es un usuario logueado.
                        $ins = Institucion::model()->findByPk(Yii::app()->user->id);
                        $fichains = FichaInstitucion::model()->find('id_institucion=:id_institucion',array(':id_institucion'=>$ins->id_institucion));
                        echo $fichains->nombre."&nbsp";
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div class="container" id="fondo">
    <div class='row'>
        <?php
        echo"<br>
        <br>
        <br>
        <br>
		<div><h3>Actividades de $ficha_usuario->nombre $ficha_usuario->apellido en $ficha_institucion->nombre</h3></div><br/>";?>
        <?php
        if($actividades_alumno != null) {
            echo "<table id='veractividades' class='display' cellspacing='0' width='100%'>
                <thead class='fuente'>
                  <tr><th>Deporte</th><th>Días y Horarios</th><th>Valor actividad</th><th>Desafectar actividad</th></tr>
                </thead>
                <tbody class='fuente'>";
            foreach ($actividades_alumno as $act_alum) {
                $act = Actividad::model()->findByAttributes(array('id_institucion' => $ins->id_institucion, 'id_actividad' => $act_alum->id_actividad));
                if ($act != null) {
                    echo "<tr>";
                    echo "<input type='hidden' value='$act_alum->id_usuario' id='idalumno'></input>";
                    $deporte = Deporte::model()->findByAttributes(array('id_deporte' =>$act->id_deporte));
                    echo "<td id='depo'>$deporte->deporte</td>";
                    $acti_horarios = ActividadHorario::model()->findAllByAttributes(array('id_actividad' => $act->id_actividad));
                    echo "<td id='diahor'>";
                    foreach($acti_horarios as $act_hor){
                        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
                        $id_dia = $act_hor->id_dia-1;
                        echo $dias[$id_dia]."&nbsp;".$act_hor->hora .':'.($act_hor->minutos == '0' ? '0'.$act_hor->minutos : $act_hor->minutos)." - ";
                    }
                    echo "</td>";
                    ?>
                    <td id='valor'><?php echo  $act->valor_actividad;?></td>
                    <td id='elim'><input type="button" value="Desafectar actividad" class="btn btn-primary" onClick="Javascript:desafectaractividad(<?php echo $act->id_actividad;?>);"></input></td>
                    </tr>
                    <?php
                    echo "
                     <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                         <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                      <h4 class='modal-title' id='myModalLabel'>Desafectar actividad</h4>
                  </div>
                  <div class='modal-body'>
                   ¿Estas seguro que desea desafectar a $ficha_usuario->nombre $ficha_usuario->apellido de la actividad?
                  </div>
                 <div class='modal-footer'>
                  <button type='button' class='btn btn-primary' id='si'>Si</button>
                  <button type='button' class='btn btn-default' id='no'>No</button>
                </div>
              </div>
                  </div>
                 </div>";
                // Modal ok
              echo "<div class='modal fade'  id='elimactexito' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                  <h4 class='modal-title' id='myModalLabel'>Eliminar Profesor</h4>
                               </div>
                            <div class='modal-body'>
                               Se elimino a $ficha_usuario->nombre $ficha_usuario->apellido de la actividad con éxito.
                            </div>
                            <div class='modal-footer'>
                                <input type='button' value='Cerrar' id='cerrarelimact' class='btn btn-primary'></input>
                            </div>
                          </div>
                        </div>
                    </div>";
                }
            }
            echo "</tbody>
               </table>";?>
               <br/>
               <input id='volver' onClick="location.href='../../../aplication/institucion/ListadoAlumnosxInstitucion'" class='btn btn-primary' type='button' value='Volver al listado de alumnos'></input>
        <?php
        }	
        ?>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $("#volver").css("float","right");
        $("#cerrarelimact").click(function(){
            $("#elimactexito").modal('hide');
            location.reload();
        });

    });
</script>
<script type="text/javascript">
    function desafectaractividad(idact)
    {
        $("#myModal").modal('show');
        $("#si").click(function(){
            var idactividad;
            idactividad = idact;
            var idalumno = $('#idalumno').val();
            var data = {"idactividad":idactividad,"idalumno":idalumno};
            $.ajax({
                url :  baseurl + "/actividadalumno/DesafectarActividad",
                type: "POST",
                dataType : "html",
                data : data,
                cache: false,
                success: function (response){
                    if(response == "ok"){
						$("#myModal").modal('hide');
						$("#elimactexito").modal('show');
                    }
                    if (response == "error"){
                        $('#mensajeerror').modal('show');
                    }
                }	,
                error: function (e) {
                    console.log(e);
                }
            });
        });
        $("#no").click(function(){
            location.reload();
        });

    }
</script>

<script type="text/javascript">
    $('#veractividades').DataTable( {
        "language" : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",

            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Ultimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    } );
</script>			 